<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2023-07-10 08:42:48 --> Severity: 8192 --> Return type of CI_Session_files_driver::open($save_path, $name) should either be compatible with SessionHandlerInterface::open(string $path, string $name): bool, or the #[\ReturnTypeWillChange] attribute should be used to temporarily suppress the notice /var/www/html/Cliffs_Internation/system/libraries/Session/drivers/Session_files_driver.php 132
ERROR - 2023-07-10 08:42:48 --> Severity: 8192 --> Return type of CI_Session_files_driver::close() should either be compatible with SessionHandlerInterface::close(): bool, or the #[\ReturnTypeWillChange] attribute should be used to temporarily suppress the notice /var/www/html/Cliffs_Internation/system/libraries/Session/drivers/Session_files_driver.php 290
ERROR - 2023-07-10 08:42:48 --> Severity: 8192 --> Return type of CI_Session_files_driver::read($session_id) should either be compatible with SessionHandlerInterface::read(string $id): string|false, or the #[\ReturnTypeWillChange] attribute should be used to temporarily suppress the notice /var/www/html/Cliffs_Internation/system/libraries/Session/drivers/Session_files_driver.php 164
ERROR - 2023-07-10 08:42:48 --> Severity: 8192 --> Return type of CI_Session_files_driver::write($session_id, $session_data) should either be compatible with SessionHandlerInterface::write(string $id, string $data): bool, or the #[\ReturnTypeWillChange] attribute should be used to temporarily suppress the notice /var/www/html/Cliffs_Internation/system/libraries/Session/drivers/Session_files_driver.php 233
ERROR - 2023-07-10 08:42:48 --> Severity: 8192 --> Return type of CI_Session_files_driver::destroy($session_id) should either be compatible with SessionHandlerInterface::destroy(string $id): bool, or the #[\ReturnTypeWillChange] attribute should be used to temporarily suppress the notice /var/www/html/Cliffs_Internation/system/libraries/Session/drivers/Session_files_driver.php 313
ERROR - 2023-07-10 08:42:48 --> Severity: 8192 --> Return type of CI_Session_files_driver::gc($maxlifetime) should either be compatible with SessionHandlerInterface::gc(int $max_lifetime): int|false, or the #[\ReturnTypeWillChange] attribute should be used to temporarily suppress the notice /var/www/html/Cliffs_Internation/system/libraries/Session/drivers/Session_files_driver.php 354
ERROR - 2023-07-10 08:42:48 --> Severity: Warning --> ini_set(): Session ini settings cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 284
ERROR - 2023-07-10 08:42:48 --> Severity: Warning --> session_set_cookie_params(): Session cookie parameters cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 296
ERROR - 2023-07-10 08:42:48 --> Severity: Warning --> ini_set(): Session ini settings cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 306
ERROR - 2023-07-10 08:42:48 --> Severity: Warning --> ini_set(): Session ini settings cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 316
ERROR - 2023-07-10 08:42:48 --> Severity: Warning --> ini_set(): Session ini settings cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 317
ERROR - 2023-07-10 08:42:48 --> Severity: Warning --> ini_set(): Session ini settings cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 318
ERROR - 2023-07-10 08:42:48 --> Severity: Warning --> ini_set(): Session ini settings cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 319
ERROR - 2023-07-10 08:42:48 --> Severity: Warning --> ini_set(): Session ini settings cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 377
ERROR - 2023-07-10 08:42:48 --> Severity: Warning --> ini_set(): Session ini settings cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/drivers/Session_files_driver.php 108
ERROR - 2023-07-10 08:42:48 --> Severity: Warning --> session_set_save_handler(): Session save handler cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 110
ERROR - 2023-07-10 08:42:48 --> Severity: Warning --> session_start(): Session cannot be started after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 143
ERROR - 2023-07-10 08:42:48 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /var/www/html/Cliffs_Internation/system/core/Exceptions.php:271) /var/www/html/Cliffs_Internation/system/helpers/url_helper.php 564
ERROR - 2023-07-10 08:42:53 --> Severity: error --> Exception: Class "CI_Exceptions" not found /var/www/html/Cliffs_Internation/system/core/Common.php 196
ERROR - 2023-07-10 08:47:44 --> Severity: Error --> Uncaught Error: Class "CI_Exceptions" not found in /var/www/html/Cliffs_Internation/system/core/Common.php:196
Stack trace:
#0 /var/www/html/Cliffs_Internation/system/core/Common.php(617): load_class()
#1 /var/www/html/Cliffs_Internation/system/core/Common.php(163): _error_handler()
#2 /var/www/html/Cliffs_Internation/system/core/Common.php(163): require_once('...')
#3 /var/www/html/Cliffs_Internation/system/core/Common.php(652): load_class()
#4 [internal function]: _exception_handler()
#5 {main}
  thrown /var/www/html/Cliffs_Internation/system/core/Common.php 196
ERROR - 2023-07-10 08:48:38 --> Severity: 8192 --> setcookie(): Passing null to parameter #2 ($value) of type string is deprecated /var/www/html/Cliffs_Internation/system/libraries/Session/Session_driver.php 132
ERROR - 2023-07-10 08:48:38 --> Severity: error --> Exception: Class "CI_Exceptions" not found /var/www/html/Cliffs_Internation/system/core/Common.php 196
ERROR - 2023-07-10 08:48:54 --> Severity: Error --> Uncaught Error: Class "CI_Exceptions" not found in /var/www/html/Cliffs_Internation/system/core/Common.php:196
Stack trace:
#0 /var/www/html/Cliffs_Internation/system/core/Common.php(617): load_class()
#1 /var/www/html/Cliffs_Internation/system/core/Common.php(163): _error_handler()
#2 /var/www/html/Cliffs_Internation/system/core/Common.php(163): require_once('...')
#3 /var/www/html/Cliffs_Internation/system/core/Common.php(652): load_class()
#4 [internal function]: _exception_handler()
#5 {main}
  thrown /var/www/html/Cliffs_Internation/system/core/Common.php 196
ERROR - 2023-07-10 09:12:18 --> Severity: 8192 --> setcookie(): Passing null to parameter #2 ($value) of type string is deprecated /var/www/html/Cliffs_Internation/system/libraries/Session/Session_driver.php 132
ERROR - 2023-07-10 09:12:18 --> Severity: error --> Exception: Class "CI_Exceptions" not found /var/www/html/Cliffs_Internation/system/core/Common.php 196
ERROR - 2023-07-10 09:12:32 --> Severity: Error --> Uncaught Error: Class "CI_Exceptions" not found in /var/www/html/Cliffs_Internation/system/core/Common.php:196
Stack trace:
#0 /var/www/html/Cliffs_Internation/system/core/Common.php(617): load_class()
#1 /var/www/html/Cliffs_Internation/system/core/Common.php(163): _error_handler()
#2 /var/www/html/Cliffs_Internation/system/core/Common.php(163): require_once('...')
#3 /var/www/html/Cliffs_Internation/system/core/Common.php(652): load_class()
#4 [internal function]: _exception_handler()
#5 {main}
  thrown /var/www/html/Cliffs_Internation/system/core/Common.php 196
ERROR - 2023-07-10 09:12:48 --> Severity: Error --> Uncaught Error: Class "CI_Exceptions" not found in /var/www/html/Cliffs_Internation/system/core/Common.php:196
Stack trace:
#0 /var/www/html/Cliffs_Internation/system/core/Common.php(617): load_class()
#1 /var/www/html/Cliffs_Internation/system/core/Common.php(163): _error_handler()
#2 /var/www/html/Cliffs_Internation/system/core/Common.php(163): require_once('...')
#3 /var/www/html/Cliffs_Internation/system/core/Common.php(652): load_class()
#4 [internal function]: _exception_handler()
#5 {main}
  thrown /var/www/html/Cliffs_Internation/system/core/Common.php 196
