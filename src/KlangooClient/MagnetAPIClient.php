<?php
/**************************************************************************************
 * 
 *  Copyright 2018, Klangoo Inc.
 *   
 *  requires 'curl' extension
 *  php.ini file:
 *  extension=curl
 *  [curl]
 *  curl.cainfo="ca-bundle.crt"
 * 
 *  Compatible with PHP version 5.2 and later
 * 
 * ************************************************************************************/
namespace KlangooClient;

class MagnetAPIClient
{
   private $_endpointUri;
   private $_calk;
   private $_secretKey;
  
   function __construct($endpointUri, $calk, $secretKey = NULL) {
	   $this->_endpointUri = $endpointUri;
	   $this->_calk = $calk;
	   $this->_secretKey = $secretKey;
   }
   
   function CallWebMethod($methodName, $request, $requestMethod) {
		
		if (!$this->HasCalk($request)){
			$request["calk"] = $this->_calk;
		}
   
		$signedQueryString = $this->GetSignedQueryString($methodName, $request, $requestMethod);

		$ch = curl_init();
	    if (strtolower($requestMethod) === "post") {
			curl_setopt($ch, CURLOPT_URL, $this->_endpointUri."/".$methodName);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $signedQueryString);
		}
		else {
			/* get */
			curl_setopt($ch, CURLOPT_URL, $this->_endpointUri."/".$methodName."?".$signedQueryString);
		}
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		
		$response = curl_exec($ch);

		if ($response === False){
			echo 'Curl error: ' . curl_error($ch);
		}

		curl_close($ch);
		
		return $response;
   }
   
   function GetSignedQueryString($methodName, $request, $requestMethod) {
      $request["timestamp"] = gmdate("Y-m-d\TH:i:s\Z");
	   
	  /* The params need to be sorted by the key */
      ksort($request);
	
	  $canonicalized_query = array();
 
      foreach ($request as $param=>$value)
      {
         $param = str_replace("%7E", "~", rawurlencode($param));
         $value = str_replace("%7E", "~", rawurlencode($value));
          $canonicalized_query[] = $param."=".$value;
      }
 
      $canonicalized_query = implode("&", $canonicalized_query);
	
	  $string_to_sign = strtolower($requestMethod)."\n".
	                  strtolower($this->_endpointUri)."\n".
					  strtolower($methodName)."\n".
					  $canonicalized_query;
					  
	  /* calculate the signature using HMAC, SHA256 and base64-encoding */
      $signature = base64_encode(hash_hmac("sha256", $string_to_sign, $this->_secretKey, True));
	
	  /* encode the signature for the request */
      $signature = str_replace("%7E", "~", rawurlencode($signature));
	
	  $signedQueryString = $canonicalized_query."&signature=".$signature;
	  
	  return $signedQueryString;
   }
   
    function HasCalk($request) {
		foreach ($request as $param=>$value)
		{
			if (strtolower($param) == "calk")
				return true;
		}
		return false;
    }
}
 
?>