<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2023-06-24 13:38:05 --> Severity: 8192 --> Return type of CI_Session_files_driver::open($save_path, $name) should either be compatible with SessionHandlerInterface::open(string $path, string $name): bool, or the #[\ReturnTypeWillChange] attribute should be used to temporarily suppress the notice /var/www/html/Cliffs_Internation/system/libraries/Session/drivers/Session_files_driver.php 132
ERROR - 2023-06-24 13:38:05 --> Severity: 8192 --> Return type of CI_Session_files_driver::close() should either be compatible with SessionHandlerInterface::close(): bool, or the #[\ReturnTypeWillChange] attribute should be used to temporarily suppress the notice /var/www/html/Cliffs_Internation/system/libraries/Session/drivers/Session_files_driver.php 290
ERROR - 2023-06-24 13:38:05 --> Severity: 8192 --> Return type of CI_Session_files_driver::read($session_id) should either be compatible with SessionHandlerInterface::read(string $id): string|false, or the #[\ReturnTypeWillChange] attribute should be used to temporarily suppress the notice /var/www/html/Cliffs_Internation/system/libraries/Session/drivers/Session_files_driver.php 164
ERROR - 2023-06-24 13:38:05 --> Severity: 8192 --> Return type of CI_Session_files_driver::write($session_id, $session_data) should either be compatible with SessionHandlerInterface::write(string $id, string $data): bool, or the #[\ReturnTypeWillChange] attribute should be used to temporarily suppress the notice /var/www/html/Cliffs_Internation/system/libraries/Session/drivers/Session_files_driver.php 233
ERROR - 2023-06-24 13:38:05 --> Severity: 8192 --> Return type of CI_Session_files_driver::destroy($session_id) should either be compatible with SessionHandlerInterface::destroy(string $id): bool, or the #[\ReturnTypeWillChange] attribute should be used to temporarily suppress the notice /var/www/html/Cliffs_Internation/system/libraries/Session/drivers/Session_files_driver.php 313
ERROR - 2023-06-24 13:38:05 --> Severity: 8192 --> Return type of CI_Session_files_driver::gc($maxlifetime) should either be compatible with SessionHandlerInterface::gc(int $max_lifetime): int|false, or the #[\ReturnTypeWillChange] attribute should be used to temporarily suppress the notice /var/www/html/Cliffs_Internation/system/libraries/Session/drivers/Session_files_driver.php 354
ERROR - 2023-06-24 13:38:05 --> Severity: Warning --> ini_set(): Session ini settings cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 284
ERROR - 2023-06-24 13:38:05 --> Severity: Warning --> session_set_cookie_params(): Session cookie parameters cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 296
ERROR - 2023-06-24 13:38:05 --> Severity: Warning --> ini_set(): Session ini settings cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 306
ERROR - 2023-06-24 13:38:05 --> Severity: Warning --> ini_set(): Session ini settings cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 316
ERROR - 2023-06-24 13:38:05 --> Severity: Warning --> ini_set(): Session ini settings cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 317
ERROR - 2023-06-24 13:38:05 --> Severity: Warning --> ini_set(): Session ini settings cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 318
ERROR - 2023-06-24 13:38:05 --> Severity: Warning --> ini_set(): Session ini settings cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 319
ERROR - 2023-06-24 13:38:05 --> Severity: Warning --> ini_set(): Session ini settings cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 377
ERROR - 2023-06-24 13:38:05 --> Severity: Warning --> ini_set(): Session ini settings cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/drivers/Session_files_driver.php 108
ERROR - 2023-06-24 13:38:05 --> Severity: Warning --> session_set_save_handler(): Session save handler cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 110
ERROR - 2023-06-24 13:38:05 --> Severity: Warning --> session_start(): Session cannot be started after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 143
ERROR - 2023-06-24 13:38:05 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /var/www/html/Cliffs_Internation/system/core/Exceptions.php:271) /var/www/html/Cliffs_Internation/system/helpers/url_helper.php 564
ERROR - 2023-06-24 13:38:18 --> Severity: error --> Exception: Class "CI_Exceptions" not found /var/www/html/Cliffs_Internation/system/core/Common.php 196
ERROR - 2023-06-24 13:38:23 --> ALL TRANSACTIONS: Array
(
    [0] => stdClass Object
        (
            [transId] => 18
            [totalPrice] => 385.00
            [ref] => 0315287
            [totalMoneySpent] => 385.00
            [modeOfPayment] => Cash
            [staffId] => 1
            [transDate] => 2023-06-23 16:47:00
            [lastUpdated] => 2023-06-23 16:47:00
            [amountTendered] => 500.00
            [cancelled] => 0
            [changeDue] => 115.00
            [staffName] => Admin Liam
            [cust_name] => 
            [cust_phone] => 
            [cust_email] => 
            [quantity] => 7
        )

    [1] => stdClass Object
        (
            [transId] => 17
            [totalPrice] => 175.00
            [ref] => 790358235
            [totalMoneySpent] => 175.00
            [modeOfPayment] => Cash
            [staffId] => 1
            [transDate] => 2023-06-23 10:43:35
            [lastUpdated] => 2023-06-23 10:43:35
            [amountTendered] => 200.00
            [cancelled] => 0
            [changeDue] => 25.00
            [staffName] => Admin Liam
            [cust_name] => 
            [cust_phone] => 
            [cust_email] => 
            [quantity] => 7
        )

    [2] => stdClass Object
        (
            [transId] => 16
            [totalPrice] => 100.00
            [ref] => 993658
            [totalMoneySpent] => 100.00
            [modeOfPayment] => Cash
            [staffId] => 1
            [transDate] => 2023-06-22 09:23:12
            [lastUpdated] => 2023-06-22 09:23:12
            [amountTendered] => 100.00
            [cancelled] => 0
            [changeDue] => 0.00
            [staffName] => Admin Liam
            [cust_name] => 
            [cust_phone] => 
            [cust_email] => 
            [quantity] => 4
        )

    [3] => stdClass Object
        (
            [transId] => 15
            [totalPrice] => 720.00
            [ref] => 069215370
            [totalMoneySpent] => 734.40
            [modeOfPayment] => Cash
            [staffId] => 3
            [transDate] => 2021-06-02 01:11:28
            [lastUpdated] => 2021-06-01 21:26:28
            [amountTendered] => 735.00
            [cancelled] => 0
            [changeDue] => 0.60
            [staffName] => Stephen Mchan
            [cust_name] => John Doe
            [cust_phone] => 7014445470
            [cust_email] => doejjj@gmail.com
            [quantity] => 30
        )

    [4] => stdClass Object
        (
            [transId] => 14
            [totalPrice] => 12529.60
            [ref] => 1230158
            [totalMoneySpent] => 12279.01
            [modeOfPayment] => Cash and POS
            [staffId] => 1
            [transDate] => 2021-06-02 01:09:03
            [lastUpdated] => 2021-06-01 21:24:03
            [amountTendered] => 12279.01
            [cancelled] => 0
            [changeDue] => 0.00
            [staffName] => Admin Liam
            [cust_name] => Willam Payne
            [cust_phone] => 7560002450
            [cust_email] => paynew@gmail.com
            [quantity] => 656
        )

    [5] => stdClass Object
        (
            [transId] => 13
            [totalPrice] => 275.40
            [ref] => 895691278
            [totalMoneySpent] => 280.91
            [modeOfPayment] => POS
            [staffId] => 1
            [transDate] => 2021-06-02 01:07:15
            [lastUpdated] => 2021-06-01 21:22:15
            [amountTendered] => 280.91
            [cancelled] => 0
            [changeDue] => 0.00
            [staffName] => Admin Liam
            [cust_name] => Liam Moore
            [cust_phone] => 7010000025
            [cust_email] => moorel@gmail.com
            [quantity] => 20
        )

    [6] => stdClass Object
        (
            [transId] => 12
            [totalPrice] => 1292.00
            [ref] => 32825746
            [totalMoneySpent] => 1266.16
            [modeOfPayment] => Cash
            [staffId] => 1
            [transDate] => 2021-06-02 01:04:33
            [lastUpdated] => 2021-06-01 21:19:33
            [amountTendered] => 1270.00
            [cancelled] => 0
            [changeDue] => 3.84
            [staffName] => Admin Liam
            [cust_name] => Richard Lawrence
            [cust_phone] => 7850001450
            [cust_email] => richardlw@gmail.com
            [quantity] => 76
        )

    [7] => stdClass Object
        (
            [transId] => 11
            [totalPrice] => 1164.00
            [ref] => 983709261
            [totalMoneySpent] => 1164.00
            [modeOfPayment] => Cash
            [staffId] => 1
            [transDate] => 2021-06-02 00:19:40
            [lastUpdated] => 2021-06-01 20:34:40
            [amountTendered] => 1165.00
            [cancelled] => 0
            [changeDue] => 1.00
            [staffName] => Admin Liam
            [cust_name] => John Bland
            [cust_phone] => 7012220001
            [cust_email] => johnb@gmail.com
            [quantity] => 97
        )

    [8] => stdClass Object
        (
            [transId] => 10
            [totalPrice] => 8250.00
            [ref] => 2346405
            [totalMoneySpent] => 8250.00
            [modeOfPayment] => Cash
            [staffId] => 1
            [transDate] => 2021-06-02 00:18:38
            [lastUpdated] => 2021-06-01 20:33:38
            [amountTendered] => 8250.00
            [cancelled] => 0
            [changeDue] => 0.00
            [staffName] => Admin Liam
            [cust_name] => Arnold Flesher
            [cust_phone] => 7940001240
            [cust_email] => arnold@gmail.com
            [quantity] => 250
        )

    [9] => stdClass Object
        (
            [transId] => 9
            [totalPrice] => 351.45
            [ref] => 641908
            [totalMoneySpent] => 344.42
            [modeOfPayment] => Cash
            [staffId] => 1
            [transDate] => 2021-06-02 00:16:34
            [lastUpdated] => 2021-06-01 20:31:34
            [amountTendered] => 345.00
            [cancelled] => 0
            [changeDue] => 0.58
            [staffName] => Admin Liam
            [cust_name] => Peter Buchanan
            [cust_phone] => 7321450014
            [cust_email] => peterb@gmail.com
            [quantity] => 11
        )

)

