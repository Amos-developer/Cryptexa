<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Http\Request;

$payload = ['id' => '4685312166', 'payment_status' => 'finished', 'price_amount' => 50];

$request = Request::create('/nowpayments/ipn', 'POST', [], [], [], [], json_encode($payload));
$request->headers->set('Content-Type', 'application/json');

$controller = new \App\Http\Controllers\NowPaymentsWebhookController();
$now = $app->make(\App\Services\NowPaymentsService::class);

$response = $controller->handle($request, $now);

echo "Controller response status: " . ($response->getStatusCode() ?? 'NULL') . PHP_EOL;
echo "Controller response body: " . ($response->getContent() ?? '') . PHP_EOL;
