<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
$d = \App\Models\Deposit::find(126);
if (!$d) {
    echo "DEPOSIT_NOT_FOUND\n";
    exit(1);
}
$u = $d->user;
echo "DEPOSIT_ID=" . $d->id . PHP_EOL;
echo "PAYMENT_ID=" . ($d->payment_id ?? 'NULL') . PHP_EOL;
echo "STATUS=" . $d->status . PHP_EOL;
echo "USER_ID=" . $u->id . PHP_EOL;
echo "USER_BALANCE=" . $u->balance . PHP_EOL;
echo "USER_REFERRAL_EARNINGS=" . $u->referral_earnings . PHP_EOL;
// print first 3 referrers balances
$ref = $u->referrer;
$level = 1;
while ($ref && $level <= 6) {
    echo "REF_LEVEL_" . $level . "_ID=" . $ref->id . " BALANCE=" . $ref->balance . " REF_EARNINGS=" . $ref->referral_earnings . PHP_EOL;
    $ref = $ref->referrer;
    $level++;
}