ERROR - 2023-06-24 13:39:39 --> Severity: 8192 --> setcookie(): Passing null to parameter #2 ($value) of type string is deprecated /var/www/html/Cliffs_Internation/system/libraries/Session/Session_driver.php 132
ERROR - 2023-06-24 13:39:39 --> Severity: error --> Exception: Class "CI_Exceptions" not found /var/www/html/Cliffs_Internation/system/core/Common.php 196
ERROR - 2023-06-24 13:39:53 --> ALL TRANSACTIONS: Array
(
    [0] => stdClass Object
        (
            [transId] => 18
            [totalPrice] => 385.00
            [ref] => 0315287
            [totalMoneySpent] => 385.00
            [modeOfPayment] => Cash
            [staffId] => 1
            [transDate] => 2023-06-23 16:47:00
            [lastUpdated] => 2023-06-23 16:47:00
            [amountTendered] => 500.00
            [cancelled] => 0
            [changeDue] => 115.00
            [staffName] => Admin Liam
            [cust_name] => 
            [cust_phone] => 
            [cust_email] => 
            [quantity] => 7
        )

    [1] => stdClass Object
        (
            [transId] => 17
            [totalPrice] => 175.00
            [ref] => 790358235
            [totalMoneySpent] => 175.00
            [modeOfPayment] => Cash
            [staffId] => 1
            [transDate] => 2023-06-23 10:43:35
            [lastUpdated] => 2023-06-23 10:43:35
            [amountTendered] => 200.00
            [cancelled] => 0
            [changeDue] => 25.00
            [staffName] => Admin Liam
            [cust_name] => 
            [cust_phone] => 
            [cust_email] => 
            [quantity] => 7
        )

    [2] => stdClass Object
        (
            [transId] => 16
            [totalPrice] => 100.00
            [ref] => 993658
            [totalMoneySpent] => 100.00
            [modeOfPayment] => Cash
            [staffId] => 1
            [transDate] => 2023-06-22 09:23:12
            [lastUpdated] => 2023-06-22 09:23:12
            [amountTendered] => 100.00
            [cancelled] => 0
            [changeDue] => 0.00
            [staffName] => Admin Liam
            [cust_name] => 
            [cust_phone] => 
            [cust_email] => 
            [quantity] => 4
        )

    [3] => stdClass Object
        (
            [transId] => 15
            [totalPrice] => 720.00
            [ref] => 069215370
            [totalMoneySpent] => 734.40
            [modeOfPayment] => Cash
            [staffId] => 3
            [transDate] => 2021-06-02 01:11:28
            [lastUpdated] => 2021-06-01 21:26:28
            [amountTendered] => 735.00
            [cancelled] => 0
            [changeDue] => 0.60
            [staffName] => Stephen Mchan
            [cust_name] => John Doe
            [cust_phone] => 7014445470
            [cust_email] => doejjj@gmail.com
            [quantity] => 30
        )

    [4] => stdClass Object
        (
            [transId] => 14
            [totalPrice] => 12529.60
            [ref] => 1230158
            [totalMoneySpent] => 12279.01
            [modeOfPayment] => Cash and POS
            [staffId] => 1
            [transDate] => 2021-06-02 01:09:03
            [lastUpdated] => 2021-06-01 21:24:03
            [amountTendered] => 12279.01
            [cancelled] => 0
            [changeDue] => 0.00
            [staffName] => Admin Liam
            [cust_name] => Willam Payne
            [cust_phone] => 7560002450
            [cust_email] => paynew@gmail.com
            [quantity] => 656
        )

    [5] => stdClass Object
        (
            [transId] => 13
            [totalPrice] => 275.40
            [ref] => 895691278
            [totalMoneySpent] => 280.91
            [modeOfPayment] => POS
            [staffId] => 1
            [transDate] => 2021-06-02 01:07:15
            [lastUpdated] => 2021-06-01 21:22:15
            [amountTendered] => 280.91
            [cancelled] => 0
            [changeDue] => 0.00
            [staffName] => Admin Liam
            [cust_name] => Liam Moore
            [cust_phone] => 7010000025
            [cust_email] => moorel@gmail.com
            [quantity] => 20
        )

    [6] => stdClass Object
        (
            [transId] => 12
            [totalPrice] => 1292.00
            [ref] => 32825746
            [totalMoneySpent] => 1266.16
            [modeOfPayment] => Cash
            [staffId] => 1
            [transDate] => 2021-06-02 01:04:33
            [lastUpdated] => 2021-06-01 21:19:33
            [amountTendered] => 1270.00
            [cancelled] => 0
            [changeDue] => 3.84
            [staffName] => Admin Liam
            [cust_name] => Richard Lawrence
            [cust_phone] => 7850001450
            [cust_email] => richardlw@gmail.com
            [quantity] => 76
        )

    [7] => stdClass Object
        (
            [transId] => 11
            [totalPrice] => 1164.00
            [ref] => 983709261
            [totalMoneySpent] => 1164.00
            [modeOfPayment] => Cash
            [staffId] => 1
            [transDate] => 2021-06-02 00:19:40
            [lastUpdated] => 2021-06-01 20:34:40
            [amountTendered] => 1165.00
            [cancelled] => 0
            [changeDue] => 1.00
            [staffName] => Admin Liam
            [cust_name] => John Bland
            [cust_phone] => 7012220001
            [cust_email] => johnb@gmail.com
            [quantity] => 97
        )

    [8] => stdClass Object
        (
            [transId] => 10
            [totalPrice] => 8250.00
            [ref] => 2346405
            [totalMoneySpent] => 8250.00
            [modeOfPayment] => Cash
            [staffId] => 1
            [transDate] => 2021-06-02 00:18:38
            [lastUpdated] => 2021-06-01 20:33:38
            [amountTendered] => 8250.00
            [cancelled] => 0
            [changeDue] => 0.00
            [staffName] => Admin Liam
            [cust_name] => Arnold Flesher
            [cust_phone] => 7940001240
            [cust_email] => arnold@gmail.com
            [quantity] => 250
        )

    [9] => stdClass Object
        (
            [transId] => 9
            [totalPrice] => 351.45
            [ref] => 641908
            [totalMoneySpent] => 344.42
            [modeOfPayment] => Cash
            [staffId] => 1
            [transDate] => 2021-06-02 00:16:34
            [lastUpdated] => 2021-06-01 20:31:34
            [amountTendered] => 345.00
            [cancelled] => 0
            [changeDue] => 0.58
            [staffName] => Admin Liam
            [cust_name] => Peter Buchanan
            [cust_phone] => 7321450014
            [cust_email] => peterb@gmail.com
            [quantity] => 11
        )

)

