<?php

function settoken()
{
     $str = md5(uniqid(md5(microtime(true)),true));  //生成一个不会重复的字符串
     $str = sha1($str);  //加密
     return $str;
}  


?>