# README ! This project has not been finished yet !
##  This aims to record personal daily costs based on lnmp
### You can build it by those steps following:
   1. Establish your lnmp server environment and make sure it works correctly;
   2. In config.php,To configure some basic informations about your server;



##########################
## Login process:
# get RSA public key for encrypting user's password and tkey.
# generate tkey by client js, whcih allows AES encode for later connection.


## get dynamic key:
```
demo:  
         $.ajax({
        type: "POST",
        url: "/interface/get_d_key.php",
        data: JSON.stringify(data),
        contentType: "application/json;charset=utf-8;",
        dataType: "json",
        complete: function (msg) {alert(msg);}});
```
