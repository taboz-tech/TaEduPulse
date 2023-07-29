<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2023-06-28 07:43:30 --> Severity: 8192 --> Return type of CI_Session_files_driver::open($save_path, $name) should either be compatible with SessionHandlerInterface::open(string $path, string $name): bool, or the #[\ReturnTypeWillChange] attribute should be used to temporarily suppress the notice /var/www/html/Cliffs_Internation/system/libraries/Session/drivers/Session_files_driver.php 132
ERROR - 2023-06-28 07:43:30 --> Severity: 8192 --> Return type of CI_Session_files_driver::close() should either be compatible with SessionHandlerInterface::close(): bool, or the #[\ReturnTypeWillChange] attribute should be used to temporarily suppress the notice /var/www/html/Cliffs_Internation/system/libraries/Session/drivers/Session_files_driver.php 290
ERROR - 2023-06-28 07:43:30 --> Severity: 8192 --> Return type of CI_Session_files_driver::read($session_id) should either be compatible with SessionHandlerInterface::read(string $id): string|false, or the #[\ReturnTypeWillChange] attribute should be used to temporarily suppress the notice /var/www/html/Cliffs_Internation/system/libraries/Session/drivers/Session_files_driver.php 164
ERROR - 2023-06-28 07:43:30 --> Severity: 8192 --> Return type of CI_Session_files_driver::write($session_id, $session_data) should either be compatible with SessionHandlerInterface::write(string $id, string $data): bool, or the #[\ReturnTypeWillChange] attribute should be used to temporarily suppress the notice /var/www/html/Cliffs_Internation/system/libraries/Session/drivers/Session_files_driver.php 233
ERROR - 2023-06-28 07:43:30 --> Severity: 8192 --> Return type of CI_Session_files_driver::destroy($session_id) should either be compatible with SessionHandlerInterface::destroy(string $id): bool, or the #[\ReturnTypeWillChange] attribute should be used to temporarily suppress the notice /var/www/html/Cliffs_Internation/system/libraries/Session/drivers/Session_files_driver.php 313
ERROR - 2023-06-28 07:43:30 --> Severity: 8192 --> Return type of CI_Session_files_driver::gc($maxlifetime) should either be compatible with SessionHandlerInterface::gc(int $max_lifetime): int|false, or the #[\ReturnTypeWillChange] attribute should be used to temporarily suppress the notice /var/www/html/Cliffs_Internation/system/libraries/Session/drivers/Session_files_driver.php 354
ERROR - 2023-06-28 07:43:30 --> Severity: Warning --> ini_set(): Session ini settings cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 284
ERROR - 2023-06-28 07:43:30 --> Severity: Warning --> session_set_cookie_params(): Session cookie parameters cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 296
ERROR - 2023-06-28 07:43:30 --> Severity: Warning --> ini_set(): Session ini settings cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 306
ERROR - 2023-06-28 07:43:30 --> Severity: Warning --> ini_set(): Session ini settings cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 316
ERROR - 2023-06-28 07:43:30 --> Severity: Warning --> ini_set(): Session ini settings cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 317
ERROR - 2023-06-28 07:43:30 --> Severity: Warning --> ini_set(): Session ini settings cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 318
ERROR - 2023-06-28 07:43:30 --> Severity: Warning --> ini_set(): Session ini settings cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 319
ERROR - 2023-06-28 07:43:30 --> Severity: Warning --> ini_set(): Session ini settings cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 377
ERROR - 2023-06-28 07:43:30 --> Severity: Warning --> ini_set(): Session ini settings cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/drivers/Session_files_driver.php 108
ERROR - 2023-06-28 07:43:30 --> Severity: Warning --> session_set_save_handler(): Session save handler cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 110
ERROR - 2023-06-28 07:43:30 --> Severity: Warning --> session_start(): Session cannot be started after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 143
ERROR - 2023-06-28 07:43:30 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /var/www/html/Cliffs_Internation/system/core/Exceptions.php:271) /var/www/html/Cliffs_Internation/system/helpers/url_helper.php 564
ERROR - 2023-06-28 07:43:36 --> Severity: error --> Exception: Class "CI_Exceptions" not found /var/www/html/Cliffs_Internation/system/core/Common.php 196
ERROR - 2023-06-28 08:59:27 --> Severity: Error --> Uncaught Error: Class "CI_Exceptions" not found in /var/www/html/Cliffs_Internation/system/core/Common.php:196
Stack trace:
#0 /var/www/html/Cliffs_Internation/system/core/Common.php(617): load_class()
#1 /var/www/html/Cliffs_Internation/system/core/Common.php(163): _error_handler()
#2 /var/www/html/Cliffs_Internation/system/core/Common.php(163): require_once('...')
#3 /var/www/html/Cliffs_Internation/system/core/Common.php(652): load_class()
#4 [internal function]: _exception_handler()
#5 {main}
  thrown /var/www/html/Cliffs_Internation/system/core/Common.php 196
ERROR - 2023-06-28 08:59:31 --> Severity: Error --> Uncaught Error: Class "CI_Exceptions" not found in /var/www/html/Cliffs_Internation/system/core/Common.php:196
Stack trace:
#0 /var/www/html/Cliffs_Internation/system/core/Common.php(617): load_class()
#1 /var/www/html/Cliffs_Internation/system/core/Common.php(163): _error_handler()
#2 /var/www/html/Cliffs_Internation/system/core/Common.php(163): require_once('...')
#3 /var/www/html/Cliffs_Internation/system/core/Common.php(652): load_class()
#4 [internal function]: _exception_handler()
#5 {main}
  thrown /var/www/html/Cliffs_Internation/system/core/Common.php 196
ERROR - 2023-06-28 09:01:41 --> Severity: Error --> Uncaught Error: Class "CI_Exceptions" not found in /var/www/html/Cliffs_Internation/system/core/Common.php:196
Stack trace:
#0 /var/www/html/Cliffs_Internation/system/core/Common.php(617): load_class()
#1 /var/www/html/Cliffs_Internation/system/core/Common.php(163): _error_handler()
#2 /var/www/html/Cliffs_Internation/system/core/Common.php(163): require_once('...')
#3 /var/www/html/Cliffs_Internation/system/core/Common.php(652): load_class()
#4 [internal function]: _exception_handler()
#5 {main}
  thrown /var/www/html/Cliffs_Internation/system/core/Common.php 196
