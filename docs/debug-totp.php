<?php

// Debug Base32 decoding
$secret = 'GEZDGNBVGY3TQOJQ';
$base32chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567';

// Decode manually
$bits = '';
for ($i = 0; $i < strlen($secret); $i++) {
    $char = $secret[$i];
    $val = strpos($base32chars, $char);
    echo "$i: $char = $val = " . str_pad(decbin($val), 5, '0', STR_PAD_LEFT) . "\n";
    $bits .= str_pad(decbin($val), 5, '0', STR_PAD_LEFT);
}

echo "\nTotal bits: " . strlen($bits) . "\n";
echo "Total bytes: " . (strlen($bits) / 8) . "\n";

// Convert to bytes
$byteSecret = '';
echo "\nByte conversion:\n";
for ($i = 0; $i + 8 <= strlen($bits); $i += 8) {
    $byteBits = substr($bits, $i, 8);
    $byte = bindec($byteBits);
    echo "Byte " . ($i / 8) . ": $byteBits = " . dechex($byte) . "\n";
    $byteSecret .= chr($byte);
}

echo "\nDecoded secret (hex): " . bin2hex($byteSecret) . "\n";
echo "Decoded secret length: " . strlen($byteSecret) . " bytes\n";

// Test with HMAC
echo "\n=== Testing TOTP at time 59 ===\n";
$timestamp = 59;
$timeCounter = intdiv($timestamp, 30);
echo "Time: $timestamp\n";
echo "Counter: $timeCounter\n";

$msg = pack('N2', 0, $timeCounter);
echo "Message (hex): " . bin2hex($msg) . "\n";

$hmac = hash_hmac('sha1', $msg, $byteSecret, true);
echo "HMAC (hex): " . bin2hex($hmac) . "\n";

$offset = ord(substr($hmac, -1)) & 0x0f;
echo "Offset: $offset\n";

$fourBytes = substr($hmac, $offset, 4);
echo "Four bytes at offset (hex): " . bin2hex($fourBytes) . "\n";

$token = unpack('N', $fourBytes)[1];
echo "Token (int): $token\n";

$token = ($token & 0x7fffffff) % 1000000;
echo "Token after mask (int): $token\n";

$totp = str_pad($token, 6, '0', STR_PAD_LEFT);
echo "TOTP: $totp\n";
echo "Expected: 287082\n";
