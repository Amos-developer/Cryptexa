<?php
// Test pagination directly
require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

// Simulate request with checkins_page=2
$_GET['checkins_page'] = 2;
$request = Illuminate\Http\Request::capture();

$checkins = App\Models\CheckIn::with('user')
    ->orderBy('created_at', 'desc')
    ->paginate(10, ['*'], 'checkins_page');

echo "Current Page: " . $checkins->currentPage() . PHP_EOL;
echo "Total: " . $checkins->total() . PHP_EOL;
echo "Per Page: " . $checkins->perPage() . PHP_EOL;
echo "First Item: " . $checkins->firstItem() . PHP_EOL;
echo "Last Item: " . $checkins->lastItem() . PHP_EOL;
echo "IDs: " . $checkins->pluck('id')->implode(', ') . PHP_EOL;
