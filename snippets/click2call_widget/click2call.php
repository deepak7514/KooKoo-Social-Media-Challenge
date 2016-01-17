<?php
	function POST($url,$params=false){
		$opts = array('http' =>
					array(
							'method'  => 'POST',
							'header'  => 'Content-type: application/x-www-form-urlencoded',
							'content' => $params));

		$context = stream_context_create($opts);
		$fp = fopen($url, 'rb', false, $context);
		$result = stream_get_contents($fp);

		return $result;
	}
	function GET($url){
		$opts = array('http' =>
					array(
						'method' => 'GET',
						'ignore_errors' => '1'));

		$context = stream_context_create($opts);
		$stream = fopen($url, 'r', false, $context);

		// actual data at $url
		$result =stream_get_contents($stream);
		fclose($stream);
		
		return $result;
	}
//This is the number which the web site customer entered.
$number=$_REQUEST['number'];
//This is the number which will be connected to the customer. Replace this with your number
$dial_to='911130803659';
//replace this with your KooKoo API key
$api_key='KKe2cdcc75b1951bf32c423e4f145894ee';
//$click2call = curl_init();
$url = "http://www.kookoo.in/outbound/outbound.php?phone_no=0".$number."&api_key=".$api_key."&extra_data=<response><dial>".$dial_to."</dial></response>";
//curl_setopt($click2call, CURLOPT_URL, $url);
//curl_setopt($click2call, CURLOPT_RETURNTRANSFER, true);
//execute post
//$result = curl_exec($click2call);
$result=GET($url)
$arr=array("html"=>"<font color='#00CC99'>Queued</font>");
header('Content-type: text/javascript');
$jsonp = $_REQUEST['callback']."(".json_encode($arr).")";
echo $jsonp;
//You can add you own error checking or storing in database etc here.
//curl_close ($click2call);
?>
