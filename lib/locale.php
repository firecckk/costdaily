<?php
# need config file
#require_once __DIR__ . '/config.php';

$LOCALE_PACKAGE = GetPackages($LOCALE_PACKAGE_DIR) ;
$LOCALE_PACKAGE_arr= json_decode('{' . substr($LOCALE_PACKAGE,0,strlen($LOCALE_PACKAGE)-1) . '}',false);

$LOCALE = array();
$LOCALE = json_decode(json_encode($LOCALE_PACKAGE_arr->$LANGUAGE),true);
if($LOCALE == NULL) die ('No Such Language or Bad Package');
#var_dump($LOCALE);

#Local($words) to get translated words
function Locale($keywords){
    global $LOCALE;
    $res = $LOCALE[$keywords];
    if($res == NULL) return( $keywords . ' *not find*');
    return $res;
}

#Read all the files under the $path
function GetPackages($path){
    $bag = '';
    $files = scandir($path);
    foreach ($files as $file) {
        if ($file != '.' && $file != '..') {
            if (is_dir($path . $file)) {
                $bag = $bag . GetPackages($path . $file . '/');
            } else {
                $rfile = fopen($path . $file, "r") or die("Unable to open file!" . $path . basename($file));
                #echo('Reading file : ' . $path . $file . "\n");
                $bag = $bag .  fread($rfile,filesize($path . $file)) . ',';
                fclose($rfile);
            }
        }
    }
    return $bag;
}

?>