ERROR - 2023-06-28 09:05:45 --> wadiii taboz
ERROR - 2023-06-28 09:05:47 --> wadiii taboz
ERROR - 2023-06-28 09:31:16 --> wadiii taboz
ERROR - 2023-06-28 09:31:40 --> wadiii tabo5666z
ERROR - 2023-06-28 09:45:57 --> Severity: Warning --> Undefined variable $categories /var/www/html/Cliffs_Internation/application/views/items/items.php 91
ERROR - 2023-06-28 09:45:57 --> Severity: Warning --> foreach() argument must be of type array|object, null given /var/www/html/Cliffs_Internation/application/views/items/items.php 91
ERROR - 2023-06-28 09:46:00 --> wadiii tabo5666z
ERROR - 2023-06-28 09:47:43 --> Severity: Warning --> Undefined variable $categories /var/www/html/Cliffs_Internation/application/views/items/items.php 91
ERROR - 2023-06-28 09:47:43 --> Severity: Warning --> foreach() argument must be of type array|object, null given /var/www/html/Cliffs_Internation/application/views/items/items.php 91
ERROR - 2023-06-28 09:47:46 --> Categories data: [{"id":1,"name":"Insecticides","status":1,"percentage":"10.50"},{"id":2,"name":"Herbicides","status":1,"percentage":"15.25"},{"id":3,"name":"Fungicides","status":1,"percentage":"4.50"},{"id":4,"name":"Nematodes Control","status":1,"percentage":"12.00"},{"id":5,"name":"Rodenticides","status":1,"percentage":"9.80"},{"id":6,"name":"Soil Amendments","status":1,"percentage":"14.50"},{"id":7,"name":"Growth Enhancers","status":1,"percentage":"7.25"},{"id":8,"name":"Plant Nutrition","status":0,"percentage":"7.90"},{"id":9,"name":"Disease Control","status":0,"percentage":"7.90"},{"id":10,"name":"Weed Control","status":1,"percentage":"9.99"},{"id":12,"name":"Synthetic fertilizers","status":1,"percentage":"8.90"},{"id":13,"name":"Soil conditioners","status":1,"percentage":"6.70"}]
ERROR - 2023-06-28 09:47:46 --> wadiii tabo5666z
ERROR - 2023-06-28 09:50:26 --> Severity: Warning --> Undefined variable $categories /var/www/html/Cliffs_Internation/application/views/items/items.php 91
ERROR - 2023-06-28 09:50:26 --> Severity: Warning --> foreach() argument must be of type array|object, null given /var/www/html/Cliffs_Internation/application/views/items/items.php 91
ERROR - 2023-06-28 09:50:27 --> Categories data: [{"id":1,"name":"Insecticides","status":1,"percentage":"10.50"},{"id":2,"name":"Herbicides","status":1,"percentage":"15.25"},{"id":3,"name":"Fungicides","status":1,"percentage":"4.50"},{"id":4,"name":"Nematodes Control","status":1,"percentage":"12.00"},{"id":5,"name":"Rodenticides","status":1,"percentage":"9.80"},{"id":6,"name":"Soil Amendments","status":1,"percentage":"14.50"},{"id":7,"name":"Growth Enhancers","status":1,"percentage":"7.25"},{"id":8,"name":"Plant Nutrition","status":0,"percentage":"7.90"},{"id":9,"name":"Disease Control","status":0,"percentage":"7.90"},{"id":10,"name":"Weed Control","status":1,"percentage":"9.99"},{"id":12,"name":"Synthetic fertilizers","status":1,"percentage":"8.90"},{"id":13,"name":"Soil conditioners","status":1,"percentage":"6.70"}]
ERROR - 2023-06-28 09:50:27 --> wadiii tabo5666z
ERROR - 2023-06-28 09:50:27 --> Severity: 8192 --> str_replace(): Passing null to parameter #3 ($subject) of type array|string is deprecated /var/www/html/Cliffs_Internation/system/core/Output.php 457
ERROR - 2023-06-28 09:51:54 --> Severity: Warning --> Undefined variable $categories /var/www/html/Cliffs_Internation/application/views/items/items.php 91
ERROR - 2023-06-28 09:51:54 --> Severity: Warning --> foreach() argument must be of type array|object, null given /var/www/html/Cliffs_Internation/application/views/items/items.php 91
ERROR - 2023-06-28 09:52:00 --> Categories data: [{"id":1,"name":"Insecticides","status":1,"percentage":"10.50"},{"id":2,"name":"Herbicides","status":1,"percentage":"15.25"},{"id":3,"name":"Fungicides","status":1,"percentage":"4.50"},{"id":4,"name":"Nematodes Control","status":1,"percentage":"12.00"},{"id":5,"name":"Rodenticides","status":1,"percentage":"9.80"},{"id":6,"name":"Soil Amendments","status":1,"percentage":"14.50"},{"id":7,"name":"Growth Enhancers","status":1,"percentage":"7.25"},{"id":8,"name":"Plant Nutrition","status":0,"percentage":"7.90"},{"id":9,"name":"Disease Control","status":0,"percentage":"7.90"},{"id":10,"name":"Weed Control","status":1,"percentage":"9.99"},{"id":12,"name":"Synthetic fertilizers","status":1,"percentage":"8.90"},{"id":13,"name":"Soil conditioners","status":1,"percentage":"6.70"}]
ERROR - 2023-06-28 09:52:00 --> wadiii tabo5666z
ERROR - 2023-06-28 09:52:00 --> Severity: Warning --> Undefined variable $json /var/www/html/Cliffs_Internation/application/controllers/Items.php 106
ERROR - 2023-06-28 10:00:43 --> Severity: Warning --> Undefined variable $categories /var/www/html/Cliffs_Internation/application/views/items/items.php 91
ERROR - 2023-06-28 10:00:43 --> Severity: Warning --> foreach() argument must be of type array|object, null given /var/www/html/Cliffs_Internation/application/views/items/items.php 91
ERROR - 2023-06-28 10:00:45 --> Severity: Warning --> Attempt to read property "id" on string /var/www/html/Cliffs_Internation/application/views/items/items.php 92
ERROR - 2023-06-28 10:00:45 --> Severity: Warning --> Attempt to read property "name" on string /var/www/html/Cliffs_Internation/application/views/items/items.php 92
ERROR - 2023-06-28 10:00:45 --> Severity: Warning --> Attempt to read property "id" on string /var/www/html/Cliffs_Internation/application/views/items/items.php 92
ERROR - 2023-06-28 10:00:45 --> Severity: Warning --> Attempt to read property "name" on string /var/www/html/Cliffs_Internation/application/views/items/items.php 92
ERROR - 2023-06-28 10:00:45 --> Severity: Warning --> Attempt to read property "id" on string /var/www/html/Cliffs_Internation/application/views/items/items.php 92
ERROR - 2023-06-28 10:00:45 --> Severity: Warning --> Attempt to read property "name" on string /var/www/html/Cliffs_Internation/application/views/items/items.php 92
ERROR - 2023-06-28 10:00:45 --> Severity: Warning --> Attempt to read property "id" on string /var/www/html/Cliffs_Internation/application/views/items/items.php 92
ERROR - 2023-06-28 10:00:45 --> Severity: Warning --> Attempt to read property "name" on string /var/www/html/Cliffs_Internation/application/views/items/items.php 92
ERROR - 2023-06-28 10:00:45 --> Severity: Warning --> Attempt to read property "id" on string /var/www/html/Cliffs_Internation/application/views/items/items.php 92
ERROR - 2023-06-28 10:00:45 --> Severity: Warning --> Attempt to read property "name" on string /var/www/html/Cliffs_Internation/application/views/items/items.php 92
ERROR - 2023-06-28 10:00:45 --> Severity: Warning --> Attempt to read property "id" on string /var/www/html/Cliffs_Internation/application/views/items/items.php 92
ERROR - 2023-06-28 10:00:45 --> Severity: Warning --> Attempt to read property "name" on string /var/www/html/Cliffs_Internation/application/views/items/items.php 92
ERROR - 2023-06-28 10:00:45 --> Severity: Warning --> Attempt to read property "id" on string /var/www/html/Cliffs_Internation/application/views/items/items.php 92
ERROR - 2023-06-28 10:00:45 --> Severity: Warning --> Attempt to read property "name" on string /var/www/html/Cliffs_Internation/application/views/items/items.php 92
ERROR - 2023-06-28 10:00:45 --> Severity: Warning --> Attempt to read property "id" on string /var/www/html/Cliffs_Internation/application/views/items/items.php 92
ERROR - 2023-06-28 10:00:45 --> Severity: Warning --> Attempt to read property "name" on string /var/www/html/Cliffs_Internation/application/views/items/items.php 92
ERROR - 2023-06-28 10:00:45 --> Severity: Warning --> Attempt to read property "id" on string /var/www/html/Cliffs_Internation/application/views/items/items.php 92
ERROR - 2023-06-28 10:00:45 --> Severity: Warning --> Attempt to read property "name" on string /var/www/html/Cliffs_Internation/application/views/items/items.php 92
ERROR - 2023-06-28 10:00:45 --> Severity: Warning --> Attempt to read property "id" on string /var/www/html/Cliffs_Internation/application/views/items/items.php 92
ERROR - 2023-06-28 10:00:45 --> Severity: Warning --> Attempt to read property "name" on string /var/www/html/Cliffs_Internation/application/views/items/items.php 92
ERROR - 2023-06-28 10:00:45 --> Severity: Warning --> Attempt to read property "id" on string /var/www/html/Cliffs_Internation/application/views/items/items.php 92
ERROR - 2023-06-28 10:00:45 --> Severity: Warning --> Attempt to read property "name" on string /var/www/html/Cliffs_Internation/application/views/items/items.php 92
ERROR - 2023-06-28 10:00:45 --> Severity: Warning --> Attempt to read property "id" on string /var/www/html/Cliffs_Internation/application/views/items/items.php 92
ERROR - 2023-06-28 10:00:45 --> Severity: Warning --> Attempt to read property "name" on string /var/www/html/Cliffs_Internation/application/views/items/items.php 92
ERROR - 2023-06-28 10:02:45 --> Severity: Warning --> Undefined variable $categories /var/www/html/Cliffs_Internation/application/views/items/items.php 91
ERROR - 2023-06-28 10:02:45 --> Severity: Warning --> foreach() argument must be of type array|object, null given /var/www/html/Cliffs_Internation/application/views/items/items.php 91
ERROR - 2023-06-28 10:02:47 --> Severity: Warning --> Attempt to read property "id" on string /var/www/html/Cliffs_Internation/application/views/items/items.php 92
ERROR - 2023-06-28 10:02:47 --> Severity: Warning --> Attempt to read property "name" on string /var/www/html/Cliffs_Internation/application/views/items/items.php 92
ERROR - 2023-06-28 10:02:47 --> Severity: Warning --> Attempt to read property "id" on string /var/www/html/Cliffs_Internation/application/views/items/items.php 92
ERROR - 2023-06-28 10:02:47 --> Severity: Warning --> Attempt to read property "name" on string /var/www/html/Cliffs_Internation/application/views/items/items.php 92
ERROR - 2023-06-28 10:02:47 --> Severity: Warning --> Attempt to read property "id" on string /var/www/html/Cliffs_Internation/application/views/items/items.php 92
ERROR - 2023-06-28 10:02:47 --> Severity: Warning --> Attempt to read property "name" on string /var/www/html/Cliffs_Internation/application/views/items/items.php 92
ERROR - 2023-06-28 10:02:47 --> Severity: Warning --> Attempt to read property "id" on string /var/www/html/Cliffs_Internation/application/views/items/items.php 92
ERROR - 2023-06-28 10:02:47 --> Severity: Warning --> Attempt to read property "name" on string /var/www/html/Cliffs_Internation/application/views/items/items.php 92
ERROR - 2023-06-28 10:02:47 --> Severity: Warning --> Attempt to read property "id" on string /var/www/html/Cliffs_Internation/application/views/items/items.php 92
ERROR - 2023-06-28 10:02:47 --> Severity: Warning --> Attempt to read property "name" on string /var/www/html/Cliffs_Internation/application/views/items/items.php 92
ERROR - 2023-06-28 10:02:47 --> Severity: Warning --> Attempt to read property "id" on string /var/www/html/Cliffs_Internation/application/views/items/items.php 92
ERROR - 2023-06-28 10:02:47 --> Severity: Warning --> Attempt to read property "name" on string /var/www/html/Cliffs_Internation/application/views/items/items.php 92
ERROR - 2023-06-28 10:02:47 --> Severity: Warning --> Attempt to read property "id" on string /var/www/html/Cliffs_Internation/application/views/items/items.php 92
ERROR - 2023-06-28 10:02:47 --> Severity: Warning --> Attempt to read property "name" on string /var/www/html/Cliffs_Internation/application/views/items/items.php 92
ERROR - 2023-06-28 10:02:47 --> Severity: Warning --> Attempt to read property "id" on string /var/www/html/Cliffs_Internation/application/views/items/items.php 92
ERROR - 2023-06-28 10:02:47 --> Severity: Warning --> Attempt to read property "name" on string /var/www/html/Cliffs_Internation/application/views/items/items.php 92
ERROR - 2023-06-28 10:02:47 --> Severity: Warning --> Attempt to read property "id" on string /var/www/html/Cliffs_Internation/application/views/items/items.php 92
ERROR - 2023-06-28 10:02:47 --> Severity: Warning --> Attempt to read property "name" on string /var/www/html/Cliffs_Internation/application/views/items/items.php 92
ERROR - 2023-06-28 10:02:47 --> Severity: Warning --> Attempt to read property "id" on string /var/www/html/Cliffs_Internation/application/views/items/items.php 92
ERROR - 2023-06-28 10:02:47 --> Severity: Warning --> Attempt to read property "name" on string /var/www/html/Cliffs_Internation/application/views/items/items.php 92
ERROR - 2023-06-28 10:02:47 --> Severity: Warning --> Attempt to read property "id" on string /var/www/html/Cliffs_Internation/application/views/items/items.php 92
ERROR - 2023-06-28 10:02:47 --> Severity: Warning --> Attempt to read property "name" on string /var/www/html/Cliffs_Internation/application/views/items/items.php 92
ERROR - 2023-06-28 10:02:47 --> Severity: Warning --> Attempt to read property "id" on string /var/www/html/Cliffs_Internation/application/views/items/items.php 92
ERROR - 2023-06-28 10:02:47 --> Severity: Warning --> Attempt to read property "name" on string /var/www/html/Cliffs_Internation/application/views/items/items.php 92
ERROR - 2023-06-28 10:05:14 --> Severity: Warning --> Undefined variable $categories /var/www/html/Cliffs_Internation/application/views/items/items.php 91
ERROR - 2023-06-28 10:05:14 --> Severity: Warning --> foreach() argument must be of type array|object, null given /var/www/html/Cliffs_Internation/application/views/items/items.php 91
ERROR - 2023-06-28 10:05:15 --> Categories data: {"1":"Insecticides","2":"Herbicides","3":"Fungicides","4":"Nematodes Control","5":"Rodenticides","6":"Soil Amendments","7":"Growth Enhancers","8":"Plant Nutrition","9":"Disease Control","10":"Weed Control","12":"Synthetic fertilizers","13":"Soil conditioners"}
ERROR - 2023-06-28 10:05:15 --> Severity: Warning --> Attempt to read property "id" on string /var/www/html/Cliffs_Internation/application/views/items/items.php 92
ERROR - 2023-06-28 10:05:15 --> Severity: Warning --> Attempt to read property "name" on string /var/www/html/Cliffs_Internation/application/views/items/items.php 92
ERROR - 2023-06-28 10:05:15 --> Severity: Warning --> Attempt to read property "id" on string /var/www/html/Cliffs_Internation/application/views/items/items.php 92
ERROR - 2023-06-28 10:05:15 --> Severity: Warning --> Attempt to read property "name" on string /var/www/html/Cliffs_Internation/application/views/items/items.php 92
ERROR - 2023-06-28 10:05:15 --> Severity: Warning --> Attempt to read property "id" on string /var/www/html/Cliffs_Internation/application/views/items/items.php 92
ERROR - 2023-06-28 10:05:15 --> Severity: Warning --> Attempt to read property "name" on string /var/www/html/Cliffs_Internation/application/views/items/items.php 92
ERROR - 2023-06-28 10:05:15 --> Severity: Warning --> Attempt to read property "id" on string /var/www/html/Cliffs_Internation/application/views/items/items.php 92
ERROR - 2023-06-28 10:05:15 --> Severity: Warning --> Attempt to read property "name" on string /var/www/html/Cliffs_Internation/application/views/items/items.php 92
ERROR - 2023-06-28 10:05:15 --> Severity: Warning --> Attempt to read property "id" on string /var/www/html/Cliffs_Internation/application/views/items/items.php 92
ERROR - 2023-06-28 10:05:15 --> Severity: Warning --> Attempt to read property "name" on string /var/www/html/Cliffs_Internation/application/views/items/items.php 92
ERROR - 2023-06-28 10:05:15 --> Severity: Warning --> Attempt to read property "id" on string /var/www/html/Cliffs_Internation/application/views/items/items.php 92
ERROR - 2023-06-28 10:05:15 --> Severity: Warning --> Attempt to read property "name" on string /var/www/html/Cliffs_Internation/application/views/items/items.php 92
ERROR - 2023-06-28 10:05:15 --> Severity: Warning --> Attempt to read property "id" on string /var/www/html/Cliffs_Internation/application/views/items/items.php 92
ERROR - 2023-06-28 10:05:15 --> Severity: Warning --> Attempt to read property "name" on string /var/www/html/Cliffs_Internation/application/views/items/items.php 92
ERROR - 2023-06-28 10:05:15 --> Severity: Warning --> Attempt to read property "id" on string /var/www/html/Cliffs_Internation/application/views/items/items.php 92
ERROR - 2023-06-28 10:05:15 --> Severity: Warning --> Attempt to read property "name" on string /var/www/html/Cliffs_Internation/application/views/items/items.php 92
ERROR - 2023-06-28 10:05:15 --> Severity: Warning --> Attempt to read property "id" on string /var/www/html/Cliffs_Internation/application/views/items/items.php 92
ERROR - 2023-06-28 10:05:15 --> Severity: Warning --> Attempt to read property "name" on string /var/www/html/Cliffs_Internation/application/views/items/items.php 92
ERROR - 2023-06-28 10:05:15 --> Severity: Warning --> Attempt to read property "id" on string /var/www/html/Cliffs_Internation/application/views/items/items.php 92
ERROR - 2023-06-28 10:05:15 --> Severity: Warning --> Attempt to read property "name" on string /var/www/html/Cliffs_Internation/application/views/items/items.php 92
ERROR - 2023-06-28 10:05:15 --> Severity: Warning --> Attempt to read property "id" on string /var/www/html/Cliffs_Internation/application/views/items/items.php 92
ERROR - 2023-06-28 10:05:15 --> Severity: Warning --> Attempt to read property "name" on string /var/www/html/Cliffs_Internation/application/views/items/items.php 92
ERROR - 2023-06-28 10:05:15 --> Severity: Warning --> Attempt to read property "id" on string /var/www/html/Cliffs_Internation/application/views/items/items.php 92
ERROR - 2023-06-28 10:05:15 --> Severity: Warning --> Attempt to read property "name" on string /var/www/html/Cliffs_Internation/application/views/items/items.php 92
ERROR - 2023-06-28 10:07:05 --> Severity: Warning --> Undefined variable $categories /var/www/html/Cliffs_Internation/application/views/items/items.php 91
ERROR - 2023-06-28 10:07:05 --> Severity: Warning --> foreach() argument must be of type array|object, null given /var/www/html/Cliffs_Internation/application/views/items/items.php 91
ERROR - 2023-06-28 10:07:06 --> Categories data: {"1":"Insecticides","2":"Herbicides","3":"Fungicides","4":"Nematodes Control","5":"Rodenticides","6":"Soil Amendments","7":"Growth Enhancers","8":"Plant Nutrition","9":"Disease Control","10":"Weed Control","12":"Synthetic fertilizers","13":"Soil conditioners"}
ERROR - 2023-06-28 10:08:25 --> Severity: Warning --> Undefined variable $categories /var/www/html/Cliffs_Internation/application/views/items/items.php 91
ERROR - 2023-06-28 10:08:25 --> Severity: Warning --> foreach() argument must be of type array|object, null given /var/www/html/Cliffs_Internation/application/views/items/items.php 91
ERROR - 2023-06-28 10:08:28 --> Categories data: {"1":"Insecticides","2":"Herbicides","3":"Fungicides","4":"Nematodes Control","5":"Rodenticides","6":"Soil Amendments","7":"Growth Enhancers","8":"Plant Nutrition","9":"Disease Control","10":"Weed Control","12":"Synthetic fertilizers","13":"Soil conditioners"}
ERROR - 2023-06-28 10:13:11 --> Severity: Warning --> Undefined variable $categories /var/www/html/Cliffs_Internation/application/views/items/items.php 91
ERROR - 2023-06-28 10:13:11 --> Severity: Warning --> foreach() argument must be of type array|object, null given /var/www/html/Cliffs_Internation/application/views/items/items.php 91
ERROR - 2023-06-28 10:13:13 --> Categories data: {"1":"Insecticides","2":"Herbicides","3":"Fungicides","4":"Nematodes Control","5":"Rodenticides","6":"Soil Amendments","7":"Growth Enhancers","8":"Plant Nutrition","9":"Disease Control","10":"Weed Control","12":"Synthetic fertilizers","13":"Soil conditioners"}
ERROR - 2023-06-28 10:14:55 --> Severity: Warning --> Undefined variable $categories /var/www/html/Cliffs_Internation/application/views/items/items.php 91
ERROR - 2023-06-28 10:14:55 --> Severity: Warning --> foreach() argument must be of type array|object, null given /var/www/html/Cliffs_Internation/application/views/items/items.php 91
ERROR - 2023-06-28 10:14:56 --> Categories data: {"1":"Insecticides","2":"Herbicides","3":"Fungicides","4":"Nematodes Control","5":"Rodenticides","6":"Soil Amendments","7":"Growth Enhancers","8":"Plant Nutrition","9":"Disease Control","10":"Weed Control","12":"Synthetic fertilizers","13":"Soil conditioners"}
ERROR - 2023-06-28 10:20:55 --> Severity: Warning --> Undefined variable $categories /var/www/html/Cliffs_Internation/application/views/items/items.php 91
ERROR - 2023-06-28 10:20:55 --> Severity: Warning --> foreach() argument must be of type array|object, null given /var/www/html/Cliffs_Internation/application/views/items/items.php 91
ERROR - 2023-06-28 10:20:57 --> Categories data: {"1":"Insecticides","2":"Herbicides","3":"Fungicides","4":"Nematodes Control","5":"Rodenticides","6":"Soil Amendments","7":"Growth Enhancers","8":"Plant Nutrition","9":"Disease Control","10":"Weed Control","12":"Synthetic fertilizers","13":"Soil conditioners"}
ERROR - 2023-06-28 10:25:46 --> Severity: Warning --> Undefined variable $categories /var/www/html/Cliffs_Internation/application/views/items/items.php 91
ERROR - 2023-06-28 10:25:46 --> Severity: Warning --> foreach() argument must be of type array|object, null given /var/www/html/Cliffs_Internation/application/views/items/items.php 91
ERROR - 2023-06-28 10:25:48 --> Categories data: {"1":"Insecticides","2":"Herbicides","3":"Fungicides","4":"Nematodes Control","5":"Rodenticides","6":"Soil Amendments","7":"Growth Enhancers","8":"Plant Nutrition","9":"Disease Control","10":"Weed Control","12":"Synthetic fertilizers","13":"Soil conditioners"}
ERROR - 2023-06-28 10:33:59 --> Severity: Warning --> Undefined variable $categories /var/www/html/Cliffs_Internation/application/views/items/items.php 91
ERROR - 2023-06-28 10:33:59 --> Severity: Warning --> foreach() argument must be of type array|object, null given /var/www/html/Cliffs_Internation/application/views/items/items.php 91
ERROR - 2023-06-28 10:34:01 --> Categories data: {"1":"Insecticides","2":"Herbicides","3":"Fungicides","4":"Nematodes Control","5":"Rodenticides","6":"Soil Amendments","7":"Growth Enhancers","8":"Plant Nutrition","9":"Disease Control","10":"Weed Control","12":"Synthetic fertilizers","13":"Soil conditioners"}
ERROR - 2023-06-28 10:34:01 --> View output: 
<div class="pwell hidden-print">   
    <div class="row">
        <div class="col-sm-12">
            <!-- sort and co row-->
            <div class="row">
                <div class="col-sm-12">
                    <div class="col-sm-2 form-inline form-group-sm">
                        <button class="btn btn-primary btn-sm" id='createItem'>Add New Item</button>
                    </div>

                    <div class="col-sm-3 form-inline form-group-sm">
                        <label for="itemsListPerPage">Show</label>
                        <select id="itemsListPerPage" class="form-control">
                            <option value="1">1</option>
                            <option value="5">5</option>
                            <option value="10" selected>10</option>
                            <option value="15">15</option>
                            <option value="20">20</option>
                            <option value="30">30</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                        <label>per page</label>
                    </div>

                    <div class="col-sm-4 form-group-sm form-inline">
                        <label for="itemsListSortBy">Sort by</label>
                        <select id="itemsListSortBy" class="form-control">
                            <option value="name-ASC">Item Name (A-Z)</option>
                            <option value="code-ASC">Item Code (Ascending)</option>
                            <option value="unitPrice-DESC">Unit Price (Highest first)</option>
                            <option value="quantity-DESC">Quantity (Highest first)</option>
                            <option value="name-DESC">Item Name (Z-A)</option>
                            <option value="code-DESC">Item Code (Descending)</option>
                            <option value="unitPrice-ASC">Unit Price (lowest first)</option>
                            <option value="quantity-ASC">Quantity (lowest first)</option>
                        </select>
                    </div>

                    <div class="col-sm-3 form-inline form-group-sm">
                        <label for='itemSearch'><i class="fa fa-search"></i></label>
                        <input type="search" id="itemSearch" class="form-control" placeholder="Search Items">
                    </div>
                </div>
            </div>
            <!-- end of sort and co div-->
        </div>
    </div>
    
    <hr>
    
    <!-- row of adding new item form and items list table-->
    <div class="row">
        <div class="col-sm-12">
            <!--Form to add/update an item-->
            <div class="col-sm-4 hidden" id='createNewItemDiv'>
                <div class="well">
                    <button class="btn btn-info btn-xs pull-left" id="useBarcodeScanner">Use Scanner</button>
                    <button class="close cancelAddItem">&times;</button><br>
                    <form name="addNewItemForm" id="addNewItemForm" role="form">
                        <div class="text-center errMsg" id='addCustErrMsg'></div>
                        
                        <br>
                        
                        <div class="row">
                            <div class="col-sm-12 form-group-sm">
                                <label for="itemCode">Item Code</label>
                                <input type="text" id="itemCode" name="itemCode" placeholder="Item Code" maxlength="80"
                                    class="form-control" onchange="checkField(this.value, 'itemCodeErr')" autofocus>
                                <!--<span class="help-block"><input type="checkbox" id="gen4me"> auto-generate</span>-->
                                <span class="help-block errMsg" id="itemCodeErr"></span>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-12 form-group-sm">
                                <label for="itemName">Item Name</label>
                                <input type="text" id="itemName" name="itemName" placeholder="Item Name" maxlength="80"
                                    class="form-control" onchange="checkField(this.value, 'itemNameErr')">
                                <span class="help-block errMsg" id="itemNameErr"></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 form-group-sm">
                                <label for="categorie">Category</label>
                                <select id="categorie" name="categorie" class="form-control">
                                                                            <option value="1">Insecticides</option>
                                                                            <option value="2">Herbicides</option>
                                                                            <option value="3">Fungicides</option>
                                                                            <option value="4">Nematodes Control</option>
                                                                            <option value="5">Rodenticides</option>
                                                                            <option value="6">Soil Amendments</option>
                                                                            <option value="7">Growth Enhancers</option>
                                                                            <option value="8">Plant Nutrition</option>
                                                                            <option value="9">Disease Control</option>
                                                                            <option value="10">Weed Control</option>
                                                                            <option value="12">Synthetic fertilizers</option>
                                                                            <option value="13">Soil conditioners</option>
                                                                    </select>
                                <span class="help-block errMsg" id="categorieErr"></span>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-sm-12 form-group-sm">
                                <label for="itemQuantity">Quantity</label>
                                <input type="number" id="itemQuantity" name="itemQuantity" placeholder="Available Quantity"
                                    class="form-control" min="0" onchange="checkField(this.value, 'itemQuantityErr')">
                                <span class="help-block errMsg" id="itemQuantityErr"></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 form-group-sm">
                                <label for="unitPrice">($)Unit Price</label>
                                <input type="text" id="itemPrice" name="itemPrice" placeholder="($)Unit Price" class="form-control"
                                    onchange="checkField(this.value, 'itemPriceErr')">
                                <span class="help-block errMsg" id="itemPriceErr"></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 form-group-sm">
                                <label for="itemDescription" class="">Description (Optional)</label>
                                <textarea class="form-control" id="itemDescription" name="itemDescription" rows='4'
                                    placeholder="Optional Item Description"></textarea>
                            </div>
                        </div>
                        <br>
                        <div class="row text-center">
                            <div class="col-sm-6 form-group-sm">
                                <button class="btn btn-primary btn-sm" id="addNewItem">Add Item</button>
                            </div>

                            <div class="col-sm-6 form-group-sm">
                                <button type="reset" id="cancelAddItem" class="btn btn-danger btn-sm cancelAddItem" form='addNewItemForm'>Cancel</button>
                            </div>
                        </div>
                    </form><!-- end of form-->
                </div>
            </div>
            
            <!--- Item list div-->
            <div class="col-sm-12" id="itemsListDiv">
                <!-- Item list Table-->
                <div class="row">
                    <div class="col-sm-12" id="itemsListTable"></div>
                </div>
                <!--end of table-->
            </div>
            <!--- End of item list div-->

        </div>
    </div>
    <!-- End of row of adding new item form and items list table-->
