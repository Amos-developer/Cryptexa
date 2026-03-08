<?php

// Test TOTP verification function
function verifyTotp($code, $secret)
{
    $secret = strtoupper(trim($secret));
    $secret = str_replace(' ', '', $secret);

    $base32chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567';
    $bits = '';
    $byteSecret = '';

    for ($i = 0; $i < strlen($secret); $i++) {
        $char = $secret[$i];
        $val = strpos($base32chars, $char);

        if ($val === false) {
            return false;
        }

        $bits .= str_pad(decbin($val), 5, '0', STR_PAD_LEFT);
    }

    for ($i = 0; $i < strlen($bits); $i += 8) {
        $byte = substr($bits, $i, 8);
        if (strlen($byte) == 8) {
            $byteSecret .= chr(bindec($byte));
        }
    }

    if (strlen($byteSecret) === 0) {
        return false;
    }

    $timeCounter = floor(time() / 30);

    for ($i = -1; $i <= 1; $i++) {
        $timestamp = $timeCounter + $i;
        $msg = pack('N*', 0);
        $msg .= pack('N*', $timestamp);

        $hmac = hash_hmac('sha1', $msg, $byteSecret, true);
        $offset = ord($hmac[19]) & 0xf;
        $fourBytes = substr($hmac, $offset, 4);

        if (strlen($fourBytes) < 4) {
            continue;
        }

        $value = unpack('N', $fourBytes)[1];
        $value = $value & 0x7fffffff;
        $totp = $value % 1000000;
        $totp = str_pad($totp, 6, '0', STR_PAD_LEFT);

        echo "Generated TOTP for window $i: $totp\n";

        if ($totp == $code) {
            return true;
        }
    }

    return false;
}

// Test with a known test vector
// Using a standard test vector from RFC 6238
$testSecret = 'GEZDGNBVGY3TQOJQ';  // Base32 for 'Ñoño' or a test vector

echo "Test TOTP Verification\n";
echo "Secret: $testSecret\n";
echo "Current time: " . date('Y-m-d H:i:s') . "\n";
echo "Unix timestamp: " . time() . "\n";
echo "\nGenerating codes for testing...\n";

// Test function that generates TOTP
function generateTotp($secret, $timestamp)
{
    $secret = strtoupper(trim($secret));
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

    for ($i = 0; $i < strlen($bits); $i += 8) {
        $byte = substr($bits, $i, 8);
        if (strlen($byte) == 8) {
            $byteSecret .= chr(bindec($byte));
        }
    }

    $timeCounter = floor($timestamp / 30);
    $msg = pack('N*', 0) . pack('N*', $timeCounter);

    $hmac = hash_hmac('sha1', $msg, $byteSecret, true);
    $offset = ord($hmac[19]) & 0xf;
    $fourBytes = substr($hmac, $offset, 4);

    $value = unpack('N', $fourBytes)[1];
    $value = $value & 0x7fffffff;
    $totp = $value % 1000000;

    return str_pad($totp, 6, '0', STR_PAD_LEFT);
}

$currentTime = time();
echo "Previous window: " . generateTotp($testSecret, $currentTime - 30) . "\n";
echo "Current window:  " . generateTotp($testSecret, $currentTime) . "\n";
echo "Next window:     " . generateTotp($testSecret, $currentTime + 30) . "\n";
