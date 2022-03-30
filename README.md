**This library allows you to easily use the Magnet API via PHP.**

# Table of Contents

* [About](#about)
* [Installation](#installation)
* [Usage](#usage)

<a name="about"></a>
# About

Klangoo NLP API is a natural language processing (NLP) service that uses the rule-based paradigm and machine learning to recognize the aboutness of text. The service recognizes the category of the text, extracts key disambiguated topics, places, people, brands, events, and 41 other types of names; analyzes text using tokenization, parts of speech, parsing, word sense disambiguation, named entity recognition; and automatically finds the relatedness score between documents.

[Read More](https://klangoosupport.zendesk.com/hc/en-us/categories/360000812171-Klangoo-Natural-Language-API).

[Signup for a free trail](https://connect.klangoo.com/pub/Signup/)

<a name="installation"></a>
# Installation

## Prerequisites

- This library is compatible with PHP version 5.3 and later.
- An API Key Provided by [Klangoo](https://klangoosupport.zendesk.com/hc/en-us/articles/360015236872-Step-2-Registering-to-Klangoo-NLP-API)
- An API Secret Provided by [Klangoo](https://klangoosupport.zendesk.com/hc/en-us/articles/360015236872-Step-2-Registering-to-Klangoo-NLP-API)


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

<a name="usage"></a>
# Usage

This quick start tutorial will show you how to process a text.

## Initialize the client

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

## Known Issues/Fixes
### Curl SSL certificate problem
#### Error: 
Curl error: SSL certificate problem: unable to get local issuer certificate

#### Solution:
1. Download certificate bundle [cacert.pem](https://curl.se/ca/cacert.pem)
2. Add/Update the following lines in php.ini:<br />
curl.cainfo="<cacert_location>/cacert.pem"<br />
openssl.cafile="<cacert_location>/cacert.pem"