ERROR - 2023-07-10 09:15:16 --> Severity: Error --> Uncaught Error: Class "CI_Exceptions" not found in /var/www/html/Cliffs_Internation/system/core/Common.php:196
Stack trace:
#0 /var/www/html/Cliffs_Internation/system/core/Common.php(617): load_class()
#1 /var/www/html/Cliffs_Internation/system/core/Common.php(163): _error_handler()
#2 /var/www/html/Cliffs_Internation/system/core/Common.php(163): require_once('...')
#3 /var/www/html/Cliffs_Internation/system/core/Common.php(652): load_class()
#4 [internal function]: _exception_handler()
#5 {main}
  thrown /var/www/html/Cliffs_Internation/system/core/Common.php 196
ERROR - 2023-07-10 09:15:51 --> Severity: Error --> Uncaught Error: Class "CI_Exceptions" not found in /var/www/html/Cliffs_Internation/system/core/Common.php:196
Stack trace:
#0 /var/www/html/Cliffs_Internation/system/core/Common.php(617): load_class()
#1 /var/www/html/Cliffs_Internation/system/core/Common.php(163): _error_handler()
#2 /var/www/html/Cliffs_Internation/system/core/Common.php(163): require_once('...')
#3 /var/www/html/Cliffs_Internation/system/core/Common.php(652): load_class()
#4 [internal function]: _exception_handler()
#5 {main}
  thrown /var/www/html/Cliffs_Internation/system/core/Common.php 196
ERROR - 2023-07-10 09:19:03 --> Severity: 8192 --> Return type of CI_Session_files_driver::open($save_path, $name) should either be compatible with SessionHandlerInterface::open(string $path, string $name): bool, or the #[\ReturnTypeWillChange] attribute should be used to temporarily suppress the notice /var/www/html/Cliffs_Internation/system/libraries/Session/drivers/Session_files_driver.php 132
ERROR - 2023-07-10 09:19:03 --> Severity: 8192 --> Return type of CI_Session_files_driver::close() should either be compatible with SessionHandlerInterface::close(): bool, or the #[\ReturnTypeWillChange] attribute should be used to temporarily suppress the notice /var/www/html/Cliffs_Internation/system/libraries/Session/drivers/Session_files_driver.php 290
ERROR - 2023-07-10 09:19:03 --> Severity: 8192 --> Return type of CI_Session_files_driver::read($session_id) should either be compatible with SessionHandlerInterface::read(string $id): string|false, or the #[\ReturnTypeWillChange] attribute should be used to temporarily suppress the notice /var/www/html/Cliffs_Internation/system/libraries/Session/drivers/Session_files_driver.php 164
ERROR - 2023-07-10 09:19:03 --> Severity: 8192 --> Return type of CI_Session_files_driver::write($session_id, $session_data) should either be compatible with SessionHandlerInterface::write(string $id, string $data): bool, or the #[\ReturnTypeWillChange] attribute should be used to temporarily suppress the notice /var/www/html/Cliffs_Internation/system/libraries/Session/drivers/Session_files_driver.php 233
ERROR - 2023-07-10 09:19:03 --> Severity: 8192 --> Return type of CI_Session_files_driver::destroy($session_id) should either be compatible with SessionHandlerInterface::destroy(string $id): bool, or the #[\ReturnTypeWillChange] attribute should be used to temporarily suppress the notice /var/www/html/Cliffs_Internation/system/libraries/Session/drivers/Session_files_driver.php 313
ERROR - 2023-07-10 09:19:03 --> Severity: 8192 --> Return type of CI_Session_files_driver::gc($maxlifetime) should either be compatible with SessionHandlerInterface::gc(int $max_lifetime): int|false, or the #[\ReturnTypeWillChange] attribute should be used to temporarily suppress the notice /var/www/html/Cliffs_Internation/system/libraries/Session/drivers/Session_files_driver.php 354
ERROR - 2023-07-10 09:19:03 --> Severity: Warning --> ini_set(): Session ini settings cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 284
ERROR - 2023-07-10 09:19:03 --> Severity: Warning --> session_set_cookie_params(): Session cookie parameters cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 296
ERROR - 2023-07-10 09:19:03 --> Severity: Warning --> ini_set(): Session ini settings cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 306
ERROR - 2023-07-10 09:19:03 --> Severity: Warning --> ini_set(): Session ini settings cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 316
ERROR - 2023-07-10 09:19:03 --> Severity: Warning --> ini_set(): Session ini settings cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 317
ERROR - 2023-07-10 09:19:03 --> Severity: Warning --> ini_set(): Session ini settings cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 318
ERROR - 2023-07-10 09:19:03 --> Severity: Warning --> ini_set(): Session ini settings cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 319
ERROR - 2023-07-10 09:19:03 --> Severity: Warning --> ini_set(): Session ini settings cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 377
ERROR - 2023-07-10 09:19:03 --> Severity: Warning --> ini_set(): Session ini settings cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/drivers/Session_files_driver.php 108
ERROR - 2023-07-10 09:19:03 --> Severity: Warning --> session_set_save_handler(): Session save handler cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 110
ERROR - 2023-07-10 09:19:03 --> Severity: Warning --> session_start(): Session cannot be started after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 143
ERROR - 2023-07-10 09:19:03 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /var/www/html/Cliffs_Internation/system/core/Exceptions.php:271) /var/www/html/Cliffs_Internation/system/helpers/url_helper.php 564
ERROR - 2023-07-10 09:19:22 --> Severity: Error --> Uncaught Error: Class "CI_Exceptions" not found in /var/www/html/Cliffs_Internation/system/core/Common.php:196
Stack trace:
#0 /var/www/html/Cliffs_Internation/system/core/Common.php(617): load_class()
#1 /var/www/html/Cliffs_Internation/system/core/Common.php(163): _error_handler()
#2 /var/www/html/Cliffs_Internation/system/core/Common.php(163): require_once('...')
#3 /var/www/html/Cliffs_Internation/system/core/Common.php(652): load_class()
#4 [internal function]: _exception_handler()
#5 {main}
  thrown /var/www/html/Cliffs_Internation/system/core/Common.php 196
ERROR - 2023-07-10 09:19:51 --> Severity: Error --> Uncaught Error: Class "CI_Exceptions" not found in /var/www/html/Cliffs_Internation/system/core/Common.php:196
Stack trace:
#0 /var/www/html/Cliffs_Internation/system/core/Common.php(617): load_class()
#1 /var/www/html/Cliffs_Internation/system/core/Common.php(163): _error_handler()
#2 /var/www/html/Cliffs_Internation/system/core/Common.php(163): require_once('...')
#3 /var/www/html/Cliffs_Internation/system/core/Common.php(652): load_class()
#4 [internal function]: _exception_handler()
#5 {main}
  thrown /var/www/html/Cliffs_Internation/system/core/Common.php 196
ERROR - 2023-07-10 09:20:27 --> Severity: Error --> Uncaught Error: Class "CI_Exceptions" not found in /var/www/html/Cliffs_Internation/system/core/Common.php:196
Stack trace:
#0 /var/www/html/Cliffs_Internation/system/core/Common.php(617): load_class()
#1 /var/www/html/Cliffs_Internation/system/core/Common.php(163): _error_handler()
#2 /var/www/html/Cliffs_Internation/system/core/Common.php(163): require_once('...')
#3 /var/www/html/Cliffs_Internation/system/core/Common.php(652): load_class()
#4 [internal function]: _exception_handler()
#5 {main}
  thrown /var/www/html/Cliffs_Internation/system/core/Common.php 196
