<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//-------------------------------------------------------------------
//-------------------------------------------------------------------
//-------
//-------      Configs comes here
//-------
//-------------------------------------------------------------------
//-------------------------------------------------------------------

$config['baseUrl'] = 'https://staging.payu.co.za'; //staging environment URL
//$config['baseUrl'] = 'https://secure.payu.co.za'; //production environment URL

$config['soapWdslUrl'] = $config['baseUrl'].'/service/PayUAPI?wsdl';
$config['payuRppUrl'] = $config['baseUrl'].'/rpp.do?PayUReference=';
$config['apiVersion'] = 'ONE_ZERO';

//set value != 1 if you dont want to auto redirect topayment page
$config['doAutoRedirectToPaymentPage'] = 1;

/*
Store config details
*/
$config['safeKey'] = '{45D5C765-16D2-45A4-8C41-8D6F84042F8C}';
$config['soapUsername'] = 'Staging Integration Store 1';
$config['soapPassword'] = '78cXrW1W'; 
