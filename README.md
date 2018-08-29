# Magnet API Client for PHP

# Getting Started



## Supported platforms

This library is compatible with PHP version 5.3 and later.

## Install

### With composer (Recommended)

Install the package via [Composer](https://getcomposer.org/doc/00-intro.md):

```bash
composer require klangoo/magnetapiclient.php
```

### Without composer

If you don't use Composer, you can download the [package](https://github.com/Klangoo/MagnetApiClient.PHP/archive/master.zip) and include it in your code.

```php
require_once 'MagnetApiClient.PHP-master/klangooclient.php';
```

## Quick Start

This quick start tutorial will show you how to process a text

### Initialize the client

To begin, you will need to initialize the client. In order to do this you will need your API Key **CALK** and **Secret Key**.
You can find both on [your Klangoo account](https://connect.klangoo.com/).

```php
// composer autoload
require __DIR__ . '/vendor/autoload.php';

// if you are not using composer
// require_once 'path/to/klangooclient.php';

use KlangooClient\MagnetAPIClient;

$ENDPOINT = "https://nlp.klangoo.com/Service.svc";
$CALK = "enter your calk here";
$SECRET_KEY = "enter your secret key here";

$client = new MagnetAPIClient($ENDPOINT, $CALK, $SECRET_KEY);

$request = array("text" => "Real Madrid transfer news",
                 "lang" => "en",
                 "format" => "json");

$json = $client->CallWebMethod("ProcessDocument", $request, "POST");
```