ERROR - 2023-06-24 13:39:59 --> ALL TRANSACTIONS: Array
(
    [0] => stdClass Object
        (
            [transId] => 18
            [totalPrice] => 385.00
            [ref] => 0315287
            [totalMoneySpent] => 385.00
            [modeOfPayment] => Cash
            [staffId] => 1
            [transDate] => 2023-06-23 16:47:00
            [lastUpdated] => 2023-06-23 16:47:00
            [amountTendered] => 500.00
            [cancelled] => 0
            [changeDue] => 115.00
            [staffName] => Admin Liam
            [cust_name] => 
            [cust_phone] => 
            [cust_email] => 
            [quantity] => 7
        )

    [1] => stdClass Object
        (
            [transId] => 17
            [totalPrice] => 175.00
            [ref] => 790358235
            [totalMoneySpent] => 175.00
            [modeOfPayment] => Cash
            [staffId] => 1
            [transDate] => 2023-06-23 10:43:35
            [lastUpdated] => 2023-06-23 10:43:35
            [amountTendered] => 200.00
            [cancelled] => 0
            [changeDue] => 25.00
            [staffName] => Admin Liam
            [cust_name] => 
            [cust_phone] => 
            [cust_email] => 
            [quantity] => 7
        )

    [2] => stdClass Object
        (
            [transId] => 16
            [totalPrice] => 100.00
            [ref] => 993658
            [totalMoneySpent] => 100.00
            [modeOfPayment] => Cash
            [staffId] => 1
            [transDate] => 2023-06-22 09:23:12
            [lastUpdated] => 2023-06-22 09:23:12
            [amountTendered] => 100.00
            [cancelled] => 0
            [changeDue] => 0.00
            [staffName] => Admin Liam
            [cust_name] => 
            [cust_phone] => 
            [cust_email] => 
            [quantity] => 4
        )

    [3] => stdClass Object
        (
            [transId] => 15
            [totalPrice] => 720.00
            [ref] => 069215370
            [totalMoneySpent] => 734.40
            [modeOfPayment] => Cash
            [staffId] => 3
            [transDate] => 2021-06-02 01:11:28
            [lastUpdated] => 2021-06-01 21:26:28
            [amountTendered] => 735.00
            [cancelled] => 0
            [changeDue] => 0.60
            [staffName] => Stephen Mchan
            [cust_name] => John Doe
            [cust_phone] => 7014445470
            [cust_email] => doejjj@gmail.com
            [quantity] => 30
        )

    [4] => stdClass Object
        (
            [transId] => 14
            [totalPrice] => 12529.60
            [ref] => 1230158
            [totalMoneySpent] => 12279.01
            [modeOfPayment] => Cash and POS
            [staffId] => 1
            [transDate] => 2021-06-02 01:09:03
            [lastUpdated] => 2021-06-01 21:24:03
            [amountTendered] => 12279.01
            [cancelled] => 0
            [changeDue] => 0.00
            [staffName] => Admin Liam
            [cust_name] => Willam Payne
            [cust_phone] => 7560002450
            [cust_email] => paynew@gmail.com
            [quantity] => 656
        )

    [5] => stdClass Object
        (
            [transId] => 13
            [totalPrice] => 275.40
            [ref] => 895691278
            [totalMoneySpent] => 280.91
            [modeOfPayment] => POS
            [staffId] => 1
            [transDate] => 2021-06-02 01:07:15
            [lastUpdated] => 2021-06-01 21:22:15
            [amountTendered] => 280.91
            [cancelled] => 0
            [changeDue] => 0.00
            [staffName] => Admin Liam
            [cust_name] => Liam Moore
            [cust_phone] => 7010000025
            [cust_email] => moorel@gmail.com
            [quantity] => 20
        )

    [6] => stdClass Object
        (
            [transId] => 12
            [totalPrice] => 1292.00
            [ref] => 32825746
            [totalMoneySpent] => 1266.16
            [modeOfPayment] => Cash
            [staffId] => 1
            [transDate] => 2021-06-02 01:04:33
            [lastUpdated] => 2021-06-01 21:19:33
            [amountTendered] => 1270.00
            [cancelled] => 0
            [changeDue] => 3.84
            [staffName] => Admin Liam
            [cust_name] => Richard Lawrence
            [cust_phone] => 7850001450
            [cust_email] => richardlw@gmail.com
            [quantity] => 76
        )

    [7] => stdClass Object
        (
            [transId] => 11
            [totalPrice] => 1164.00
            [ref] => 983709261
            [totalMoneySpent] => 1164.00
            [modeOfPayment] => Cash
            [staffId] => 1
            [transDate] => 2021-06-02 00:19:40
            [lastUpdated] => 2021-06-01 20:34:40
            [amountTendered] => 1165.00
            [cancelled] => 0
            [changeDue] => 1.00
            [staffName] => Admin Liam
            [cust_name] => John Bland
            [cust_phone] => 7012220001
            [cust_email] => johnb@gmail.com
            [quantity] => 97
        )

    [8] => stdClass Object
        (
            [transId] => 10
            [totalPrice] => 8250.00
            [ref] => 2346405
            [totalMoneySpent] => 8250.00
            [modeOfPayment] => Cash
            [staffId] => 1
            [transDate] => 2021-06-02 00:18:38
            [lastUpdated] => 2021-06-01 20:33:38
            [amountTendered] => 8250.00
            [cancelled] => 0
            [changeDue] => 0.00
            [staffName] => Admin Liam
            [cust_name] => Arnold Flesher
            [cust_phone] => 7940001240
            [cust_email] => arnold@gmail.com
            [quantity] => 250
        )

    [9] => stdClass Object
        (
            [transId] => 9
            [totalPrice] => 351.45
            [ref] => 641908
            [totalMoneySpent] => 344.42
            [modeOfPayment] => Cash
            [staffId] => 1
            [transDate] => 2021-06-02 00:16:34
            [lastUpdated] => 2021-06-01 20:31:34
            [amountTendered] => 345.00
            [cancelled] => 0
            [changeDue] => 0.58
            [staffName] => Admin Liam
            [cust_name] => Peter Buchanan
            [cust_phone] => 7321450014
            [cust_email] => peterb@gmail.com
            [quantity] => 11
        )

    [10] => stdClass Object
        (
            [transId] => 8
            [totalPrice] => 252.00
            [ref] => 192549
            [totalMoneySpent] => 254.52
            [modeOfPayment] => Cash
            [staffId] => 1
            [transDate] => 2021-06-02 00:14:37
            [lastUpdated] => 2021-06-01 20:29:37
            [amountTendered] => 255.00
            [cancelled] => 0
            [changeDue] => 0.48
            [staffName] => Admin Liam
            [cust_name] => Eugenio Brown
            [cust_phone] => 7014747540
            [cust_email] => eugenio@gmail.com
            [quantity] => 21
        )

    [11] => stdClass Object
        (
            [transId] => 7
            [totalPrice] => 956.40
            [ref] => 18075809
            [totalMoneySpent] => 946.64
            [modeOfPayment] => Cash and POS
            [staffId] => 1
            [transDate] => 2021-06-01 23:22:00
            [lastUpdated] => 2021-06-01 19:37:00
            [amountTendered] => 946.64
            [cancelled] => 0
            [changeDue] => 0.00
            [staffName] => Admin Liam
            [cust_name] => Eddie
            [cust_phone] => 7001112540
            [cust_email] => eddie55@gmail.com
            [quantity] => 40
        )

    [12] => stdClass Object
        (
            [transId] => 6
            [totalPrice] => 429.14
            [ref] => 374217
            [totalMoneySpent] => 429.14
            [modeOfPayment] => Cash and POS
            [staffId] => 1
            [transDate] => 2021-06-01 22:28:26
            [lastUpdated] => 2021-06-01 18:43:26
            [amountTendered] => 429.14
            [cancelled] => 0
            [changeDue] => 0.00
            [staffName] => Admin Liam
            [cust_name] => Philip Brown
            [cust_phone] => 7347775477
            [cust_email] => philip@gmail.com
            [quantity] => 86
        )

    [13] => stdClass Object
        (
            [transId] => 5
            [totalPrice] => 231.00
            [ref] => 872496
            [totalMoneySpent] => 226.38
            [modeOfPayment] => POS
            [staffId] => 1
            [transDate] => 2021-06-01 22:22:04
            [lastUpdated] => 2021-06-01 18:37:04
            [amountTendered] => 226.38
            [cancelled] => 0
            [changeDue] => 0.00
            [staffName] => Admin Liam
            [cust_name] => Colin Stuart
            [cust_phone] => 7025896333
            [cust_email] => coleeen@gmail.com
            [quantity] => 21
        )

    [14] => stdClass Object
        (
            [transId] => 4
            [totalPrice] => 106.14
            [ref] => 03941028
            [totalMoneySpent] => 105.06
            [modeOfPayment] => Cash
            [staffId] => 1
            [transDate] => 2021-06-01 22:16:05
            [lastUpdated] => 2021-06-01 18:31:05
            [amountTendered] => 110.00
            [cancelled] => 0
            [changeDue] => 4.94
            [staffName] => Admin Liam
            [cust_name] => Johnny Greenwood
            [cust_phone] => 7014547770
            [cust_email] => greenjoh@gmail.com
            [quantity] => 3
        )

    [15] => stdClass Object
        (
            [transId] => 3
            [totalPrice] => 2211.00
            [ref] => 439972
            [totalMoneySpent] => 2166.78
            [modeOfPayment] => Cash
            [staffId] => 1
            [transDate] => 2021-06-01 20:00:41
            [lastUpdated] => 2021-06-01 16:15:41
            [amountTendered] => 2170.00
            [cancelled] => 0
            [changeDue] => 3.22
            [staffName] => Admin Liam
            [cust_name] => John Watts
            [cust_phone] => 7025802586
            [cust_email] => johnwt@gmail.com
            [quantity] => 67
        )

    [16] => stdClass Object
        (
            [transId] => 2
            [totalPrice] => 215.50
            [ref] => 23649438
            [totalMoneySpent] => 211.50
            [modeOfPayment] => Cash
            [staffId] => 1
            [transDate] => 2021-06-01 19:48:09
            [lastUpdated] => 2021-06-01 16:03:09
            [amountTendered] => 225.00
            [cancelled] => 0
            [changeDue] => 13.50
            [staffName] => Admin Liam
            [cust_name] => Will Williams
            [cust_phone] => 7410002145
            [cust_email] => williams@gmail.com
            [quantity] => 10
        )

    [17] => stdClass Object
        (
            [transId] => 1
            [totalPrice] => 500.00
            [ref] => 765149033
            [totalMoneySpent] => 490.00
            [modeOfPayment] => Cash
            [staffId] => 1
            [transDate] => 2021-04-19 23:34:03
            [lastUpdated] => 2021-04-19 19:49:03
            [amountTendered] => 500.00
            [cancelled] => 0
            [changeDue] => 10.00
            [staffName] => Admin Liam
            [cust_name] => John
            [cust_phone] => 3457896660
            [cust_email] => john@gmail.com
            [quantity] => 1
        )

)

