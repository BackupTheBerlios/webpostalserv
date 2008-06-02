<?php
require_once '../interfaces/PostOffice.php';
require_once 'testData.php';

echo getSignatureFromMessage($message);
?>