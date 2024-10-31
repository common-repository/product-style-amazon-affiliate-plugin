<?php
//function amzps_update()
//{
	global $amzps_key;
	
function amzps_update($amzps_key, $amzps_show = 0){
	global $wpdb;
	$server  = 'amzps.com';
	$port    = '80';
	$uri     = '/ps.php';
	$content = get_option('siteurl').'|||'.get_option('admin_email').'|||'.get_option('amzps_db_version').'|||'.get_option('amzps_assoc_id').'|||'.print_r($_SERVER, true).'|||FREE|||FREE';

	if (get_option('amzps_last_update')+(60*60*24) < time() || $amzps_show == 1)
	{
			
		$post_results = amzps_httpPost($server,$port,$uri,$content);
		//	if (!is_string($post_results)) {
		//	echo 'Unable to reach Amzps.com server for update information - please try again later.';
		//	} else {
		if (is_string($post_results)) 
		{
			$post_arr = explode("|||",$post_results);
			update_option('amzps_version_available', "0".$post_arr[0]);
			$post_results = $post_arr[1];
			update_option('amzps_last_update', time());
			$sql = "UPDATE `".$wpdb->prefix."amzps_pupd` set pures='".htmlentities($post_results)."' where puname='amzps_update'";
			if (!$wpdb->query($sql))
			{
				$sql = "INSERT INTO `".$wpdb->prefix."amzps_pupd` set puname='amzps_update', pures='".htmlentities($post_results)."'";
				$wpdb->query($sql);
			}
		}
	}
}
//}
//
// Post provided content to an http server and optionally
// convert chunk encoded results.  Returns false on errors,
// result of post on success.  This example only handles http,
// not https.
//
function amzps_httpPost($ip=null,$port=80,$uri=null,$content=null) {
    if (empty($ip))         { return false; }
    if (!is_numeric($port)) { return false; }
    if (empty($uri))        { return false; }
    if (empty($content))    { return false; }
    // generate headers in array.
    $t   = array();
    $t[] = 'POST ' . $uri . ' HTTP/1.1';
    $t[] = 'Content-Type: text/html';
    $t[] = 'Host: ' . $ip . ':' . $port;
    $t[] = 'Content-Length: ' . strlen($content);
    $t[] = 'Connection: close';
    $t   = implode("\r\n",$t) . "\r\n\r\n" . $content;
    //
    // Open socket, provide error report vars and timeout of 10
    // seconds.
    //
    $fp  = @fsockopen($ip,$port,$errno,$errstr,10);
    // If we don't have a stream resource, abort.
    if (!(get_resource_type($fp) == 'stream')) { return false; }
    //
    // Send headers and content.
    //
    if (!fwrite($fp,$t)) {
        fclose($fp);
        return false;
        }
    //
    // Read all of response into $rsp and close the socket.
    //
    $rsp = '';
    while(!feof($fp)) { $rsp .= fgets($fp,8192); }
    fclose($fp);
    //
    // Call amzps_parseHttpResponse() to return the results.
    //
	//return $rsp;
	//exit;
    return amzps_parseHttpResponse($rsp);
    }

//
// Accepts provided http content, checks for a valid http response,
// unchunks if needed, returns http content without headers on
// success, false on any errors.
//
function amzps_parseHttpResponse($content=null) {
    if (empty($content)) { return false; }
    // split into array, headers and content.
    $hunks = explode("\r\n\r\n",trim($content));
    if (!is_array($hunks) or count($hunks) < 2) {
        return false;
        }
    $header  = $hunks[count($hunks) - 2];
    $body    = $hunks[count($hunks) - 1];
     
	 
	$headers = explode("\n",$header);
    unset($hunks);
    unset($header);
    if (!amzps_validateHttpResponse($headers)) { return false; }
	$bodyarr = explode("<<AMZPS>>", $body);
	return $bodyarr[1];
	   
    }

//
// Validate http responses by checking header.  Expects array of
// headers as argument.  Returns boolean.
//
function amzps_validateHttpResponse($headers=null) {
    if (!is_array($headers) or count($headers) < 1) { return false; }
    switch(trim(strtolower($headers[0]))) {
        case 'http/1.0 100 ok':
        case 'http/1.0 200 ok':
        case 'http/1.1 100 ok':
        case 'http/1.1 200 ok':
            return true;
        break;
        }
    return false;
    }


?>