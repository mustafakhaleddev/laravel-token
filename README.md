# Laravel Token

![Laravel](http://getfreetutorial.com/wp-content/uploads/2016/07/Laravel-From-Scratch.jpg)

Laravel unique Token Generator 
```php
// Generate unique Token From Database.
$new_token = $token->Unique($table_name, $column_name, $size);

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
'Token'=>\Dirape\Token\Facades\Facade::class
```

## Documentation

### ★ New Token Trait ★
##### setup in model
To use new trait token you need to do some changes in the model that contain the token column.
##### One Column Token

#####One token Trait allow you to generate token for one columns in the  table

* To use one column token you need to add `` use DirapeToken;`` in the model .
* In database we use default column called ``dt_token`` to replace with your column name add  ``  protected $DT_Column='column_name';`` in the model .
* Token settings are set by default to this value `` ['type' => DT_Unique, 'size' => 40, 'special_chr' => false]`` to replace with your custom settings add  ``    protected $DT_settings=['type'=>DT_Unique,'size'=>60,'special_chr'=>false]; `` in the model .
* you should know that we use custom constants for our token type
```php
  Const DT_Unique = 'Unique'; 
  Const DT_UniqueNum = 'UniqueNumber'; 
  Const DT_UniqueStr = 'UniqueString';
  Const DT_Random = 'Random';
  Const DT_RandomNum = 'RandomNumber';
  Const DT_RandomStr = 'RandomString';
  ``` 
 * after preparing the model to use our trait token in your code you can set the token with your custom column and settings like this
```php
           $user=User::first();
           $user->setToken();
           $user->save();
```
* you can use your custom settings in ``setToken();`` function like this
```php
           $user=User::first();
           $user->setToken(DT_UniqueStr,100,false);
           $user->save();
```
* you can set your custom column in the function
 ```php
            $user=User::first();
            $user->setToken(DT_UniqueStr,100,false,'column_name');
            $user->save();
 ```      
* To get model query with token you can use `WithToken()` .
       ```
                  $user=User::WithToken()->get();
       ```
* To get model query with no tokens you can use flag ``false``  in `WithToken()`
       ```
                       $user=User::WithToken(false)->get();
            ```
##### Multi Column Token

#####Multi token allow you to generate tokens for multi columns in the same table
  
  * To use multi column token you need to add `` use DirapeMultiToken;`` in the model .
  * Columns settings are not set by default so you need to make your custom settings in the model
```php
  protected $DMT_columns=[
        'unique_id'=>['type'=>DT_Unique,'size'=>60,'special_chr'=>false],
        'unique_uid'=>['type'=>DT_Unique,'size'=>30,'special_chr'=>false],
    ];

``` 
* you should know that we use custom constants for our token type
  ```php
    Const DT_Unique = 'Unique'; 
    Const DT_UniqueNum = 'UniqueNumber'; 
    Const DT_UniqueStr = 'UniqueString';
    Const DT_Random = 'Random';
    Const DT_RandomNum = 'RandomNumber';
    Const DT_RandomStr = 'RandomString';
    ``` 
   * after preparing the model to use our trait multi token in your code you can set the tokens with only one function
  ```php
             $user=User::first();
             $user->setTokens();
             $user->save();
  ```
    
          
### ★ The old way ★
#### Generate unique token

With this package you can generate unqiue token not repated in database just by using `unique($table_name,$column_name,$size)` Function  `$table_name` is the table name in database , `$column_name` is the column name in the table, `$size` is token size.


#### Generate unique string token

generate unique strings token with the same signature  of unique token with function `UniqueString($table_name,$column_name,$size)`.


#### Generate unique integer token

generate unique integers token with the same signature  of unique token with function `UniqueNumber($table_name,$column_name,$size)`.


#### Generate random token
generate random token with function `Random($size)` and `$size` is the size of token length.


#### Generate random integer token
generate random integer token with function `RandomNumber($size)` and `$size` is the size of token length.


#### Generate random string token
generate random string token with function `RandomString($size)` and `$size` is the size of token length.

#### Special Characters

use `true` to allow special characters in your token `!@#$%^&*()` in all functions just like `Random($size,true)`.

### Examples

Here you can see an example of just how simple this package is to use.
#### Unique Token
```php

// Generate unique token not rebeated in database table with column name 
Token::Unique($table_name, $column_name, 10 );
//Result: fCWih6TDAf


// Generate unique integer token not rebeated in database table with column name
Token::UniqueNumber($table_name, $column_name, 10 );
//Result: 9647307239


// Generate unique string token not rebeated in database table with column name
Token::UniqueString($table_name, $column_name, 10 );
//Result: SOUjkyAyxC


//You can use special characters just add "true" to the function
Token::Unique($table_name, $column_name, 10,true );
//Result: H@klU$u^3z
```

#### Random Token (not unique)
```php
$size=10;
// Generate random token 
Token::Random($size);

// Generate random integer token
Token::RandomNumber($size);

// Generate random string token
Token::RandomString($size);

//You can use special characters just add "true" to the function
Token::Random($size,true);

```

## License

[MIT](LICENSE) © [Mustafa Khaled](https://github.com/Dirape)
