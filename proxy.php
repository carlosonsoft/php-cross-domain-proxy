<?php
 
$post_data =  file_get_contents("php://input");

$request_headers = getallheaders();

$request_url=$request_headers['X-Proxy-URL'];
unset($request_headers['X-Proxy-URL']);
 
$ch = curl_init($request_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);
curl_setopt($ch, CURLOPT_HTTPHEADER, $request_headers);
curl_setopt($ch, CURLOPT_HEADER, true);
curl_setopt($ch, CURLOPT_COOKIE, $request_headers["Cookie"]);

if ( strlen($post_data)>0 ){
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
}

$response = curl_exec($ch);     

if (curl_errno($ch)) {
    print curl_error($ch);
} else {
    curl_close($ch);

	$parts = explode("\r\n\r\n", $response);
	$headers = array_shift($parts);

	  // Send headers
	  foreach (explode("\r\n", $headers) as $header) {
	    $header = trim($header);
	    if ($header) header($header);
	  }
			  
	  echo implode("\r\n\r\n", $parts);     
	  
}

?>
