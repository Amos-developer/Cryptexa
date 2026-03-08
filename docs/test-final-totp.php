<?php

// Test the new TOTP implementation
function base32Decode($input)
{
    $baseMap = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567';
    $input = strtoupper($input);
    $bits = '';

    for ($i = 0; $i < strlen($input); $i++) {
        $idx = strpos($baseMap, $input[$i]);
        if ($idx === false) {
            continue;
        }
        $bits .= str_pad(decbin($idx), 5, '0', STR_PAD_LEFT);
    }

    $ret = '';
    for ($i = 0; $i + 8 <= strlen($bits); $i += 8) {
        $ret .= chr(bindec(substr($bits, $i, 8)));
    }
    return $ret;
}

function generateTotp($secret, $timestamp)
{
    $secret = preg_replace('/[^A-Z2-7]/', '', strtoupper($secret));
    $key = base32Decode($secret);

    if (strlen($key) < 8) {
        return null;
    }

    // Time counter
    $timeCounter = intdiv($timestamp, 30);

    // Pack timestamp as 64-bit big-endian
    $binary = '';
    for ($j = 7; $j >= 0; $j--) {
        $binary .= chr(($timeCounter >> ($j * 8)) & 0xff);
    }

    // Calculate HMAC-SHA1
    $hmac = hash_hmac('sha1', $binary, $key, true);

    // Extract offset
    $offset = ord(substr($hmac, -1)) & 0x0f;

    // Extract 4 bytes
    $value = 0;
    for ($j = 0; $j < 4; $j++) {
        $value = ($value << 8) | ord(substr($hmac, $offset + $j, 1));
    }

    // Mask and modulo
    $token = ($value & 0x7fffffff) % 1000000;
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

    echo "Time: $timestamp | Expected: $expectedCode | Generated: $generatedCode | " . ($passed ? "PASS ✓" : "FAIL ✗") . "\n";
}

echo "\n=====================================\n";
echo "Overall Result: " . ($allPassed ? "ALL TESTS PASSED ✓" : "SOME TESTS FAILED ✗") . "\n";
