# Laravel Token

![Laravel](http://getfreetutorial.com/wp-content/uploads/2016/07/Laravel-From-Scratch.jpg)

Laravel unique Token Generator 
```php
// Generate unique Token From Database.
$new_token = $token->unique($table_name, $column_name, $size);
```

## Installation

Require this package, with [Composer](https://getcomposer.org/), in the root directory of your project.

```bash
$ composer require dirape/token
```

Add the service provider to `config/app.php` in the `providers` array, or if you're using Laravel 5.5, this can be done via the automatic package discovery.

```php
Dirape\Token\TokenServiceProvider::class
```

If you want you can use the [facade](http://laravel.com/docs/facades). Add the reference in `config/app.php` to your aliases array.

```php
'Token' => \Dirape\Token\Facades\Facade::class
```

## Usage

If you want to use a token in you model, you have to add the `DirapeToken` or `DirapeMultiToken` trait to your Eloquent model, depending on if you want to use multiple tokens per model.
To use  trait token you need to do some changes in the model that contain the token column.

### Single token

* The token gets stored in the database. The column is called `dt_token` by default. To change this, you can add a `protected $DT_column` property to your model.
* Token settings are set by default to this value `['type' => DT_Unique, 'size' => 40, 'special_chr' => false]` to replace with your custom settings add  `protected $DT_settings = ['type'=> DT_Unique,'size' => 60,'special_chr' => false];` in the model.
* you should know that we use custom constants for our token type
```php
const DT_Unique = 'Unique'; 
const DT_UniqueNum = 'UniqueNumber'; 
const DT_UniqueStr = 'UniqueString';
const DT_Random = 'Random';
const DT_RandomNum = 'RandomNumber';
const DT_RandomStr = 'RandomString';
``` 
 * after preparing the model to use our trait token in your code you can set the token with your custom column and settings like this
```php
$user = User::first();
$user->setToken();
$user->save();
```
* you can use your custom settings in `setToken();` function like this
```php
$user = User::first();
$user->setToken(DT_UniqueStr, 100, false);
$user->save();
```
* you can set your custom column in the function
 ```php
$user = User::first();
$user->setToken(DT_UniqueStr, 100, false, 'column_name');
$user->save();
 ```      
* To get model query with token you can use `WithToken()` .
```
$user = User::withToken()->get();
```
* To get model query with no tokens you can use flag ``false``  in `WithToken()`
```
$user = User::withToken(false)->get();
```
### Multiple tokens
  
  * Columns settings are not set by default so you need to make your custom settings in the model
```php
protected $DMT_columns = [
	'unique_id' => [
		'type' => DT_Unique,
		'size' => 60,
		'special_chr' => false
	],
	'unique_uid' => [
		'type' => DT_Unique,
		'size' => 30,
		'special_chr' => false
	],
];
``` 
* you should know that we use custom constants for our token type
```php
const DT_Unique = 'Unique'; 
const DT_UniqueNum = 'UniqueNumber'; 
const DT_UniqueStr = 'UniqueString';
const DT_Random = 'Random';
const DT_RandomNum = 'RandomNumber';
const DT_RandomStr = 'RandomString';
``` 
   * after preparing the model to use our trait multi token in your code you can set the tokens with only one function
```php
$user = User::first();
$user->setTokens();
$user->save();
```
## Methods

Here you can see an example of just how simple this package is to use.

### Random tokens

```php
// Generate random token with upper- and lowercase letter and numbers. (a-z, A-Z, 0-9)
Token::random('users', 'api_token', 60);
// Results in: "6nz1pk70YdQZP01tPXdQArx6B6IVwr7v3vnKqLYkamAifvmrG8TVrza42wZt"

// Generate random token with numbers. (0-9)
Token::randomNumber('products', 'identifier', 15);
// Results in: "964730723939485"

// Generate random token with upper- and lowercase letters. (a-z, A-Z)
Token::randomString('coupons', 'code', 10);
// Results in: "bIQBqnlRzG"
```

### Unique tokens
```php
// Generate unique token with upper- and lowercase letter and numbers. (a-z, A-Z, 0-9)
Token::unique('users', 'api_token', 60);
// Results in: "6nz1pk70YdQZP01tPXdQArx6B6IVwr7v3vnKqLYkamAifvmrG8TVrza42wZt"

// Generate unique token with numbers. (0-9)
Token::uniqueNumber('products', 'identifier', 15);
// Results in: "964730723939485"

// Generate unique token with upper- and lowercase letters. (a-z, A-Z)
Token::uniqueString('coupons', 'code', 10);
// Results in: "bIQBqnlRzG"
```

### Special characters

For every method there is an optional last parameter. This parameter determines if the token can contain special characters. (`!@#$%^&*()`)

```php

Token::unique('users', 'api_token', 60, true);
// Results in "^QRMBksyp*(tGfLlzp9JCFayE7!gIpb1ssjrIyECp9$S2wM1VeL7fzARm!sU"

Token::randomString(15, true);
// Results in "$YnBG(jFSbpL^EF"
```

## License

[MIT](LICENSE) © [Mustafa Khaled](https://github.com/Dirape)
