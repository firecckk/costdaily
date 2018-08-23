<?php
require_once __DIR__ . '/../lib/log.php';
require_once __DIR__ . '/../config.php';

$postData = file_get_contents('php://input'); 
logOutput($postData);

$res = json_decode($postData,true);
echo($res['name'] . phpinfo());

?>