<?php
    require_once __DIR__ .'/config.php';
    require_once __DIR__ . '/lib/locale.php';


    Init_mysql();

    function Init_mysql(){
        global $MYSQL_HOST_ADDRESS, $MYSQL_USERNAME, $MYSQL_PASSWORD;
        $con = mysqli_connect($MYSQL_HOST_ADDRESS,$MYSQL_USERNAME,$MYSQL_PASSWORD) or die( Locale('mysql connection failed') . ':'.mysqli_error());
        echo(Locale('mysql connection successed') . '\n');

        $commands = array(
            'CREATE TABLE IF NOT EXISTS`costdaily`.`dynamic_key` (   `username` varchar(20) NOT NULL,   `d_key` int(9) NOT NULL,   `expired` int(11) NOT NULL ) ENGINE=InnoDB;',
            ';');

        foreach ($commands as $cmd){
            if (mysqli_query($con,$cmd)){
            echo ($cmd . "\t -- " . Locale('successed') . "\n");
            } else {
            die ( $cmd . "\t ++ " . Locale('failed') . "\n");}
        }
        mysql_close($con);
    }    

    echo('init finished');
    
?>