ERROR - 2023-07-10 09:27:44 --> Severity: Error --> Uncaught Error: Class "CI_Exceptions" not found in /var/www/html/Cliffs_Internation/system/core/Common.php:196
Stack trace:
#0 /var/www/html/Cliffs_Internation/system/core/Common.php(617): load_class()
#1 /var/www/html/Cliffs_Internation/system/core/Common.php(163): _error_handler()
#2 /var/www/html/Cliffs_Internation/system/core/Common.php(163): require_once('...')
#3 /var/www/html/Cliffs_Internation/system/core/Common.php(652): load_class()
#4 [internal function]: _exception_handler()
#5 {main}
  thrown /var/www/html/Cliffs_Internation/system/core/Common.php 196
ERROR - 2023-07-10 09:27:52 --> Severity: Error --> Uncaught Error: Class "CI_Exceptions" not found in /var/www/html/Cliffs_Internation/system/core/Common.php:196
Stack trace:
#0 /var/www/html/Cliffs_Internation/system/core/Common.php(617): load_class()
#1 /var/www/html/Cliffs_Internation/system/core/Common.php(163): _error_handler()
#2 /var/www/html/Cliffs_Internation/system/core/Common.php(163): require_once('...')
#3 /var/www/html/Cliffs_Internation/system/core/Common.php(652): load_class()
#4 [internal function]: _exception_handler()
#5 {main}
  thrown /var/www/html/Cliffs_Internation/system/core/Common.php 196
ERROR - 2023-07-10 09:28:17 --> Severity: Error --> Uncaught Error: Class "CI_Exceptions" not found in /var/www/html/Cliffs_Internation/system/core/Common.php:196
Stack trace:
#0 /var/www/html/Cliffs_Internation/system/core/Common.php(617): load_class()
#1 /var/www/html/Cliffs_Internation/system/core/Common.php(163): _error_handler()
#2 /var/www/html/Cliffs_Internation/system/core/Common.php(163): require_once('...')
#3 /var/www/html/Cliffs_Internation/system/core/Common.php(652): load_class()
#4 [internal function]: _exception_handler()
#5 {main}
  thrown /var/www/html/Cliffs_Internation/system/core/Common.php 196
ERROR - 2023-07-10 09:29:01 --> Severity: Error --> Uncaught Error: Class "CI_Exceptions" not found in /var/www/html/Cliffs_Internation/system/core/Common.php:196
Stack trace:
#0 /var/www/html/Cliffs_Internation/system/core/Common.php(617): load_class()
#1 /var/www/html/Cliffs_Internation/system/core/Common.php(163): _error_handler()
#2 /var/www/html/Cliffs_Internation/system/core/Common.php(163): require_once('...')
#3 /var/www/html/Cliffs_Internation/system/core/Common.php(652): load_class()
#4 [internal function]: _exception_handler()
#5 {main}
  thrown /var/www/html/Cliffs_Internation/system/core/Common.php 196
ERROR - 2023-07-10 09:38:43 --> Severity: Error --> Uncaught Error: Class "CI_Exceptions" not found in /var/www/html/Cliffs_Internation/system/core/Common.php:196
Stack trace:
#0 /var/www/html/Cliffs_Internation/system/core/Common.php(617): load_class()
#1 /var/www/html/Cliffs_Internation/system/core/Common.php(163): _error_handler()
#2 /var/www/html/Cliffs_Internation/system/core/Common.php(163): require_once('...')
#3 /var/www/html/Cliffs_Internation/system/core/Common.php(652): load_class()
#4 [internal function]: _exception_handler()
#5 {main}
  thrown /var/www/html/Cliffs_Internation/system/core/Common.php 196
ERROR - 2023-07-10 09:38:53 --> Severity: Error --> Uncaught Error: Class "CI_Exceptions" not found in /var/www/html/Cliffs_Internation/system/core/Common.php:196
Stack trace:
#0 /var/www/html/Cliffs_Internation/system/core/Common.php(617): load_class()
#1 /var/www/html/Cliffs_Internation/system/core/Common.php(163): _error_handler()
#2 /var/www/html/Cliffs_Internation/system/core/Common.php(163): require_once('...')
#3 /var/www/html/Cliffs_Internation/system/core/Common.php(652): load_class()
#4 [internal function]: _exception_handler()
#5 {main}
  thrown /var/www/html/Cliffs_Internation/system/core/Common.php 196
ERROR - 2023-07-10 10:54:21 --> DESC transDate
ERROR - 2023-07-10 10:54:21 --> Severity: Error --> Uncaught Error: Class "CI_Exceptions" not found in /var/www/html/Cliffs_Internation/system/core/Common.php:196
Stack trace:
#0 /var/www/html/Cliffs_Internation/system/core/Common.php(617): load_class()
#1 /var/www/html/Cliffs_Internation/system/core/Common.php(163): _error_handler()
#2 /var/www/html/Cliffs_Internation/system/core/Common.php(163): require_once('...')
#3 /var/www/html/Cliffs_Internation/system/core/Common.php(652): load_class()
#4 [internal function]: _exception_handler()
#5 {main}
  thrown /var/www/html/Cliffs_Internation/system/core/Common.php 196
ERROR - 2023-07-10 10:54:38 --> DESC quantity
ERROR - 2023-07-10 10:54:40 --> DESC transDate
ERROR - 2023-07-10 10:54:40 --> Severity: Error --> Uncaught Error: Class "CI_Exceptions" not found in /var/www/html/Cliffs_Internation/system/core/Common.php:196
Stack trace:
#0 /var/www/html/Cliffs_Internation/system/core/Common.php(617): load_class()
#1 /var/www/html/Cliffs_Internation/system/core/Common.php(163): _error_handler()
#2 /var/www/html/Cliffs_Internation/system/core/Common.php(163): require_once('...')
#3 /var/www/html/Cliffs_Internation/system/core/Common.php(652): load_class()
#4 [internal function]: _exception_handler()
#5 {main}
  thrown /var/www/html/Cliffs_Internation/system/core/Common.php 196
ERROR - 2023-07-10 11:03:27 --> DESC transDate
ERROR - 2023-07-10 11:03:27 --> Severity: Error --> Uncaught Error: Class "CI_Exceptions" not found in /var/www/html/Cliffs_Internation/system/core/Common.php:196
Stack trace:
#0 /var/www/html/Cliffs_Internation/system/core/Common.php(617): load_class()
#1 /var/www/html/Cliffs_Internation/system/core/Common.php(163): _error_handler()
#2 /var/www/html/Cliffs_Internation/system/core/Common.php(163): require_once('...')
#3 /var/www/html/Cliffs_Internation/system/core/Common.php(652): load_class()
#4 [internal function]: _exception_handler()
#5 {main}
  thrown /var/www/html/Cliffs_Internation/system/core/Common.php 196
ERROR - 2023-07-10 11:04:12 --> DESC transDate
ERROR - 2023-07-10 11:04:12 --> Severity: Error --> Uncaught Error: Class "CI_Exceptions" not found in /var/www/html/Cliffs_Internation/system/core/Common.php:196
Stack trace:
#0 /var/www/html/Cliffs_Internation/system/core/Common.php(617): load_class()
#1 /var/www/html/Cliffs_Internation/system/core/Common.php(163): _error_handler()
#2 /var/www/html/Cliffs_Internation/system/core/Common.php(163): require_once('...')
#3 /var/www/html/Cliffs_Internation/system/core/Common.php(652): load_class()
#4 [internal function]: _exception_handler()
#5 {main}
  thrown /var/www/html/Cliffs_Internation/system/core/Common.php 196
