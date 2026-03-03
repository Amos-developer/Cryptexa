# Spanish
(Get-Content "lang\es\spanish.php" -Encoding UTF8) -replace "'liquidity_pools' => '.*'", "'liquidity_pools' => 'Bóvedas de Inversión'" | Set-Content "lang\es\spanish.php" -Encoding UTF8
(Get-Content "resources\lang\es\spanish.php" -Encoding UTF8) -replace "'liquidity_pools' => '.*'", "'liquidity_pools' => 'Bóvedas de Inversión'" | Set-Content "resources\lang\es\spanish.php" -Encoding UTF8

# French  
(Get-Content "lang\fr\french.php" -Encoding UTF8) -replace "'liquidity_pools' => '.*'", "'liquidity_pools' => 'Coffres d''Investissement'" | Set-Content "lang\fr\french.php" -Encoding UTF8
(Get-Content "resources\lang\fr\french.php" -Encoding UTF8) -replace "'liquidity_pools' => '.*'", "'liquidity_pools' => 'Coffres d''Investissement'" | Set-Content "resources\lang\fr\french.php" -Encoding UTF8

# German
(Get-Content "lang\de\german.php" -Encoding UTF8) -replace "'liquidity_pools' => '.*'", "'liquidity_pools' => 'Investitionstresore'" | Set-Content "lang\de\german.php" -Encoding UTF8
(Get-Content "resources\lang\de\german.php" -Encoding UTF8) -replace "'liquidity_pools' => '.*'", "'liquidity_pools' => 'Investitionstresore'" | Set-Content "resources\lang\de\german.php" -Encoding UTF8

# Portuguese
(Get-Content "lang\pt\portuguese.php" -Encoding UTF8) -replace "'liquidity_pools' => '.*'", "'liquidity_pools' => 'Cofres de Investimento'" | Set-Content "lang\pt\portuguese.php" -Encoding UTF8
(Get-Content "resources\lang\pt\portuguese.php" -Encoding UTF8) -replace "'liquidity_pools' => '.*'", "'liquidity_pools' => 'Cofres de Investimento'" | Set-Content "resources\lang\pt\portuguese.php" -Encoding UTF8

# Italian
(Get-Content "lang\it\italian.php" -Encoding UTF8) -replace "'liquidity_pools' => '.*'", "'liquidity_pools' => 'Casseforti di Investimento'" | Set-Content "lang\it\italian.php" -Encoding UTF8
(Get-Content "resources\lang\it\italian.php" -Encoding UTF8) -replace "'liquidity_pools' => '.*'", "'liquidity_pools' => 'Casseforti di Investimento'" | Set-Content "resources\lang\it\italian.php" -Encoding UTF8

# Dutch
(Get-Content "lang\nl\dutch.php" -Encoding UTF8) -replace "'liquidity_pools' => '.*'", "'liquidity_pools' => 'Investeringskluizen'" | Set-Content "lang\nl\dutch.php" -Encoding UTF8
(Get-Content "resources\lang\nl\dutch.php" -Encoding UTF8) -replace "'liquidity_pools' => '.*'", "'liquidity_pools' => 'Investeringskluizen'" | Set-Content "resources\lang\nl\dutch.php" -Encoding UTF8

# Polish
(Get-Content "lang\pl\polish.php" -Encoding UTF8) -replace "'liquidity_pools' => '.*'", "'liquidity_pools' => 'Skarbce Inwestycyjne'" | Set-Content "lang\pl\polish.php" -Encoding UTF8
(Get-Content "resources\lang\pl\polish.php" -Encoding UTF8) -replace "'liquidity_pools' => '.*'", "'liquidity_pools' => 'Skarbce Inwestycyjne'" | Set-Content "resources\lang\pl\polish.php" -Encoding UTF8

# Turkish
(Get-Content "lang\tr\turkish.php" -Encoding UTF8) -replace "'liquidity_pools' => '.*'", "'liquidity_pools' => 'Yatirim Kasalari'" | Set-Content "lang\tr\turkish.php" -Encoding UTF8
(Get-Content "resources\lang\tr\turkish.php" -Encoding UTF8) -replace "'liquidity_pools' => '.*'", "'liquidity_pools' => 'Yatirim Kasalari'" | Set-Content "resources\lang\tr\turkish.php" -Encoding UTF8

# Indonesian
(Get-Content "lang\id\indonesian.php" -Encoding UTF8) -replace "'liquidity_pools' => '.*'", "'liquidity_pools' => 'Brankas Investasi'" | Set-Content "lang\id\indonesian.php" -Encoding UTF8
(Get-Content "resources\lang\id\indonesian.php" -Encoding UTF8) -replace "'liquidity_pools' => '.*'", "'liquidity_pools' => 'Brankas Investasi'" | Set-Content "resources\lang\id\indonesian.php" -Encoding UTF8

# Vietnamese
(Get-Content "lang\vi\vietnamese.php" -Encoding UTF8) -replace "'liquidity_pools' => '.*'", "'liquidity_pools' => 'Ket Dau Tu'" | Set-Content "lang\vi\vietnamese.php" -Encoding UTF8
(Get-Content "resources\lang\vi\vietnamese.php" -Encoding UTF8) -replace "'liquidity_pools' => '.*'", "'liquidity_pools' => 'Ket Dau Tu'" | Set-Content "resources\lang\vi\vietnamese.php" -Encoding UTF8

Write-Host "All language files updated successfully!"
