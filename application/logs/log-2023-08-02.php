<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2023-08-02 09:54:10 --> Severity: 8192 --> Return type of CI_Session_files_driver::open($save_path, $name) should either be compatible with SessionHandlerInterface::open(string $path, string $name): bool, or the #[\ReturnTypeWillChange] attribute should be used to temporarily suppress the notice /var/www/html/Cliffs_Internation/system/libraries/Session/drivers/Session_files_driver.php 132
ERROR - 2023-08-02 09:54:10 --> Severity: 8192 --> Return type of CI_Session_files_driver::close() should either be compatible with SessionHandlerInterface::close(): bool, or the #[\ReturnTypeWillChange] attribute should be used to temporarily suppress the notice /var/www/html/Cliffs_Internation/system/libraries/Session/drivers/Session_files_driver.php 290
ERROR - 2023-08-02 09:54:10 --> Severity: 8192 --> Return type of CI_Session_files_driver::read($session_id) should either be compatible with SessionHandlerInterface::read(string $id): string|false, or the #[\ReturnTypeWillChange] attribute should be used to temporarily suppress the notice /var/www/html/Cliffs_Internation/system/libraries/Session/drivers/Session_files_driver.php 164
ERROR - 2023-08-02 09:54:10 --> Severity: 8192 --> Return type of CI_Session_files_driver::write($session_id, $session_data) should either be compatible with SessionHandlerInterface::write(string $id, string $data): bool, or the #[\ReturnTypeWillChange] attribute should be used to temporarily suppress the notice /var/www/html/Cliffs_Internation/system/libraries/Session/drivers/Session_files_driver.php 233
ERROR - 2023-08-02 09:54:10 --> Severity: 8192 --> Return type of CI_Session_files_driver::destroy($session_id) should either be compatible with SessionHandlerInterface::destroy(string $id): bool, or the #[\ReturnTypeWillChange] attribute should be used to temporarily suppress the notice /var/www/html/Cliffs_Internation/system/libraries/Session/drivers/Session_files_driver.php 313
ERROR - 2023-08-02 09:54:10 --> Severity: 8192 --> Return type of CI_Session_files_driver::gc($maxlifetime) should either be compatible with SessionHandlerInterface::gc(int $max_lifetime): int|false, or the #[\ReturnTypeWillChange] attribute should be used to temporarily suppress the notice /var/www/html/Cliffs_Internation/system/libraries/Session/drivers/Session_files_driver.php 354
ERROR - 2023-08-02 09:54:10 --> Severity: Warning --> ini_set(): Session ini settings cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 284
ERROR - 2023-08-02 09:54:10 --> Severity: Warning --> session_set_cookie_params(): Session cookie parameters cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 296
ERROR - 2023-08-02 09:54:10 --> Severity: Warning --> ini_set(): Session ini settings cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 306
ERROR - 2023-08-02 09:54:10 --> Severity: Warning --> ini_set(): Session ini settings cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 316
ERROR - 2023-08-02 09:54:10 --> Severity: Warning --> ini_set(): Session ini settings cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 317
ERROR - 2023-08-02 09:54:10 --> Severity: Warning --> ini_set(): Session ini settings cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 318
ERROR - 2023-08-02 09:54:10 --> Severity: Warning --> ini_set(): Session ini settings cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 319
ERROR - 2023-08-02 09:54:10 --> Severity: Warning --> ini_set(): Session ini settings cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 377
ERROR - 2023-08-02 09:54:10 --> Severity: Warning --> ini_set(): Session ini settings cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/drivers/Session_files_driver.php 108
ERROR - 2023-08-02 09:54:10 --> Severity: Warning --> session_set_save_handler(): Session save handler cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 110
ERROR - 2023-08-02 09:54:10 --> Severity: Warning --> session_start(): Session cannot be started after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 143
ERROR - 2023-08-02 09:54:10 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /var/www/html/Cliffs_Internation/system/core/Exceptions.php:271) /var/www/html/Cliffs_Internation/system/helpers/url_helper.php 564
ERROR - 2023-08-02 09:54:14 --> Severity: error --> Exception: Class "CI_Exceptions" not found /var/www/html/Cliffs_Internation/system/core/Common.php 196
ERROR - 2023-08-02 09:54:22 --> Severity: error --> Exception: Class "CI_Exceptions" not found /var/www/html/Cliffs_Internation/system/core/Common.php 196
ERROR - 2023-08-02 09:54:35 --> Severity: Error --> Uncaught Error: Class "CI_Exceptions" not found in /var/www/html/Cliffs_Internation/system/core/Common.php:196
Stack trace:
#0 /var/www/html/Cliffs_Internation/system/core/Common.php(617): load_class()
#1 /var/www/html/Cliffs_Internation/system/core/Common.php(163): _error_handler()
#2 /var/www/html/Cliffs_Internation/system/core/Common.php(163): require_once('...')
#3 /var/www/html/Cliffs_Internation/system/core/Common.php(652): load_class()
#4 [internal function]: _exception_handler()
#5 {main}
  thrown /var/www/html/Cliffs_Internation/system/core/Common.php 196