ERROR - 2023-07-10 11:13:38 --> DESC transDate
ERROR - 2023-07-10 11:13:38 --> 44
ERROR - 2023-07-10 11:13:38 --> Severity: Error --> Uncaught Error: Class "CI_Exceptions" not found in /var/www/html/Cliffs_Internation/system/core/Common.php:196
Stack trace:
#0 /var/www/html/Cliffs_Internation/system/core/Common.php(617): load_class()
#1 /var/www/html/Cliffs_Internation/system/core/Common.php(163): _error_handler()
#2 /var/www/html/Cliffs_Internation/system/core/Common.php(163): require_once('...')
#3 /var/www/html/Cliffs_Internation/system/core/Common.php(652): load_class()
#4 [internal function]: _exception_handler()
#5 {main}
  thrown /var/www/html/Cliffs_Internation/system/core/Common.php 196
ERROR - 2023-07-10 11:14:50 --> DESC transDate
ERROR - 2023-07-10 11:14:50 --> 44
ERROR - 2023-07-10 11:14:50 --> we are here now
ERROR - 2023-07-10 11:14:50 --> Severity: Error --> Uncaught Error: Class "CI_Exceptions" not found in /var/www/html/Cliffs_Internation/system/core/Common.php:196
Stack trace:
#0 /var/www/html/Cliffs_Internation/system/core/Common.php(617): load_class()
#1 /var/www/html/Cliffs_Internation/system/core/Common.php(163): _error_handler()
#2 /var/www/html/Cliffs_Internation/system/core/Common.php(163): require_once('...')
#3 /var/www/html/Cliffs_Internation/system/core/Common.php(652): load_class()
#4 [internal function]: _exception_handler()
#5 {main}
  thrown /var/www/html/Cliffs_Internation/system/core/Common.php 196
ERROR - 2023-07-10 11:15:40 --> DESC transDate
ERROR - 2023-07-10 11:15:40 --> 44
ERROR - 2023-07-10 11:15:40 --> we are here now
ERROR - 2023-07-10 11:15:40 --> 0
ERROR - 2023-07-10 11:15:40 --> Severity: Error --> Uncaught Error: Class "CI_Exceptions" not found in /var/www/html/Cliffs_Internation/system/core/Common.php:196
Stack trace:
#0 /var/www/html/Cliffs_Internation/system/core/Common.php(617): load_class()
#1 /var/www/html/Cliffs_Internation/system/core/Common.php(163): _error_handler()
#2 /var/www/html/Cliffs_Internation/system/core/Common.php(163): require_once('...')
#3 /var/www/html/Cliffs_Internation/system/core/Common.php(652): load_class()
#4 [internal function]: _exception_handler()
#5 {main}
  thrown /var/www/html/Cliffs_Internation/system/core/Common.php 196
ERROR - 2023-07-10 11:16:05 --> ASC transDate
ERROR - 2023-07-10 11:16:05 --> 44
ERROR - 2023-07-10 11:16:05 --> we are here now
ERROR - 2023-07-10 11:16:05 --> 0
ERROR - 2023-07-10 11:17:22 --> DESC transDate
ERROR - 2023-07-10 11:17:22 --> 44
ERROR - 2023-07-10 11:17:22 --> we are here now
ERROR - 2023-07-10 11:17:22 --> 0
ERROR - 2023-07-10 11:17:22 --> Severity: Error --> Uncaught Error: Class "CI_Exceptions" not found in /var/www/html/Cliffs_Internation/system/core/Common.php:196
Stack trace:
#0 /var/www/html/Cliffs_Internation/system/core/Common.php(617): load_class()
#1 /var/www/html/Cliffs_Internation/system/core/Common.php(163): _error_handler()
#2 /var/www/html/Cliffs_Internation/system/core/Common.php(163): require_once('...')
#3 /var/www/html/Cliffs_Internation/system/core/Common.php(652): load_class()
#4 [internal function]: _exception_handler()
#5 {main}
  thrown /var/www/html/Cliffs_Internation/system/core/Common.php 196
ERROR - 2023-07-10 11:21:44 --> DESC transDate
ERROR - 2023-07-10 11:21:44 --> 44
ERROR - 2023-07-10 11:21:44 --> 0
ERROR - 2023-07-10 11:21:44 --> we are here now
ERROR - 2023-07-10 11:21:45 --> Severity: Error --> Uncaught Error: Class "CI_Exceptions" not found in /var/www/html/Cliffs_Internation/system/core/Common.php:196
Stack trace:
#0 /var/www/html/Cliffs_Internation/system/core/Common.php(617): load_class()
#1 /var/www/html/Cliffs_Internation/system/core/Common.php(163): _error_handler()
#2 /var/www/html/Cliffs_Internation/system/core/Common.php(163): require_once('...')
#3 /var/www/html/Cliffs_Internation/system/core/Common.php(652): load_class()
#4 [internal function]: _exception_handler()
#5 {main}
  thrown /var/www/html/Cliffs_Internation/system/core/Common.php 196
ERROR - 2023-07-10 11:22:56 --> DESC transDate
ERROR - 2023-07-10 11:22:56 --> 44
ERROR - 2023-07-10 11:22:56 --> 0
ERROR - 2023-07-10 11:22:56 --> 10
ERROR - 2023-07-10 11:22:56 --> 0
ERROR - 2023-07-10 11:22:56 --> we are here now
ERROR - 2023-07-10 11:22:56 --> Severity: Error --> Uncaught Error: Class "CI_Exceptions" not found in /var/www/html/Cliffs_Internation/system/core/Common.php:196
Stack trace:
#0 /var/www/html/Cliffs_Internation/system/core/Common.php(617): load_class()
#1 /var/www/html/Cliffs_Internation/system/core/Common.php(163): _error_handler()
#2 /var/www/html/Cliffs_Internation/system/core/Common.php(163): require_once('...')
#3 /var/www/html/Cliffs_Internation/system/core/Common.php(652): load_class()
#4 [internal function]: _exception_handler()
#5 {main}
  thrown /var/www/html/Cliffs_Internation/system/core/Common.php 196
ERROR - 2023-07-10 11:23:19 --> ASC transDate
ERROR - 2023-07-10 11:23:19 --> 44
ERROR - 2023-07-10 11:23:19 --> 0
ERROR - 2023-07-10 11:23:19 --> 10
ERROR - 2023-07-10 11:23:19 --> 0
ERROR - 2023-07-10 11:23:19 --> we are here now
ERROR - 2023-07-10 11:27:07 --> DESC transDate
ERROR - 2023-07-10 11:27:07 --> 44
ERROR - 2023-07-10 11:27:07 --> 0
ERROR - 2023-07-10 11:27:07 --> 10
ERROR - 2023-07-10 11:27:07 --> 0
ERROR - 2023-07-10 11:27:07 --> Severity: Error --> Uncaught Error: Class "CI_Exceptions" not found in /var/www/html/Cliffs_Internation/system/core/Common.php:196
Stack trace:
#0 /var/www/html/Cliffs_Internation/system/core/Common.php(617): load_class()
#1 /var/www/html/Cliffs_Internation/system/core/Common.php(163): _error_handler()
#2 /var/www/html/Cliffs_Internation/system/core/Common.php(163): require_once('...')
#3 /var/www/html/Cliffs_Internation/system/core/Common.php(652): load_class()
#4 [internal function]: _exception_handler()
#5 {main}
  thrown /var/www/html/Cliffs_Internation/system/core/Common.php 196
ERROR - 2023-07-10 11:27:36 --> ASC transDate
ERROR - 2023-07-10 11:27:36 --> 44
ERROR - 2023-07-10 11:27:36 --> 0
ERROR - 2023-07-10 11:27:36 --> 10
ERROR - 2023-07-10 11:27:36 --> 0
ERROR - 2023-07-10 11:27:36 --> Array
(
    [total_rows] => 44
    [base_url] => http://localhost/Cliffs_Internation/transactions/latr_
    [per_page] => 10
    [uri_segment] => 3
    [num_links] => 5
    [use_page_numbers] => 1
    [first_link] => 
    [last_link] => 
    [prev_link] => &lt;&lt;
    [next_link] => &gt;&gt;
    [full_tag_open] => <ul class='pagination'>
    [full_tag_close] => </ul>
    [num_tag_open] => <li>
    [num_tag_close] => </li>
    [next_tag_open] => <li>
    [next_tag_close] => </li>
    [prev_tag_open] => <li>
    [prev_tag_close] => </li>
    [cur_tag_open] => <li><a><b style="color:black">
    [cur_tag_close] => </b></a></li>
    [attributes] => Array
        (
            [onclick] => return latr_(this.href);
        )

)

