PHPUnit-Event-Demo
==================

== 分支說明

* start - 起始專案
    * 基本目錄架構，autoloading 功能
* test1 - 測試活動的報名功能
* test2-with-reserve-and-unreserve - 活動的報名與取消報名功能的測試，放在同一個測試案例內
* test2 - 活動報名與取消的兩個功能測試分開
    * 利用 `@depends` 改善 test2-with-reserve-and-unreserve 分支的問題
* test3-with-data-and-test-case - 測試案例與被測試的資料，放在同一個測試案例內
* test3 - 被測試的資料與測試案例分開，寫成 **Data Provider**
* test3-data-provider-with-depends - 錯誤的範例，`@depends` 與 `@dataProvider`混用
    * 被依賴的測試，如果使用了 `@dataProvider`，會造成依賴的測試沒辦法正確傳入值
* test4 - 測試預期異常
* test4-with-fixtures - 將建立、釋放活動物件，寫成 `setUp()`, `tearDown()`


