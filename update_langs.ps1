$translations = @{
    'spanish' = 'Bóvedas de Inversión'
    'french' = "Coffres d'Investissement"
    'german' = 'Investitionstresore'
    'chinese' = '投资金库'
    'japanese' = '投資ボールト'
    'korean' = '투자 금고'
    'portuguese' = 'Cofres de Investimento'
    'russian' = 'Инвестиционные Хранилища'
    'arabic' = 'خزائن الاستثمار'
    'hindi' = 'निवेश तिजोरी'
    'italian' = 'Casseforti di Investimento'
    'dutch' = 'Investeringskluizen'
    'polish' = 'Skarbce Inwestycyjne'
    'turkish' = 'Yatırım Kasaları'
    'vietnamese' = 'Két Đầu Tư'
    'thai' = 'ตู้นิรภัยการลงทุน'
    'indonesian' = 'Brankas Investasi'
}

foreach ($lang in $translations.Keys) {
    $file1 = "lang\*\$lang.php"
    $file2 = "resources\lang\*\$lang.php"
    
    Get-ChildItem $file1 -ErrorAction SilentlyContinue | ForEach-Object {
        (Get-Content $_.FullName) -replace "'liquidity_pools' => '.*'", "'liquidity_pools' => '$($translations[$lang])'" | Set-Content $_.FullName
        Write-Host "Updated: $($_.FullName)"
    }
    
    Get-ChildItem $file2 -ErrorAction SilentlyContinue | ForEach-Object {
        (Get-Content $_.FullName) -replace "'liquidity_pools' => '.*'", "'liquidity_pools' => '$($translations[$lang])'" | Set-Content $_.FullName
        Write-Host "Updated: $($_.FullName)"
    }
}

Write-Host "All language files updated!"
