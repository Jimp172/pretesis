<?php
@session_start(); 
/**
 * 
 */
class telegram
{
	
	function __construct()
	{
		
	}
	function enviar_mensaje($mensaje,$id_telegram)
	{
		$token = "5120429574:AAFujn0i9D_WJuC42G0X3UaXuSf3zP5z2UA";		
		$id = $id_telegram;
		$urlMsg = "https://api.telegram.org/bot{$token}/sendMessage";
		$msg = $mensaje;
		 
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $urlMsg);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "chat_id={$id}&parse_mode=HTML&text=$msg");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		 
		$server_output = curl_exec($ch);
		curl_close($ch);

	}
}
?>