ERROR - 2023-07-10 11:27:39 --> DESC transDate
ERROR - 2023-07-10 11:27:39 --> 44
ERROR - 2023-07-10 11:27:39 --> 0
ERROR - 2023-07-10 11:27:39 --> 10
ERROR - 2023-07-10 11:27:39 --> 0
ERROR - 2023-07-10 11:27:39 --> Array
(
    [total_rows] => 44
    [base_url] => http://localhost/Cliffs_Internation/transactions/latr_
    [per_page] => 10
    [uri_segment] => 3
    [num_links] => 5
    [use_page_numbers] => 1
    [first_link] => 
    [last_link] => 
    [prev_link] => &lt;&lt;
    [next_link] => &gt;&gt;
    [full_tag_open] => <ul class='pagination'>
    [full_tag_close] => </ul>
    [num_tag_open] => <li>
    [num_tag_close] => </li>
    [next_tag_open] => <li>
    [next_tag_close] => </li>
    [prev_tag_open] => <li>
    [prev_tag_close] => </li>
    [cur_tag_open] => <li><a><b style="color:black">
    [cur_tag_close] => </b></a></li>
    [attributes] => Array
        (
            [onclick] => return latr_(this.href);
        )

)

ERROR - 2023-07-10 11:27:39 --> Severity: Error --> Uncaught Error: Class "CI_Exceptions" not found in /var/www/html/Cliffs_Internation/system/core/Common.php:196
Stack trace:
#0 /var/www/html/Cliffs_Internation/system/core/Common.php(617): load_class()
#1 /var/www/html/Cliffs_Internation/system/core/Common.php(163): _error_handler()
#2 /var/www/html/Cliffs_Internation/system/core/Common.php(163): require_once('...')
#3 /var/www/html/Cliffs_Internation/system/core/Common.php(652): load_class()
#4 [internal function]: _exception_handler()
#5 {main}
  thrown /var/www/html/Cliffs_Internation/system/core/Common.php 196
ERROR - 2023-07-10 11:30:41 --> ASC transDate
ERROR - 2023-07-10 11:30:41 --> 44
ERROR - 2023-07-10 11:30:41 --> 0
ERROR - 2023-07-10 11:30:41 --> 10
ERROR - 2023-07-10 11:30:41 --> 0
ERROR - 2023-07-10 11:30:41 --> we are here taboz
ERROR - 2023-07-10 11:30:44 --> DESC transDate
ERROR - 2023-07-10 11:30:44 --> 44
ERROR - 2023-07-10 11:30:44 --> 0
ERROR - 2023-07-10 11:30:44 --> 10
ERROR - 2023-07-10 11:30:44 --> 0
ERROR - 2023-07-10 11:30:44 --> we are here taboz
ERROR - 2023-07-10 11:30:44 --> Severity: Error --> Uncaught Error: Class "CI_Exceptions" not found in /var/www/html/Cliffs_Internation/system/core/Common.php:196
Stack trace:
#0 /var/www/html/Cliffs_Internation/system/core/Common.php(617): load_class()
#1 /var/www/html/Cliffs_Internation/system/core/Common.php(163): _error_handler()
#2 /var/www/html/Cliffs_Internation/system/core/Common.php(163): require_once('...')
#3 /var/www/html/Cliffs_Internation/system/core/Common.php(652): load_class()
#4 [internal function]: _exception_handler()
#5 {main}
  thrown /var/www/html/Cliffs_Internation/system/core/Common.php 196
ERROR - 2023-07-10 11:35:30 --> ASC transDate
ERROR - 2023-07-10 11:35:30 --> 44
ERROR - 2023-07-10 11:35:30 --> 0
ERROR - 2023-07-10 11:35:30 --> 10
ERROR - 2023-07-10 11:35:30 --> 0
ERROR - 2023-07-10 11:35:30 --> we are here taboz
ERROR - 2023-07-10 11:35:30 --> Array
(
    [0] => stdClass Object
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

    [1] => stdClass Object
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

    [2] => stdClass Object
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

    [3] => stdClass Object
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

    [4] => stdClass Object
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

    [5] => stdClass Object
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

    [6] => stdClass Object
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

    [7] => stdClass Object
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

    [8] => stdClass Object
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

    [9] => stdClass Object
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

)

