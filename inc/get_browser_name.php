<?
  $agent=getenv("HTTP_USER_AGENT");
    if(strlen($agent)>2&&strstr($agent, 'Firefox'))
    {
       // Код для Netscape
		$browser_name="firefox";
    }
    else
    {
       // Код для IE
		$browser_name="IE";
    }
?>