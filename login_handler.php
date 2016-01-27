<?php 
function cas_authentication($ticket){
   $cas_response = http_get("https://login.oregonstate.edu/cas/serviceValidate?ticket=" . $ticket . "&service=http://web.engr.oregonstate.edu/~malickc/");
   echo $cas_response
}
?>