ERROR - 2023-07-10 11:35:48 --> DESC transDate
ERROR - 2023-07-10 11:35:48 --> 44
ERROR - 2023-07-10 11:35:48 --> 0
ERROR - 2023-07-10 11:35:48 --> 10
ERROR - 2023-07-10 11:35:48 --> 0
ERROR - 2023-07-10 11:35:48 --> we are here taboz
ERROR - 2023-07-10 11:35:48 --> Array
(
    [0] => stdClass Object
        (
            [transId] => 47
            [totalPrice] => 55.00
            [ref] => 473967314
            [totalMoneySpent] => 55.00
            [modeOfPayment] => Cash
            [staffId] => 1
            [transDate] => 2023-07-10 09:20:27
            [lastUpdated] => 2023-07-10 09:20:27
            [amountTendered] => 100.00
            [cancelled] => 0
            [changeDue] => 45.00
            [staffName] => Admin Liam
            [cust_name] => 
            [cust_phone] => 0775923458
            [cust_email] => 
            [quantity] => 1
        )

    [1] => stdClass Object
        (
            [transId] => 45,46
            [totalPrice] => 25.00,275.00
            [ref] => 128607483
            [totalMoneySpent] => 300.00
            [modeOfPayment] => Cash
            [staffId] => 1
            [transDate] => 2023-07-10 08:47:44
            [lastUpdated] => 2023-07-10 08:47:44
            [amountTendered] => 400.00
            [cancelled] => 0
            [changeDue] => 100.00
            [staffName] => Admin Liam
            [cust_name] => 
            [cust_phone] => 0773372616
            [cust_email] => 
            [quantity] => 6
        )

    [2] => stdClass Object
        (
            [transId] => 44
            [totalPrice] => 3436.40
            [ref] => 26439195
            [totalMoneySpent] => 3436.40
            [modeOfPayment] => Cash and POS
            [staffId] => 1
            [transDate] => 2023-07-03 16:23:12
            [lastUpdated] => 2023-07-03 16:23:12
            [amountTendered] => 3436.40
            [cancelled] => 0
            [changeDue] => 0.00
            [staffName] => Admin Liam
            [cust_name] => 
            [cust_phone] => 0775923458
            [cust_email] => 
            [quantity] => 55
        )

    [3] => stdClass Object
        (
            [transId] => 43
            [totalPrice] => 62.48
            [ref] => 523091
            [totalMoneySpent] => 62.48
            [modeOfPayment] => POS
            [staffId] => 1
            [transDate] => 2023-07-03 16:08:23
            [lastUpdated] => 2023-07-03 16:08:23
            [amountTendered] => 62.48
            [cancelled] => 0
            [changeDue] => 0.00
            [staffName] => Admin Liam
            [cust_name] => 
            [cust_phone] => 0773372616
            [cust_email] => 
            [quantity] => 1
        )

    [4] => stdClass Object
        (
            [transId] => 42
            [totalPrice] => 62.48
            [ref] => 2874932
            [totalMoneySpent] => 62.48
            [modeOfPayment] => Cash
            [staffId] => 1
            [transDate] => 2023-07-03 16:05:52
            [lastUpdated] => 2023-07-03 16:05:52
            [amountTendered] => 100.00
            [cancelled] => 0
            [changeDue] => 37.52
            [staffName] => Admin Liam
            [cust_name] => 
            [cust_phone] => 0775923459
            [cust_email] => 
            [quantity] => 1
        )

    [5] => stdClass Object
        (
            [transId] => 39
            [totalPrice] => 2311.76
            [ref] => 363169075
            [totalMoneySpent] => 2311.76
            [modeOfPayment] => Cash and POS
            [staffId] => 4
            [transDate] => 2023-07-03 16:00:15
            [lastUpdated] => 2023-07-03 16:00:15
            [amountTendered] => 2500.00
            [cancelled] => 0
            [changeDue] => 188.24
            [staffName] => Taboz Mafura
            [cust_name] => 
            [cust_phone] => 0775932458
            [cust_email] => 
            [quantity] => 37
        )

    [6] => stdClass Object
        (
            [transId] => 38
            [totalPrice] => 312.40
            [ref] => 1248134
            [totalMoneySpent] => 312.40
            [modeOfPayment] => Cash and POS
            [staffId] => 4
            [transDate] => 2023-07-03 15:58:43
            [lastUpdated] => 2023-07-03 15:58:43
            [amountTendered] => 345.00
            [cancelled] => 0
            [changeDue] => 32.60
            [staffName] => Taboz Mafura
            [cust_name] => 
            [cust_phone] => 0773372161
            [cust_email] => 
            [quantity] => 5
        )

    [7] => stdClass Object
        (
            [transId] => 37
            [totalPrice] => 62.48
            [ref] => 534782161
            [totalMoneySpent] => 62.48
            [modeOfPayment] => Cash
            [staffId] => 4
            [transDate] => 2023-07-03 15:52:43
            [lastUpdated] => 2023-07-03 15:52:43
            [amountTendered] => 67.00
            [cancelled] => 0
            [changeDue] => 4.52
            [staffName] => Taboz Mafura
            [cust_name] => 
            [cust_phone] => 0773375467
            [cust_email] => 
            [quantity] => 1
        )

    [8] => stdClass Object
        (
            [transId] => 36
            [totalPrice] => 62.48
            [ref] => 035240543
            [totalMoneySpent] => 62.48
            [modeOfPayment] => Cash and POS
            [staffId] => 4
            [transDate] => 2023-07-03 15:50:30
            [lastUpdated] => 2023-07-03 15:50:30
            [amountTendered] => 95.00
            [cancelled] => 0
            [changeDue] => 32.52
            [staffName] => Taboz Mafura
            [cust_name] => 
            [cust_phone] => 0775923458
            [cust_email] => 
            [quantity] => 1
        )

    [9] => stdClass Object
        (
            [transId] => 35
            [totalPrice] => 374.88
            [ref] => 416057265
            [totalMoneySpent] => 374.88
            [modeOfPayment] => Cash
            [staffId] => 4
            [transDate] => 2023-07-03 15:25:00
            [lastUpdated] => 2023-07-03 15:25:00
            [amountTendered] => 500.00
            [cancelled] => 0
            [changeDue] => 125.12
            [staffName] => Taboz Mafura
            [cust_name] => 
            [cust_phone] => 0773372616
            [cust_email] => 
            [quantity] => 6
        )

)

ERROR - 2023-07-10 11:35:48 --> Severity: Error --> Uncaught Error: Class "CI_Exceptions" not found in /var/www/html/Cliffs_Internation/system/core/Common.php:196
Stack trace:
#0 /var/www/html/Cliffs_Internation/system/core/Common.php(617): load_class()
#1 /var/www/html/Cliffs_Internation/system/core/Common.php(163): _error_handler()
#2 /var/www/html/Cliffs_Internation/system/core/Common.php(163): require_once('...')
#3 /var/www/html/Cliffs_Internation/system/core/Common.php(652): load_class()
#4 [internal function]: _exception_handler()
#5 {main}
  thrown /var/www/html/Cliffs_Internation/system/core/Common.php 196
ERROR - 2023-07-10 11:37:34 --> ASC transDate
ERROR - 2023-07-10 11:37:34 --> 44
ERROR - 2023-07-10 11:37:34 --> 0
ERROR - 2023-07-10 11:37:34 --> 10
ERROR - 2023-07-10 11:37:34 --> 0
ERROR - 2023-07-10 11:37:34 --> we are here taboz
ERROR - 2023-07-10 11:37:34 --> Array
(
    [0] => stdClass Object
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

    [1] => stdClass Object
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

    [2] => stdClass Object
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

    [3] => stdClass Object
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

    [4] => stdClass Object
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

    [5] => stdClass Object
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

    [6] => stdClass Object
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

    [7] => stdClass Object
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

    [8] => stdClass Object
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

    [9] => stdClass Object
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

)

