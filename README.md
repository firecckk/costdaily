# README ! This project has not been finished yet !
##  This is the php server aiming to record personal daily costs
### You can build it by those steps following:
   1. Establish your lnmp server environment and make sure it works correctly;
   2. In config.php,To configure some basic informations about your server;



##########################
## Login process:
## 1. get dynamic key:
##        demo:  
##         $.ajax({
##        type: "POST",
##        url: "/interface/get_d_key.php",
##        data: JSON.stringify(data),
##        contentType: "application/json;charset=utf-8;",
##        dataType: "json",
##        complete: function (msg) {alert(msg);}});
##
##
##