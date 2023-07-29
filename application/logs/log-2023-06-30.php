<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2023-06-30 07:39:59 --> Severity: 8192 --> Return type of CI_Session_files_driver::open($save_path, $name) should either be compatible with SessionHandlerInterface::open(string $path, string $name): bool, or the #[\ReturnTypeWillChange] attribute should be used to temporarily suppress the notice /var/www/html/Cliffs_Internation/system/libraries/Session/drivers/Session_files_driver.php 132
ERROR - 2023-06-30 07:40:00 --> Severity: 8192 --> Return type of CI_Session_files_driver::close() should either be compatible with SessionHandlerInterface::close(): bool, or the #[\ReturnTypeWillChange] attribute should be used to temporarily suppress the notice /var/www/html/Cliffs_Internation/system/libraries/Session/drivers/Session_files_driver.php 290
ERROR - 2023-06-30 07:40:00 --> Severity: 8192 --> Return type of CI_Session_files_driver::read($session_id) should either be compatible with SessionHandlerInterface::read(string $id): string|false, or the #[\ReturnTypeWillChange] attribute should be used to temporarily suppress the notice /var/www/html/Cliffs_Internation/system/libraries/Session/drivers/Session_files_driver.php 164
ERROR - 2023-06-30 07:40:00 --> Severity: 8192 --> Return type of CI_Session_files_driver::write($session_id, $session_data) should either be compatible with SessionHandlerInterface::write(string $id, string $data): bool, or the #[\ReturnTypeWillChange] attribute should be used to temporarily suppress the notice /var/www/html/Cliffs_Internation/system/libraries/Session/drivers/Session_files_driver.php 233
ERROR - 2023-06-30 07:40:00 --> Severity: 8192 --> Return type of CI_Session_files_driver::destroy($session_id) should either be compatible with SessionHandlerInterface::destroy(string $id): bool, or the #[\ReturnTypeWillChange] attribute should be used to temporarily suppress the notice /var/www/html/Cliffs_Internation/system/libraries/Session/drivers/Session_files_driver.php 313
ERROR - 2023-06-30 07:40:00 --> Severity: 8192 --> Return type of CI_Session_files_driver::gc($maxlifetime) should either be compatible with SessionHandlerInterface::gc(int $max_lifetime): int|false, or the #[\ReturnTypeWillChange] attribute should be used to temporarily suppress the notice /var/www/html/Cliffs_Internation/system/libraries/Session/drivers/Session_files_driver.php 354
ERROR - 2023-06-30 07:40:00 --> Severity: Warning --> ini_set(): Session ini settings cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 284
ERROR - 2023-06-30 07:40:00 --> Severity: Warning --> session_set_cookie_params(): Session cookie parameters cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 296
ERROR - 2023-06-30 07:40:00 --> Severity: Warning --> ini_set(): Session ini settings cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 306
ERROR - 2023-06-30 07:40:00 --> Severity: Warning --> ini_set(): Session ini settings cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 316
ERROR - 2023-06-30 07:40:00 --> Severity: Warning --> ini_set(): Session ini settings cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 317
ERROR - 2023-06-30 07:40:00 --> Severity: Warning --> ini_set(): Session ini settings cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 318
ERROR - 2023-06-30 07:40:00 --> Severity: Warning --> ini_set(): Session ini settings cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 319
ERROR - 2023-06-30 07:40:00 --> Severity: Warning --> ini_set(): Session ini settings cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 377
ERROR - 2023-06-30 07:40:00 --> Severity: Warning --> ini_set(): Session ini settings cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/drivers/Session_files_driver.php 108
ERROR - 2023-06-30 07:40:00 --> Severity: Warning --> session_set_save_handler(): Session save handler cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 110
ERROR - 2023-06-30 07:40:00 --> Severity: Warning --> session_start(): Session cannot be started after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 143
ERROR - 2023-06-30 07:40:00 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /var/www/html/Cliffs_Internation/system/core/Exceptions.php:271) /var/www/html/Cliffs_Internation/system/helpers/url_helper.php 564
ERROR - 2023-06-30 07:40:40 --> Severity: error --> Exception: Class "CI_Exceptions" not found /var/www/html/Cliffs_Internation/system/core/Common.php 196
ERROR - 2023-06-30 11:54:50 --> Severity: Error --> Uncaught Error: Class "CI_Exceptions" not found in /var/www/html/Cliffs_Internation/system/core/Common.php:196
Stack trace:
#0 /var/www/html/Cliffs_Internation/system/core/Common.php(617): load_class()
#1 /var/www/html/Cliffs_Internation/system/core/Common.php(163): _error_handler()
#2 /var/www/html/Cliffs_Internation/system/core/Common.php(163): require_once('...')
#3 /var/www/html/Cliffs_Internation/system/core/Common.php(652): load_class()
#4 [internal function]: _exception_handler()
#5 {main}
  thrown /var/www/html/Cliffs_Internation/system/core/Common.php 196
