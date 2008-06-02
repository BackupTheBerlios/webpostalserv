<?php
$messageName='purchaseGift';
$authorName='Buddy';
$password='password';
$envelopeFormat='SOAP1.1';
$messageHeader=createMessageHeader($messageName,$authorName,$password,$envelopeFormat);

$body='<gift><value>30EUR</value></gift>';
$bodyFormat='XML';
$bodyArray=null;
$messageBody=createMessageBody($body,$bodyFormat,$bodyArray);

$message='<ns:webmessage "xmlns:ns="http://www.pantouflette.fr/lampadaire">'.
'<header>'.
'<messageName>'.$messageName.'</messageName>'.
'<callingPartyID>'.$authorName.'</callingPartyID>'.
'<callingPartyKey>ABCDEFGHIJKLMNOP</callingPartyKey>'.
'</header>'.
'<body>'.
$body.
'</body>'.
'</ns:webmessage>';



$envelope='<?xml version="1.0" encoding="UTF-8"?>'.
'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope">'.
'<env:Body>'.
$message.
'</env:Body>'.
'</env:Envelope>';

$signatureCheckStatus=true;
$exchangeStatus='EXCHANGE_FAILED';
$exception='<exception>Server failure</exception>';
$body=null;
$exchangeReceipt=createExchangeReceipt($signatureCheckStatus, $exchangeStatus, $exception, $body);


?>