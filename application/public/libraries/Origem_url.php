<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Origem_url {
	
	var $CI;
	
	function Origem_url ()
	{	
		$this->CI =& get_instance();
		$this->origem();
	}
	
	function origem(){
		@$utm_source 	= @$_GET['utm_source'];
		@$utm_medium 	= @$_GET['utm_medium'];
		@$utm_content 	= @$_GET['utm_content'];
		@$utm_campaign 	= @$_GET['utm_campaign'];
		
		@$url = $utm_source."__".$utm_medium."__".$utm_content."__".$utm_campaign;
		
		
		@session_cache_expire(1440);
		@session_start();
		
		if(!@$_SESSION['origem'])
		{
			@$_SESSION['origem']	= @$_SERVER['HTTP_REFERER'];
		}
		if(!@$_SESSION['url'])
		{
			@$_SESSION['url']		= @$url;
		}
	}
}

?>