ERROR - 2023-06-30 11:54:53 --> Severity: Error --> Uncaught Error: Class "CI_Exceptions" not found in /var/www/html/Cliffs_Internation/system/core/Common.php:196
Stack trace:
#0 /var/www/html/Cliffs_Internation/system/core/Common.php(617): load_class()
#1 /var/www/html/Cliffs_Internation/system/core/Common.php(163): _error_handler()
#2 /var/www/html/Cliffs_Internation/system/core/Common.php(163): require_once('...')
#3 /var/www/html/Cliffs_Internation/system/core/Common.php(652): load_class()
#4 [internal function]: _exception_handler()
#5 {main}
  thrown /var/www/html/Cliffs_Internation/system/core/Common.php 196
ERROR - 2023-06-30 11:55:29 --> Severity: Error --> Uncaught Error: Class "CI_Exceptions" not found in /var/www/html/Cliffs_Internation/system/core/Common.php:196
Stack trace:
#0 /var/www/html/Cliffs_Internation/system/core/Common.php(617): load_class()
#1 /var/www/html/Cliffs_Internation/system/core/Common.php(163): _error_handler()
#2 /var/www/html/Cliffs_Internation/system/core/Common.php(163): require_once('...')
#3 /var/www/html/Cliffs_Internation/system/core/Common.php(652): load_class()
#4 [internal function]: _exception_handler()
#5 {main}
  thrown /var/www/html/Cliffs_Internation/system/core/Common.php 196
ERROR - 2023-06-30 11:55:43 --> Severity: Error --> Uncaught Error: Class "CI_Exceptions" not found in /var/www/html/Cliffs_Internation/system/core/Common.php:196
Stack trace:
#0 /var/www/html/Cliffs_Internation/system/core/Common.php(617): load_class()
#1 /var/www/html/Cliffs_Internation/system/core/Common.php(163): _error_handler()
#2 /var/www/html/Cliffs_Internation/system/core/Common.php(163): require_once('...')
#3 /var/www/html/Cliffs_Internation/system/core/Common.php(652): load_class()
#4 [internal function]: _exception_handler()
#5 {main}
  thrown /var/www/html/Cliffs_Internation/system/core/Common.php 196
ERROR - 2023-06-30 11:56:59 --> Severity: Error --> Uncaught Error: Class "CI_Exceptions" not found in /var/www/html/Cliffs_Internation/system/core/Common.php:196
Stack trace:
#0 /var/www/html/Cliffs_Internation/system/core/Common.php(617): load_class()
#1 /var/www/html/Cliffs_Internation/system/core/Common.php(163): _error_handler()
#2 /var/www/html/Cliffs_Internation/system/core/Common.php(163): require_once('...')
#3 /var/www/html/Cliffs_Internation/system/core/Common.php(652): load_class()
#4 [internal function]: _exception_handler()
#5 {main}
  thrown /var/www/html/Cliffs_Internation/system/core/Common.php 196
ERROR - 2023-06-30 11:57:00 --> Severity: Error --> Uncaught Error: Class "CI_Exceptions" not found in /var/www/html/Cliffs_Internation/system/core/Common.php:196
Stack trace:
#0 /var/www/html/Cliffs_Internation/system/core/Common.php(617): load_class()
#1 /var/www/html/Cliffs_Internation/system/core/Common.php(163): _error_handler()
#2 /var/www/html/Cliffs_Internation/system/core/Common.php(163): require_once('...')
#3 /var/www/html/Cliffs_Internation/system/core/Common.php(652): load_class()
#4 [internal function]: _exception_handler()
#5 {main}
  thrown /var/www/html/Cliffs_Internation/system/core/Common.php 196