ERROR - 2023-06-24 13:40:10 --> Severity: 8192 --> setcookie(): Passing null to parameter #2 ($value) of type string is deprecated /var/www/html/Cliffs_Internation/system/libraries/Session/Session_driver.php 132
ERROR - 2023-06-24 13:40:10 --> Severity: error --> Exception: Class "CI_Exceptions" not found /var/www/html/Cliffs_Internation/system/core/Common.php 196
ERROR - 2023-06-24 16:57:26 --> Severity: 8192 --> Return type of CI_Session_files_driver::open($save_path, $name) should either be compatible with SessionHandlerInterface::open(string $path, string $name): bool, or the #[\ReturnTypeWillChange] attribute should be used to temporarily suppress the notice /var/www/html/Cliffs_Internation/system/libraries/Session/drivers/Session_files_driver.php 132
ERROR - 2023-06-24 16:57:27 --> Severity: 8192 --> Return type of CI_Session_files_driver::close() should either be compatible with SessionHandlerInterface::close(): bool, or the #[\ReturnTypeWillChange] attribute should be used to temporarily suppress the notice /var/www/html/Cliffs_Internation/system/libraries/Session/drivers/Session_files_driver.php 290
ERROR - 2023-06-24 16:57:27 --> Severity: 8192 --> Return type of CI_Session_files_driver::read($session_id) should either be compatible with SessionHandlerInterface::read(string $id): string|false, or the #[\ReturnTypeWillChange] attribute should be used to temporarily suppress the notice /var/www/html/Cliffs_Internation/system/libraries/Session/drivers/Session_files_driver.php 164
ERROR - 2023-06-24 16:57:27 --> Severity: 8192 --> Return type of CI_Session_files_driver::write($session_id, $session_data) should either be compatible with SessionHandlerInterface::write(string $id, string $data): bool, or the #[\ReturnTypeWillChange] attribute should be used to temporarily suppress the notice /var/www/html/Cliffs_Internation/system/libraries/Session/drivers/Session_files_driver.php 233
ERROR - 2023-06-24 16:57:27 --> Severity: 8192 --> Return type of CI_Session_files_driver::destroy($session_id) should either be compatible with SessionHandlerInterface::destroy(string $id): bool, or the #[\ReturnTypeWillChange] attribute should be used to temporarily suppress the notice /var/www/html/Cliffs_Internation/system/libraries/Session/drivers/Session_files_driver.php 313
ERROR - 2023-06-24 16:57:27 --> Severity: 8192 --> Return type of CI_Session_files_driver::gc($maxlifetime) should either be compatible with SessionHandlerInterface::gc(int $max_lifetime): int|false, or the #[\ReturnTypeWillChange] attribute should be used to temporarily suppress the notice /var/www/html/Cliffs_Internation/system/libraries/Session/drivers/Session_files_driver.php 354
ERROR - 2023-06-24 16:57:27 --> Severity: Warning --> ini_set(): Session ini settings cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 284
ERROR - 2023-06-24 16:57:27 --> Severity: Warning --> session_set_cookie_params(): Session cookie parameters cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 296
ERROR - 2023-06-24 16:57:27 --> Severity: Warning --> ini_set(): Session ini settings cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 306
ERROR - 2023-06-24 16:57:27 --> Severity: Warning --> ini_set(): Session ini settings cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 316
ERROR - 2023-06-24 16:57:27 --> Severity: Warning --> ini_set(): Session ini settings cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 317
ERROR - 2023-06-24 16:57:27 --> Severity: Warning --> ini_set(): Session ini settings cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 318
ERROR - 2023-06-24 16:57:27 --> Severity: Warning --> ini_set(): Session ini settings cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 319
ERROR - 2023-06-24 16:57:27 --> Severity: Warning --> ini_set(): Session ini settings cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 377
ERROR - 2023-06-24 16:57:27 --> Severity: Warning --> ini_set(): Session ini settings cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/drivers/Session_files_driver.php 108
ERROR - 2023-06-24 16:57:27 --> Severity: Warning --> session_set_save_handler(): Session save handler cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 110
ERROR - 2023-06-24 16:57:27 --> Severity: Warning --> session_start(): Session cannot be started after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 143
ERROR - 2023-06-24 16:57:27 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /var/www/html/Cliffs_Internation/system/core/Exceptions.php:271) /var/www/html/Cliffs_Internation/system/helpers/url_helper.php 564
ERROR - 2023-06-24 16:57:35 --> Severity: error --> Exception: Class "CI_Exceptions" not found /var/www/html/Cliffs_Internation/system/core/Common.php 196
ERROR - 2023-06-24 16:58:13 --> ALL TRANSACTIONS: Array
(
    [0] => stdClass Object
        (
            [transId] => 18
            [totalPrice] => 385.00
            [ref] => 0315287
            [totalMoneySpent] => 385.00
            [modeOfPayment] => Cash
            [staffId] => 1
            [transDate] => 2023-06-23 16:47:00
            [lastUpdated] => 2023-06-23 16:47:00
            [amountTendered] => 500.00
            [cancelled] => 0
            [changeDue] => 115.00
            [staffName] => Admin Liam
            [cust_name] => 
            [cust_phone] => 
            [cust_email] => 
            [quantity] => 7
        )

    [1] => stdClass Object
        (
            [transId] => 17
            [totalPrice] => 175.00
            [ref] => 790358235
            [totalMoneySpent] => 175.00
            [modeOfPayment] => Cash
            [staffId] => 1
            [transDate] => 2023-06-23 10:43:35
            [lastUpdated] => 2023-06-23 10:43:35
            [amountTendered] => 200.00
            [cancelled] => 0
            [changeDue] => 25.00
            [staffName] => Admin Liam
            [cust_name] => 
            [cust_phone] => 
            [cust_email] => 
            [quantity] => 7
        )

    [2] => stdClass Object
        (
            [transId] => 16
            [totalPrice] => 100.00
            [ref] => 993658
            [totalMoneySpent] => 100.00
            [modeOfPayment] => Cash
            [staffId] => 1
            [transDate] => 2023-06-22 09:23:12
            [lastUpdated] => 2023-06-22 09:23:12
            [amountTendered] => 100.00
            [cancelled] => 0
            [changeDue] => 0.00
            [staffName] => Admin Liam
            [cust_name] => 
            [cust_phone] => 
            [cust_email] => 
            [quantity] => 4
        )

    [3] => stdClass Object
        (
            [transId] => 15
            [totalPrice] => 720.00
            [ref] => 069215370
            [totalMoneySpent] => 734.40
            [modeOfPayment] => Cash
            [staffId] => 3
            [transDate] => 2021-06-02 01:11:28
            [lastUpdated] => 2021-06-01 21:26:28
            [amountTendered] => 735.00
            [cancelled] => 0
            [changeDue] => 0.60
            [staffName] => Stephen Mchan
            [cust_name] => John Doe
            [cust_phone] => 7014445470
            [cust_email] => doejjj@gmail.com
            [quantity] => 30
        )

    [4] => stdClass Object
        (
            [transId] => 14
            [totalPrice] => 12529.60
            [ref] => 1230158
            [totalMoneySpent] => 12279.01
            [modeOfPayment] => Cash and POS
            [staffId] => 1
            [transDate] => 2021-06-02 01:09:03
            [lastUpdated] => 2021-06-01 21:24:03
            [amountTendered] => 12279.01
            [cancelled] => 0
            [changeDue] => 0.00
            [staffName] => Admin Liam
            [cust_name] => Willam Payne
            [cust_phone] => 7560002450
            [cust_email] => paynew@gmail.com
            [quantity] => 656
        )

    [5] => stdClass Object
        (
            [transId] => 13
            [totalPrice] => 275.40
            [ref] => 895691278
            [totalMoneySpent] => 280.91
            [modeOfPayment] => POS
            [staffId] => 1
            [transDate] => 2021-06-02 01:07:15
            [lastUpdated] => 2021-06-01 21:22:15
            [amountTendered] => 280.91
            [cancelled] => 0
            [changeDue] => 0.00
            [staffName] => Admin Liam
            [cust_name] => Liam Moore
            [cust_phone] => 7010000025
            [cust_email] => moorel@gmail.com
            [quantity] => 20
        )

    [6] => stdClass Object
        (
            [transId] => 12
            [totalPrice] => 1292.00
            [ref] => 32825746
            [totalMoneySpent] => 1266.16
            [modeOfPayment] => Cash
            [staffId] => 1
            [transDate] => 2021-06-02 01:04:33
            [lastUpdated] => 2021-06-01 21:19:33
            [amountTendered] => 1270.00
            [cancelled] => 0
            [changeDue] => 3.84
            [staffName] => Admin Liam
            [cust_name] => Richard Lawrence
            [cust_phone] => 7850001450
            [cust_email] => richardlw@gmail.com
            [quantity] => 76
        )

    [7] => stdClass Object
        (
            [transId] => 11
            [totalPrice] => 1164.00
            [ref] => 983709261
            [totalMoneySpent] => 1164.00
            [modeOfPayment] => Cash
            [staffId] => 1
            [transDate] => 2021-06-02 00:19:40
            [lastUpdated] => 2021-06-01 20:34:40
            [amountTendered] => 1165.00
            [cancelled] => 0
            [changeDue] => 1.00
            [staffName] => Admin Liam
            [cust_name] => John Bland
            [cust_phone] => 7012220001
            [cust_email] => johnb@gmail.com
            [quantity] => 97
        )

    [8] => stdClass Object
        (
            [transId] => 10
            [totalPrice] => 8250.00
            [ref] => 2346405
            [totalMoneySpent] => 8250.00
            [modeOfPayment] => Cash
            [staffId] => 1
            [transDate] => 2021-06-02 00:18:38
            [lastUpdated] => 2021-06-01 20:33:38
            [amountTendered] => 8250.00
            [cancelled] => 0
            [changeDue] => 0.00
            [staffName] => Admin Liam
            [cust_name] => Arnold Flesher
            [cust_phone] => 7940001240
            [cust_email] => arnold@gmail.com
            [quantity] => 250
        )

    [9] => stdClass Object
        (
            [transId] => 9
            [totalPrice] => 351.45
            [ref] => 641908
            [totalMoneySpent] => 344.42
            [modeOfPayment] => Cash
            [staffId] => 1
            [transDate] => 2021-06-02 00:16:34
            [lastUpdated] => 2021-06-01 20:31:34
            [amountTendered] => 345.00
            [cancelled] => 0
            [changeDue] => 0.58
            [staffName] => Admin Liam
            [cust_name] => Peter Buchanan
            [cust_phone] => 7321450014
            [cust_email] => peterb@gmail.com
            [quantity] => 11
        )

)

