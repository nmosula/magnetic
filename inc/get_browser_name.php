<?
  $agent=getenv("HTTP_USER_AGENT");
    if(strlen($agent)>2&&strstr($agent, 'Firefox'))
    {
       // ��� ��� Netscape
		$browser_name="firefox";
    }
    else
    {
       // ��� ��� IE
		$browser_name="IE";
    }
?>