ERROR - 2023-06-30 12:47:31 --> Severity: Error --> Uncaught Error: Class "CI_Exceptions" not found in /var/www/html/Cliffs_Internation/system/core/Common.php:196
Stack trace:
#0 /var/www/html/Cliffs_Internation/system/core/Common.php(617): load_class()
#1 /var/www/html/Cliffs_Internation/system/core/Common.php(163): _error_handler()
#2 /var/www/html/Cliffs_Internation/system/core/Common.php(163): require_once('...')
#3 /var/www/html/Cliffs_Internation/system/core/Common.php(652): load_class()
#4 [internal function]: _exception_handler()
#5 {main}
  thrown /var/www/html/Cliffs_Internation/system/core/Common.php 196
ERROR - 2023-06-30 12:52:21 --> Severity: Error --> Uncaught Error: Class "CI_Exceptions" not found in /var/www/html/Cliffs_Internation/system/core/Common.php:196
Stack trace:
#0 /var/www/html/Cliffs_Internation/system/core/Common.php(617): load_class()
#1 /var/www/html/Cliffs_Internation/system/core/Common.php(163): _error_handler()
#2 /var/www/html/Cliffs_Internation/system/core/Common.php(163): require_once('...')
#3 /var/www/html/Cliffs_Internation/system/core/Common.php(652): load_class()
#4 [internal function]: _exception_handler()
#5 {main}
  thrown /var/www/html/Cliffs_Internation/system/core/Common.php 196
ERROR - 2023-06-30 12:52:59 --> Severity: Error --> Uncaught Error: Class "CI_Exceptions" not found in /var/www/html/Cliffs_Internation/system/core/Common.php:196
Stack trace:
#0 /var/www/html/Cliffs_Internation/system/core/Common.php(617): load_class()
#1 /var/www/html/Cliffs_Internation/system/core/Common.php(163): _error_handler()
#2 /var/www/html/Cliffs_Internation/system/core/Common.php(163): require_once('...')
#3 /var/www/html/Cliffs_Internation/system/core/Common.php(652): load_class()
#4 [internal function]: _exception_handler()
#5 {main}
  thrown /var/www/html/Cliffs_Internation/system/core/Common.php 196
ERROR - 2023-06-30 13:04:01 --> Severity: Error --> Uncaught Error: Class "CI_Exceptions" not found in /var/www/html/Cliffs_Internation/system/core/Common.php:196
Stack trace:
#0 /var/www/html/Cliffs_Internation/system/core/Common.php(617): load_class()
#1 /var/www/html/Cliffs_Internation/system/core/Common.php(163): _error_handler()
#2 /var/www/html/Cliffs_Internation/system/core/Common.php(163): require_once('...')
#3 /var/www/html/Cliffs_Internation/system/core/Common.php(652): load_class()
#4 [internal function]: _exception_handler()
#5 {main}
  thrown /var/www/html/Cliffs_Internation/system/core/Common.php 196
ERROR - 2023-06-30 13:10:00 --> Severity: Error --> Uncaught Error: Class "CI_Exceptions" not found in /var/www/html/Cliffs_Internation/system/core/Common.php:196
Stack trace:
#0 /var/www/html/Cliffs_Internation/system/core/Common.php(617): load_class()
#1 /var/www/html/Cliffs_Internation/system/core/Common.php(163): _error_handler()
#2 /var/www/html/Cliffs_Internation/system/core/Common.php(163): require_once('...')
#3 /var/www/html/Cliffs_Internation/system/core/Common.php(652): load_class()
#4 [internal function]: _exception_handler()
#5 {main}
  thrown /var/www/html/Cliffs_Internation/system/core/Common.php 196