ERROR - 2023-08-02 11:21:07 --> Severity: 8192 --> Return type of CI_Session_files_driver::open($save_path, $name) should either be compatible with SessionHandlerInterface::open(string $path, string $name): bool, or the #[\ReturnTypeWillChange] attribute should be used to temporarily suppress the notice /var/www/html/Cliffs_Internation/system/libraries/Session/drivers/Session_files_driver.php 132
ERROR - 2023-08-02 11:21:07 --> Severity: 8192 --> Return type of CI_Session_files_driver::close() should either be compatible with SessionHandlerInterface::close(): bool, or the #[\ReturnTypeWillChange] attribute should be used to temporarily suppress the notice /var/www/html/Cliffs_Internation/system/libraries/Session/drivers/Session_files_driver.php 290
ERROR - 2023-08-02 11:21:07 --> Severity: 8192 --> Return type of CI_Session_files_driver::read($session_id) should either be compatible with SessionHandlerInterface::read(string $id): string|false, or the #[\ReturnTypeWillChange] attribute should be used to temporarily suppress the notice /var/www/html/Cliffs_Internation/system/libraries/Session/drivers/Session_files_driver.php 164
ERROR - 2023-08-02 11:21:07 --> Severity: 8192 --> Return type of CI_Session_files_driver::write($session_id, $session_data) should either be compatible with SessionHandlerInterface::write(string $id, string $data): bool, or the #[\ReturnTypeWillChange] attribute should be used to temporarily suppress the notice /var/www/html/Cliffs_Internation/system/libraries/Session/drivers/Session_files_driver.php 233
ERROR - 2023-08-02 11:21:07 --> Severity: 8192 --> Return type of CI_Session_files_driver::destroy($session_id) should either be compatible with SessionHandlerInterface::destroy(string $id): bool, or the #[\ReturnTypeWillChange] attribute should be used to temporarily suppress the notice /var/www/html/Cliffs_Internation/system/libraries/Session/drivers/Session_files_driver.php 313
ERROR - 2023-08-02 11:21:07 --> Severity: 8192 --> Return type of CI_Session_files_driver::gc($maxlifetime) should either be compatible with SessionHandlerInterface::gc(int $max_lifetime): int|false, or the #[\ReturnTypeWillChange] attribute should be used to temporarily suppress the notice /var/www/html/Cliffs_Internation/system/libraries/Session/drivers/Session_files_driver.php 354
ERROR - 2023-08-02 11:21:07 --> Severity: Warning --> ini_set(): Session ini settings cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 284
ERROR - 2023-08-02 11:21:07 --> Severity: Warning --> session_set_cookie_params(): Session cookie parameters cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 296
ERROR - 2023-08-02 11:21:07 --> Severity: Warning --> ini_set(): Session ini settings cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 306
ERROR - 2023-08-02 11:21:07 --> Severity: Warning --> ini_set(): Session ini settings cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 316
ERROR - 2023-08-02 11:21:07 --> Severity: Warning --> ini_set(): Session ini settings cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 317
ERROR - 2023-08-02 11:21:07 --> Severity: Warning --> ini_set(): Session ini settings cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 318
ERROR - 2023-08-02 11:21:07 --> Severity: Warning --> ini_set(): Session ini settings cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 319
ERROR - 2023-08-02 11:21:07 --> Severity: Warning --> ini_set(): Session ini settings cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 377
ERROR - 2023-08-02 11:21:07 --> Severity: Warning --> ini_set(): Session ini settings cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/drivers/Session_files_driver.php 108
ERROR - 2023-08-02 11:21:07 --> Severity: Warning --> session_set_save_handler(): Session save handler cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 110
ERROR - 2023-08-02 11:21:07 --> Severity: Warning --> session_start(): Session cannot be started after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 143
ERROR - 2023-08-02 11:21:07 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /var/www/html/Cliffs_Internation/system/core/Exceptions.php:271) /var/www/html/Cliffs_Internation/system/helpers/url_helper.php 564
ERROR - 2023-08-02 11:21:10 --> Severity: error --> Exception: Class "CI_Exceptions" not found /var/www/html/Cliffs_Internation/system/core/Common.php 196
ERROR - 2023-08-02 11:21:16 --> Severity: error --> Exception: Class "CI_Exceptions" not found /var/www/html/Cliffs_Internation/system/core/Common.php 196
ERROR - 2023-08-02 11:23:52 --> Severity: Error --> Uncaught Error: Class "CI_Exceptions" not found in /var/www/html/Cliffs_Internation/system/core/Common.php:196
Stack trace:
#0 /var/www/html/Cliffs_Internation/system/core/Common.php(617): load_class()
#1 /var/www/html/Cliffs_Internation/system/core/Common.php(163): _error_handler()
#2 /var/www/html/Cliffs_Internation/system/core/Common.php(163): require_once('...')
#3 /var/www/html/Cliffs_Internation/system/core/Common.php(652): load_class()
#4 [internal function]: _exception_handler()
#5 {main}
  thrown /var/www/html/Cliffs_Internation/system/core/Common.php 196
