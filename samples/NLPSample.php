<?php
require_once '../src/KlangooClient/MagnetAPIClient.php';

use KlangooClient\MagnetAPIClient;

$ENDPOINT = "https://nlp.klangoo.com/Service.svc";
$CALK = "enter you calk here";
$SECRET_KEY = "enter your secret key here";

$client = new MagnetAPIClient($ENDPOINT, $CALK, $SECRET_KEY);

$request = array("text" => "Hello \"World\"",
                 "lang" => "en",
                 "format" => "json");

$json = $client->CallWebMethod("ProcessDocument", $request, "POST");

print($json);
?>