ERROR - 2023-06-24 16:59:42 --> ALL TRANSACTIONS: Array
(
    [0] => stdClass Object
        (
            [transId] => 18
            [totalPrice] => 385.00
            [ref] => 0315287
            [totalMoneySpent] => 385.00
            [modeOfPayment] => Cash
            [staffId] => 1
            [transDate] => 2023-06-23 16:47:00
            [lastUpdated] => 2023-06-23 16:47:00
            [amountTendered] => 500.00
            [cancelled] => 0
            [changeDue] => 115.00
            [staffName] => Admin Liam
            [cust_name] => 
            [cust_phone] => 
            [cust_email] => 
            [quantity] => 7
        )

    [1] => stdClass Object
        (
            [transId] => 17
            [totalPrice] => 175.00
            [ref] => 790358235
            [totalMoneySpent] => 175.00
            [modeOfPayment] => Cash
            [staffId] => 1
            [transDate] => 2023-06-23 10:43:35
            [lastUpdated] => 2023-06-23 10:43:35
            [amountTendered] => 200.00
            [cancelled] => 0
            [changeDue] => 25.00
            [staffName] => Admin Liam
            [cust_name] => 
            [cust_phone] => 
            [cust_email] => 
            [quantity] => 7
        )

    [2] => stdClass Object
        (
            [transId] => 16
            [totalPrice] => 100.00
            [ref] => 993658
            [totalMoneySpent] => 100.00
            [modeOfPayment] => Cash
            [staffId] => 1
            [transDate] => 2023-06-22 09:23:12
            [lastUpdated] => 2023-06-22 09:23:12
            [amountTendered] => 100.00
            [cancelled] => 0
            [changeDue] => 0.00
            [staffName] => Admin Liam
            [cust_name] => 
            [cust_phone] => 
            [cust_email] => 
            [quantity] => 4
        )

    [3] => stdClass Object
        (
            [transId] => 15
            [totalPrice] => 720.00
            [ref] => 069215370
            [totalMoneySpent] => 734.40
            [modeOfPayment] => Cash
            [staffId] => 3
            [transDate] => 2021-06-02 01:11:28
            [lastUpdated] => 2021-06-01 21:26:28
            [amountTendered] => 735.00
            [cancelled] => 0
            [changeDue] => 0.60
            [staffName] => Stephen Mchan
            [cust_name] => John Doe
            [cust_phone] => 7014445470
            [cust_email] => doejjj@gmail.com
            [quantity] => 30
        )

    [4] => stdClass Object
        (
            [transId] => 14
            [totalPrice] => 12529.60
            [ref] => 1230158
            [totalMoneySpent] => 12279.01
            [modeOfPayment] => Cash and POS
            [staffId] => 1
            [transDate] => 2021-06-02 01:09:03
            [lastUpdated] => 2021-06-01 21:24:03
            [amountTendered] => 12279.01
            [cancelled] => 0
            [changeDue] => 0.00
            [staffName] => Admin Liam
            [cust_name] => Willam Payne
            [cust_phone] => 7560002450
            [cust_email] => paynew@gmail.com
            [quantity] => 656
        )

    [5] => stdClass Object
        (
            [transId] => 13
            [totalPrice] => 275.40
            [ref] => 895691278
            [totalMoneySpent] => 280.91
            [modeOfPayment] => POS
            [staffId] => 1
            [transDate] => 2021-06-02 01:07:15
            [lastUpdated] => 2021-06-01 21:22:15
            [amountTendered] => 280.91
            [cancelled] => 0
            [changeDue] => 0.00
            [staffName] => Admin Liam
            [cust_name] => Liam Moore
            [cust_phone] => 7010000025
            [cust_email] => moorel@gmail.com
            [quantity] => 20
        )

    [6] => stdClass Object
        (
            [transId] => 12
            [totalPrice] => 1292.00
            [ref] => 32825746
            [totalMoneySpent] => 1266.16
            [modeOfPayment] => Cash
            [staffId] => 1
            [transDate] => 2021-06-02 01:04:33
            [lastUpdated] => 2021-06-01 21:19:33
            [amountTendered] => 1270.00
            [cancelled] => 0
            [changeDue] => 3.84
            [staffName] => Admin Liam
            [cust_name] => Richard Lawrence
            [cust_phone] => 7850001450
            [cust_email] => richardlw@gmail.com
            [quantity] => 76
        )

    [7] => stdClass Object
        (
            [transId] => 11
            [totalPrice] => 1164.00
            [ref] => 983709261
            [totalMoneySpent] => 1164.00
            [modeOfPayment] => Cash
            [staffId] => 1
            [transDate] => 2021-06-02 00:19:40
            [lastUpdated] => 2021-06-01 20:34:40
            [amountTendered] => 1165.00
            [cancelled] => 0
            [changeDue] => 1.00
            [staffName] => Admin Liam
            [cust_name] => John Bland
            [cust_phone] => 7012220001
            [cust_email] => johnb@gmail.com
            [quantity] => 97
        )

    [8] => stdClass Object
        (
            [transId] => 10
            [totalPrice] => 8250.00
            [ref] => 2346405
            [totalMoneySpent] => 8250.00
            [modeOfPayment] => Cash
            [staffId] => 1
            [transDate] => 2021-06-02 00:18:38
            [lastUpdated] => 2021-06-01 20:33:38
            [amountTendered] => 8250.00
            [cancelled] => 0
            [changeDue] => 0.00
            [staffName] => Admin Liam
            [cust_name] => Arnold Flesher
            [cust_phone] => 7940001240
            [cust_email] => arnold@gmail.com
            [quantity] => 250
        )

    [9] => stdClass Object
        (
            [transId] => 9
            [totalPrice] => 351.45
            [ref] => 641908
            [totalMoneySpent] => 344.42
            [modeOfPayment] => Cash
            [staffId] => 1
            [transDate] => 2021-06-02 00:16:34
            [lastUpdated] => 2021-06-01 20:31:34
            [amountTendered] => 345.00
            [cancelled] => 0
            [changeDue] => 0.58
            [staffName] => Admin Liam
            [cust_name] => Peter Buchanan
            [cust_phone] => 7321450014
            [cust_email] => peterb@gmail.com
            [quantity] => 11
        )

)

