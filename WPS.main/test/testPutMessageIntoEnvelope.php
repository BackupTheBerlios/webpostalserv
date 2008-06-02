<?php
require_once '../interfaces/PostOffice.php';
require_once 'testData.php';

$message=createMessage($messageHeader,$messageBody);
echo putMessageIntoEnvelope($message,$messageHeader);
?>