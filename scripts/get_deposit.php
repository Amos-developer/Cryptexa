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
echo "DEPOSIT_ID=" . $d->id . PHP_EOL;
echo "PAYMENT_ID=" . ($d->payment_id ?? 'NULL') . PHP_EOL;
echo "STATUS=" . $d->status . PHP_EOL;