ERROR - 2023-07-10 11:37:34 --> 1-10 of 44
ERROR - 2023-07-10 11:37:34 --> <ul class='pagination'><li><a href="http://localhost/Cliffs_Internation/transactions/latr_/-1" onclick="return latr_(this.href);" data-ci-pagination-page="-1" rel="prev">&lt;&lt;</a></li><li><a href="http://localhost/Cliffs_Internation/transactions/latr_" onclick="return latr_(this.href);" data-ci-pagination-page="1" rel="start">1</a></li><li><a href="http://localhost/Cliffs_Internation/transactions/latr_/2" onclick="return latr_(this.href);" data-ci-pagination-page="2">2</a></li><li><a href="http://localhost/Cliffs_Internation/transactions/latr_/3" onclick="return latr_(this.href);" data-ci-pagination-page="3">3</a></li><li><a href="http://localhost/Cliffs_Internation/transactions/latr_/4" onclick="return latr_(this.href);" data-ci-pagination-page="4">4</a></li><li><a href="http://localhost/Cliffs_Internation/transactions/latr_/5" onclick="return latr_(this.href);" data-ci-pagination-page="5">5</a></li><li><a href="http://localhost/Cliffs_Internation/transactions/latr_/1" onclick="return latr_(this.href);" data-ci-pagination-page="1" rel="next">&gt;&gt;</a></li></ul>
ERROR - 2023-07-10 11:37:34 --> 1
ERROR - 2023-07-10 11:37:54 --> DESC transDate
ERROR - 2023-07-10 11:37:54 --> 44
ERROR - 2023-07-10 11:37:54 --> 0
ERROR - 2023-07-10 11:37:54 --> 10
ERROR - 2023-07-10 11:37:54 --> 0
ERROR - 2023-07-10 11:37:54 --> we are here taboz
ERROR - 2023-07-10 11:37:54 --> Array
(
    [0] => stdClass Object
        (
            [transId] => 47
            [totalPrice] => 55.00
            [ref] => 473967314
            [totalMoneySpent] => 55.00
            [modeOfPayment] => Cash
            [staffId] => 1
            [transDate] => 2023-07-10 09:20:27
            [lastUpdated] => 2023-07-10 09:20:27
            [amountTendered] => 100.00
            [cancelled] => 0
            [changeDue] => 45.00
            [staffName] => Admin Liam
            [cust_name] => 
            [cust_phone] => 0775923458
            [cust_email] => 
            [quantity] => 1
        )

    [1] => stdClass Object
        (
            [transId] => 45,46
            [totalPrice] => 25.00,275.00
            [ref] => 128607483
            [totalMoneySpent] => 300.00
            [modeOfPayment] => Cash
            [staffId] => 1
            [transDate] => 2023-07-10 08:47:44
            [lastUpdated] => 2023-07-10 08:47:44
            [amountTendered] => 400.00
            [cancelled] => 0
            [changeDue] => 100.00
            [staffName] => Admin Liam
            [cust_name] => 
            [cust_phone] => 0773372616
            [cust_email] => 
            [quantity] => 6
        )

    [2] => stdClass Object
        (
            [transId] => 44
            [totalPrice] => 3436.40
            [ref] => 26439195
            [totalMoneySpent] => 3436.40
            [modeOfPayment] => Cash and POS
            [staffId] => 1
            [transDate] => 2023-07-03 16:23:12
            [lastUpdated] => 2023-07-03 16:23:12
            [amountTendered] => 3436.40
            [cancelled] => 0
            [changeDue] => 0.00
            [staffName] => Admin Liam
            [cust_name] => 
            [cust_phone] => 0775923458
            [cust_email] => 
            [quantity] => 55
        )

    [3] => stdClass Object
        (
            [transId] => 43
            [totalPrice] => 62.48
            [ref] => 523091
            [totalMoneySpent] => 62.48
            [modeOfPayment] => POS
            [staffId] => 1
            [transDate] => 2023-07-03 16:08:23
            [lastUpdated] => 2023-07-03 16:08:23
            [amountTendered] => 62.48
            [cancelled] => 0
            [changeDue] => 0.00
            [staffName] => Admin Liam
            [cust_name] => 
            [cust_phone] => 0773372616
            [cust_email] => 
            [quantity] => 1
        )

    [4] => stdClass Object
        (
            [transId] => 42
            [totalPrice] => 62.48
            [ref] => 2874932
            [totalMoneySpent] => 62.48
            [modeOfPayment] => Cash
            [staffId] => 1
            [transDate] => 2023-07-03 16:05:52
            [lastUpdated] => 2023-07-03 16:05:52
            [amountTendered] => 100.00
            [cancelled] => 0
            [changeDue] => 37.52
            [staffName] => Admin Liam
            [cust_name] => 
            [cust_phone] => 0775923459
            [cust_email] => 
            [quantity] => 1
        )

    [5] => stdClass Object
        (
            [transId] => 39
            [totalPrice] => 2311.76
            [ref] => 363169075
            [totalMoneySpent] => 2311.76
            [modeOfPayment] => Cash and POS
            [staffId] => 4
            [transDate] => 2023-07-03 16:00:15
            [lastUpdated] => 2023-07-03 16:00:15
            [amountTendered] => 2500.00
            [cancelled] => 0
            [changeDue] => 188.24
            [staffName] => Taboz Mafura
            [cust_name] => 
            [cust_phone] => 0775932458
            [cust_email] => 
            [quantity] => 37
        )

    [6] => stdClass Object
        (
            [transId] => 38
            [totalPrice] => 312.40
            [ref] => 1248134
            [totalMoneySpent] => 312.40
            [modeOfPayment] => Cash and POS
            [staffId] => 4
            [transDate] => 2023-07-03 15:58:43
            [lastUpdated] => 2023-07-03 15:58:43
            [amountTendered] => 345.00
            [cancelled] => 0
            [changeDue] => 32.60
            [staffName] => Taboz Mafura
            [cust_name] => 
            [cust_phone] => 0773372161
            [cust_email] => 
            [quantity] => 5
        )

    [7] => stdClass Object
        (
            [transId] => 37
            [totalPrice] => 62.48
            [ref] => 534782161
            [totalMoneySpent] => 62.48
            [modeOfPayment] => Cash
            [staffId] => 4
            [transDate] => 2023-07-03 15:52:43
            [lastUpdated] => 2023-07-03 15:52:43
            [amountTendered] => 67.00
            [cancelled] => 0
            [changeDue] => 4.52
            [staffName] => Taboz Mafura
            [cust_name] => 
            [cust_phone] => 0773375467
            [cust_email] => 
            [quantity] => 1
        )

    [8] => stdClass Object
        (
            [transId] => 36
            [totalPrice] => 62.48
            [ref] => 035240543
            [totalMoneySpent] => 62.48
            [modeOfPayment] => Cash and POS
            [staffId] => 4
            [transDate] => 2023-07-03 15:50:30
            [lastUpdated] => 2023-07-03 15:50:30
            [amountTendered] => 95.00
            [cancelled] => 0
            [changeDue] => 32.52
            [staffName] => Taboz Mafura
            [cust_name] => 
            [cust_phone] => 0775923458
            [cust_email] => 
            [quantity] => 1
        )

    [9] => stdClass Object
        (
            [transId] => 35
            [totalPrice] => 374.88
            [ref] => 416057265
            [totalMoneySpent] => 374.88
            [modeOfPayment] => Cash
            [staffId] => 4
            [transDate] => 2023-07-03 15:25:00
            [lastUpdated] => 2023-07-03 15:25:00
            [amountTendered] => 500.00
            [cancelled] => 0
            [changeDue] => 125.12
            [staffName] => Taboz Mafura
            [cust_name] => 
            [cust_phone] => 0773372616
            [cust_email] => 
            [quantity] => 6
        )

)

ERROR - 2023-07-10 11:37:54 --> 1-10 of 44
ERROR - 2023-07-10 11:37:54 --> <ul class='pagination'><li><a href="http://localhost/Cliffs_Internation/transactions/latr_/-1" onclick="return latr_(this.href);" data-ci-pagination-page="-1" rel="prev">&lt;&lt;</a></li><li><a href="http://localhost/Cliffs_Internation/transactions/latr_" onclick="return latr_(this.href);" data-ci-pagination-page="1" rel="start">1</a></li><li><a href="http://localhost/Cliffs_Internation/transactions/latr_/2" onclick="return latr_(this.href);" data-ci-pagination-page="2">2</a></li><li><a href="http://localhost/Cliffs_Internation/transactions/latr_/3" onclick="return latr_(this.href);" data-ci-pagination-page="3">3</a></li><li><a href="http://localhost/Cliffs_Internation/transactions/latr_/4" onclick="return latr_(this.href);" data-ci-pagination-page="4">4</a></li><li><a href="http://localhost/Cliffs_Internation/transactions/latr_/5" onclick="return latr_(this.href);" data-ci-pagination-page="5">5</a></li><li><a href="http://localhost/Cliffs_Internation/transactions/latr_/1" onclick="return latr_(this.href);" data-ci-pagination-page="1" rel="next">&gt;&gt;</a></li></ul>
ERROR - 2023-07-10 11:37:54 --> 1
ERROR - 2023-07-10 11:37:54 --> Severity: Error --> Uncaught Error: Class "CI_Exceptions" not found in /var/www/html/Cliffs_Internation/system/core/Common.php:196
Stack trace:
#0 /var/www/html/Cliffs_Internation/system/core/Common.php(617): load_class()
#1 /var/www/html/Cliffs_Internation/system/core/Common.php(163): _error_handler()
#2 /var/www/html/Cliffs_Internation/system/core/Common.php(163): require_once('...')
#3 /var/www/html/Cliffs_Internation/system/core/Common.php(652): load_class()
#4 [internal function]: _exception_handler()
#5 {main}
  thrown /var/www/html/Cliffs_Internation/system/core/Common.php 196