</div>

<!--modal to update stock-->
<div id="updateStockModal" class="modal fade" role="dialog" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal">&times;</button>
                <h4 class="text-center">Update Stock</h4>
                <div id="stockUpdateFMsg" class="text-center"></div>
            </div>
            <div class="modal-body">
                <form name="updateStockForm" id="updateStockForm" role="form">
                    <div class="row">
                        <div class="col-sm-4 form-group-sm">
                            <label>Item Name</label>
                            <input type="text" readonly id="stockUpdateItemName" class="form-control">
                        </div>
                        
                        <div class="col-sm-4 form-group-sm">
                            <label>Item Code</label>
                            <input type="text" readonly id="stockUpdateItemCode" class="form-control">
                        </div>
                        
                        <div class="col-sm-4 form-group-sm">
                            <label>Quantity in Stock</label>
                            <input type="text" readonly id="stockUpdateItemQInStock" class="form-control">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-6 form-group-sm">
                            <label for="stockUpdateType">Update Type</label>
                            <select id="stockUpdateType" class="form-control checkField">
                                <option value="">---</option>
                                <option value="newStock">New Stock</option>
                                <option value="deficit">Deficit</option>
                            </select>
                            <span class="help-block errMsg" id="stockUpdateTypeErr"></span>
                        </div>
                        
                        <div class="col-sm-6 form-group-sm">
                            <label for="stockUpdateQuantity">Quantity</label>
                            <input type="number" id="stockUpdateQuantity" placeholder="Update Quantity"
                                class="form-control checkField" min="0">
                            <span class="help-block errMsg" id="stockUpdateQuantityErr"></span>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-12 form-group-sm">
                            <label for="stockUpdateDescription" class="">Description</label>
                            <textarea class="form-control checkField" id="stockUpdateDescription" placeholder="Update Description"></textarea>
                            <span class="help-block errMsg" id="stockUpdateDescriptionErr"></span>
                        </div>
                    </div>
                    
                    <input type="hidden" id="stockUpdateItemId">
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" id="stockUpdateSubmit">Update</button>
                <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<!--end of modal-->



<!--modal to edit item-->
<div id="editItemModal" class="modal fade" role="dialog" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal">&times;</button>
                <h4 class="text-center">Edit Item</h4>
                <div id="editItemFMsg" class="text-center"></div>
            </div>
            <div class="modal-body">
                <form role="form">
                    <div class="row">
                        <div class="col-sm-4 form-group-sm">
                            <label for="itemNameEdit">Item Name</label>
                            <input type="text" id="itemNameEdit" placeholder="Item Name" autofocus class="form-control checkField">
                            <span class="help-block errMsg" id="itemNameEditErr"></span>
                        </div>
                        
                        <div class="col-sm-4 form-group-sm">
                            <label for="itemCode">Item Code</label>
                            <input type="text" id="itemCodeEdit" class="form-control">
                            <span class="help-block errMsg" id="itemCodeEditErr"></span>
                        </div>
                        
                        <div class="col-sm-4 form-group-sm">
                            <label for="unitPrice">Unit Price</label>
                            <input type="text" id="itemPriceEdit" name="itemPrice" placeholder="Unit Price" class="form-control checkField">
                            <span class="help-block errMsg" id="itemPriceEditErr"></span>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-12 form-group-sm">
                            <label for="itemDescriptionEdit" class="">Description (Optional)</label>
                            <textarea class="form-control" id="itemDescriptionEdit" placeholder="Optional Item Description"></textarea>
                        </div>
                    </div>
                    <input type="hidden" id="itemIdEdit">
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" id="editItemSubmit">Save</button>
                <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<!--end of modal-->
<script src="http://localhost/Cliffs_Internation/public/js/items.js"></script>
ERROR - 2023-06-28 10:34:01 --> Severity: 8192 --> str_replace(): Passing null to parameter #3 ($subject) of type array|string is deprecated /var/www/html/Cliffs_Internation/system/core/Output.php 457
ERROR - 2023-06-28 10:40:35 --> Categories data: {"1":"Insecticides","2":"Herbicides","3":"Fungicides","4":"Nematodes Control","5":"Rodenticides","6":"Soil Amendments","7":"Growth Enhancers","8":"Plant Nutrition","9":"Disease Control","10":"Weed Control","12":"Synthetic fertilizers","13":"Soil conditioners"}
ERROR - 2023-06-28 10:40:35 --> View output: 
<div class="pwell hidden-print">   
    <div class="row">
        <div class="col-sm-12">
            <!-- sort and co row-->
            <div class="row">
                <div class="col-sm-12">
                    <div class="col-sm-2 form-inline form-group-sm">
                        <button class="btn btn-primary btn-sm" id='createItem'>Add New Item</button>
                    </div>

                    <div class="col-sm-3 form-inline form-group-sm">
                        <label for="itemsListPerPage">Show</label>
                        <select id="itemsListPerPage" class="form-control">
                            <option value="1">1</option>
                            <option value="5">5</option>
                            <option value="10" selected>10</option>
                            <option value="15">15</option>
                            <option value="20">20</option>
                            <option value="30">30</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                        <label>per page</label>
                    </div>

                    <div class="col-sm-4 form-group-sm form-inline">
                        <label for="itemsListSortBy">Sort by</label>
                        <select id="itemsListSortBy" class="form-control">
                            <option value="name-ASC">Item Name (A-Z)</option>
                            <option value="code-ASC">Item Code (Ascending)</option>
                            <option value="unitPrice-DESC">Unit Price (Highest first)</option>
                            <option value="quantity-DESC">Quantity (Highest first)</option>
                            <option value="name-DESC">Item Name (Z-A)</option>
                            <option value="code-DESC">Item Code (Descending)</option>
                            <option value="unitPrice-ASC">Unit Price (lowest first)</option>
                            <option value="quantity-ASC">Quantity (lowest first)</option>
                        </select>
                    </div>

                    <div class="col-sm-3 form-inline form-group-sm">
                        <label for='itemSearch'><i class="fa fa-search"></i></label>
                        <input type="search" id="itemSearch" class="form-control" placeholder="Search Items">
                    </div>
                </div>
            </div>
            <!-- end of sort and co div-->
        </div>
    </div>
    
    <hr>
    
    <!-- row of adding new item form and items list table-->
    <div class="row">
        <div class="col-sm-12">
            <!--Form to add/update an item-->
            <div class="col-sm-4 hidden" id='createNewItemDiv'>
                <div class="well">
                    <button class="btn btn-info btn-xs pull-left" id="useBarcodeScanner">Use Scanner</button>
                    <button class="close cancelAddItem">&times;</button><br>
                    <form name="addNewItemForm" id="addNewItemForm" role="form">
                        <div class="text-center errMsg" id='addCustErrMsg'></div>
                        
                        <br>
                        
                        <div class="row">
                            <div class="col-sm-12 form-group-sm">
                                <label for="itemCode">Item Code</label>
                                <input type="text" id="itemCode" name="itemCode" placeholder="Item Code" maxlength="80"
                                    class="form-control" onchange="checkField(this.value, 'itemCodeErr')" autofocus>
                                <!--<span class="help-block"><input type="checkbox" id="gen4me"> auto-generate</span>-->
                                <span class="help-block errMsg" id="itemCodeErr"></span>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-12 form-group-sm">
                                <label for="itemName">Item Name</label>
                                <input type="text" id="itemName" name="itemName" placeholder="Item Name" maxlength="80"
                                    class="form-control" onchange="checkField(this.value, 'itemNameErr')">
                                <span class="help-block errMsg" id="itemNameErr"></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 form-group-sm">
                                <label for="categorie">Category</label>
                                <select id="categorie" name="categorie" class="form-control">
                                                                            <option value="1">Insecticides</option>
                                                                            <option value="2">Herbicides</option>
                                                                            <option value="3">Fungicides</option>
                                                                            <option value="4">Nematodes Control</option>
                                                                            <option value="5">Rodenticides</option>
                                                                            <option value="6">Soil Amendments</option>
                                                                            <option value="7">Growth Enhancers</option>
                                                                            <option value="8">Plant Nutrition</option>
                                                                            <option value="9">Disease Control</option>
                                                                            <option value="10">Weed Control</option>
                                                                            <option value="12">Synthetic fertilizers</option>
                                                                            <option value="13">Soil conditioners</option>
                                                                    </select>
                                <span class="help-block errMsg" id="categorieErr"></span>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-sm-12 form-group-sm">
                                <label for="itemQuantity">Quantity</label>
                                <input type="number" id="itemQuantity" name="itemQuantity" placeholder="Available Quantity"
                                    class="form-control" min="0" onchange="checkField(this.value, 'itemQuantityErr')">
                                <span class="help-block errMsg" id="itemQuantityErr"></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 form-group-sm">
                                <label for="unitPrice">($)Unit Price</label>
                                <input type="text" id="itemPrice" name="itemPrice" placeholder="($)Unit Price" class="form-control"
                                    onchange="checkField(this.value, 'itemPriceErr')">
                                <span class="help-block errMsg" id="itemPriceErr"></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 form-group-sm">
                                <label for="itemDescription" class="">Description (Optional)</label>
                                <textarea class="form-control" id="itemDescription" name="itemDescription" rows='4'
                                    placeholder="Optional Item Description"></textarea>
                            </div>
                        </div>
                        <br>
                        <div class="row text-center">
                            <div class="col-sm-6 form-group-sm">
                                <button class="btn btn-primary btn-sm" id="addNewItem">Add Item</button>
                            </div>

                            <div class="col-sm-6 form-group-sm">
                                <button type="reset" id="cancelAddItem" class="btn btn-danger btn-sm cancelAddItem" form='addNewItemForm'>Cancel</button>
                            </div>
                        </div>
                    </form><!-- end of form-->
                </div>
            </div>
            
            <!--- Item list div-->
            <div class="col-sm-12" id="itemsListDiv">
                <!-- Item list Table-->
                <div class="row">
                    <div class="col-sm-12" id="itemsListTable"></div>
                </div>
                <!--end of table-->
            </div>
            <!--- End of item list div-->

        </div>
    </div>
    <!-- End of row of adding new item form and items list table-->
</div>

<!--modal to update stock-->
<div id="updateStockModal" class="modal fade" role="dialog" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal">&times;</button>
                <h4 class="text-center">Update Stock</h4>
                <div id="stockUpdateFMsg" class="text-center"></div>
            </div>
            <div class="modal-body">
                <form name="updateStockForm" id="updateStockForm" role="form">
                    <div class="row">
                        <div class="col-sm-4 form-group-sm">
                            <label>Item Name</label>
                            <input type="text" readonly id="stockUpdateItemName" class="form-control">
                        </div>
                        
                        <div class="col-sm-4 form-group-sm">
                            <label>Item Code</label>
                            <input type="text" readonly id="stockUpdateItemCode" class="form-control">
                        </div>
                        
                        <div class="col-sm-4 form-group-sm">
                            <label>Quantity in Stock</label>
                            <input type="text" readonly id="stockUpdateItemQInStock" class="form-control">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-6 form-group-sm">
                            <label for="stockUpdateType">Update Type</label>
                            <select id="stockUpdateType" class="form-control checkField">
                                <option value="">---</option>
                                <option value="newStock">New Stock</option>
                                <option value="deficit">Deficit</option>
                            </select>
                            <span class="help-block errMsg" id="stockUpdateTypeErr"></span>
                        </div>
                        
                        <div class="col-sm-6 form-group-sm">
                            <label for="stockUpdateQuantity">Quantity</label>
                            <input type="number" id="stockUpdateQuantity" placeholder="Update Quantity"
                                class="form-control checkField" min="0">
                            <span class="help-block errMsg" id="stockUpdateQuantityErr"></span>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-12 form-group-sm">
                            <label for="stockUpdateDescription" class="">Description</label>
                            <textarea class="form-control checkField" id="stockUpdateDescription" placeholder="Update Description"></textarea>
                            <span class="help-block errMsg" id="stockUpdateDescriptionErr"></span>
                        </div>
                    </div>
                    
                    <input type="hidden" id="stockUpdateItemId">
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" id="stockUpdateSubmit">Update</button>
                <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<!--end of modal-->



<!--modal to edit item-->
<div id="editItemModal" class="modal fade" role="dialog" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal">&times;</button>
                <h4 class="text-center">Edit Item</h4>
                <div id="editItemFMsg" class="text-center"></div>
            </div>
            <div class="modal-body">
                <form role="form">
                    <div class="row">
                        <div class="col-sm-4 form-group-sm">
                            <label for="itemNameEdit">Item Name</label>
                            <input type="text" id="itemNameEdit" placeholder="Item Name" autofocus class="form-control checkField">
                            <span class="help-block errMsg" id="itemNameEditErr"></span>
                        </div>
                        
                        <div class="col-sm-4 form-group-sm">
                            <label for="itemCode">Item Code</label>
                            <input type="text" id="itemCodeEdit" class="form-control">
                            <span class="help-block errMsg" id="itemCodeEditErr"></span>
                        </div>
                        
                        <div class="col-sm-4 form-group-sm">
                            <label for="unitPrice">Unit Price</label>
                            <input type="text" id="itemPriceEdit" name="itemPrice" placeholder="Unit Price" class="form-control checkField">
                            <span class="help-block errMsg" id="itemPriceEditErr"></span>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-12 form-group-sm">
                            <label for="itemDescriptionEdit" class="">Description (Optional)</label>
                            <textarea class="form-control" id="itemDescriptionEdit" placeholder="Optional Item Description"></textarea>
                        </div>
                    </div>
                    <input type="hidden" id="itemIdEdit">
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" id="editItemSubmit">Save</button>
                <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<!--end of modal-->
<script src="http://localhost/Cliffs_Internation/public/js/items.js"></script>
ERROR - 2023-06-28 10:40:35 --> Severity: 8192 --> str_replace(): Passing null to parameter #3 ($subject) of type array|string is deprecated /var/www/html/Cliffs_Internation/system/core/Output.php 457
ERROR - 2023-06-28 10:41:01 --> Categories data: {"1":"Insecticides","2":"Herbicides","3":"Fungicides","4":"Nematodes Control","5":"Rodenticides","6":"Soil Amendments","7":"Growth Enhancers","8":"Plant Nutrition","9":"Disease Control","10":"Weed Control","12":"Synthetic fertilizers","13":"Soil conditioners"}
ERROR - 2023-06-28 10:41:01 --> View output: 
<div class="pwell hidden-print">   
    <div class="row">
        <div class="col-sm-12">
            <!-- sort and co row-->
            <div class="row">
                <div class="col-sm-12">
                    <div class="col-sm-2 form-inline form-group-sm">
                        <button class="btn btn-primary btn-sm" id='createItem'>Add New Item</button>
                    </div>

                    <div class="col-sm-3 form-inline form-group-sm">
                        <label for="itemsListPerPage">Show</label>
                        <select id="itemsListPerPage" class="form-control">
                            <option value="1">1</option>
                            <option value="5">5</option>
                            <option value="10" selected>10</option>
                            <option value="15">15</option>
                            <option value="20">20</option>
                            <option value="30">30</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                        <label>per page</label>
                    </div>

                    <div class="col-sm-4 form-group-sm form-inline">
                        <label for="itemsListSortBy">Sort by</label>
                        <select id="itemsListSortBy" class="form-control">
                            <option value="name-ASC">Item Name (A-Z)</option>
                            <option value="code-ASC">Item Code (Ascending)</option>
                            <option value="unitPrice-DESC">Unit Price (Highest first)</option>
                            <option value="quantity-DESC">Quantity (Highest first)</option>
                            <option value="name-DESC">Item Name (Z-A)</option>
                            <option value="code-DESC">Item Code (Descending)</option>
                            <option value="unitPrice-ASC">Unit Price (lowest first)</option>
                            <option value="quantity-ASC">Quantity (lowest first)</option>
                        </select>
                    </div>

                    <div class="col-sm-3 form-inline form-group-sm">
                        <label for='itemSearch'><i class="fa fa-search"></i></label>
                        <input type="search" id="itemSearch" class="form-control" placeholder="Search Items">
                    </div>
                </div>
            </div>
            <!-- end of sort and co div-->
        </div>
    </div>
    
    <hr>
    
    <!-- row of adding new item form and items list table-->
    <div class="row">
        <div class="col-sm-12">
            <!--Form to add/update an item-->
            <div class="col-sm-4 hidden" id='createNewItemDiv'>
                <div class="well">
                    <button class="btn btn-info btn-xs pull-left" id="useBarcodeScanner">Use Scanner</button>
                    <button class="close cancelAddItem">&times;</button><br>
                    <form name="addNewItemForm" id="addNewItemForm" role="form">
                        <div class="text-center errMsg" id='addCustErrMsg'></div>
                        
                        <br>
                        
                        <div class="row">
                            <div class="col-sm-12 form-group-sm">
                                <label for="itemCode">Item Code</label>
                                <input type="text" id="itemCode" name="itemCode" placeholder="Item Code" maxlength="80"
                                    class="form-control" onchange="checkField(this.value, 'itemCodeErr')" autofocus>
                                <!--<span class="help-block"><input type="checkbox" id="gen4me"> auto-generate</span>-->
                                <span class="help-block errMsg" id="itemCodeErr"></span>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-12 form-group-sm">
                                <label for="itemName">Item Name</label>
                                <input type="text" id="itemName" name="itemName" placeholder="Item Name" maxlength="80"
                                    class="form-control" onchange="checkField(this.value, 'itemNameErr')">
                                <span class="help-block errMsg" id="itemNameErr"></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 form-group-sm">
                                <label for="categorie">Category</label>
                                <select id="categorie" name="categorie" class="form-control">
                                                                            <option value="1">Insecticides</option>
                                                                            <option value="2">Herbicides</option>
                                                                            <option value="3">Fungicides</option>
                                                                            <option value="4">Nematodes Control</option>
                                                                            <option value="5">Rodenticides</option>
                                                                            <option value="6">Soil Amendments</option>
                                                                            <option value="7">Growth Enhancers</option>
                                                                            <option value="8">Plant Nutrition</option>
                                                                            <option value="9">Disease Control</option>
                                                                            <option value="10">Weed Control</option>
                                                                            <option value="12">Synthetic fertilizers</option>
                                                                            <option value="13">Soil conditioners</option>
                                                                    </select>
                                <span class="help-block errMsg" id="categorieErr"></span>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-sm-12 form-group-sm">
                                <label for="itemQuantity">Quantity</label>
                                <input type="number" id="itemQuantity" name="itemQuantity" placeholder="Available Quantity"
                                    class="form-control" min="0" onchange="checkField(this.value, 'itemQuantityErr')">
                                <span class="help-block errMsg" id="itemQuantityErr"></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 form-group-sm">
                                <label for="unitPrice">($)Unit Price</label>
                                <input type="text" id="itemPrice" name="itemPrice" placeholder="($)Unit Price" class="form-control"
                                    onchange="checkField(this.value, 'itemPriceErr')">
                                <span class="help-block errMsg" id="itemPriceErr"></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 form-group-sm">
                                <label for="itemDescription" class="">Description (Optional)</label>
                                <textarea class="form-control" id="itemDescription" name="itemDescription" rows='4'
                                    placeholder="Optional Item Description"></textarea>
                            </div>
                        </div>
                        <br>
                        <div class="row text-center">
                            <div class="col-sm-6 form-group-sm">
                                <button class="btn btn-primary btn-sm" id="addNewItem">Add Item</button>
                            </div>

                            <div class="col-sm-6 form-group-sm">
                                <button type="reset" id="cancelAddItem" class="btn btn-danger btn-sm cancelAddItem" form='addNewItemForm'>Cancel</button>
                            </div>
                        </div>
                    </form><!-- end of form-->
                </div>
            </div>
            
            <!--- Item list div-->
            <div class="col-sm-12" id="itemsListDiv">
                <!-- Item list Table-->
                <div class="row">
                    <div class="col-sm-12" id="itemsListTable"></div>
                </div>
                <!--end of table-->
            </div>
            <!--- End of item list div-->

        </div>
    </div>
    <!-- End of row of adding new item form and items list table-->
