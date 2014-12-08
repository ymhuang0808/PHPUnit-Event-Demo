PHPUnit-Event-Demo
==================

## Branch: test2 

### 目錄結構
* src - 程式
* tests - 測試程式
* vendor - Composer 套件

### 說明

* src/PHPUnitEventDemo/
    * Event.php - 活動類別
    * User.php - 使用者類別
* tests/
    * EventTest.php - 測試 `Event` 類別

### 修正的問題
* tests/EventTest.php - 分成 `testReserve()`, `testUnreserve()` ，使用 `@depends` 取得來自 `testReserve()` 的活動物件