ERROR - 2023-07-10 16:11:14 --> Severity: 8192 --> Return type of CI_Session_files_driver::open($save_path, $name) should either be compatible with SessionHandlerInterface::open(string $path, string $name): bool, or the #[\ReturnTypeWillChange] attribute should be used to temporarily suppress the notice /var/www/html/Cliffs_Internation/system/libraries/Session/drivers/Session_files_driver.php 132
ERROR - 2023-07-10 16:11:14 --> Severity: 8192 --> Return type of CI_Session_files_driver::close() should either be compatible with SessionHandlerInterface::close(): bool, or the #[\ReturnTypeWillChange] attribute should be used to temporarily suppress the notice /var/www/html/Cliffs_Internation/system/libraries/Session/drivers/Session_files_driver.php 290
ERROR - 2023-07-10 16:11:14 --> Severity: 8192 --> Return type of CI_Session_files_driver::read($session_id) should either be compatible with SessionHandlerInterface::read(string $id): string|false, or the #[\ReturnTypeWillChange] attribute should be used to temporarily suppress the notice /var/www/html/Cliffs_Internation/system/libraries/Session/drivers/Session_files_driver.php 164
ERROR - 2023-07-10 16:11:14 --> Severity: 8192 --> Return type of CI_Session_files_driver::write($session_id, $session_data) should either be compatible with SessionHandlerInterface::write(string $id, string $data): bool, or the #[\ReturnTypeWillChange] attribute should be used to temporarily suppress the notice /var/www/html/Cliffs_Internation/system/libraries/Session/drivers/Session_files_driver.php 233
ERROR - 2023-07-10 16:11:14 --> Severity: 8192 --> Return type of CI_Session_files_driver::destroy($session_id) should either be compatible with SessionHandlerInterface::destroy(string $id): bool, or the #[\ReturnTypeWillChange] attribute should be used to temporarily suppress the notice /var/www/html/Cliffs_Internation/system/libraries/Session/drivers/Session_files_driver.php 313
ERROR - 2023-07-10 16:11:14 --> Severity: 8192 --> Return type of CI_Session_files_driver::gc($maxlifetime) should either be compatible with SessionHandlerInterface::gc(int $max_lifetime): int|false, or the #[\ReturnTypeWillChange] attribute should be used to temporarily suppress the notice /var/www/html/Cliffs_Internation/system/libraries/Session/drivers/Session_files_driver.php 354
ERROR - 2023-07-10 16:11:14 --> Severity: Warning --> ini_set(): Session ini settings cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 284
ERROR - 2023-07-10 16:11:14 --> Severity: Warning --> session_set_cookie_params(): Session cookie parameters cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 296
ERROR - 2023-07-10 16:11:14 --> Severity: Warning --> ini_set(): Session ini settings cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 306
ERROR - 2023-07-10 16:11:14 --> Severity: Warning --> ini_set(): Session ini settings cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 316
ERROR - 2023-07-10 16:11:14 --> Severity: Warning --> ini_set(): Session ini settings cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 317
ERROR - 2023-07-10 16:11:14 --> Severity: Warning --> ini_set(): Session ini settings cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 318
ERROR - 2023-07-10 16:11:14 --> Severity: Warning --> ini_set(): Session ini settings cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 319
ERROR - 2023-07-10 16:11:14 --> Severity: Warning --> ini_set(): Session ini settings cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 377
ERROR - 2023-07-10 16:11:14 --> Severity: Warning --> ini_set(): Session ini settings cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/drivers/Session_files_driver.php 108
ERROR - 2023-07-10 16:11:14 --> Severity: Warning --> session_set_save_handler(): Session save handler cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 110
ERROR - 2023-07-10 16:11:14 --> Severity: Warning --> session_start(): Session cannot be started after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 143
ERROR - 2023-07-10 16:11:14 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /var/www/html/Cliffs_Internation/system/core/Exceptions.php:271) /var/www/html/Cliffs_Internation/system/helpers/url_helper.php 564
ERROR - 2023-07-10 16:11:24 --> Severity: error --> Exception: Class "CI_Exceptions" not found /var/www/html/Cliffs_Internation/system/core/Common.php 196
ERROR - 2023-07-10 16:11:57 --> Severity: 8192 --> Return type of CI_Session_files_driver::open($save_path, $name) should either be compatible with SessionHandlerInterface::open(string $path, string $name): bool, or the #[\ReturnTypeWillChange] attribute should be used to temporarily suppress the notice /var/www/html/Cliffs_Internation/system/libraries/Session/drivers/Session_files_driver.php 132
ERROR - 2023-07-10 16:11:57 --> Severity: 8192 --> Return type of CI_Session_files_driver::close() should either be compatible with SessionHandlerInterface::close(): bool, or the #[\ReturnTypeWillChange] attribute should be used to temporarily suppress the notice /var/www/html/Cliffs_Internation/system/libraries/Session/drivers/Session_files_driver.php 290
ERROR - 2023-07-10 16:11:57 --> Severity: 8192 --> Return type of CI_Session_files_driver::read($session_id) should either be compatible with SessionHandlerInterface::read(string $id): string|false, or the #[\ReturnTypeWillChange] attribute should be used to temporarily suppress the notice /var/www/html/Cliffs_Internation/system/libraries/Session/drivers/Session_files_driver.php 164
ERROR - 2023-07-10 16:11:57 --> Severity: 8192 --> Return type of CI_Session_files_driver::write($session_id, $session_data) should either be compatible with SessionHandlerInterface::write(string $id, string $data): bool, or the #[\ReturnTypeWillChange] attribute should be used to temporarily suppress the notice /var/www/html/Cliffs_Internation/system/libraries/Session/drivers/Session_files_driver.php 233
ERROR - 2023-07-10 16:11:57 --> Severity: 8192 --> Return type of CI_Session_files_driver::destroy($session_id) should either be compatible with SessionHandlerInterface::destroy(string $id): bool, or the #[\ReturnTypeWillChange] attribute should be used to temporarily suppress the notice /var/www/html/Cliffs_Internation/system/libraries/Session/drivers/Session_files_driver.php 313
ERROR - 2023-07-10 16:11:57 --> Severity: 8192 --> Return type of CI_Session_files_driver::gc($maxlifetime) should either be compatible with SessionHandlerInterface::gc(int $max_lifetime): int|false, or the #[\ReturnTypeWillChange] attribute should be used to temporarily suppress the notice /var/www/html/Cliffs_Internation/system/libraries/Session/drivers/Session_files_driver.php 354
ERROR - 2023-07-10 16:11:57 --> Severity: Warning --> ini_set(): Session ini settings cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 284
ERROR - 2023-07-10 16:11:57 --> Severity: Warning --> session_set_cookie_params(): Session cookie parameters cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 296
ERROR - 2023-07-10 16:11:57 --> Severity: Warning --> ini_set(): Session ini settings cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 306
ERROR - 2023-07-10 16:11:57 --> Severity: Warning --> ini_set(): Session ini settings cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 316
ERROR - 2023-07-10 16:11:57 --> Severity: Warning --> ini_set(): Session ini settings cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 317
ERROR - 2023-07-10 16:11:57 --> Severity: Warning --> ini_set(): Session ini settings cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 318
ERROR - 2023-07-10 16:11:57 --> Severity: Warning --> ini_set(): Session ini settings cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 319
ERROR - 2023-07-10 16:11:57 --> Severity: Warning --> ini_set(): Session ini settings cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 377
ERROR - 2023-07-10 16:11:57 --> Severity: Warning --> ini_set(): Session ini settings cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/drivers/Session_files_driver.php 108
ERROR - 2023-07-10 16:11:57 --> Severity: Warning --> session_set_save_handler(): Session save handler cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 110
ERROR - 2023-07-10 16:11:57 --> Severity: Warning --> session_start(): Session cannot be started after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 143
ERROR - 2023-07-10 16:12:14 --> Severity: Error --> Uncaught Error: Class "CI_Exceptions" not found in /var/www/html/Cliffs_Internation/system/core/Common.php:196
Stack trace:
#0 /var/www/html/Cliffs_Internation/system/core/Common.php(617): load_class()
#1 /var/www/html/Cliffs_Internation/system/core/Common.php(163): _error_handler()
#2 /var/www/html/Cliffs_Internation/system/core/Common.php(163): require_once('...')
#3 /var/www/html/Cliffs_Internation/system/core/Common.php(652): load_class()
#4 [internal function]: _exception_handler()
#5 {main}
  thrown /var/www/html/Cliffs_Internation/system/core/Common.php 196
