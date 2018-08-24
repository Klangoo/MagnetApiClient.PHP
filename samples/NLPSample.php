<?php
require_once '../src/KlangooClient/MagnetAPIClient.php';

use KlangooClient\MagnetAPIClient;

$ENDPOINT = "https://nlp.klangoo.com/Service.svc";
$CALK = "3D5F1F4B-1C47-40D7-B687-476C55EB591A";
$SECRET_KEY = "zrKEvs8kISrVzpWp4e5xqxqBiX4HSD9NqJfYpWRa";

$client = new MagnetAPIClient($ENDPOINT, $CALK, $SECRET_KEY);

$request = array("text" => "Hello \"World\"",
                 "lang" => "en",
                 "format" => "json");

$json = $client->CallWebMethod("ProcessDocument", $request, "POST");

print($json);
?>