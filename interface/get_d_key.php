<?php
## post -- json
## username
##
## send / return dynamic key code -- int[6]
##

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../lib/locale.php';
require_once __DIR__ . '/../lib/db.php';
require_once __DIR__ . '/../lib/checker.php';
require_once __DIR__ . '/../lib/log.php';

$key = '';

$postData = file_get_contents('php://input'); 
if(is_json($postData)){
    $res = json_decode($postData,true);
} else {
    $err = locale('invalid posts!');
    logOutput(array($err => $postData));
    die($err);
}

$user_name = $res['username'];
if(is_username($user_name)){
    $key = generate_code(6);
} else {
    $err = locale('invalid username!');
    logOutput(array($err => $user_name));
    die($err);
}

$db = new DB($MYSQL_HOST_ADDRESS, $MYSQL_HOST_PORT, $MYSQL_USERNAME, $MYSQL_PASSWORD, $MYSQL_DATABASE, 'utf8');
$get_old_expired = $db->getAll('SELECT `expired` FROM `dynamic_key` WHERE `username` = "'. $user_name . '" ');

/*
ob_start();
var_dump($get_old_expired);
$result = ob_get_clean();
logOutput($result);
*/

if(!array_key_exists("expired",$get_old_expired[0])){
    $db->query('INSERT INTO `dynamic_key` (`username`, `d_key`, `expired`) VALUES ("' . $user_name . '", ' . $key . ', ' . (time()+300) . ');');
    echo($key);
} else  {
    if($get_old_expired[0]['expired'] -240 > time()){
        //has not been 5 min
        echo('key code has been sended, plese wait for 1 min');
    } else {
        $key = generate_code(6);
        $db->query('UPDATE`dynamic_key`SET `expired` =' . (time()+300) . ' , `d_key`=' . $key . ' WHERE `username`="' . $user_name . '"');
        echo($key);
    }
}

### needs improve : allows key being sended by email or message;


function generate_code($length = 6) {
    return rand(pow(10,($length-1)), pow(10,$length)-1);
}

?>