</div>

<!--modal to update stock-->
<div id="updateStockModal" class="modal fade" role="dialog" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal">&times;</button>
                <h4 class="text-center">Update Stock</h4>
                <div id="stockUpdateFMsg" class="text-center"></div>
            </div>
            <div class="modal-body">
                <form name="updateStockForm" id="updateStockForm" role="form">
                    <div class="row">
                        <div class="col-sm-4 form-group-sm">
                            <label>Item Name</label>
                            <input type="text" readonly id="stockUpdateItemName" class="form-control">
                        </div>
                        
                        <div class="col-sm-4 form-group-sm">
                            <label>Item Code</label>
                            <input type="text" readonly id="stockUpdateItemCode" class="form-control">
                        </div>
                        
                        <div class="col-sm-4 form-group-sm">
                            <label>Quantity in Stock</label>
                            <input type="text" readonly id="stockUpdateItemQInStock" class="form-control">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-6 form-group-sm">
                            <label for="stockUpdateType">Update Type</label>
                            <select id="stockUpdateType" class="form-control checkField">
                                <option value="">---</option>
                                <option value="newStock">New Stock</option>
                                <option value="deficit">Deficit</option>
                            </select>
                            <span class="help-block errMsg" id="stockUpdateTypeErr"></span>
                        </div>
                        
                        <div class="col-sm-6 form-group-sm">
                            <label for="stockUpdateQuantity">Quantity</label>
                            <input type="number" id="stockUpdateQuantity" placeholder="Update Quantity"
                                class="form-control checkField" min="0">
                            <span class="help-block errMsg" id="stockUpdateQuantityErr"></span>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-12 form-group-sm">
                            <label for="stockUpdateDescription" class="">Description</label>
                            <textarea class="form-control checkField" id="stockUpdateDescription" placeholder="Update Description"></textarea>
                            <span class="help-block errMsg" id="stockUpdateDescriptionErr"></span>
                        </div>
                    </div>
                    
                    <input type="hidden" id="stockUpdateItemId">
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" id="stockUpdateSubmit">Update</button>
                <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<!--end of modal-->



<!--modal to edit item-->
<div id="editItemModal" class="modal fade" role="dialog" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal">&times;</button>
                <h4 class="text-center">Edit Item</h4>
                <div id="editItemFMsg" class="text-center"></div>
            </div>
            <div class="modal-body">
                <form role="form">
                    <div class="row">
                        <div class="col-sm-4 form-group-sm">
                            <label for="itemNameEdit">Item Name</label>
                            <input type="text" id="itemNameEdit" placeholder="Item Name" autofocus class="form-control checkField">
                            <span class="help-block errMsg" id="itemNameEditErr"></span>
                        </div>
                        
                        <div class="col-sm-4 form-group-sm">
                            <label for="itemCode">Item Code</label>
                            <input type="text" id="itemCodeEdit" class="form-control">
                            <span class="help-block errMsg" id="itemCodeEditErr"></span>
                        </div>
                        
                        <div class="col-sm-4 form-group-sm">
                            <label for="unitPrice">Unit Price</label>
                            <input type="text" id="itemPriceEdit" name="itemPrice" placeholder="Unit Price" class="form-control checkField">
                            <span class="help-block errMsg" id="itemPriceEditErr"></span>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-12 form-group-sm">
                            <label for="itemDescriptionEdit" class="">Description (Optional)</label>
                            <textarea class="form-control" id="itemDescriptionEdit" placeholder="Optional Item Description"></textarea>
                        </div>
                    </div>
                    <input type="hidden" id="itemIdEdit">
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" id="editItemSubmit">Save</button>
                <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<!--end of modal-->
<script src="http://localhost/Cliffs_Internation/public/js/items.js"></script>
ERROR - 2023-06-28 10:41:01 --> Severity: 8192 --> str_replace(): Passing null to parameter #3 ($subject) of type array|string is deprecated /var/www/html/Cliffs_Internation/system/core/Output.php 457
ERROR - 2023-06-28 10:41:03 --> Categories data: {"1":"Insecticides","2":"Herbicides","3":"Fungicides","4":"Nematodes Control","5":"Rodenticides","6":"Soil Amendments","7":"Growth Enhancers","8":"Plant Nutrition","9":"Disease Control","10":"Weed Control","12":"Synthetic fertilizers","13":"Soil conditioners"}
ERROR - 2023-06-28 10:41:03 --> View output: 
<div class="pwell hidden-print">   
    <div class="row">
        <div class="col-sm-12">
            <!-- sort and co row-->
            <div class="row">
                <div class="col-sm-12">
                    <div class="col-sm-2 form-inline form-group-sm">
                        <button class="btn btn-primary btn-sm" id='createItem'>Add New Item</button>
                    </div>

                    <div class="col-sm-3 form-inline form-group-sm">
                        <label for="itemsListPerPage">Show</label>
                        <select id="itemsListPerPage" class="form-control">
                            <option value="1">1</option>
                            <option value="5">5</option>
                            <option value="10" selected>10</option>
                            <option value="15">15</option>
                            <option value="20">20</option>
                            <option value="30">30</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                        <label>per page</label>
                    </div>

                    <div class="col-sm-4 form-group-sm form-inline">
                        <label for="itemsListSortBy">Sort by</label>
                        <select id="itemsListSortBy" class="form-control">
                            <option value="name-ASC">Item Name (A-Z)</option>
                            <option value="code-ASC">Item Code (Ascending)</option>
                            <option value="unitPrice-DESC">Unit Price (Highest first)</option>
                            <option value="quantity-DESC">Quantity (Highest first)</option>
                            <option value="name-DESC">Item Name (Z-A)</option>
                            <option value="code-DESC">Item Code (Descending)</option>
                            <option value="unitPrice-ASC">Unit Price (lowest first)</option>
                            <option value="quantity-ASC">Quantity (lowest first)</option>
                        </select>
                    </div>

                    <div class="col-sm-3 form-inline form-group-sm">
                        <label for='itemSearch'><i class="fa fa-search"></i></label>
                        <input type="search" id="itemSearch" class="form-control" placeholder="Search Items">
                    </div>
                </div>
            </div>
            <!-- end of sort and co div-->
        </div>
    </div>
    
    <hr>
    
    <!-- row of adding new item form and items list table-->
    <div class="row">
        <div class="col-sm-12">
            <!--Form to add/update an item-->
            <div class="col-sm-4 hidden" id='createNewItemDiv'>
                <div class="well">
                    <button class="btn btn-info btn-xs pull-left" id="useBarcodeScanner">Use Scanner</button>
                    <button class="close cancelAddItem">&times;</button><br>
                    <form name="addNewItemForm" id="addNewItemForm" role="form">
                        <div class="text-center errMsg" id='addCustErrMsg'></div>
                        
                        <br>
                        
                        <div class="row">
                            <div class="col-sm-12 form-group-sm">
                                <label for="itemCode">Item Code</label>
                                <input type="text" id="itemCode" name="itemCode" placeholder="Item Code" maxlength="80"
                                    class="form-control" onchange="checkField(this.value, 'itemCodeErr')" autofocus>
                                <!--<span class="help-block"><input type="checkbox" id="gen4me"> auto-generate</span>-->
                                <span class="help-block errMsg" id="itemCodeErr"></span>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-12 form-group-sm">
                                <label for="itemName">Item Name</label>
                                <input type="text" id="itemName" name="itemName" placeholder="Item Name" maxlength="80"
                                    class="form-control" onchange="checkField(this.value, 'itemNameErr')">
                                <span class="help-block errMsg" id="itemNameErr"></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 form-group-sm">
                                <label for="categorie">Category</label>
                                <select id="categorie" name="categorie" class="form-control">
                                                                            <option value="1">Insecticides</option>
                                                                            <option value="2">Herbicides</option>
                                                                            <option value="3">Fungicides</option>
                                                                            <option value="4">Nematodes Control</option>
                                                                            <option value="5">Rodenticides</option>
                                                                            <option value="6">Soil Amendments</option>
                                                                            <option value="7">Growth Enhancers</option>
                                                                            <option value="8">Plant Nutrition</option>
                                                                            <option value="9">Disease Control</option>
                                                                            <option value="10">Weed Control</option>
                                                                            <option value="12">Synthetic fertilizers</option>
                                                                            <option value="13">Soil conditioners</option>
                                                                    </select>
                                <span class="help-block errMsg" id="categorieErr"></span>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-sm-12 form-group-sm">
                                <label for="itemQuantity">Quantity</label>
                                <input type="number" id="itemQuantity" name="itemQuantity" placeholder="Available Quantity"
                                    class="form-control" min="0" onchange="checkField(this.value, 'itemQuantityErr')">
                                <span class="help-block errMsg" id="itemQuantityErr"></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 form-group-sm">
                                <label for="unitPrice">($)Unit Price</label>
                                <input type="text" id="itemPrice" name="itemPrice" placeholder="($)Unit Price" class="form-control"
                                    onchange="checkField(this.value, 'itemPriceErr')">
                                <span class="help-block errMsg" id="itemPriceErr"></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 form-group-sm">
                                <label for="itemDescription" class="">Description (Optional)</label>
                                <textarea class="form-control" id="itemDescription" name="itemDescription" rows='4'
                                    placeholder="Optional Item Description"></textarea>
                            </div>
                        </div>
                        <br>
                        <div class="row text-center">
                            <div class="col-sm-6 form-group-sm">
                                <button class="btn btn-primary btn-sm" id="addNewItem">Add Item</button>
                            </div>

                            <div class="col-sm-6 form-group-sm">
                                <button type="reset" id="cancelAddItem" class="btn btn-danger btn-sm cancelAddItem" form='addNewItemForm'>Cancel</button>
                            </div>
                        </div>
                    </form><!-- end of form-->
                </div>
            </div>
            
            <!--- Item list div-->
            <div class="col-sm-12" id="itemsListDiv">
                <!-- Item list Table-->
                <div class="row">
                    <div class="col-sm-12" id="itemsListTable"></div>
                </div>
                <!--end of table-->
            </div>
            <!--- End of item list div-->

        </div>
    </div>
    <!-- End of row of adding new item form and items list table-->
</div>

<!--modal to update stock-->
<div id="updateStockModal" class="modal fade" role="dialog" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal">&times;</button>
                <h4 class="text-center">Update Stock</h4>
                <div id="stockUpdateFMsg" class="text-center"></div>
            </div>
            <div class="modal-body">
                <form name="updateStockForm" id="updateStockForm" role="form">
                    <div class="row">
                        <div class="col-sm-4 form-group-sm">
                            <label>Item Name</label>
                            <input type="text" readonly id="stockUpdateItemName" class="form-control">
                        </div>
                        
                        <div class="col-sm-4 form-group-sm">
                            <label>Item Code</label>
                            <input type="text" readonly id="stockUpdateItemCode" class="form-control">
                        </div>
                        
                        <div class="col-sm-4 form-group-sm">
                            <label>Quantity in Stock</label>
                            <input type="text" readonly id="stockUpdateItemQInStock" class="form-control">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-6 form-group-sm">
                            <label for="stockUpdateType">Update Type</label>
                            <select id="stockUpdateType" class="form-control checkField">
                                <option value="">---</option>
                                <option value="newStock">New Stock</option>
                                <option value="deficit">Deficit</option>
                            </select>
                            <span class="help-block errMsg" id="stockUpdateTypeErr"></span>
                        </div>
                        
                        <div class="col-sm-6 form-group-sm">
                            <label for="stockUpdateQuantity">Quantity</label>
                            <input type="number" id="stockUpdateQuantity" placeholder="Update Quantity"
                                class="form-control checkField" min="0">
                            <span class="help-block errMsg" id="stockUpdateQuantityErr"></span>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-12 form-group-sm">
                            <label for="stockUpdateDescription" class="">Description</label>
                            <textarea class="form-control checkField" id="stockUpdateDescription" placeholder="Update Description"></textarea>
                            <span class="help-block errMsg" id="stockUpdateDescriptionErr"></span>
                        </div>
                    </div>
                    
                    <input type="hidden" id="stockUpdateItemId">
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" id="stockUpdateSubmit">Update</button>
                <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<!--end of modal-->



<!--modal to edit item-->
<div id="editItemModal" class="modal fade" role="dialog" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal">&times;</button>
                <h4 class="text-center">Edit Item</h4>
                <div id="editItemFMsg" class="text-center"></div>
            </div>
            <div class="modal-body">
                <form role="form">
                    <div class="row">
                        <div class="col-sm-4 form-group-sm">
                            <label for="itemNameEdit">Item Name</label>
                            <input type="text" id="itemNameEdit" placeholder="Item Name" autofocus class="form-control checkField">
                            <span class="help-block errMsg" id="itemNameEditErr"></span>
                        </div>
                        
                        <div class="col-sm-4 form-group-sm">
                            <label for="itemCode">Item Code</label>
                            <input type="text" id="itemCodeEdit" class="form-control">
                            <span class="help-block errMsg" id="itemCodeEditErr"></span>
                        </div>
                        
                        <div class="col-sm-4 form-group-sm">
                            <label for="unitPrice">Unit Price</label>
                            <input type="text" id="itemPriceEdit" name="itemPrice" placeholder="Unit Price" class="form-control checkField">
                            <span class="help-block errMsg" id="itemPriceEditErr"></span>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-12 form-group-sm">
                            <label for="itemDescriptionEdit" class="">Description (Optional)</label>
                            <textarea class="form-control" id="itemDescriptionEdit" placeholder="Optional Item Description"></textarea>
                        </div>
                    </div>
                    <input type="hidden" id="itemIdEdit">
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" id="editItemSubmit">Save</button>
                <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<!--end of modal-->