ERROR - 2023-06-30 13:10:26 --> Severity: Error --> Uncaught Error: Class "CI_Exceptions" not found in /var/www/html/Cliffs_Internation/system/core/Common.php:196
Stack trace:
#0 /var/www/html/Cliffs_Internation/system/core/Common.php(617): load_class()
#1 /var/www/html/Cliffs_Internation/system/core/Common.php(163): _error_handler()
#2 /var/www/html/Cliffs_Internation/system/core/Common.php(163): require_once('...')
#3 /var/www/html/Cliffs_Internation/system/core/Common.php(652): load_class()
#4 [internal function]: _exception_handler()
#5 {main}
  thrown /var/www/html/Cliffs_Internation/system/core/Common.php 196
ERROR - 2023-06-30 13:14:36 --> Severity: Error --> Uncaught Error: Class "CI_Exceptions" not found in /var/www/html/Cliffs_Internation/system/core/Common.php:196
Stack trace:
#0 /var/www/html/Cliffs_Internation/system/core/Common.php(617): load_class()
#1 /var/www/html/Cliffs_Internation/system/core/Common.php(163): _error_handler()
#2 /var/www/html/Cliffs_Internation/system/core/Common.php(163): require_once('...')
#3 /var/www/html/Cliffs_Internation/system/core/Common.php(652): load_class()
#4 [internal function]: _exception_handler()
#5 {main}
  thrown /var/www/html/Cliffs_Internation/system/core/Common.php 196
ERROR - 2023-06-30 13:15:48 --> Severity: 8192 --> Return type of CI_Session_files_driver::open($save_path, $name) should either be compatible with SessionHandlerInterface::open(string $path, string $name): bool, or the #[\ReturnTypeWillChange] attribute should be used to temporarily suppress the notice /var/www/html/Cliffs_Internation/system/libraries/Session/drivers/Session_files_driver.php 132
ERROR - 2023-06-30 13:15:48 --> Severity: 8192 --> Return type of CI_Session_files_driver::close() should either be compatible with SessionHandlerInterface::close(): bool, or the #[\ReturnTypeWillChange] attribute should be used to temporarily suppress the notice /var/www/html/Cliffs_Internation/system/libraries/Session/drivers/Session_files_driver.php 290
ERROR - 2023-06-30 13:15:48 --> Severity: 8192 --> Return type of CI_Session_files_driver::read($session_id) should either be compatible with SessionHandlerInterface::read(string $id): string|false, or the #[\ReturnTypeWillChange] attribute should be used to temporarily suppress the notice /var/www/html/Cliffs_Internation/system/libraries/Session/drivers/Session_files_driver.php 164
ERROR - 2023-06-30 13:15:48 --> Severity: 8192 --> Return type of CI_Session_files_driver::write($session_id, $session_data) should either be compatible with SessionHandlerInterface::write(string $id, string $data): bool, or the #[\ReturnTypeWillChange] attribute should be used to temporarily suppress the notice /var/www/html/Cliffs_Internation/system/libraries/Session/drivers/Session_files_driver.php 233
ERROR - 2023-06-30 13:15:48 --> Severity: 8192 --> Return type of CI_Session_files_driver::destroy($session_id) should either be compatible with SessionHandlerInterface::destroy(string $id): bool, or the #[\ReturnTypeWillChange] attribute should be used to temporarily suppress the notice /var/www/html/Cliffs_Internation/system/libraries/Session/drivers/Session_files_driver.php 313
ERROR - 2023-06-30 13:15:48 --> Severity: 8192 --> Return type of CI_Session_files_driver::gc($maxlifetime) should either be compatible with SessionHandlerInterface::gc(int $max_lifetime): int|false, or the #[\ReturnTypeWillChange] attribute should be used to temporarily suppress the notice /var/www/html/Cliffs_Internation/system/libraries/Session/drivers/Session_files_driver.php 354
ERROR - 2023-06-30 13:15:48 --> Severity: Warning --> ini_set(): Session ini settings cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 284
ERROR - 2023-06-30 13:15:48 --> Severity: Warning --> session_set_cookie_params(): Session cookie parameters cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 296
ERROR - 2023-06-30 13:15:48 --> Severity: Warning --> ini_set(): Session ini settings cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 306
ERROR - 2023-06-30 13:15:48 --> Severity: Warning --> ini_set(): Session ini settings cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 316
ERROR - 2023-06-30 13:15:48 --> Severity: Warning --> ini_set(): Session ini settings cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 317
ERROR - 2023-06-30 13:15:48 --> Severity: Warning --> ini_set(): Session ini settings cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 318
ERROR - 2023-06-30 13:15:48 --> Severity: Warning --> ini_set(): Session ini settings cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 319
ERROR - 2023-06-30 13:15:48 --> Severity: Warning --> ini_set(): Session ini settings cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 377
ERROR - 2023-06-30 13:15:48 --> Severity: Warning --> ini_set(): Session ini settings cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/drivers/Session_files_driver.php 108
ERROR - 2023-06-30 13:15:48 --> Severity: Warning --> session_set_save_handler(): Session save handler cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 110
ERROR - 2023-06-30 13:15:48 --> Severity: Warning --> session_start(): Session cannot be started after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 143
ERROR - 2023-06-30 13:15:48 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /var/www/html/Cliffs_Internation/system/core/Exceptions.php:271) /var/www/html/Cliffs_Internation/system/helpers/url_helper.php 564
ERROR - 2023-06-30 13:15:58 --> Severity: Error --> Uncaught Error: Class "CI_Exceptions" not found in /var/www/html/Cliffs_Internation/system/core/Common.php:196
Stack trace:
#0 /var/www/html/Cliffs_Internation/system/core/Common.php(617): load_class()
#1 /var/www/html/Cliffs_Internation/system/core/Common.php(163): _error_handler()
#2 /var/www/html/Cliffs_Internation/system/core/Common.php(163): require_once('...')
#3 /var/www/html/Cliffs_Internation/system/core/Common.php(652): load_class()
#4 [internal function]: _exception_handler()
#5 {main}
  thrown /var/www/html/Cliffs_Internation/system/core/Common.php 196
