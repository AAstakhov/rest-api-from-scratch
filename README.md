# TryCatch
[![Build Status](https://travis-ci.org/AAstakhov/try-catch-test-task.svg?branch=master)](https://travis-ci.org/AAstakhov/try-catch-test-task)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/AAstakhov/try-catch-test-task/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/AAstakhov/try-catch-test-task/?branch=master)


This project is an architectural struggle with the goal to reimplement
a proposed simple script using better development practices. See a complete 
[task description](Task.md).

# How to run tests

All tests

```
vendor/bin/phpunit
```

Tests without functional tests (web tests to test api using guzzle http client)

```
vendor/bin/phpunit --testsuite AllWithoutWeb
```

Or just observe [how it works in Travis](https://travis-ci.org/AAstakhov/try-catch-test-task)


## Rest API 

### CRUD operations with address records

```
/example.php/address [GET, POST, PUT, DELETE]
```

#### Method GET

Fetches an address record with a given id.

##### GET parameters

Parameter | Type    | Description
--------- | ------- | -----------
id        | integer | Address ID 
 
##### Responses

Code | Description
---- | -----------
404  | Address record with the a id is not found


#### Method POST

Adds a new address record.

##### POST parameters

Array with address data.
 
 
##### Responses

Code | Description
---- | -----------
400  | Wrong parameters: element count is less then header element count



#### Method PUT

Updates an address record with a given id.

##### GET parameters

Parameter | Type    | Description
--------- | ------- | -----------
id        | integer | Address ID 

##### POST parameters

Array with address data.




#### Method DELETE

Deletes an address record with a given id.

##### GET parameters

Parameter | Type    | Description
--------- | ------- | -----------
id        | integer | Address ID 
 
##### Responses

Code | Description
---- | -----------
404  | Address record with the a id is not found


## Technical implementation

### Entry point

Entry point is an instance of class Application.

### Components

* Autoloader
* DI Container
* Router
* HttpRequest
* HttpResponse

### How to extend solution

### How to add new data storage

Implement new class using DataStorageInterface, e.g. MysqlDataStorage.

```php
class MysqlDataStorage implements DataStorageInterface
{
  ...
```

Register new class in the DI container:

```php
$container->add('data-storage', function () {
    return new MysqlDataStorage();
});
```

### How to add new view (data presentation)

Implement new class using ViewInterface, e.g. XhtmlView.

```php
class XhtmlView implements ViewInterface
{
  ...
```

Register new class in the DI container:

```php
$container->add('view', function () {
    return new XhtmlView();
});
```
