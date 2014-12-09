PHPUnit-Event-Demo
==================

## Branch: test3-data-provider-with-depends

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

### 問題
* tests/EventTest.php - 將 `testUnreserve()` 依賴 `testAttendeeLimitReserve()`，會發生以下問題：
    ```
    PHPUnit 4.3.5 by Sebastian Bergmann.

    ...PHP Fatal error:  Call to a member function unreserve() on a non-object in /Users/phpunit/git/PHPUnit-Event-Demo/tests/EventTest.php on line 114

    (ignore...)

    Fatal error: Call to a member function unreserve() on a non-object in /Users/phpunit/git/PHPUnit-Event-Demo/tests/EventTest.php on line 114

    (ignore...)
    ``` 

    造成 `testUnreserve()` 無法取得傳入參數的物件，所以 `@depends` 無法依賴使用 `@dataProvider` 的測試。