<script src="http://localhost/Cliffs_Internation/public/js/items.js"></script>
ERROR - 2023-06-28 10:41:03 --> Severity: 8192 --> str_replace(): Passing null to parameter #3 ($subject) of type array|string is deprecated /var/www/html/Cliffs_Internation/system/core/Output.php 457
ERROR - 2023-06-28 10:41:12 --> Severity: Warning --> Undefined variable $categories /var/www/html/Cliffs_Internation/application/views/items/items.php 91
ERROR - 2023-06-28 10:41:12 --> Severity: Warning --> foreach() argument must be of type array|object, null given /var/www/html/Cliffs_Internation/application/views/items/items.php 91
ERROR - 2023-06-28 10:41:14 --> Categories data: {"1":"Insecticides","2":"Herbicides","3":"Fungicides","4":"Nematodes Control","5":"Rodenticides","6":"Soil Amendments","7":"Growth Enhancers","8":"Plant Nutrition","9":"Disease Control","10":"Weed Control","12":"Synthetic fertilizers","13":"Soil conditioners"}
ERROR - 2023-06-28 10:41:14 --> View output: 
<div class="pwell hidden-print">   
    <div class="row">
        <div class="col-sm-12">
            <!-- sort and co row-->
            <div class="row">
                <div class="col-sm-12">
                    <div class="col-sm-2 form-inline form-group-sm">
                        <button class="btn btn-primary btn-sm" id='createItem'>Add New Item</button>
                    </div>

                    <div class="col-sm-3 form-inline form-group-sm">
                        <label for="itemsListPerPage">Show</label>
                        <select id="itemsListPerPage" class="form-control">
                            <option value="1">1</option>
                            <option value="5">5</option>
                            <option value="10" selected>10</option>
                            <option value="15">15</option>
                            <option value="20">20</option>
                            <option value="30">30</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                        <label>per page</label>
                    </div>

                    <div class="col-sm-4 form-group-sm form-inline">
                        <label for="itemsListSortBy">Sort by</label>
                        <select id="itemsListSortBy" class="form-control">
                            <option value="name-ASC">Item Name (A-Z)</option>
                            <option value="code-ASC">Item Code (Ascending)</option>
                            <option value="unitPrice-DESC">Unit Price (Highest first)</option>
                            <option value="quantity-DESC">Quantity (Highest first)</option>
                            <option value="name-DESC">Item Name (Z-A)</option>
                            <option value="code-DESC">Item Code (Descending)</option>
                            <option value="unitPrice-ASC">Unit Price (lowest first)</option>
                            <option value="quantity-ASC">Quantity (lowest first)</option>
                        </select>
                    </div>

                    <div class="col-sm-3 form-inline form-group-sm">
                        <label for='itemSearch'><i class="fa fa-search"></i></label>
                        <input type="search" id="itemSearch" class="form-control" placeholder="Search Items">
                    </div>
                </div>
            </div>
            <!-- end of sort and co div-->
        </div>
    </div>
    
    <hr>
    
    <!-- row of adding new item form and items list table-->
    <div class="row">
        <div class="col-sm-12">
            <!--Form to add/update an item-->
            <div class="col-sm-4 hidden" id='createNewItemDiv'>
                <div class="well">
                    <button class="btn btn-info btn-xs pull-left" id="useBarcodeScanner">Use Scanner</button>
                    <button class="close cancelAddItem">&times;</button><br>
                    <form name="addNewItemForm" id="addNewItemForm" role="form">
                        <div class="text-center errMsg" id='addCustErrMsg'></div>
                        
                        <br>
                        
                        <div class="row">
                            <div class="col-sm-12 form-group-sm">
                                <label for="itemCode">Item Code</label>
                                <input type="text" id="itemCode" name="itemCode" placeholder="Item Code" maxlength="80"
                                    class="form-control" onchange="checkField(this.value, 'itemCodeErr')" autofocus>
                                <!--<span class="help-block"><input type="checkbox" id="gen4me"> auto-generate</span>-->
                                <span class="help-block errMsg" id="itemCodeErr"></span>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-12 form-group-sm">
                                <label for="itemName">Item Name</label>
                                <input type="text" id="itemName" name="itemName" placeholder="Item Name" maxlength="80"
                                    class="form-control" onchange="checkField(this.value, 'itemNameErr')">
                                <span class="help-block errMsg" id="itemNameErr"></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 form-group-sm">
                                <label for="categorie">Category</label>
                                <select id="categorie" name="categorie" class="form-control">
                                                                            <option value="1">Insecticides</option>
                                                                            <option value="2">Herbicides</option>
                                                                            <option value="3">Fungicides</option>
                                                                            <option value="4">Nematodes Control</option>
                                                                            <option value="5">Rodenticides</option>
                                                                            <option value="6">Soil Amendments</option>
                                                                            <option value="7">Growth Enhancers</option>
                                                                            <option value="8">Plant Nutrition</option>
                                                                            <option value="9">Disease Control</option>
                                                                            <option value="10">Weed Control</option>
                                                                            <option value="12">Synthetic fertilizers</option>
                                                                            <option value="13">Soil conditioners</option>
                                                                    </select>
                                <span class="help-block errMsg" id="categorieErr"></span>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-sm-12 form-group-sm">
                                <label for="itemQuantity">Quantity</label>
                                <input type="number" id="itemQuantity" name="itemQuantity" placeholder="Available Quantity"
                                    class="form-control" min="0" onchange="checkField(this.value, 'itemQuantityErr')">
                                <span class="help-block errMsg" id="itemQuantityErr"></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 form-group-sm">
                                <label for="unitPrice">($)Unit Price</label>
                                <input type="text" id="itemPrice" name="itemPrice" placeholder="($)Unit Price" class="form-control"
                                    onchange="checkField(this.value, 'itemPriceErr')">
                                <span class="help-block errMsg" id="itemPriceErr"></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 form-group-sm">
                                <label for="itemDescription" class="">Description (Optional)</label>
                                <textarea class="form-control" id="itemDescription" name="itemDescription" rows='4'
                                    placeholder="Optional Item Description"></textarea>
                            </div>
                        </div>
                        <br>
                        <div class="row text-center">
                            <div class="col-sm-6 form-group-sm">
                                <button class="btn btn-primary btn-sm" id="addNewItem">Add Item</button>
                            </div>

                            <div class="col-sm-6 form-group-sm">
                                <button type="reset" id="cancelAddItem" class="btn btn-danger btn-sm cancelAddItem" form='addNewItemForm'>Cancel</button>
                            </div>
                        </div>
                    </form><!-- end of form-->
                </div>
            </div>
            
            <!--- Item list div-->
            <div class="col-sm-12" id="itemsListDiv">
                <!-- Item list Table-->
                <div class="row">
                    <div class="col-sm-12" id="itemsListTable"></div>
                </div>
                <!--end of table-->
            </div>
            <!--- End of item list div-->

        </div>
    </div>
    <!-- End of row of adding new item form and items list table-->
</div>

<!--modal to update stock-->
<div id="updateStockModal" class="modal fade" role="dialog" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal">&times;</button>
                <h4 class="text-center">Update Stock</h4>
                <div id="stockUpdateFMsg" class="text-center"></div>
            </div>
            <div class="modal-body">
                <form name="updateStockForm" id="updateStockForm" role="form">
                    <div class="row">
                        <div class="col-sm-4 form-group-sm">
                            <label>Item Name</label>
                            <input type="text" readonly id="stockUpdateItemName" class="form-control">
                        </div>
                        
                        <div class="col-sm-4 form-group-sm">
                            <label>Item Code</label>
                            <input type="text" readonly id="stockUpdateItemCode" class="form-control">
                        </div>
                        
                        <div class="col-sm-4 form-group-sm">
                            <label>Quantity in Stock</label>
                            <input type="text" readonly id="stockUpdateItemQInStock" class="form-control">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-6 form-group-sm">
                            <label for="stockUpdateType">Update Type</label>
                            <select id="stockUpdateType" class="form-control checkField">
                                <option value="">---</option>
                                <option value="newStock">New Stock</option>
                                <option value="deficit">Deficit</option>
                            </select>
                            <span class="help-block errMsg" id="stockUpdateTypeErr"></span>
                        </div>
                        
                        <div class="col-sm-6 form-group-sm">
                            <label for="stockUpdateQuantity">Quantity</label>
                            <input type="number" id="stockUpdateQuantity" placeholder="Update Quantity"
                                class="form-control checkField" min="0">
                            <span class="help-block errMsg" id="stockUpdateQuantityErr"></span>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-12 form-group-sm">
                            <label for="stockUpdateDescription" class="">Description</label>
                            <textarea class="form-control checkField" id="stockUpdateDescription" placeholder="Update Description"></textarea>
                            <span class="help-block errMsg" id="stockUpdateDescriptionErr"></span>
                        </div>
                    </div>
                    
                    <input type="hidden" id="stockUpdateItemId">
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" id="stockUpdateSubmit">Update</button>
                <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<!--end of modal-->



<!--modal to edit item-->
<div id="editItemModal" class="modal fade" role="dialog" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal">&times;</button>
                <h4 class="text-center">Edit Item</h4>
                <div id="editItemFMsg" class="text-center"></div>
            </div>
            <div class="modal-body">
                <form role="form">
                    <div class="row">
                        <div class="col-sm-4 form-group-sm">
                            <label for="itemNameEdit">Item Name</label>
                            <input type="text" id="itemNameEdit" placeholder="Item Name" autofocus class="form-control checkField">
                            <span class="help-block errMsg" id="itemNameEditErr"></span>
                        </div>
                        
                        <div class="col-sm-4 form-group-sm">
                            <label for="itemCode">Item Code</label>
                            <input type="text" id="itemCodeEdit" class="form-control">
                            <span class="help-block errMsg" id="itemCodeEditErr"></span>
                        </div>
                        
                        <div class="col-sm-4 form-group-sm">
                            <label for="unitPrice">Unit Price</label>
                            <input type="text" id="itemPriceEdit" name="itemPrice" placeholder="Unit Price" class="form-control checkField">
                            <span class="help-block errMsg" id="itemPriceEditErr"></span>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-12 form-group-sm">
                            <label for="itemDescriptionEdit" class="">Description (Optional)</label>
                            <textarea class="form-control" id="itemDescriptionEdit" placeholder="Optional Item Description"></textarea>
                        </div>
                    </div>
                    <input type="hidden" id="itemIdEdit">
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" id="editItemSubmit">Save</button>
                <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<!--end of modal-->
<script src="http://localhost/Cliffs_Internation/public/js/items.js"></script>
ERROR - 2023-06-28 10:41:14 --> Severity: 8192 --> str_replace(): Passing null to parameter #3 ($subject) of type array|string is deprecated /var/www/html/Cliffs_Internation/system/core/Output.php 457
ERROR - 2023-06-28 10:43:51 --> Categories data: {"1":"Insecticides","2":"Herbicides","3":"Fungicides","4":"Nematodes Control","5":"Rodenticides","6":"Soil Amendments","7":"Growth Enhancers","8":"Plant Nutrition","9":"Disease Control","10":"Weed Control","12":"Synthetic fertilizers","13":"Soil conditioners"}
ERROR - 2023-06-28 10:43:51 --> View output: 
<div class="pwell hidden-print">   
    <div class="row">
        <div class="col-sm-12">
            <!-- sort and co row-->
            <div class="row">
                <div class="col-sm-12">
                    <div class="col-sm-2 form-inline form-group-sm">
                        <button class="btn btn-primary btn-sm" id='createItem'>Add New Item</button>
                    </div>

                    <div class="col-sm-3 form-inline form-group-sm">
                        <label for="itemsListPerPage">Show</label>
                        <select id="itemsListPerPage" class="form-control">
                            <option value="1">1</option>
                            <option value="5">5</option>
                            <option value="10" selected>10</option>
                            <option value="15">15</option>
                            <option value="20">20</option>
                            <option value="30">30</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                        <label>per page</label>
                    </div>

                    <div class="col-sm-4 form-group-sm form-inline">
                        <label for="itemsListSortBy">Sort by</label>
                        <select id="itemsListSortBy" class="form-control">
                            <option value="name-ASC">Item Name (A-Z)</option>
                            <option value="code-ASC">Item Code (Ascending)</option>
                            <option value="unitPrice-DESC">Unit Price (Highest first)</option>
                            <option value="quantity-DESC">Quantity (Highest first)</option>
                            <option value="name-DESC">Item Name (Z-A)</option>
                            <option value="code-DESC">Item Code (Descending)</option>
                            <option value="unitPrice-ASC">Unit Price (lowest first)</option>
                            <option value="quantity-ASC">Quantity (lowest first)</option>
                        </select>
                    </div>

                    <div class="col-sm-3 form-inline form-group-sm">
                        <label for='itemSearch'><i class="fa fa-search"></i></label>
                        <input type="search" id="itemSearch" class="form-control" placeholder="Search Items">
                    </div>
                </div>
            </div>
            <!-- end of sort and co div-->
        </div>
    </div>
    
    <hr>
    
    <!-- row of adding new item form and items list table-->
    <div class="row">
        <div class="col-sm-12">
            <!--Form to add/update an item-->
            <div class="col-sm-4 hidden" id='createNewItemDiv'>
                <div class="well">
                    <button class="btn btn-info btn-xs pull-left" id="useBarcodeScanner">Use Scanner</button>
                    <button class="close cancelAddItem">&times;</button><br>
                    <form name="addNewItemForm" id="addNewItemForm" role="form">
                        <div class="text-center errMsg" id='addCustErrMsg'></div>
                        
                        <br>
                        
                        <div class="row">
                            <div class="col-sm-12 form-group-sm">
                                <label for="itemCode">Item Code</label>
                                <input type="text" id="itemCode" name="itemCode" placeholder="Item Code" maxlength="80"
                                    class="form-control" onchange="checkField(this.value, 'itemCodeErr')" autofocus>
                                <!--<span class="help-block"><input type="checkbox" id="gen4me"> auto-generate</span>-->
                                <span class="help-block errMsg" id="itemCodeErr"></span>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-12 form-group-sm">
                                <label for="itemName">Item Name</label>
                                <input type="text" id="itemName" name="itemName" placeholder="Item Name" maxlength="80"
                                    class="form-control" onchange="checkField(this.value, 'itemNameErr')">
                                <span class="help-block errMsg" id="itemNameErr"></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 form-group-sm">
                                <label for="categorie">Category</label>
                                <select id="categorie" name="categorie" class="form-control">
                                                                            <option value="1">Insecticides</option>
                                                                            <option value="2">Herbicides</option>
                                                                            <option value="3">Fungicides</option>
                                                                            <option value="4">Nematodes Control</option>
                                                                            <option value="5">Rodenticides</option>
                                                                            <option value="6">Soil Amendments</option>
                                                                            <option value="7">Growth Enhancers</option>
                                                                            <option value="8">Plant Nutrition</option>
                                                                            <option value="9">Disease Control</option>
                                                                            <option value="10">Weed Control</option>
                                                                            <option value="12">Synthetic fertilizers</option>
                                                                            <option value="13">Soil conditioners</option>
                                                                    </select>
                                <span class="help-block errMsg" id="categorieErr"></span>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-sm-12 form-group-sm">
                                <label for="itemQuantity">Quantity</label>
                                <input type="number" id="itemQuantity" name="itemQuantity" placeholder="Available Quantity"
                                    class="form-control" min="0" onchange="checkField(this.value, 'itemQuantityErr')">
                                <span class="help-block errMsg" id="itemQuantityErr"></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 form-group-sm">
                                <label for="unitPrice">($)Unit Price</label>
                                <input type="text" id="itemPrice" name="itemPrice" placeholder="($)Unit Price" class="form-control"
                                    onchange="checkField(this.value, 'itemPriceErr')">
                                <span class="help-block errMsg" id="itemPriceErr"></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 form-group-sm">
                                <label for="itemDescription" class="">Description (Optional)</label>
                                <textarea class="form-control" id="itemDescription" name="itemDescription" rows='4'
                                    placeholder="Optional Item Description"></textarea>
                            </div>
                        </div>
                        <br>
                        <div class="row text-center">
                            <div class="col-sm-6 form-group-sm">
                                <button class="btn btn-primary btn-sm" id="addNewItem">Add Item</button>
                            </div>

                            <div class="col-sm-6 form-group-sm">
                                <button type="reset" id="cancelAddItem" class="btn btn-danger btn-sm cancelAddItem" form='addNewItemForm'>Cancel</button>
                            </div>
                        </div>
                    </form><!-- end of form-->
                </div>
            </div>
            
            <!--- Item list div-->
            <div class="col-sm-12" id="itemsListDiv">
                <!-- Item list Table-->
                <div class="row">
                    <div class="col-sm-12" id="itemsListTable"></div>
                </div>
                <!--end of table-->
            </div>
            <!--- End of item list div-->

        </div>
    </div>
    <!-- End of row of adding new item form and items list table-->
</div>

<!--modal to update stock-->
<div id="updateStockModal" class="modal fade" role="dialog" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal">&times;</button>
                <h4 class="text-center">Update Stock</h4>
                <div id="stockUpdateFMsg" class="text-center"></div>
            </div>
            <div class="modal-body">
                <form name="updateStockForm" id="updateStockForm" role="form">
                    <div class="row">
                        <div class="col-sm-4 form-group-sm">
                            <label>Item Name</label>
                            <input type="text" readonly id="stockUpdateItemName" class="form-control">
                        </div>
                        
                        <div class="col-sm-4 form-group-sm">
                            <label>Item Code</label>
                            <input type="text" readonly id="stockUpdateItemCode" class="form-control">
                        </div>
                        
                        <div class="col-sm-4 form-group-sm">
                            <label>Quantity in Stock</label>
                            <input type="text" readonly id="stockUpdateItemQInStock" class="form-control">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-6 form-group-sm">
                            <label for="stockUpdateType">Update Type</label>
                            <select id="stockUpdateType" class="form-control checkField">
                                <option value="">---</option>
                                <option value="newStock">New Stock</option>
                                <option value="deficit">Deficit</option>
                            </select>
                            <span class="help-block errMsg" id="stockUpdateTypeErr"></span>
                        </div>
                        
                        <div class="col-sm-6 form-group-sm">
                            <label for="stockUpdateQuantity">Quantity</label>
                            <input type="number" id="stockUpdateQuantity" placeholder="Update Quantity"
                                class="form-control checkField" min="0">
                            <span class="help-block errMsg" id="stockUpdateQuantityErr"></span>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-12 form-group-sm">
                            <label for="stockUpdateDescription" class="">Description</label>
                            <textarea class="form-control checkField" id="stockUpdateDescription" placeholder="Update Description"></textarea>
                            <span class="help-block errMsg" id="stockUpdateDescriptionErr"></span>
                        </div>
                    </div>
                    
                    <input type="hidden" id="stockUpdateItemId">
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" id="stockUpdateSubmit">Update</button>
                <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<!--end of modal-->



<!--modal to edit item-->
<div id="editItemModal" class="modal fade" role="dialog" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal">&times;</button>
                <h4 class="text-center">Edit Item</h4>
                <div id="editItemFMsg" class="text-center"></div>
            </div>
            <div class="modal-body">
                <form role="form">
                    <div class="row">
                        <div class="col-sm-4 form-group-sm">
                            <label for="itemNameEdit">Item Name</label>
                            <input type="text" id="itemNameEdit" placeholder="Item Name" autofocus class="form-control checkField">
                            <span class="help-block errMsg" id="itemNameEditErr"></span>
                        </div>
                        
                        <div class="col-sm-4 form-group-sm">
                            <label for="itemCode">Item Code</label>
                            <input type="text" id="itemCodeEdit" class="form-control">
                            <span class="help-block errMsg" id="itemCodeEditErr"></span>
                        </div>
                        
                        <div class="col-sm-4 form-group-sm">
                            <label for="unitPrice">Unit Price</label>
                            <input type="text" id="itemPriceEdit" name="itemPrice" placeholder="Unit Price" class="form-control checkField">
                            <span class="help-block errMsg" id="itemPriceEditErr"></span>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-12 form-group-sm">
                            <label for="itemDescriptionEdit" class="">Description (Optional)</label>
                            <textarea class="form-control" id="itemDescriptionEdit" placeholder="Optional Item Description"></textarea>
                        </div>
                    </div>
                    <input type="hidden" id="itemIdEdit">
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" id="editItemSubmit">Save</button>
                <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<!--end of modal-->
