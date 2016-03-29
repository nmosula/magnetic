/* <![CDATA[ */
function ajax(ñ,url) {
var http_request = false;
if (window.XMLHttpRequest) { // Mozilla, Safari,... 
	http_request = new XMLHttpRequest(); 
	if (http_request.overrideMimeType) { 
		http_request.overrideMimeType('text/xml'); 
	} 
} else if (window.ActiveXObject) { // IE 
	try { 
		http_request = new ActiveXObject("Msxml2.XMLHTTP"); 
	}
catch (e) { 
	try { 
		http_request = new ActiveXObject("Microsoft.XMLHTTP"); 
	}
catch (e) {
// do nothing
	} 
}
}


if (!http_request) { 
	c.innerHTML = 'Unfortunatelly you browser doesn\'t support this feature.'; 
} 

http_request.onreadystatechange = function() { 
	if (http_request.readyState == 4) { 
		if (http_request.status == 200) { 
			c.innerHTML = http_request.responseText; 
		} else { 
			c.innerHTML = 'There was a problem with the request.(Code: ' + http_request.status + ')'; 
			} 
		} 
}
http_request.open('GET', url, true); 
http_request.send(null); 
}

function get_ajax(block, url) {
c = document.getElementById(block);
if (c.style.display == "none")	c.style.display = "block";
		c.innerHTML = '<center><img src="/ajax/img/bar120.gif" width="120" height="15" border="0" alt="loading"></center>';
		ajax(c,url);
}

function get_ajax_admin(block, url) {
c = document.getElementById(block);
if (c.style.display == "none")	c.style.display = "block";
		c.innerHTML = '<center><img src="/ajax/img/bar120.gif" width="120" height="15" border="0" alt="loading"></center>';
		ajax(c,url);
}