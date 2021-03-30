<?php 
/**
 * Template Name: Api
**/
/*
$arr = array(
  
  'id' => 102,
  'ProductName' => 'hairoil',
  'ProductCode' =>  'SUK-101',

);

$xml = new XMLWriter();
$xml->openURI("php://output");
$xml->startDocument();
$xml->setIndent(true);
$xml->startElement('Inart');
$xml->startElement('products');
 //foreach here
  foreach ($arr as $key => $value) {
    
    
      $xml->startElement($key);
      $xml->writeRaw($value);
      $xml->endElement();
    
  }
$xml->endElement();
$xml->endElement();
header('Content-type: text/xml');
$xml->flush();
*/
$base_url = 'https://www.inart.com/';
$gr_url   = $base_url . 'api/rest/products/store/1';   //Products in Greek language
$en_url   = $base_url . 'api/rest/products/store/2';   //Products in English Language

$consumer_key    = '3626311748bcf2072da2bd475fccfa3c';
$consumer_secret = '0cbb0df8d840e22b96d4f80449e7e0b7';
$token           = '0ec8d706bc2735b770469832af2f4953';
$token_secret    = '0d9ff40d9e1e3e13e452ee855b184b77';

$parameters = array();

$headers    = array(
    'Content-Type' => 'text/xml',
    'Accept'       => 'text/xml'
);

$filters    = array(
    //Number of products per page (Default 10, Max 100)
    'limit' => 5,
    //Number of page to fetch
    'page'  => 1
); 
//For more filters visit: http://devdocs.magento.com/guides/m1x/api/rest/get_filters.html

$url = $gr_url . '?' . http_build_query($filters);

try {
    $oauthClient = new OAuth($consumer_key, $consumer_secret, OAUTH_SIG_METHOD_PLAINTEXT, OAUTH_AUTH_TYPE_AUTHORIZATION);

    $oauthClient->setToken($token, $token_secret);

    $oauthClient->fetch($url, $parameters, OAUTH_HTTP_METHOD_GET, $headers);
     
    $response = $oauthClient->getLastResponse();
    $xml = new XMLWriter();
    $xml->openURI("php://output");
    $xml->startDocument();
    $xml->setIndent(true);
    $xml->startElement('Inart');
    $xml->writeRaw($response);
    $xml->endElement();
    $xml->flush();
    
   /*
    foreach ($raw_data as $i => $in_array) {
       
         echo "<pre>";print_r($in_array);
       }
       
    
    $xml = new XMLWriter();
    $xml->openURI("php://output");
    $xml->startDocument();
    $xml->setIndent(true);
    $xml->startElement('Inart');
    //foreach here
   // echo "<pre>";print_r($products);exit;
    foreach ($products as $key => $in_arr) {
       
       $xml->startElement('product');
      foreach($in_arr as $tag => $value) {

         $xml->startElement($tag);
         $xml->writeRaw($value);
         $xml->endElement();
      }
      $xml->endElement();
    }
     $xml->endElement();
     header('Content-type: text/xml');
     $xml->flush();*/

} catch (Exception $e) {
    echo $e->getMessage();
}