<script src="http://localhost/Cliffs_Internation/public/js/items.js"></script>
ERROR - 2023-06-28 10:43:51 --> Severity: 8192 --> str_replace(): Passing null to parameter #3 ($subject) of type array|string is deprecated /var/www/html/Cliffs_Internation/system/core/Output.php 457
ERROR - 2023-06-28 10:47:46 --> Severity: Warning --> Undefined variable $allitems /var/www/html/Cliffs_Internation/application/views/items/items.php 91
ERROR - 2023-06-28 10:47:46 --> Severity: Warning --> foreach() argument must be of type array|object, null given /var/www/html/Cliffs_Internation/application/views/items/items.php 91
ERROR - 2023-06-28 10:47:48 --> Categories data: {"1":"Insecticides","2":"Herbicides","3":"Fungicides","4":"Nematodes Control","5":"Rodenticides","6":"Soil Amendments","7":"Growth Enhancers","8":"Plant Nutrition","9":"Disease Control","10":"Weed Control","12":"Synthetic fertilizers","13":"Soil conditioners"}
ERROR - 2023-06-28 10:47:48 --> Severity: Warning --> Undefined variable $allitems /var/www/html/Cliffs_Internation/application/views/items/items.php 91
ERROR - 2023-06-28 10:47:48 --> Severity: Warning --> foreach() argument must be of type array|object, null given /var/www/html/Cliffs_Internation/application/views/items/items.php 91
ERROR - 2023-06-28 10:47:48 --> View output: 
<div class="pwell hidden-print">   
    <div class="row">
        <div class="col-sm-12">
            <!-- sort and co row-->
            <div class="row">
                <div class="col-sm-12">
                    <div class="col-sm-2 form-inline form-group-sm">
                        <button class="btn btn-primary btn-sm" id='createItem'>Add New Item</button>
                    </div>

                    <div class="col-sm-3 form-inline form-group-sm">
                        <label for="itemsListPerPage">Show</label>
                        <select id="itemsListPerPage" class="form-control">
                            <option value="1">1</option>
                            <option value="5">5</option>
                            <option value="10" selected>10</option>
                            <option value="15">15</option>
                            <option value="20">20</option>
                            <option value="30">30</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                        <label>per page</label>
                    </div>

                    <div class="col-sm-4 form-group-sm form-inline">
                        <label for="itemsListSortBy">Sort by</label>
                        <select id="itemsListSortBy" class="form-control">
                            <option value="name-ASC">Item Name (A-Z)</option>
                            <option value="code-ASC">Item Code (Ascending)</option>
                            <option value="unitPrice-DESC">Unit Price (Highest first)</option>
                            <option value="quantity-DESC">Quantity (Highest first)</option>
                            <option value="name-DESC">Item Name (Z-A)</option>
                            <option value="code-DESC">Item Code (Descending)</option>
                            <option value="unitPrice-ASC">Unit Price (lowest first)</option>
                            <option value="quantity-ASC">Quantity (lowest first)</option>
                        </select>
                    </div>

                    <div class="col-sm-3 form-inline form-group-sm">
                        <label for='itemSearch'><i class="fa fa-search"></i></label>
                        <input type="search" id="itemSearch" class="form-control" placeholder="Search Items">
                    </div>
                </div>
            </div>
            <!-- end of sort and co div-->
        </div>
    </div>
    
    <hr>
    
    <!-- row of adding new item form and items list table-->
    <div class="row">
        <div class="col-sm-12">
            <!--Form to add/update an item-->
            <div class="col-sm-4 hidden" id='createNewItemDiv'>
                <div class="well">
                    <button class="btn btn-info btn-xs pull-left" id="useBarcodeScanner">Use Scanner</button>
                    <button class="close cancelAddItem">&times;</button><br>
                    <form name="addNewItemForm" id="addNewItemForm" role="form">
                        <div class="text-center errMsg" id='addCustErrMsg'></div>
                        
                        <br>
                        
                        <div class="row">
                            <div class="col-sm-12 form-group-sm">
                                <label for="itemCode">Item Code</label>
                                <input type="text" id="itemCode" name="itemCode" placeholder="Item Code" maxlength="80"
                                    class="form-control" onchange="checkField(this.value, 'itemCodeErr')" autofocus>
                                <!--<span class="help-block"><input type="checkbox" id="gen4me"> auto-generate</span>-->
                                <span class="help-block errMsg" id="itemCodeErr"></span>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-12 form-group-sm">
                                <label for="itemName">Item Name</label>
                                <input type="text" id="itemName" name="itemName" placeholder="Item Name" maxlength="80"
                                    class="form-control" onchange="checkField(this.value, 'itemNameErr')">
                                <span class="help-block errMsg" id="itemNameErr"></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 form-group-sm">
                                <label for="categorie">Category</label>
                                <select id="categorie" name="categorie" class="form-control">
                                    <br />
<b>Deprecated</b>:  Return type of CI_Session_files_driver::open($save_path, $name) should either be compatible with SessionHandlerInterface::open(string $path, string $name): bool, or the #[\ReturnTypeWillChange] attribute should be used to temporarily suppress the notice in <b>/var/www/html/Cliffs_Internation/system/libraries/Session/drivers/Session_files_driver.php</b> on line <b>132</b><br />

<div style="border:1px solid #990000;padding-left:20px;margin:0 0 10px 0;">

<h4>A PHP Error was encountered</h4>

<p>Severity: Warning</p>
<p>Message:  Undefined variable $allitems</p>
<p>Filename: items/items.php</p>
<p>Line Number: 91</p>


	<p>Backtrace:</p>
	
		
	
		
	
		
			<p style="margin-left:10px">
			File: /var/www/html/Cliffs_Internation/application/views/items/items.php<br />
			Line: 91<br />
			Function: _error_handler			</p>

		
	
		
	
		
	
		
			<p style="margin-left:10px">
			File: /var/www/html/Cliffs_Internation/application/controllers/Items.php<br />
			Line: 105<br />
			Function: view			</p>

		
	
		
	
		
			<p style="margin-left:10px">
			File: /var/www/html/Cliffs_Internation/index.php<br />
			Line: 315<br />
			Function: require_once			</p>

		
	

</div>
<div style="border:1px solid #990000;padding-left:20px;margin:0 0 10px 0;">

<h4>A PHP Error was encountered</h4>

<p>Severity: Warning</p>
<p>Message:  foreach() argument must be of type array|object, null given</p>
<p>Filename: items/items.php</p>
<p>Line Number: 91</p>


	<p>Backtrace:</p>
	
		
	
		
	
		
			<p style="margin-left:10px">
			File: /var/www/html/Cliffs_Internation/application/views/items/items.php<br />
			Line: 91<br />
			Function: _error_handler			</p>

		
	
		
	
		
	
		
			<p style="margin-left:10px">
			File: /var/www/html/Cliffs_Internation/application/controllers/Items.php<br />
			Line: 105<br />
			Function: view			</p>

		
	
		
	
		
			<p style="margin-left:10px">
			File: /var/www/html/Cliffs_Internation/index.php<br />
			Line: 315<br />
			Function: require_once			</p>

		
	

</div>                                </select>
                                <span class="help-block errMsg" id="categorieErr"></span>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-sm-12 form-group-sm">
                                <label for="itemQuantity">Quantity</label>
                                <input type="number" id="itemQuantity" name="itemQuantity" placeholder="Available Quantity"
                                    class="form-control" min="0" onchange="checkField(this.value, 'itemQuantityErr')">
                                <span class="help-block errMsg" id="itemQuantityErr"></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 form-group-sm">
                                <label for="unitPrice">($)Unit Price</label>
                                <input type="text" id="itemPrice" name="itemPrice" placeholder="($)Unit Price" class="form-control"
                                    onchange="checkField(this.value, 'itemPriceErr')">
                                <span class="help-block errMsg" id="itemPriceErr"></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 form-group-sm">
                                <label for="itemDescription" class="">Description (Optional)</label>
                                <textarea class="form-control" id="itemDescription" name="itemDescription" rows='4'
                                    placeholder="Optional Item Description"></textarea>
                            </div>
                        </div>
                        <br>
                        <div class="row text-center">
                            <div class="col-sm-6 form-group-sm">
                                <button class="btn btn-primary btn-sm" id="addNewItem">Add Item</button>
                            </div>

                            <div class="col-sm-6 form-group-sm">
                                <button type="reset" id="cancelAddItem" class="btn btn-danger btn-sm cancelAddItem" form='addNewItemForm'>Cancel</button>
                            </div>
                        </div>
                    </form><!-- end of form-->
                </div>
            </div>
            
            <!--- Item list div-->
            <div class="col-sm-12" id="itemsListDiv">
                <!-- Item list Table-->
                <div class="row">
                    <div class="col-sm-12" id="itemsListTable"></div>
                </div>
                <!--end of table-->
            </div>
            <!--- End of item list div-->

        </div>
    </div>
    <!-- End of row of adding new item form and items list table-->
</div>

<!--modal to update stock-->
<div id="updateStockModal" class="modal fade" role="dialog" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal">&times;</button>
                <h4 class="text-center">Update Stock</h4>
                <div id="stockUpdateFMsg" class="text-center"></div>
            </div>
            <div class="modal-body">
                <form name="updateStockForm" id="updateStockForm" role="form">
                    <div class="row">
                        <div class="col-sm-4 form-group-sm">
                            <label>Item Name</label>
                            <input type="text" readonly id="stockUpdateItemName" class="form-control">
                        </div>
                        
                        <div class="col-sm-4 form-group-sm">
                            <label>Item Code</label>
                            <input type="text" readonly id="stockUpdateItemCode" class="form-control">
                        </div>
                        
                        <div class="col-sm-4 form-group-sm">
                            <label>Quantity in Stock</label>
                            <input type="text" readonly id="stockUpdateItemQInStock" class="form-control">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-6 form-group-sm">
                            <label for="stockUpdateType">Update Type</label>
                            <select id="stockUpdateType" class="form-control checkField">
                                <option value="">---</option>
                                <option value="newStock">New Stock</option>
                                <option value="deficit">Deficit</option>
                            </select>
                            <span class="help-block errMsg" id="stockUpdateTypeErr"></span>
                        </div>
                        
                        <div class="col-sm-6 form-group-sm">
                            <label for="stockUpdateQuantity">Quantity</label>
                            <input type="number" id="stockUpdateQuantity" placeholder="Update Quantity"
                                class="form-control checkField" min="0">
                            <span class="help-block errMsg" id="stockUpdateQuantityErr"></span>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-12 form-group-sm">
                            <label for="stockUpdateDescription" class="">Description</label>
                            <textarea class="form-control checkField" id="stockUpdateDescription" placeholder="Update Description"></textarea>
                            <span class="help-block errMsg" id="stockUpdateDescriptionErr"></span>
                        </div>
                    </div>
                    
                    <input type="hidden" id="stockUpdateItemId">
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" id="stockUpdateSubmit">Update</button>
                <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<!--end of modal-->



<!--modal to edit item-->
<div id="editItemModal" class="modal fade" role="dialog" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal">&times;</button>
                <h4 class="text-center">Edit Item</h4>
                <div id="editItemFMsg" class="text-center"></div>
            </div>
            <div class="modal-body">
                <form role="form">
                    <div class="row">
                        <div class="col-sm-4 form-group-sm">
                            <label for="itemNameEdit">Item Name</label>
                            <input type="text" id="itemNameEdit" placeholder="Item Name" autofocus class="form-control checkField">
                            <span class="help-block errMsg" id="itemNameEditErr"></span>
                        </div>
                        
                        <div class="col-sm-4 form-group-sm">
                            <label for="itemCode">Item Code</label>
                            <input type="text" id="itemCodeEdit" class="form-control">
                            <span class="help-block errMsg" id="itemCodeEditErr"></span>
                        </div>
                        
                        <div class="col-sm-4 form-group-sm">
                            <label for="unitPrice">Unit Price</label>
                            <input type="text" id="itemPriceEdit" name="itemPrice" placeholder="Unit Price" class="form-control checkField">
                            <span class="help-block errMsg" id="itemPriceEditErr"></span>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-12 form-group-sm">
                            <label for="itemDescriptionEdit" class="">Description (Optional)</label>
                            <textarea class="form-control" id="itemDescriptionEdit" placeholder="Optional Item Description"></textarea>
                        </div>
                    </div>
                    <input type="hidden" id="itemIdEdit">
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" id="editItemSubmit">Save</button>
                <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<!--end of modal-->