ERROR - 2023-06-30 13:18:27 --> here we are 
ERROR - 2023-06-30 13:22:13 --> here we are 
ERROR - 2023-06-30 13:22:13 --> categorie yedu is1
ERROR - 2023-06-30 13:22:45 --> here we are 
ERROR - 2023-06-30 13:22:45 --> categorie yedu is4
ERROR - 2023-06-30 13:26:11 --> pecerntage is 10.50
ERROR - 2023-06-30 13:33:33 --> pecerntage is 10.50
ERROR - 2023-06-30 13:33:53 --> pecerntage is 10.50
ERROR - 2023-06-30 13:34:09 --> pecerntage is 10.50
ERROR - 2023-06-30 13:34:24 --> pecerntage is 10.50
ERROR - 2023-06-30 13:39:00 --> pecerntage is 10.50
ERROR - 2023-06-30 13:39:11 --> pecerntage is 10.50
ERROR - 2023-06-30 13:39:35 --> pecerntage is 10.50
ERROR - 2023-06-30 13:39:46 --> pecerntage is 10.50
ERROR - 2023-06-30 13:40:05 --> pecerntage is 10.50
ERROR - 2023-06-30 13:47:41 --> pecerntage is 10.50
ERROR - 2023-06-30 13:48:03 --> pecerntage is 10.50
ERROR - 2023-06-30 13:51:04 --> pecerntage is 10.50
ERROR - 2023-06-30 13:51:12 --> pecerntage is 10.50
ERROR - 2023-06-30 13:51:23 --> pecerntage is 10.50
ERROR - 2023-06-30 13:54:40 --> pecerntage is 10.50
ERROR - 2023-06-30 13:56:23 --> pecerntage is 10.50
ERROR - 2023-06-30 13:57:41 --> pecerntage is 12.00
ERROR - 2023-06-30 14:00:45 --> pecerntage is 10.50
ERROR - 2023-06-30 14:15:02 --> pecerntage is 10.50
ERROR - 2023-06-30 14:23:51 --> pecerntage is 10.50
ERROR - 2023-06-30 14:32:54 --> pecerntage is 10.50
ERROR - 2023-06-30 14:33:30 --> pecerntage is 10.50
ERROR - 2023-06-30 14:42:30 --> pecerntage is 10.50
ERROR - 2023-06-30 14:44:09 --> pecerntage is 10.50
ERROR - 2023-06-30 14:44:39 --> pecerntage is 10.50
ERROR - 2023-06-30 14:46:10 --> pecerntage is 10.50
ERROR - 2023-06-30 14:52:20 --> pecerntage is 12.00
ERROR - 2023-06-30 14:53:26 --> pecerntage is 12.00
ERROR - 2023-06-30 14:53:57 --> pecerntage is 12.00
ERROR - 2023-06-30 15:02:07 --> Severity: Error --> Uncaught Error: Class "CI_Exceptions" not found in /var/www/html/Cliffs_Internation/system/core/Common.php:196
Stack trace:
#0 /var/www/html/Cliffs_Internation/system/core/Common.php(617): load_class()
#1 /var/www/html/Cliffs_Internation/system/core/Common.php(163): _error_handler()
#2 /var/www/html/Cliffs_Internation/system/core/Common.php(163): require_once('...')
#3 /var/www/html/Cliffs_Internation/system/core/Common.php(652): load_class()
#4 [internal function]: _exception_handler()
#5 {main}
  thrown /var/www/html/Cliffs_Internation/system/core/Common.php 196