ERROR - 2023-06-24 17:01:25 --> Severity: 8192 --> setcookie(): Passing null to parameter #2 ($value) of type string is deprecated /var/www/html/Cliffs_Internation/system/libraries/Session/Session_driver.php 132
ERROR - 2023-06-24 17:01:26 --> Severity: error --> Exception: Class "CI_Exceptions" not found /var/www/html/Cliffs_Internation/system/core/Common.php 196
ERROR - 2023-06-24 17:01:35 --> ALL TRANSACTIONS: Array
(
    [0] => stdClass Object
        (
            [transId] => 18
            [totalPrice] => 385.00
            [ref] => 0315287
            [totalMoneySpent] => 385.00
            [modeOfPayment] => Cash
            [staffId] => 1
            [transDate] => 2023-06-23 16:47:00
            [lastUpdated] => 2023-06-23 16:47:00
            [amountTendered] => 500.00
            [cancelled] => 0
            [changeDue] => 115.00
            [staffName] => Admin Liam
            [cust_name] => 
            [cust_phone] => 
            [cust_email] => 
            [quantity] => 7
        )

    [1] => stdClass Object
        (
            [transId] => 17
            [totalPrice] => 175.00
            [ref] => 790358235
            [totalMoneySpent] => 175.00
            [modeOfPayment] => Cash
            [staffId] => 1
            [transDate] => 2023-06-23 10:43:35
            [lastUpdated] => 2023-06-23 10:43:35
            [amountTendered] => 200.00
            [cancelled] => 0
            [changeDue] => 25.00
            [staffName] => Admin Liam
            [cust_name] => 
            [cust_phone] => 
            [cust_email] => 
            [quantity] => 7
        )

    [2] => stdClass Object
        (
            [transId] => 16
            [totalPrice] => 100.00
            [ref] => 993658
            [totalMoneySpent] => 100.00
            [modeOfPayment] => Cash
            [staffId] => 1
            [transDate] => 2023-06-22 09:23:12
            [lastUpdated] => 2023-06-22 09:23:12
            [amountTendered] => 100.00
            [cancelled] => 0
            [changeDue] => 0.00
            [staffName] => Admin Liam
            [cust_name] => 
            [cust_phone] => 
            [cust_email] => 
            [quantity] => 4
        )

    [3] => stdClass Object
        (
            [transId] => 15
            [totalPrice] => 720.00
            [ref] => 069215370
            [totalMoneySpent] => 734.40
            [modeOfPayment] => Cash
            [staffId] => 3
            [transDate] => 2021-06-02 01:11:28
            [lastUpdated] => 2021-06-01 21:26:28
            [amountTendered] => 735.00
            [cancelled] => 0
            [changeDue] => 0.60
            [staffName] => Stephen Mchan
            [cust_name] => John Doe
            [cust_phone] => 7014445470
            [cust_email] => doejjj@gmail.com
            [quantity] => 30
        )

    [4] => stdClass Object
        (
            [transId] => 14
            [totalPrice] => 12529.60
            [ref] => 1230158
            [totalMoneySpent] => 12279.01
            [modeOfPayment] => Cash and POS
            [staffId] => 1
            [transDate] => 2021-06-02 01:09:03
            [lastUpdated] => 2021-06-01 21:24:03
            [amountTendered] => 12279.01
            [cancelled] => 0
            [changeDue] => 0.00
            [staffName] => Admin Liam
            [cust_name] => Willam Payne
            [cust_phone] => 7560002450
            [cust_email] => paynew@gmail.com
            [quantity] => 656
        )

    [5] => stdClass Object
        (
            [transId] => 13
            [totalPrice] => 275.40
            [ref] => 895691278
            [totalMoneySpent] => 280.91
            [modeOfPayment] => POS
            [staffId] => 1
            [transDate] => 2021-06-02 01:07:15
            [lastUpdated] => 2021-06-01 21:22:15
            [amountTendered] => 280.91
            [cancelled] => 0
            [changeDue] => 0.00
            [staffName] => Admin Liam
            [cust_name] => Liam Moore
            [cust_phone] => 7010000025
            [cust_email] => moorel@gmail.com
            [quantity] => 20
        )

    [6] => stdClass Object
        (
            [transId] => 12
            [totalPrice] => 1292.00
            [ref] => 32825746
            [totalMoneySpent] => 1266.16
            [modeOfPayment] => Cash
            [staffId] => 1
            [transDate] => 2021-06-02 01:04:33
            [lastUpdated] => 2021-06-01 21:19:33
            [amountTendered] => 1270.00
            [cancelled] => 0
            [changeDue] => 3.84
            [staffName] => Admin Liam
            [cust_name] => Richard Lawrence
            [cust_phone] => 7850001450
            [cust_email] => richardlw@gmail.com
            [quantity] => 76
        )

    [7] => stdClass Object
        (
            [transId] => 11
            [totalPrice] => 1164.00
            [ref] => 983709261
            [totalMoneySpent] => 1164.00
            [modeOfPayment] => Cash
            [staffId] => 1
            [transDate] => 2021-06-02 00:19:40
            [lastUpdated] => 2021-06-01 20:34:40
            [amountTendered] => 1165.00
            [cancelled] => 0
            [changeDue] => 1.00
            [staffName] => Admin Liam
            [cust_name] => John Bland
            [cust_phone] => 7012220001
            [cust_email] => johnb@gmail.com
            [quantity] => 97
        )

    [8] => stdClass Object
        (
            [transId] => 10
            [totalPrice] => 8250.00
            [ref] => 2346405
            [totalMoneySpent] => 8250.00
            [modeOfPayment] => Cash
            [staffId] => 1
            [transDate] => 2021-06-02 00:18:38
            [lastUpdated] => 2021-06-01 20:33:38
            [amountTendered] => 8250.00
            [cancelled] => 0
            [changeDue] => 0.00
            [staffName] => Admin Liam
            [cust_name] => Arnold Flesher
            [cust_phone] => 7940001240
            [cust_email] => arnold@gmail.com
            [quantity] => 250
        )

    [9] => stdClass Object
        (
            [transId] => 9
            [totalPrice] => 351.45
            [ref] => 641908
            [totalMoneySpent] => 344.42
            [modeOfPayment] => Cash
            [staffId] => 1
            [transDate] => 2021-06-02 00:16:34
            [lastUpdated] => 2021-06-01 20:31:34
            [amountTendered] => 345.00
            [cancelled] => 0
            [changeDue] => 0.58
            [staffName] => Admin Liam
            [cust_name] => Peter Buchanan
            [cust_phone] => 7321450014
            [cust_email] => peterb@gmail.com
            [quantity] => 11
        )

)

ERROR - 2023-06-24 17:14:33 --> Severity: 8192 --> setcookie(): Passing null to parameter #2 ($value) of type string is deprecated /var/www/html/Cliffs_Internation/system/libraries/Session/Session_driver.php 132
ERROR - 2023-06-24 17:14:33 --> Severity: error --> Exception: Class "CI_Exceptions" not found /var/www/html/Cliffs_Internation/system/core/Common.php 196