<script src="http://localhost/Cliffs_Internation/public/js/items.js"></script>
ERROR - 2023-06-28 10:47:48 --> Severity: 8192 --> str_replace(): Passing null to parameter #3 ($subject) of type array|string is deprecated /var/www/html/Cliffs_Internation/system/core/Output.php 457
ERROR - 2023-06-28 10:51:20 --> Severity: Warning --> Undefined variable $allitems /var/www/html/Cliffs_Internation/application/views/items/items.php 91
ERROR - 2023-06-28 10:51:20 --> Severity: Warning --> foreach() argument must be of type array|object, null given /var/www/html/Cliffs_Internation/application/views/items/items.php 91
ERROR - 2023-06-28 10:51:20 --> View output: 
ERROR - 2023-06-28 10:51:52 --> Severity: Warning --> Undefined variable $categories /var/www/html/Cliffs_Internation/application/views/items/items.php 91
ERROR - 2023-06-28 10:51:52 --> Severity: Warning --> foreach() argument must be of type array|object, null given /var/www/html/Cliffs_Internation/application/views/items/items.php 91
ERROR - 2023-06-28 10:51:52 --> View output: 
ERROR - 2023-06-28 10:52:05 --> Categories data: {"1":"Insecticides","2":"Herbicides","3":"Fungicides","4":"Nematodes Control","5":"Rodenticides","6":"Soil Amendments","7":"Growth Enhancers","8":"Plant Nutrition","9":"Disease Control","10":"Weed Control","12":"Synthetic fertilizers","13":"Soil conditioners"}
ERROR - 2023-06-28 11:02:34 --> Severity: 8192 --> Return type of CI_Session_files_driver::open($save_path, $name) should either be compatible with SessionHandlerInterface::open(string $path, string $name): bool, or the #[\ReturnTypeWillChange] attribute should be used to temporarily suppress the notice /var/www/html/Cliffs_Internation/system/libraries/Session/drivers/Session_files_driver.php 132
ERROR - 2023-06-28 11:02:34 --> Severity: 8192 --> Return type of CI_Session_files_driver::close() should either be compatible with SessionHandlerInterface::close(): bool, or the #[\ReturnTypeWillChange] attribute should be used to temporarily suppress the notice /var/www/html/Cliffs_Internation/system/libraries/Session/drivers/Session_files_driver.php 290
ERROR - 2023-06-28 11:02:34 --> Severity: 8192 --> Return type of CI_Session_files_driver::read($session_id) should either be compatible with SessionHandlerInterface::read(string $id): string|false, or the #[\ReturnTypeWillChange] attribute should be used to temporarily suppress the notice /var/www/html/Cliffs_Internation/system/libraries/Session/drivers/Session_files_driver.php 164
ERROR - 2023-06-28 11:02:34 --> Severity: 8192 --> Return type of CI_Session_files_driver::write($session_id, $session_data) should either be compatible with SessionHandlerInterface::write(string $id, string $data): bool, or the #[\ReturnTypeWillChange] attribute should be used to temporarily suppress the notice /var/www/html/Cliffs_Internation/system/libraries/Session/drivers/Session_files_driver.php 233
ERROR - 2023-06-28 11:02:34 --> Severity: 8192 --> Return type of CI_Session_files_driver::destroy($session_id) should either be compatible with SessionHandlerInterface::destroy(string $id): bool, or the #[\ReturnTypeWillChange] attribute should be used to temporarily suppress the notice /var/www/html/Cliffs_Internation/system/libraries/Session/drivers/Session_files_driver.php 313
ERROR - 2023-06-28 11:02:34 --> Severity: 8192 --> Return type of CI_Session_files_driver::gc($maxlifetime) should either be compatible with SessionHandlerInterface::gc(int $max_lifetime): int|false, or the #[\ReturnTypeWillChange] attribute should be used to temporarily suppress the notice /var/www/html/Cliffs_Internation/system/libraries/Session/drivers/Session_files_driver.php 354
ERROR - 2023-06-28 11:02:34 --> Severity: Warning --> ini_set(): Session ini settings cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 284
ERROR - 2023-06-28 11:02:34 --> Severity: Warning --> session_set_cookie_params(): Session cookie parameters cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 296
ERROR - 2023-06-28 11:02:34 --> Severity: Warning --> ini_set(): Session ini settings cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 306
ERROR - 2023-06-28 11:02:34 --> Severity: Warning --> ini_set(): Session ini settings cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 316
ERROR - 2023-06-28 11:02:34 --> Severity: Warning --> ini_set(): Session ini settings cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 317
ERROR - 2023-06-28 11:02:34 --> Severity: Warning --> ini_set(): Session ini settings cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 318
ERROR - 2023-06-28 11:02:34 --> Severity: Warning --> ini_set(): Session ini settings cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 319
ERROR - 2023-06-28 11:02:34 --> Severity: Warning --> ini_set(): Session ini settings cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 377
ERROR - 2023-06-28 11:02:34 --> Severity: Warning --> ini_set(): Session ini settings cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/drivers/Session_files_driver.php 108
ERROR - 2023-06-28 11:02:34 --> Severity: Warning --> session_set_save_handler(): Session save handler cannot be changed after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 110
ERROR - 2023-06-28 11:02:34 --> Severity: Warning --> session_start(): Session cannot be started after headers have already been sent /var/www/html/Cliffs_Internation/system/libraries/Session/Session.php 143
ERROR - 2023-06-28 11:02:34 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /var/www/html/Cliffs_Internation/system/core/Exceptions.php:271) /var/www/html/Cliffs_Internation/system/helpers/url_helper.php 564
ERROR - 2023-06-28 11:23:28 --> This is a log message
ERROR - 2023-06-28 11:23:28 --> Severity: Warning --> Undefined variable $categories /var/www/html/Cliffs_Internation/application/views/items/items.php 92
ERROR - 2023-06-28 11:23:28 --> Severity: Warning --> foreach() argument must be of type array|object, null given /var/www/html/Cliffs_Internation/application/views/items/items.php 92
ERROR - 2023-06-28 11:23:29 --> View output: 
ERROR - 2023-06-28 11:24:46 --> Severity: Warning --> Undefined variable $categories /var/www/html/Cliffs_Internation/application/views/items/items.php 8
ERROR - 2023-06-28 11:24:46 --> This is a log message
ERROR - 2023-06-28 11:24:46 --> Severity: Warning --> Undefined variable $categories /var/www/html/Cliffs_Internation/application/views/items/items.php 92
ERROR - 2023-06-28 11:24:46 --> Severity: Warning --> foreach() argument must be of type array|object, null given /var/www/html/Cliffs_Internation/application/views/items/items.php 92
ERROR - 2023-06-28 11:25:16 --> Severity: Warning --> Undefined variable $allitems /var/www/html/Cliffs_Internation/application/views/items/items.php 8
ERROR - 2023-06-28 11:25:16 --> This is a log message
ERROR - 2023-06-28 11:25:16 --> Severity: Warning --> Undefined variable $categories /var/www/html/Cliffs_Internation/application/views/items/items.php 92
ERROR - 2023-06-28 11:25:16 --> Severity: Warning --> foreach() argument must be of type array|object, null given /var/www/html/Cliffs_Internation/application/views/items/items.php 92
ERROR - 2023-06-28 11:26:17 --> Severity: Warning --> Undefined variable $categories /var/www/html/Cliffs_Internation/application/views/items/items.php 91
ERROR - 2023-06-28 11:26:17 --> Severity: Warning --> foreach() argument must be of type array|object, null given /var/www/html/Cliffs_Internation/application/views/items/items.php 91
ERROR - 2023-06-28 11:26:17 --> Severity: Warning --> Undefined variable $allitems /var/www/html/Cliffs_Internation/application/views/items/itemslisttable.php 5
ERROR - 2023-06-28 11:26:17 --> This is a log message
ERROR - 2023-06-28 11:27:03 --> Severity: Warning --> Undefined variable $categories /var/www/html/Cliffs_Internation/application/views/items/items.php 91
ERROR - 2023-06-28 11:27:03 --> Severity: Warning --> foreach() argument must be of type array|object, null given /var/www/html/Cliffs_Internation/application/views/items/items.php 91
ERROR - 2023-06-28 11:27:04 --> Severity: Warning --> Array to string conversion /var/www/html/Cliffs_Internation/application/views/items/itemslisttable.php 5
ERROR - 2023-06-28 11:27:04 --> This is a log messageArray
ERROR - 2023-06-28 14:52:04 --> Severity: error --> Exception: Class "CI_Exceptions" not found /var/www/html/Cliffs_Internation/system/core/Common.php 196
ERROR - 2023-06-28 14:52:14 --> Severity: Warning --> Undefined variable $categories /var/www/html/Cliffs_Internation/application/views/items/items.php 91
ERROR - 2023-06-28 14:52:14 --> Severity: Warning --> foreach() argument must be of type array|object, null given /var/www/html/Cliffs_Internation/application/views/items/items.php 91
ERROR - 2023-06-28 14:52:16 --> Severity: Warning --> Array to string conversion /var/www/html/Cliffs_Internation/application/views/items/itemslisttable.php 5
ERROR - 2023-06-28 14:52:16 --> This is a log messageArray
ERROR - 2023-06-28 14:52:45 --> Severity: Warning --> Undefined variable $categories /var/www/html/Cliffs_Internation/application/views/items/items.php 91
ERROR - 2023-06-28 14:52:45 --> Severity: Warning --> foreach() argument must be of type array|object, null given /var/www/html/Cliffs_Internation/application/views/items/items.php 91
ERROR - 2023-06-28 14:54:04 --> Categories data: {"1":"Insecticides","2":"Herbicides","3":"Fungicides","4":"Nematodes Control","5":"Rodenticides","6":"Soil Amendments","7":"Growth Enhancers","8":"Plant Nutrition","9":"Disease Control","10":"Weed Control","12":"Synthetic fertilizers","13":"Soil conditioners"}
ERROR - 2023-06-28 14:54:37 --> Severity: Warning --> Undefined variable $categories /var/www/html/Cliffs_Internation/application/views/items/items.php 91
ERROR - 2023-06-28 14:54:37 --> Severity: Warning --> foreach() argument must be of type array|object, null given /var/www/html/Cliffs_Internation/application/views/items/items.php 91
ERROR - 2023-06-28 14:55:19 --> Severity: Warning --> Undefined variable $categories /var/www/html/Cliffs_Internation/application/views/items/items.php 91
ERROR - 2023-06-28 14:55:19 --> Severity: Warning --> foreach() argument must be of type array|object, null given /var/www/html/Cliffs_Internation/application/views/items/items.php 91
ERROR - 2023-06-28 14:55:21 --> Categories data: {"1":"Insecticides","2":"Herbicides","3":"Fungicides","4":"Nematodes Control","5":"Rodenticides","6":"Soil Amendments","7":"Growth Enhancers","8":"Plant Nutrition","9":"Disease Control","10":"Weed Control","12":"Synthetic fertilizers","13":"Soil conditioners"}
ERROR - 2023-06-28 15:02:18 --> Severity: Warning --> Undefined variable $categories /var/www/html/Cliffs_Internation/application/views/items/items.php 91
ERROR - 2023-06-28 15:02:18 --> Severity: Warning --> foreach() argument must be of type array|object, null given /var/www/html/Cliffs_Internation/application/views/items/items.php 91
ERROR - 2023-06-28 15:02:20 --> Categories data: {"1":"Insecticides","2":"Herbicides","3":"Fungicides","4":"Nematodes Control","5":"Rodenticides","6":"Soil Amendments","7":"Growth Enhancers","8":"Plant Nutrition","9":"Disease Control","10":"Weed Control","12":"Synthetic fertilizers","13":"Soil conditioners"}
ERROR - 2023-06-28 15:05:47 --> Severity: Warning --> Undefined variable $categories /var/www/html/Cliffs_Internation/application/views/items/items.php 91
ERROR - 2023-06-28 15:05:47 --> Severity: Warning --> foreach() argument must be of type array|object, null given /var/www/html/Cliffs_Internation/application/views/items/items.php 91
ERROR - 2023-06-28 15:05:49 --> Categories data: {"1":"Insecticides","2":"Herbicides","3":"Fungicides","4":"Nematodes Control","5":"Rodenticides","6":"Soil Amendments","7":"Growth Enhancers","8":"Plant Nutrition","9":"Disease Control","10":"Weed Control","12":"Synthetic fertilizers","13":"Soil conditioners"}
ERROR - 2023-06-28 15:07:51 --> Severity: Warning --> Undefined variable $categories /var/www/html/Cliffs_Internation/application/views/items/items.php 91
ERROR - 2023-06-28 15:07:51 --> Severity: Warning --> foreach() argument must be of type array|object, null given /var/www/html/Cliffs_Internation/application/views/items/items.php 91
ERROR - 2023-06-28 15:07:53 --> Severity: 8192 --> str_replace(): Passing null to parameter #3 ($subject) of type array|string is deprecated /var/www/html/Cliffs_Internation/system/core/Output.php 457
ERROR - 2023-06-28 15:09:34 --> Severity: Warning --> Undefined variable $categories /var/www/html/Cliffs_Internation/application/views/items/items.php 91
ERROR - 2023-06-28 15:09:34 --> Severity: Warning --> foreach() argument must be of type array|object, null given /var/www/html/Cliffs_Internation/application/views/items/items.php 91
ERROR - 2023-06-28 15:09:36 --> Categories data: {"1":"Insecticides","2":"Herbicides","3":"Fungicides","4":"Nematodes Control","5":"Rodenticides","6":"Soil Amendments","7":"Growth Enhancers","8":"Plant Nutrition","9":"Disease Control","10":"Weed Control","12":"Synthetic fertilizers","13":"Soil conditioners"}
ERROR - 2023-06-28 15:09:36 --> Severity: 8192 --> str_replace(): Passing null to parameter #3 ($subject) of type array|string is deprecated /var/www/html/Cliffs_Internation/system/core/Output.php 457
ERROR - 2023-06-28 15:11:49 --> Severity: Warning --> Undefined variable $categories /var/www/html/Cliffs_Internation/application/views/items/items.php 91
ERROR - 2023-06-28 15:11:49 --> Severity: Warning --> foreach() argument must be of type array|object, null given /var/www/html/Cliffs_Internation/application/views/items/items.php 91
ERROR - 2023-06-28 15:11:50 --> Categories data: {"1":"Insecticides","2":"Herbicides","3":"Fungicides","4":"Nematodes Control","5":"Rodenticides","6":"Soil Amendments","7":"Growth Enhancers","8":"Plant Nutrition","9":"Disease Control","10":"Weed Control","12":"Synthetic fertilizers","13":"Soil conditioners"}
ERROR - 2023-06-28 15:11:50 --> Severity: 8192 --> str_replace(): Passing null to parameter #3 ($subject) of type array|string is deprecated /var/www/html/Cliffs_Internation/system/core/Output.php 457
ERROR - 2023-06-28 15:22:35 --> Severity: Warning --> Undefined variable $categories /var/www/html/Cliffs_Internation/application/views/items/items.php 91
ERROR - 2023-06-28 15:22:35 --> Severity: Warning --> foreach() argument must be of type array|object, null given /var/www/html/Cliffs_Internation/application/views/items/items.php 91
ERROR - 2023-06-28 15:23:08 --> Categories data: {"1":"Insecticides","2":"Herbicides","3":"Fungicides","4":"Nematodes Control","5":"Rodenticides","6":"Soil Amendments","7":"Growth Enhancers","8":"Plant Nutrition","9":"Disease Control","10":"Weed Control","12":"Synthetic fertilizers","13":"Soil conditioners"}
ERROR - 2023-06-28 15:23:49 --> Severity: Warning --> Undefined variable $categories /var/www/html/Cliffs_Internation/application/views/items/items.php 91
ERROR - 2023-06-28 15:23:49 --> Severity: Warning --> foreach() argument must be of type array|object, null given /var/www/html/Cliffs_Internation/application/views/items/items.php 91
ERROR - 2023-06-28 15:23:51 --> Categories data: {"1":"Insecticides","2":"Herbicides","3":"Fungicides","4":"Nematodes Control","5":"Rodenticides","6":"Soil Amendments","7":"Growth Enhancers","8":"Plant Nutrition","9":"Disease Control","10":"Weed Control","12":"Synthetic fertilizers","13":"Soil conditioners"}
ERROR - 2023-06-28 15:25:43 --> Severity: Warning --> Undefined variable $categories /var/www/html/Cliffs_Internation/application/views/items/items.php 91
ERROR - 2023-06-28 15:25:43 --> Severity: Warning --> foreach() argument must be of type array|object, null given /var/www/html/Cliffs_Internation/application/views/items/items.php 91
ERROR - 2023-06-28 15:25:45 --> Categories data: [{"id":1,"name":"Insecticides","status":1,"percentage":"10.50"},{"id":2,"name":"Herbicides","status":1,"percentage":"15.25"},{"id":3,"name":"Fungicides","status":1,"percentage":"4.50"},{"id":4,"name":"Nematodes Control","status":1,"percentage":"12.00"},{"id":5,"name":"Rodenticides","status":1,"percentage":"9.80"},{"id":6,"name":"Soil Amendments","status":1,"percentage":"14.50"},{"id":7,"name":"Growth Enhancers","status":1,"percentage":"7.25"},{"id":8,"name":"Plant Nutrition","status":0,"percentage":"7.90"},{"id":9,"name":"Disease Control","status":0,"percentage":"7.90"},{"id":10,"name":"Weed Control","status":1,"percentage":"9.99"},{"id":12,"name":"Synthetic fertilizers","status":1,"percentage":"8.90"},{"id":13,"name":"Soil conditioners","status":1,"percentage":"6.70"}]
ERROR - 2023-06-28 15:33:58 --> Severity: Warning --> Undefined variable $categorie /var/www/html/Cliffs_Internation/application/views/items/items.php 91
ERROR - 2023-06-28 15:33:58 --> Severity: Warning --> foreach() argument must be of type array|object, null given /var/www/html/Cliffs_Internation/application/views/items/items.php 91
ERROR - 2023-06-28 15:33:59 --> Categories data: [{"id":1,"name":"Insecticides","status":1,"percentage":"10.50"},{"id":2,"name":"Herbicides","status":1,"percentage":"15.25"},{"id":3,"name":"Fungicides","status":1,"percentage":"4.50"},{"id":4,"name":"Nematodes Control","status":1,"percentage":"12.00"},{"id":5,"name":"Rodenticides","status":1,"percentage":"9.80"},{"id":6,"name":"Soil Amendments","status":1,"percentage":"14.50"},{"id":7,"name":"Growth Enhancers","status":1,"percentage":"7.25"},{"id":8,"name":"Plant Nutrition","status":0,"percentage":"7.90"},{"id":9,"name":"Disease Control","status":0,"percentage":"7.90"},{"id":10,"name":"Weed Control","status":1,"percentage":"9.99"},{"id":12,"name":"Synthetic fertilizers","status":1,"percentage":"8.90"},{"id":13,"name":"Soil conditioners","status":1,"percentage":"6.70"}]
ERROR - 2023-06-28 15:34:41 --> Categories data: [{"id":1,"name":"Insecticides","status":1,"percentage":"10.50"},{"id":2,"name":"Herbicides","status":1,"percentage":"15.25"},{"id":3,"name":"Fungicides","status":1,"percentage":"4.50"},{"id":4,"name":"Nematodes Control","status":1,"percentage":"12.00"},{"id":5,"name":"Rodenticides","status":1,"percentage":"9.80"},{"id":6,"name":"Soil Amendments","status":1,"percentage":"14.50"},{"id":7,"name":"Growth Enhancers","status":1,"percentage":"7.25"},{"id":8,"name":"Plant Nutrition","status":0,"percentage":"7.90"},{"id":9,"name":"Disease Control","status":0,"percentage":"7.90"},{"id":10,"name":"Weed Control","status":1,"percentage":"9.99"},{"id":12,"name":"Synthetic fertilizers","status":1,"percentage":"8.90"},{"id":13,"name":"Soil conditioners","status":1,"percentage":"6.70"}]
ERROR - 2023-06-28 15:41:14 --> Categories data: [{"id":1,"name":"Insecticides","status":1,"percentage":"10.50"},{"id":2,"name":"Herbicides","status":1,"percentage":"15.25"},{"id":3,"name":"Fungicides","status":1,"percentage":"4.50"},{"id":4,"name":"Nematodes Control","status":1,"percentage":"12.00"},{"id":5,"name":"Rodenticides","status":1,"percentage":"9.80"},{"id":6,"name":"Soil Amendments","status":1,"percentage":"14.50"},{"id":7,"name":"Growth Enhancers","status":1,"percentage":"7.25"},{"id":8,"name":"Plant Nutrition","status":0,"percentage":"7.90"},{"id":9,"name":"Disease Control","status":0,"percentage":"7.90"},{"id":10,"name":"Weed Control","status":1,"percentage":"9.99"},{"id":12,"name":"Synthetic fertilizers","status":1,"percentage":"8.90"},{"id":13,"name":"Soil conditioners","status":1,"percentage":"6.70"}]
ERROR - 2023-06-28 15:47:22 --> Categories data: [{"id":1,"name":"Insecticides","status":1,"percentage":"10.50"},{"id":2,"name":"Herbicides","status":1,"percentage":"15.25"},{"id":3,"name":"Fungicides","status":1,"percentage":"4.50"},{"id":4,"name":"Nematodes Control","status":1,"percentage":"12.00"},{"id":5,"name":"Rodenticides","status":1,"percentage":"9.80"},{"id":6,"name":"Soil Amendments","status":1,"percentage":"14.50"},{"id":7,"name":"Growth Enhancers","status":1,"percentage":"7.25"},{"id":8,"name":"Plant Nutrition","status":0,"percentage":"7.90"},{"id":9,"name":"Disease Control","status":0,"percentage":"7.90"},{"id":10,"name":"Weed Control","status":1,"percentage":"9.99"},{"id":12,"name":"Synthetic fertilizers","status":1,"percentage":"8.90"},{"id":13,"name":"Soil conditioners","status":1,"percentage":"6.70"}]
ERROR - 2023-06-28 15:47:26 --> Categories data: [{"id":1,"name":"Insecticides","status":1,"percentage":"10.50"},{"id":2,"name":"Herbicides","status":1,"percentage":"15.25"},{"id":3,"name":"Fungicides","status":1,"percentage":"4.50"},{"id":4,"name":"Nematodes Control","status":1,"percentage":"12.00"},{"id":5,"name":"Rodenticides","status":1,"percentage":"9.80"},{"id":6,"name":"Soil Amendments","status":1,"percentage":"14.50"},{"id":7,"name":"Growth Enhancers","status":1,"percentage":"7.25"},{"id":8,"name":"Plant Nutrition","status":0,"percentage":"7.90"},{"id":9,"name":"Disease Control","status":0,"percentage":"7.90"},{"id":10,"name":"Weed Control","status":1,"percentage":"9.99"},{"id":12,"name":"Synthetic fertilizers","status":1,"percentage":"8.90"},{"id":13,"name":"Soil conditioners","status":1,"percentage":"6.70"}]
ERROR - 2023-06-28 15:48:08 --> Categories data: [{"id":1,"name":"Insecticides","status":1,"percentage":"10.50"},{"id":2,"name":"Herbicides","status":1,"percentage":"15.25"},{"id":3,"name":"Fungicides","status":1,"percentage":"4.50"},{"id":4,"name":"Nematodes Control","status":1,"percentage":"12.00"},{"id":5,"name":"Rodenticides","status":1,"percentage":"9.80"},{"id":6,"name":"Soil Amendments","status":1,"percentage":"14.50"},{"id":7,"name":"Growth Enhancers","status":1,"percentage":"7.25"},{"id":8,"name":"Plant Nutrition","status":0,"percentage":"7.90"},{"id":9,"name":"Disease Control","status":0,"percentage":"7.90"},{"id":10,"name":"Weed Control","status":1,"percentage":"9.99"},{"id":12,"name":"Synthetic fertilizers","status":1,"percentage":"8.90"},{"id":13,"name":"Soil conditioners","status":1,"percentage":"6.70"}]
ERROR - 2023-06-28 15:48:08 --> Categories data: [{"id":1,"name":"Insecticides","status":1,"percentage":"10.50"},{"id":2,"name":"Herbicides","status":1,"percentage":"15.25"},{"id":3,"name":"Fungicides","status":1,"percentage":"4.50"},{"id":4,"name":"Nematodes Control","status":1,"percentage":"12.00"},{"id":5,"name":"Rodenticides","status":1,"percentage":"9.80"},{"id":6,"name":"Soil Amendments","status":1,"percentage":"14.50"},{"id":7,"name":"Growth Enhancers","status":1,"percentage":"7.25"},{"id":8,"name":"Plant Nutrition","status":0,"percentage":"7.90"},{"id":9,"name":"Disease Control","status":0,"percentage":"7.90"},{"id":10,"name":"Weed Control","status":1,"percentage":"9.99"},{"id":12,"name":"Synthetic fertilizers","status":1,"percentage":"8.90"},{"id":13,"name":"Soil conditioners","status":1,"percentage":"6.70"}]
ERROR - 2023-06-28 15:48:08 --> Categories data: [{"id":1,"name":"Insecticides","status":1,"percentage":"10.50"},{"id":2,"name":"Herbicides","status":1,"percentage":"15.25"},{"id":3,"name":"Fungicides","status":1,"percentage":"4.50"},{"id":4,"name":"Nematodes Control","status":1,"percentage":"12.00"},{"id":5,"name":"Rodenticides","status":1,"percentage":"9.80"},{"id":6,"name":"Soil Amendments","status":1,"percentage":"14.50"},{"id":7,"name":"Growth Enhancers","status":1,"percentage":"7.25"},{"id":8,"name":"Plant Nutrition","status":0,"percentage":"7.90"},{"id":9,"name":"Disease Control","status":0,"percentage":"7.90"},{"id":10,"name":"Weed Control","status":1,"percentage":"9.99"},{"id":12,"name":"Synthetic fertilizers","status":1,"percentage":"8.90"},{"id":13,"name":"Soil conditioners","status":1,"percentage":"6.70"}]
ERROR - 2023-06-28 15:56:32 --> Categories data: [{"id":1,"name":"Insecticides","status":1,"percentage":"10.50"},{"id":2,"name":"Herbicides","status":1,"percentage":"15.25"},{"id":3,"name":"Fungicides","status":1,"percentage":"4.50"},{"id":4,"name":"Nematodes Control","status":1,"percentage":"12.00"},{"id":5,"name":"Rodenticides","status":1,"percentage":"9.80"},{"id":6,"name":"Soil Amendments","status":1,"percentage":"14.50"},{"id":7,"name":"Growth Enhancers","status":1,"percentage":"7.25"},{"id":8,"name":"Plant Nutrition","status":0,"percentage":"7.90"},{"id":9,"name":"Disease Control","status":0,"percentage":"7.90"},{"id":10,"name":"Weed Control","status":1,"percentage":"9.99"},{"id":12,"name":"Synthetic fertilizers","status":1,"percentage":"8.90"},{"id":13,"name":"Soil conditioners","status":1,"percentage":"6.70"}]
ERROR - 2023-06-28 15:57:11 --> Categories data: [{"id":1,"name":"Insecticides","status":1,"percentage":"10.50"},{"id":2,"name":"Herbicides","status":1,"percentage":"15.25"},{"id":3,"name":"Fungicides","status":1,"percentage":"4.50"},{"id":4,"name":"Nematodes Control","status":1,"percentage":"12.00"},{"id":5,"name":"Rodenticides","status":1,"percentage":"9.80"},{"id":6,"name":"Soil Amendments","status":1,"percentage":"14.50"},{"id":7,"name":"Growth Enhancers","status":1,"percentage":"7.25"},{"id":8,"name":"Plant Nutrition","status":0,"percentage":"7.90"},{"id":9,"name":"Disease Control","status":0,"percentage":"7.90"},{"id":10,"name":"Weed Control","status":1,"percentage":"9.99"},{"id":12,"name":"Synthetic fertilizers","status":1,"percentage":"8.90"},{"id":13,"name":"Soil conditioners","status":1,"percentage":"6.70"}]
ERROR - 2023-06-28 16:02:58 --> Categories data: [{"id":1,"name":"Insecticides","status":1,"percentage":"10.50"},{"id":2,"name":"Herbicides","status":1,"percentage":"15.25"},{"id":3,"name":"Fungicides","status":1,"percentage":"4.50"},{"id":4,"name":"Nematodes Control","status":1,"percentage":"12.00"},{"id":5,"name":"Rodenticides","status":1,"percentage":"9.80"},{"id":6,"name":"Soil Amendments","status":1,"percentage":"14.50"},{"id":7,"name":"Growth Enhancers","status":1,"percentage":"7.25"},{"id":8,"name":"Plant Nutrition","status":0,"percentage":"7.90"},{"id":9,"name":"Disease Control","status":0,"percentage":"7.90"},{"id":10,"name":"Weed Control","status":1,"percentage":"9.99"},{"id":12,"name":"Synthetic fertilizers","status":1,"percentage":"8.90"},{"id":13,"name":"Soil conditioners","status":1,"percentage":"6.70"}]
ERROR - 2023-06-28 16:17:44 --> Categories data: [{"id":1,"name":"Insecticides","status":1,"percentage":"10.50"},{"id":2,"name":"Herbicides","status":1,"percentage":"15.25"},{"id":3,"name":"Fungicides","status":1,"percentage":"4.50"},{"id":4,"name":"Nematodes Control","status":1,"percentage":"12.00"},{"id":5,"name":"Rodenticides","status":1,"percentage":"9.80"},{"id":6,"name":"Soil Amendments","status":1,"percentage":"14.50"},{"id":7,"name":"Growth Enhancers","status":1,"percentage":"7.25"},{"id":8,"name":"Plant Nutrition","status":0,"percentage":"7.90"},{"id":9,"name":"Disease Control","status":0,"percentage":"7.90"},{"id":10,"name":"Weed Control","status":1,"percentage":"9.99"},{"id":12,"name":"Synthetic fertilizers","status":1,"percentage":"8.90"},{"id":13,"name":"Soil conditioners","status":1,"percentage":"6.70"}]
ERROR - 2023-06-28 16:19:10 --> Categories data: [{"id":1,"name":"Insecticides","status":1,"percentage":"10.50"},{"id":2,"name":"Herbicides","status":1,"percentage":"15.25"},{"id":3,"name":"Fungicides","status":1,"percentage":"4.50"},{"id":4,"name":"Nematodes Control","status":1,"percentage":"12.00"},{"id":5,"name":"Rodenticides","status":1,"percentage":"9.80"},{"id":6,"name":"Soil Amendments","status":1,"percentage":"14.50"},{"id":7,"name":"Growth Enhancers","status":1,"percentage":"7.25"},{"id":8,"name":"Plant Nutrition","status":0,"percentage":"7.90"},{"id":9,"name":"Disease Control","status":0,"percentage":"7.90"},{"id":10,"name":"Weed Control","status":1,"percentage":"9.99"},{"id":12,"name":"Synthetic fertilizers","status":1,"percentage":"8.90"},{"id":13,"name":"Soil conditioners","status":1,"percentage":"6.70"}]
ERROR - 2023-06-28 16:37:15 --> Categories data: [{"id":1,"name":"Insecticides","status":1,"percentage":"10.50"},{"id":2,"name":"Herbicides","status":1,"percentage":"15.25"},{"id":3,"name":"Fungicides","status":1,"percentage":"4.50"},{"id":4,"name":"Nematodes Control","status":1,"percentage":"12.00"},{"id":5,"name":"Rodenticides","status":1,"percentage":"9.80"},{"id":6,"name":"Soil Amendments","status":1,"percentage":"14.50"},{"id":7,"name":"Growth Enhancers","status":1,"percentage":"7.25"},{"id":8,"name":"Plant Nutrition","status":0,"percentage":"7.90"},{"id":9,"name":"Disease Control","status":0,"percentage":"7.90"},{"id":10,"name":"Weed Control","status":1,"percentage":"9.99"},{"id":12,"name":"Synthetic fertilizers","status":1,"percentage":"8.90"},{"id":13,"name":"Soil conditioners","status":1,"percentage":"6.70"}]
ERROR - 2023-06-28 16:38:17 --> Categories data: [{"id":1,"name":"Insecticides","status":1,"percentage":"10.50"},{"id":2,"name":"Herbicides","status":1,"percentage":"15.25"},{"id":3,"name":"Fungicides","status":1,"percentage":"4.50"},{"id":4,"name":"Nematodes Control","status":1,"percentage":"12.00"},{"id":5,"name":"Rodenticides","status":1,"percentage":"9.80"},{"id":6,"name":"Soil Amendments","status":1,"percentage":"14.50"},{"id":7,"name":"Growth Enhancers","status":1,"percentage":"7.25"},{"id":8,"name":"Plant Nutrition","status":0,"percentage":"7.90"},{"id":9,"name":"Disease Control","status":0,"percentage":"7.90"},{"id":10,"name":"Weed Control","status":1,"percentage":"9.99"},{"id":12,"name":"Synthetic fertilizers","status":1,"percentage":"8.90"},{"id":13,"name":"Soil conditioners","status":1,"percentage":"6.70"}]
ERROR - 2023-06-28 16:39:22 --> Categories data: [{"id":1,"name":"Insecticides","status":1,"percentage":"10.50"},{"id":2,"name":"Herbicides","status":1,"percentage":"15.25"},{"id":3,"name":"Fungicides","status":1,"percentage":"4.50"},{"id":4,"name":"Nematodes Control","status":1,"percentage":"12.00"},{"id":5,"name":"Rodenticides","status":1,"percentage":"9.80"},{"id":6,"name":"Soil Amendments","status":1,"percentage":"14.50"},{"id":7,"name":"Growth Enhancers","status":1,"percentage":"7.25"},{"id":8,"name":"Plant Nutrition","status":0,"percentage":"7.90"},{"id":9,"name":"Disease Control","status":0,"percentage":"7.90"},{"id":10,"name":"Weed Control","status":1,"percentage":"9.99"},{"id":12,"name":"Synthetic fertilizers","status":1,"percentage":"8.90"},{"id":13,"name":"Soil conditioners","status":1,"percentage":"6.70"}]
ERROR - 2023-06-28 16:41:27 --> Categories data: [{"id":1,"name":"Insecticides","status":1,"percentage":"10.50"},{"id":2,"name":"Herbicides","status":1,"percentage":"15.25"},{"id":3,"name":"Fungicides","status":1,"percentage":"4.50"},{"id":4,"name":"Nematodes Control","status":1,"percentage":"12.00"},{"id":5,"name":"Rodenticides","status":1,"percentage":"9.80"},{"id":6,"name":"Soil Amendments","status":1,"percentage":"14.50"},{"id":7,"name":"Growth Enhancers","status":1,"percentage":"7.25"},{"id":8,"name":"Plant Nutrition","status":0,"percentage":"7.90"},{"id":9,"name":"Disease Control","status":0,"percentage":"7.90"},{"id":10,"name":"Weed Control","status":1,"percentage":"9.99"},{"id":12,"name":"Synthetic fertilizers","status":1,"percentage":"8.90"},{"id":13,"name":"Soil conditioners","status":1,"percentage":"6.70"}]
ERROR - 2023-06-28 16:41:50 --> Categories data: [{"id":1,"name":"Insecticides","status":1,"percentage":"10.50"},{"id":2,"name":"Herbicides","status":1,"percentage":"15.25"},{"id":3,"name":"Fungicides","status":1,"percentage":"4.50"},{"id":4,"name":"Nematodes Control","status":1,"percentage":"12.00"},{"id":5,"name":"Rodenticides","status":1,"percentage":"9.80"},{"id":6,"name":"Soil Amendments","status":1,"percentage":"14.50"},{"id":7,"name":"Growth Enhancers","status":1,"percentage":"7.25"},{"id":8,"name":"Plant Nutrition","status":0,"percentage":"7.90"},{"id":9,"name":"Disease Control","status":0,"percentage":"7.90"},{"id":10,"name":"Weed Control","status":1,"percentage":"9.99"},{"id":12,"name":"Synthetic fertilizers","status":1,"percentage":"8.90"},{"id":13,"name":"Soil conditioners","status":1,"percentage":"6.70"}]
ERROR - 2023-06-28 16:42:47 --> Categories data: [{"id":1,"name":"Insecticides","status":1,"percentage":"10.50"},{"id":2,"name":"Herbicides","status":1,"percentage":"15.25"},{"id":3,"name":"Fungicides","status":1,"percentage":"4.50"},{"id":4,"name":"Nematodes Control","status":1,"percentage":"12.00"},{"id":5,"name":"Rodenticides","status":1,"percentage":"9.80"},{"id":6,"name":"Soil Amendments","status":1,"percentage":"14.50"},{"id":7,"name":"Growth Enhancers","status":1,"percentage":"7.25"},{"id":8,"name":"Plant Nutrition","status":0,"percentage":"7.90"},{"id":9,"name":"Disease Control","status":0,"percentage":"7.90"},{"id":10,"name":"Weed Control","status":1,"percentage":"9.99"},{"id":12,"name":"Synthetic fertilizers","status":1,"percentage":"8.90"},{"id":13,"name":"Soil conditioners","status":1,"percentage":"6.70"}]
ERROR - 2023-06-28 16:50:20 --> Categories data: [{"id":1,"name":"Insecticides","status":1,"percentage":"10.50"},{"id":2,"name":"Herbicides","status":1,"percentage":"15.25"},{"id":3,"name":"Fungicides","status":1,"percentage":"4.50"},{"id":4,"name":"Nematodes Control","status":1,"percentage":"12.00"},{"id":5,"name":"Rodenticides","status":1,"percentage":"9.80"},{"id":6,"name":"Soil Amendments","status":1,"percentage":"14.50"},{"id":7,"name":"Growth Enhancers","status":1,"percentage":"7.25"},{"id":8,"name":"Plant Nutrition","status":0,"percentage":"7.90"},{"id":9,"name":"Disease Control","status":0,"percentage":"7.90"},{"id":10,"name":"Weed Control","status":1,"percentage":"9.99"},{"id":12,"name":"Synthetic fertilizers","status":1,"percentage":"8.90"},{"id":13,"name":"Soil conditioners","status":1,"percentage":"6.70"}]
ERROR - 2023-06-28 16:52:06 --> Categories data: [{"id":1,"name":"Insecticides","status":1,"percentage":"10.50"},{"id":2,"name":"Herbicides","status":1,"percentage":"15.25"},{"id":3,"name":"Fungicides","status":1,"percentage":"4.50"},{"id":4,"name":"Nematodes Control","status":1,"percentage":"12.00"},{"id":5,"name":"Rodenticides","status":1,"percentage":"9.80"},{"id":6,"name":"Soil Amendments","status":1,"percentage":"14.50"},{"id":7,"name":"Growth Enhancers","status":1,"percentage":"7.25"},{"id":8,"name":"Plant Nutrition","status":0,"percentage":"7.90"},{"id":9,"name":"Disease Control","status":0,"percentage":"7.90"},{"id":10,"name":"Weed Control","status":1,"percentage":"9.99"},{"id":12,"name":"Synthetic fertilizers","status":1,"percentage":"8.90"},{"id":13,"name":"Soil conditioners","status":1,"percentage":"6.70"}]
ERROR - 2023-06-28 16:52:24 --> Categories data: [{"id":1,"name":"Insecticides","status":1,"percentage":"10.50"},{"id":2,"name":"Herbicides","status":1,"percentage":"15.25"},{"id":3,"name":"Fungicides","status":1,"percentage":"4.50"},{"id":4,"name":"Nematodes Control","status":1,"percentage":"12.00"},{"id":5,"name":"Rodenticides","status":1,"percentage":"9.80"},{"id":6,"name":"Soil Amendments","status":1,"percentage":"14.50"},{"id":7,"name":"Growth Enhancers","status":1,"percentage":"7.25"},{"id":8,"name":"Plant Nutrition","status":0,"percentage":"7.90"},{"id":9,"name":"Disease Control","status":0,"percentage":"7.90"},{"id":10,"name":"Weed Control","status":1,"percentage":"9.99"},{"id":12,"name":"Synthetic fertilizers","status":1,"percentage":"8.90"},{"id":13,"name":"Soil conditioners","status":1,"percentage":"6.70"}]
ERROR - 2023-06-28 16:53:05 --> Categories data: [{"id":1,"name":"Insecticides","status":1,"percentage":"10.50"},{"id":2,"name":"Herbicides","status":1,"percentage":"15.25"},{"id":3,"name":"Fungicides","status":1,"percentage":"4.50"},{"id":4,"name":"Nematodes Control","status":1,"percentage":"12.00"},{"id":5,"name":"Rodenticides","status":1,"percentage":"9.80"},{"id":6,"name":"Soil Amendments","status":1,"percentage":"14.50"},{"id":7,"name":"Growth Enhancers","status":1,"percentage":"7.25"},{"id":8,"name":"Plant Nutrition","status":0,"percentage":"7.90"},{"id":9,"name":"Disease Control","status":0,"percentage":"7.90"},{"id":10,"name":"Weed Control","status":1,"percentage":"9.99"},{"id":12,"name":"Synthetic fertilizers","status":1,"percentage":"8.90"},{"id":13,"name":"Soil conditioners","status":1,"percentage":"6.70"}]
ERROR - 2023-06-28 16:59:37 --> Categories data: [{"id":1,"name":"Insecticides","status":1,"percentage":"10.50"},{"id":2,"name":"Herbicides","status":1,"percentage":"15.25"},{"id":3,"name":"Fungicides","status":1,"percentage":"4.50"},{"id":4,"name":"Nematodes Control","status":1,"percentage":"12.00"},{"id":5,"name":"Rodenticides","status":1,"percentage":"9.80"},{"id":6,"name":"Soil Amendments","status":1,"percentage":"14.50"},{"id":7,"name":"Growth Enhancers","status":1,"percentage":"7.25"},{"id":8,"name":"Plant Nutrition","status":0,"percentage":"7.90"},{"id":9,"name":"Disease Control","status":0,"percentage":"7.90"},{"id":10,"name":"Weed Control","status":1,"percentage":"9.99"},{"id":12,"name":"Synthetic fertilizers","status":1,"percentage":"8.90"},{"id":13,"name":"Soil conditioners","status":1,"percentage":"6.70"}]