ERROR - 2023-08-02 11:31:26 --> Severity: Error --> Uncaught Error: Class "CI_Exceptions" not found in /var/www/html/Cliffs_Internation/system/core/Common.php:196
Stack trace:
#0 /var/www/html/Cliffs_Internation/system/core/Common.php(617): load_class()
#1 /var/www/html/Cliffs_Internation/system/core/Common.php(163): _error_handler()
#2 /var/www/html/Cliffs_Internation/system/core/Common.php(163): require_once('...')
#3 /var/www/html/Cliffs_Internation/system/core/Common.php(652): load_class()
#4 [internal function]: _exception_handler()
#5 {main}
  thrown /var/www/html/Cliffs_Internation/system/core/Common.php 196
ERROR - 2023-08-02 11:31:30 --> Severity: Error --> Uncaught Error: Class "CI_Exceptions" not found in /var/www/html/Cliffs_Internation/system/core/Common.php:196
Stack trace:
#0 /var/www/html/Cliffs_Internation/system/core/Common.php(617): load_class()
#1 /var/www/html/Cliffs_Internation/system/core/Common.php(163): _error_handler()
#2 /var/www/html/Cliffs_Internation/system/core/Common.php(163): require_once('...')
#3 /var/www/html/Cliffs_Internation/system/core/Common.php(652): load_class()
#4 [internal function]: _exception_handler()
#5 {main}
  thrown /var/www/html/Cliffs_Internation/system/core/Common.php 196
ERROR - 2023-08-02 12:24:25 --> Severity: Error --> Uncaught Error: Class "CI_Exceptions" not found in /var/www/html/Cliffs_Internation/system/core/Common.php:196
Stack trace:
#0 /var/www/html/Cliffs_Internation/system/core/Common.php(617): load_class()
#1 /var/www/html/Cliffs_Internation/system/core/Common.php(163): _error_handler()
#2 /var/www/html/Cliffs_Internation/system/core/Common.php(163): require_once('...')
#3 /var/www/html/Cliffs_Internation/system/core/Common.php(652): load_class()
#4 [internal function]: _exception_handler()
#5 {main}
  thrown /var/www/html/Cliffs_Internation/system/core/Common.php 196