ERROR - 2023-06-30 15:19:39 --> Severity: Error --> Uncaught Error: Class "CI_Exceptions" not found in /var/www/html/Cliffs_Internation/system/core/Common.php:196
Stack trace:
#0 /var/www/html/Cliffs_Internation/system/core/Common.php(617): load_class()
#1 /var/www/html/Cliffs_Internation/system/core/Common.php(163): _error_handler()
#2 /var/www/html/Cliffs_Internation/system/core/Common.php(163): require_once('...')
#3 /var/www/html/Cliffs_Internation/system/core/Common.php(652): load_class()
#4 [internal function]: _exception_handler()
#5 {main}
  thrown /var/www/html/Cliffs_Internation/system/core/Common.php 196
ERROR - 2023-06-30 16:39:40 --> Severity: Error --> Uncaught Error: Class "CI_Exceptions" not found in /var/www/html/Cliffs_Internation/system/core/Common.php:196
Stack trace:
#0 /var/www/html/Cliffs_Internation/system/core/Common.php(617): load_class()
#1 /var/www/html/Cliffs_Internation/system/core/Common.php(163): _error_handler()
#2 /var/www/html/Cliffs_Internation/system/core/Common.php(163): require_once('...')
#3 /var/www/html/Cliffs_Internation/system/core/Common.php(652): load_class()
#4 [internal function]: _exception_handler()
#5 {main}
  thrown /var/www/html/Cliffs_Internation/system/core/Common.php 196
ERROR - 2023-06-30 16:40:45 --> Severity: Error --> Uncaught Error: Class "CI_Exceptions" not found in /var/www/html/Cliffs_Internation/system/core/Common.php:196
Stack trace:
#0 /var/www/html/Cliffs_Internation/system/core/Common.php(617): load_class()
#1 /var/www/html/Cliffs_Internation/system/core/Common.php(163): _error_handler()
#2 /var/www/html/Cliffs_Internation/system/core/Common.php(163): require_once('...')
#3 /var/www/html/Cliffs_Internation/system/core/Common.php(652): load_class()
#4 [internal function]: _exception_handler()
#5 {main}
  thrown /var/www/html/Cliffs_Internation/system/core/Common.php 196
ERROR - 2023-06-30 16:40:46 --> Severity: Error --> Uncaught Error: Class "CI_Exceptions" not found in /var/www/html/Cliffs_Internation/system/core/Common.php:196
Stack trace:
#0 /var/www/html/Cliffs_Internation/system/core/Common.php(617): load_class()
#1 /var/www/html/Cliffs_Internation/system/core/Common.php(163): _error_handler()
#2 /var/www/html/Cliffs_Internation/system/core/Common.php(163): require_once('...')
#3 /var/www/html/Cliffs_Internation/system/core/Common.php(652): load_class()
#4 [internal function]: _exception_handler()
#5 {main}
  thrown /var/www/html/Cliffs_Internation/system/core/Common.php 196
