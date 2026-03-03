@echo off
echo Updating all language files...

REM Spanish
powershell -Command "(Get-Content 'lang\es\spanish.php') -replace \"'liquidity_pools' => '.*'\", \"'liquidity_pools' => 'Bóvedas de Inversión'\" | Set-Content 'lang\es\spanish.php'"
powershell -Command "(Get-Content 'resources\lang\es\spanish.php') -replace \"'liquidity_pools' => '.*'\", \"'liquidity_pools' => 'Bóvedas de Inversión'\" | Set-Content 'resources\lang\es\spanish.php'"

REM French
powershell -Command "(Get-Content 'lang\fr\french.php') -replace \"'liquidity_pools' => '.*'\", \"'liquidity_pools' => 'Coffres d''Investissement'\" | Set-Content 'lang\fr\french.php'"
powershell -Command "(Get-Content 'resources\lang\fr\french.php') -replace \"'liquidity_pools' => '.*'\", \"'liquidity_pools' => 'Coffres d''Investissement'\" | Set-Content 'resources\lang\fr\french.php'"

REM German
powershell -Command "(Get-Content 'lang\de\german.php') -replace \"'liquidity_pools' => '.*'\", \"'liquidity_pools' => 'Investitionstresore'\" | Set-Content 'lang\de\german.php'"
powershell -Command "(Get-Content 'resources\lang\de\german.php') -replace \"'liquidity_pools' => '.*'\", \"'liquidity_pools' => 'Investitionstresore'\" | Set-Content 'resources\lang\de\german.php'"

REM Chinese
powershell -Command "(Get-Content 'lang\zh\chinese.php') -replace \"'liquidity_pools' => '.*'\", \"'liquidity_pools' => '投资金库'\" | Set-Content 'lang\zh\chinese.php'"
powershell -Command "(Get-Content 'resources\lang\zh\chinese.php') -replace \"'liquidity_pools' => '.*'\", \"'liquidity_pools' => '投资金库'\" | Set-Content 'resources\lang\zh\chinese.php'"

REM Japanese
powershell -Command "(Get-Content 'lang\ja\japanese.php') -replace \"'liquidity_pools' => '.*'\", \"'liquidity_pools' => '投資ボールト'\" | Set-Content 'lang\ja\japanese.php'"
powershell -Command "(Get-Content 'resources\lang\ja\japanese.php') -replace \"'liquidity_pools' => '.*'\", \"'liquidity_pools' => '投資ボールト'\" | Set-Content 'resources\lang\ja\japanese.php'"

REM Korean
powershell -Command "(Get-Content 'lang\ko\korean.php') -replace \"'liquidity_pools' => '.*'\", \"'liquidity_pools' => '투자 금고'\" | Set-Content 'lang\ko\korean.php'"
powershell -Command "(Get-Content 'resources\lang\ko\korean.php') -replace \"'liquidity_pools' => '.*'\", \"'liquidity_pools' => '투자 금고'\" | Set-Content 'resources\lang\ko\korean.php'"

REM Portuguese
powershell -Command "(Get-Content 'lang\pt\portuguese.php') -replace \"'liquidity_pools' => '.*'\", \"'liquidity_pools' => 'Cofres de Investimento'\" | Set-Content 'lang\pt\portuguese.php'"
powershell -Command "(Get-Content 'resources\lang\pt\portuguese.php') -replace \"'liquidity_pools' => '.*'\", \"'liquidity_pools' => 'Cofres de Investimento'\" | Set-Content 'resources\lang\pt\portuguese.php'"

REM Russian
powershell -Command "(Get-Content 'lang\ru\russian.php') -replace \"'liquidity_pools' => '.*'\", \"'liquidity_pools' => 'Инвестиционные Хранилища'\" | Set-Content 'lang\ru\russian.php'"
powershell -Command "(Get-Content 'resources\lang\ru\russian.php') -replace \"'liquidity_pools' => '.*'\", \"'liquidity_pools' => 'Инвестиционные Хранилища'\" | Set-Content 'resources\lang\ru\russian.php'"

REM Arabic
powershell -Command "(Get-Content 'lang\ar\arabic.php') -replace \"'liquidity_pools' => '.*'\", \"'liquidity_pools' => 'خزائن الاستثمار'\" | Set-Content 'lang\ar\arabic.php'"
powershell -Command "(Get-Content 'resources\lang\ar\arabic.php') -replace \"'liquidity_pools' => '.*'\", \"'liquidity_pools' => 'خزائن الاستثمار'\" | Set-Content 'resources\lang\ar\arabic.php'"

