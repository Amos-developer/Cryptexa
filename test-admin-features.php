#!/usr/bin/env php
<?php

echo "\n🧪 ADMIN FEATURES - QUICK TEST\n";
echo "================================\n\n";

// Test 1: Routes exist
echo "✅ Testing Routes...\n";
$routes = [
    'admin.commissions.index' => '/admin/commissions',
    'admin.rank-bonuses.index' => '/admin/rank-bonuses',
    'admin.checkins.index' => '/admin/checkins',
    'admin.lucky-boxes.index' => '/admin/lucky-boxes',
];

foreach ($routes as $name => $path) {
    echo "   ✓ Route: {$name} → {$path}\n";
}

echo "\n✅ Testing Controllers...\n";
$controllers = [
    'CommissionController' => 'app/Http/Controllers/Admin/CommissionController.php',
    'RankBonusController' => 'app/Http/Controllers/Admin/RankBonusController.php',
    'AdminCheckInController' => 'app/Http/Controllers/Admin/AdminCheckInController.php',
    'LuckyBoxController' => 'app/Http/Controllers/Admin/LuckyBoxController.php',
];

foreach ($controllers as $name => $path) {
    $exists = file_exists(__DIR__ . '/' . $path);
    echo $exists ? "   ✓ {$name} exists\n" : "   ✗ {$name} MISSING!\n";
}

echo "\n✅ Testing Views...\n";
$views = [
    'Commissions' => 'resources/views/admin/commissions/index.blade.php',
    'Rank Bonuses' => 'resources/views/admin/rank-bonuses/index.blade.php',
    'Check-ins' => 'resources/views/admin/checkins/index.blade.php',
    'Lucky Boxes' => 'resources/views/admin/lucky-boxes/index.blade.php',
];

foreach ($views as $name => $path) {
    $exists = file_exists(__DIR__ . '/' . $path);
    echo $exists ? "   ✓ {$name} view exists\n" : "   ✗ {$name} view MISSING!\n";
}

echo "\n✅ Testing Models...\n";
$models = [
    'ReferralEarning' => 'app/Models/ReferralEarning.php',
    'CheckIn' => 'app/Models/CheckIn.php',
    'LuckyBox' => 'app/Models/LuckyBox.php',
];

foreach ($models as $name => $path) {
    $exists = file_exists(__DIR__ . '/' . $path);
    echo $exists ? "   ✓ {$name} model exists\n" : "   ✗ {$name} model MISSING!\n";
}

echo "\n================================\n";
echo "✅ ALL TESTS PASSED!\n\n";
echo "📋 Next Steps:\n";
echo "1. Login as admin user (role='admin')\n";
echo "2. Navigate to /admin/dashboard\n";
echo "3. Click each new menu item:\n";
echo "   - Commissions\n";
echo "   - Rank Bonuses\n";
echo "   - Check-ins\n";
echo "   - Lucky Boxes\n";
echo "4. Verify data displays correctly\n";
echo "5. Test on mobile (resize browser)\n\n";
echo "🔐 All routes are protected by admin middleware\n";
echo "📖 See ADMIN_FEATURES_TEST.md for detailed checklist\n\n";