ERROR - 2023-06-30 16:40:50 --> Severity: Error --> Uncaught Error: Class "CI_Exceptions" not found in /var/www/html/Cliffs_Internation/system/core/Common.php:196
Stack trace:
#0 /var/www/html/Cliffs_Internation/system/core/Common.php(617): load_class()
#1 /var/www/html/Cliffs_Internation/system/core/Common.php(163): _error_handler()
#2 /var/www/html/Cliffs_Internation/system/core/Common.php(163): require_once('...')
#3 /var/www/html/Cliffs_Internation/system/core/Common.php(652): load_class()
#4 [internal function]: _exception_handler()
#5 {main}
  thrown /var/www/html/Cliffs_Internation/system/core/Common.php 196
ERROR - 2023-06-30 16:41:16 --> Severity: Error --> Uncaught Error: Class "CI_Exceptions" not found in /var/www/html/Cliffs_Internation/system/core/Common.php:196
Stack trace:
#0 /var/www/html/Cliffs_Internation/system/core/Common.php(617): load_class()
#1 /var/www/html/Cliffs_Internation/system/core/Common.php(163): _error_handler()
#2 /var/www/html/Cliffs_Internation/system/core/Common.php(163): require_once('...')
#3 /var/www/html/Cliffs_Internation/system/core/Common.php(652): load_class()
#4 [internal function]: _exception_handler()
#5 {main}
  thrown /var/www/html/Cliffs_Internation/system/core/Common.php 196
ERROR - 2023-06-30 16:41:32 --> Severity: Error --> Uncaught Error: Class "CI_Exceptions" not found in /var/www/html/Cliffs_Internation/system/core/Common.php:196
Stack trace:
#0 /var/www/html/Cliffs_Internation/system/core/Common.php(617): load_class()
#1 /var/www/html/Cliffs_Internation/system/core/Common.php(163): _error_handler()
#2 /var/www/html/Cliffs_Internation/system/core/Common.php(163): require_once('...')
#3 /var/www/html/Cliffs_Internation/system/core/Common.php(652): load_class()
#4 [internal function]: _exception_handler()
#5 {main}
  thrown /var/www/html/Cliffs_Internation/system/core/Common.php 196
ERROR - 2023-06-30 16:46:32 --> Severity: Error --> Uncaught Error: Class "CI_Exceptions" not found in /var/www/html/Cliffs_Internation/system/core/Common.php:196
Stack trace:
#0 /var/www/html/Cliffs_Internation/system/core/Common.php(617): load_class()
#1 /var/www/html/Cliffs_Internation/system/core/Common.php(163): _error_handler()
#2 /var/www/html/Cliffs_Internation/system/core/Common.php(163): require_once('...')
#3 /var/www/html/Cliffs_Internation/system/core/Common.php(652): load_class()
#4 [internal function]: _exception_handler()
#5 {main}
  thrown /var/www/html/Cliffs_Internation/system/core/Common.php 196
ERROR - 2023-06-30 16:51:17 --> Severity: Error --> Uncaught Error: Class "CI_Exceptions" not found in /var/www/html/Cliffs_Internation/system/core/Common.php:196
Stack trace:
#0 /var/www/html/Cliffs_Internation/system/core/Common.php(617): load_class()
#1 /var/www/html/Cliffs_Internation/system/core/Common.php(163): _error_handler()
#2 /var/www/html/Cliffs_Internation/system/core/Common.php(163): require_once('...')
#3 /var/www/html/Cliffs_Internation/system/core/Common.php(652): load_class()
#4 [internal function]: _exception_handler()
#5 {main}
  thrown /var/www/html/Cliffs_Internation/system/core/Common.php 196
ERROR - 2023-06-30 16:52:37 --> Severity: Error --> Uncaught Error: Class "CI_Exceptions" not found in /var/www/html/Cliffs_Internation/system/core/Common.php:196
Stack trace:
#0 /var/www/html/Cliffs_Internation/system/core/Common.php(617): load_class()
#1 /var/www/html/Cliffs_Internation/system/core/Common.php(163): _error_handler()
#2 /var/www/html/Cliffs_Internation/system/core/Common.php(163): require_once('...')
#3 /var/www/html/Cliffs_Internation/system/core/Common.php(652): load_class()
#4 [internal function]: _exception_handler()
#5 {main}
  thrown /var/www/html/Cliffs_Internation/system/core/Common.php 196