REM Hindi
powershell -Command "(Get-Content 'lang\hi\hindi.php') -replace \"'liquidity_pools' => '.*'\", \"'liquidity_pools' => 'निवेश तिजोरी'\" | Set-Content 'lang\hi\hindi.php'"
powershell -Command "(Get-Content 'resources\lang\hi\hindi.php') -replace \"'liquidity_pools' => '.*'\", \"'liquidity_pools' => 'निवेश तिजोरी'\" | Set-Content 'resources\lang\hi\hindi.php'"

REM Italian
powershell -Command "(Get-Content 'lang\it\italian.php') -replace \"'liquidity_pools' => '.*'\", \"'liquidity_pools' => 'Casseforti di Investimento'\" | Set-Content 'lang\it\italian.php'"
powershell -Command "(Get-Content 'resources\lang\it\italian.php') -replace \"'liquidity_pools' => '.*'\", \"'liquidity_pools' => 'Casseforti di Investimento'\" | Set-Content 'resources\lang\it\italian.php'"

REM Dutch
powershell -Command "(Get-Content 'lang\nl\dutch.php') -replace \"'liquidity_pools' => '.*'\", \"'liquidity_pools' => 'Investeringskluizen'\" | Set-Content 'lang\nl\dutch.php'"
powershell -Command "(Get-Content 'resources\lang\nl\dutch.php') -replace \"'liquidity_pools' => '.*'\", \"'liquidity_pools' => 'Investeringskluizen'\" | Set-Content 'resources\lang\nl\dutch.php'"

REM Polish
powershell -Command "(Get-Content 'lang\pl\polish.php') -replace \"'liquidity_pools' => '.*'\", \"'liquidity_pools' => 'Skarbce Inwestycyjne'\" | Set-Content 'lang\pl\polish.php'"
powershell -Command "(Get-Content 'resources\lang\pl\polish.php') -replace \"'liquidity_pools' => '.*'\", \"'liquidity_pools' => 'Skarbce Inwestycyjne'\" | Set-Content 'resources\lang\pl\polish.php'"

REM Turkish
powershell -Command "(Get-Content 'lang\tr\turkish.php') -replace \"'liquidity_pools' => '.*'\", \"'liquidity_pools' => 'Yatırım Kasaları'\" | Set-Content 'lang\tr\turkish.php'"
powershell -Command "(Get-Content 'resources\lang\tr\turkish.php') -replace \"'liquidity_pools' => '.*'\", \"'liquidity_pools' => 'Yatırım Kasaları'\" | Set-Content 'resources\lang\tr\turkish.php'"

REM Vietnamese
powershell -Command "(Get-Content 'lang\vi\vietnamese.php') -replace \"'liquidity_pools' => '.*'\", \"'liquidity_pools' => 'Két Đầu Tư'\" | Set-Content 'lang\vi\vietnamese.php'"
powershell -Command "(Get-Content 'resources\lang\vi\vietnamese.php') -replace \"'liquidity_pools' => '.*'\", \"'liquidity_pools' => 'Két Đầu Tư'\" | Set-Content 'resources\lang\vi\vietnamese.php'"

REM Thai
powershell -Command "(Get-Content 'lang\th\thai.php') -replace \"'liquidity_pools' => '.*'\", \"'liquidity_pools' => 'ตู้นิรภัยการลงทุน'\" | Set-Content 'lang\th\thai.php'"
powershell -Command "(Get-Content 'resources\lang\th\thai.php') -replace \"'liquidity_pools' => '.*'\", \"'liquidity_pools' => 'ตู้นิรภัยการลงทุน'\" | Set-Content 'resources\lang\th\thai.php'"

REM Indonesian
powershell -Command "(Get-Content 'lang\id\indonesian.php') -replace \"'liquidity_pools' => '.*'\", \"'liquidity_pools' => 'Brankas Investasi'\" | Set-Content 'lang\id\indonesian.php'"
powershell -Command "(Get-Content 'resources\lang\id\indonesian.php') -replace \"'liquidity_pools' => '.*'\", \"'liquidity_pools' => 'Brankas Investasi'\" | Set-Content 'resources\lang\id\indonesian.php'"

echo Done! All language files updated.
