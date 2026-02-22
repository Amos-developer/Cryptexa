<?php

// RFC 6238 Test Vectors - Verify TOTP algorithm
function generateTotp($secret, $timestamp)
{
    $secret = strtoupper(trim($secret));
    $secret = str_replace('=', '', $secret);
    $secret = str_replace(' ', '', $secret);

    $base32chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567';
    $bits = '';
    $byteSecret = '';

    for ($i = 0; $i < strlen($secret); $i++) {
        $char = $secret[$i];
        $val = strpos($base32chars, $char);

        if ($val === false) {
            return null;
        }

        $bits .= str_pad(decbin($val), 5, '0', STR_PAD_LEFT);
    }

    // Convert bits to bytes - only complete bytes
    for ($i = 0; $i + 8 <= strlen($bits); $i += 8) {
        $byteSecret .= chr(bindec(substr($bits, $i, 8)));
    }

    if (strlen($byteSecret) < 10) {
        return null;
    }

    // Time counter
    $timeCounter = intdiv($timestamp, 30);

    // Pack timestamp as 64-bit big-endian
    $msg = pack('N2', 0, $timeCounter);

    // Generate HMAC-SHA1
    $hmac = hash_hmac('sha1', $msg, $byteSecret, true);

    // Extract offset from last 4 bits of HMAC
    $offset = ord(substr($hmac, -1)) & 0x0f;
    $fourBytes = substr($hmac, $offset, 4);

    // Convert to token
    $token = unpack('N', $fourBytes)[1];
    $token = ($token & 0x7fffffff) % 1000000;

    return str_pad($token, 6, '0', STR_PAD_LEFT);
}

// Test with RFC 6238 vectors
$secret = 'GEZDGNBVGY3TQOJQ';

$testVectors = [
    59 => '287082',
    1111111109 => '081804',
    1111111111 => '050471',
    1235996800 => '005924',
    1241920971 => '279037',
    1500000000 => '254676',
    2000000000 => '287922',
    20000000000 => '553285',
];

echo "RFC 6238 Test Vector Validation\n";
echo "Secret: $secret\n";
echo "=====================================\n";

$allPassed = true;
foreach ($testVectors as $timestamp => $expectedCode) {
    $generatedCode = generateTotp($secret, $timestamp);
    $passed = ($generatedCode === $expectedCode);
    $allPassed = $allPassed && $passed;

    echo "Time: $timestamp\n";
    echo "Expected: $expectedCode\n";
    echo "Generated: $generatedCode\n";
    echo "Status: " . ($passed ? "PASS ✓" : "FAIL ✗") . "\n";
    echo "---\n";
}

echo "\n=====================================\n";
echo "Overall Result: " . ($allPassed ? "ALL TESTS PASSED ✓" : "SOME TESTS FAILED ✗") . "\n";
