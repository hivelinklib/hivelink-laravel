<!-- PROJECT LOGO -->    
<br />    
<p align="center">    
  <a href="https://github.com/hivelinklib/hivelink-laravel">  
    <img src="logo.png" alt="Logo" height="200" alt="hivelink for laravel">    
  </a>    
    
  <h3 align="center">Hivelink Laravel SDK</h3>    
    
  <p align="center">    
    SDK for implementing Hivelink SMS,Inquiry API in your Laravel projects.    
    <br />    
    <a href="#table-of-contents"><strong>Explore the docs »</strong></a>    
    <br />    
    <br />    

  </p>    
</p>

# Hivelink Laravel

**First of all you will ned an [API Key](http://notif.hivelink.co "API Key") . You can get one [Here](http://notif.hivelink.co/app/auth/login).**

##### Supported Laravel Versions:

- V.4
- V.5
- V.6
- V.7
- V.8
- V.9
- **V.10**

# Installation

## Step 1 - Install the package

- **Method 1**:
  You can install hivelink/laravel with Composer directly in your project:

```php
composer require hivelink/laravel
```

- **Method 2**:
  Add this line to **Composer.json** file in your project

```php
"hivelink/php": "*"
```

Then run following command to download extension using **composer**

```php
$ composer update
```

## Step 2

Head to **config/app.php** and add this line to the end of **providers** Array:

```php
Hivelink\Laravel\ServiceProvider::class,
```

So that array must me something like this:

```php
'providers' => [
		/*
		* Laravel Framework Service Providers...
		*/
		.
		.
		.
		Hivelink\Laravel\ServiceProvider::class
]
```

Then in the **config/app.php** and add this line to the end of **aliases** Array:

```php
'Hivelink' => Hivelink\Laravel\Facade::class,
```

## Step 3 - Publish

Run this command in your project dirctory:

```
php artisan vendor:publish
```
OR
```
php artisan vendor:publish --provider="Hivelink\Laravel\ServiceProviderLaravel9" --tag="config"
```

In the message appear, find the number of Hivelink, enter the related number then hit Enter. for Example in the below case you must enter **9** then enter:

```bash
Which provider or tag files would you like to publish?:
[0 ] Publish files from all providers and tags listed below
[1 ] Provider: Facade\Ignition\IgnitionServiceProvider
[2 ] Provider: Fideloper\Proxy\TrustedProxyServiceProvider
[3 ] Provider: Fruitcake\Cors\CorsServiceProvider
[4 ] Provider: Illuminate\Foundation\Providers\FoundationServiceProvider
[5 ] Provider: Illuminate\Mail\MailServiceProvider
[6 ] Provider: Illuminate\Pagination\PaginationServiceProvider
**_ [8 ] Provider: Hivelink\Laravel\ServiceProviderLaravel9_**
.
.
.
```

## Step 4 - Api-Key

Now you must define your [API Key](https://notif.hivelink.co/app/auth/login "API Key") to project. for this head to **config/hivelink.php** then put your API KEY in the code:

```
<?php
return [
    'apikey' => ' ',
];
```

### All Set

# Usage

You can use the package where ever you want.

- First use the class:

```php
use Hivelink;
```

Then use this pattern to send SMS:

```php
try{
    $sender = "9000****";	

    $message = "این یک پیام تست می باشد";

    $receiver = array("090********");

    $result = Hivelink::SendSimple($sender,$receiver ,$message);
    if($result){
        foreach($result as $r){
            var_dump($r)
        }
    }
}
catch(\Hivelink\Exceptions\ApiException $e){
    echo $e->errorMessage();
}
catch(\Hivelink\Exceptions\HttpException $e){
    echo $e->errorMessage();
}catch(\Exceptions $ex){
    echo $ex->getMessage()
}
```

Use this method get account balanced :

```php
try{
    $result = Hivelink::getCredit();
    if($result){
        var_dump($result);
    }
}
catch(\Hivelink\Exceptions\ApiException $e){
    echo $e->errorMessage();
}
catch(\Hivelink\Exceptions\HttpException $e){
    echo $e->errorMessage();
}
```
## Contribution

[https://notif.hivelink.co](https://notif.hivelink.co)
