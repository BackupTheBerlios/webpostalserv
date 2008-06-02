<?php

require_once 'Configuration.php';
require_once '../interfaces/MailSignature.php';
require_once '../interfaces/PublicInterface.php';
require_once '../interfaces/PostOffice.php';

 function simpleCreateMessage($messageHeader,$messageBody){
	
 	$message ='<ns:webmessage "xmlns:ns="'.XML_NAMESPACE_URL.'">';
 	if($messageHeader['version']!=null){
 		$message .='<header version="'.$messageHeader['version'].'">';
 	}
 	else {
 		$message .='<header>';
 	}
 	$message .='<messageName>';
 	$message .=$messageHeader['messageName'];
 	$message .='</messageName>';
 	$message .='<authorName>';
 	$message .=$messageHeader['authorName'];
 	$message .='</authorName>';
 	$message .='<messageSignature>';
 	if(WITH_SIGNATURE)$message .=signMessage($messageHeader['password'],$messageBody['body']);
 	$message .='</messageSignature>';
 	$message .='</header>';
 	$message .='<body>';
 	$message .=$messageBody['body'];
 	$message .='</body>';
 	$message .='</ns:webmessage>';
 	return $message;
 	
 }
 
 function simplePostMessageAndGetReceipt($messageHeader, $messageBody){
 $message=createMessage($messageHeader,$messageBody);
 $envelope=putMessageIntoEnvelope($message,$messageHeader);
 $responseEnvelope=sendEnvelopeAndReceiveResponse($envelope,$messageHeader);
 $password=$messageHeader['password'];
 return receiveEnvelopeAndGiveReceipt($envelope,$password);
}
 
 function simplePutMessageIntoEnvelope($message, $messageHeader){

 $envelope ='<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope">';
 $envelope .='<env:Body>';
 $envelope .='<env:Body>';
 $envelope .=$message;
 $envelope .='</env:Body>';
 $envelope .='</env:Envelope>';
 return $envelope;
 
 }
 
 function simpleSendEnvelopeAndReceiveResponse($envelope,$messageHeader){
 	
  $httpHeaders = array(); 
  $httpHeaders[] = "Content-Type: application/soap+xml; charset=UTF-8"; 
  //$httpHeaders[] = "Accept: application/soap+xml; charset=UTF-8"; 
  $curlSession = curl_init();     
  curl_setopt($curlSession, CURLOPT_URL,$messageHeader['destinationURL']);  
  curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, 1); 
  curl_setopt($curlSession, CURLOPT_HTTPHEADER, $httpHeaders); 
  curl_setopt($curlSession, CURLOPT_TIMEOUT, 4);  
  if(WITH_SSL){
  curl_setopt($curlSession, CURLOPT_SSL_VERIFYPEER, true); 
  curl_setopt($curlSession, CURLOPT_SSL_VERIFYHOST, 2); 
  }
  curl_setopt($curlSession, CURLOPT_POST, 1);  
  curl_setopt($curlSession, CURLOPT_POSTFIELDS, $envelope); 
  $responseEnvelope = curl_exec($curlSession); 
  curl_close($curlSession); 
	return  $responseEnvelope;
 }
 
 function simpleReceiveEnvelopeAndGiveReceipt($envelope,$password){
 
 $message=getMessageFromEnvelope($envelope);
 
 $messageName=getMessageNameFromMessage($message);
 $authorName=getAuthorNameFromMessage($message);
 $messageHeader=array();
 $messageHeader['messageName']=$messageName;
 $messageHeader['authorName']=$authorName;
 
 $messageBody=getMessageBodyFromMessage($message);
 
 $signature=getSignatureFromMessage($message);
 
 $signatureCheckStatus=checkMessageSignature($password , $messageBody['body'], $signature);
 
  
 if(!$signatureCheckStatus){
 $exchangeStatus='EXCHANGE_FAILED';
 $exchangeReceipt=createExchangeReceipt($signatureCheckStatus,$exchangeStatus,null,null);
 $messageBody['body']=writeExchangeReceipt($exchangeReceipt);
 $message=createMessage($messageHeader,$messageBody);
 return putMessageIntoEnvelope($message,$messageHeader);
 }
 
 $exchangeReceipt=receiveMessageAndGiveReceipt($messageHeader, $messageBody);
 
 $messageBody['body']=writeExchangeReceipt($exchangeReceipt);
 $message=createMessage($messageHeader,$messageBody);
 return putMessageIntoEnvelope($message,$messageHeader);
}
	
function simpleGetMessageFromEnvelope($envelope) {
 
 $message=strstr($envelope,'<env:Body>');
 $message=substr($message,strlen('<env:Body>'));
 $message=substr($message,0,strlen($message)-strlen('<env:Body></env:Envelope>'));

 return $message;
}

function simpleGetMessageNameFromMessage($message) {

$messageName=strstr($message,'<messageName>');
$messageName=substr($messageName,strlen('<messageName>'));
$messageName=substr($messageName,0,strlen($messageName)-strlen(strstr($messageName,'</messageName>')));

return $messageName;
}

function simpleGetMessageBodyFromMessage($message) {

$body=strstr($message,'<body>');
$body=substr($body,strlen('<body>'));
$body=substr($body,0,strlen($body)-strlen(strstr($body,'</body>')));
$messageBody=array();
$messageBody['body']=$body;
$messageBody['bodyFORMAT']='XML';

return $messageBody;


}

function simpleGetSignatureFromMessage($message) {

$signature=strstr($message,'<messageSignature>');
$signature=substr($signature,strlen('<messageSignature>'));
$signature=substr($signature,0,strlen($signature)-strlen(strstr($signature,'</messageSignature>')));

return $signature;
 
}

function simpleGetAuthorNameFromMessage($message) {

$authorName=strstr($message,'<authorName>');
$authorName=substr($authorName,strlen('<authorName>'));
$authorName=substr($authorName,0,strlen($authorName)-strlen(strstr($authorName,'</authorName>')));

return $authorName;
 
}


function simpleWriteExchangeReceipt($exchangeReceipt){
	if($exchangeReceipt['body'])return$exchangeReceipt['body'];
 	$receipt='<ack>';
	$receipt.='<exchangeStatus>';
	$receipt.= $exchangeReceipt['exchangeStatus']; 
	$receipt.='</exchangeStatus>';
	if($exchangeReceipt['exchangeStatus']=='EXCHANGE_FAILED'){
	$receipt.=$exchangeReceipt['exception'];
	}
	$receipt .='</ack>';
	return $receipt;
 }
             
?>