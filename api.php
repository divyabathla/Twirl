<?php
require "php/init.php";

$responses["Tweet"] = array();
error_reporting(E_ALL); 
ini_set('display_errors', 1); 
if(isset($_POST["data"])){	
include 'twAPI.php';
$url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
$getfield = '?screen_name=Taranpreet Singh';
$requestMethod = 'GET';

$settings = array(
    'oauth_access_token' => "361992566-XkkGgJ10XL71n2mYriLpoFtvP6K4y1wpTRVfcmVx",
    'oauth_access_token_secret' => "rsniSXTs7zlrwun7V9OiOjVAT0thAFOfC8VgIp28B6RsK",
    'consumer_key' => "rDeuIpPB0jM9bweM1okYV8GhG",
    'consumer_secret' => "bomFl1QVZuTwQnVLSOtxDYm909RjnlVTDm6M0dzkLtw7VRvsaG"
);
$twitter = new TwitterAPIExchange($settings);
$response =  $twitter->setGetfield($getfield)
    ->buildOauth($url, $requestMethod)
    ->performRequest();
	$results = (array)json_decode($response,true);
	$result = [];
	
	$responses["success"] = 1;
	$allResult = [];
	foreach($results as $key => $val){
	$result['created_at'] = $val['created_at'];
	$result['id'] =  $val['id'];
		if(count($val['entities']['urls']) > 0){
			foreach($val['entities']['urls'] as $url){
				$result['expanded_url'] = $url['expanded_url'];
				$result['url'] = $url['url'];
			}
		}
		array_push($allResult,$result);
	} 
	array_push($responses["Tweet"], $allResult);
	//print_r($responses);
	echo json_encode($responses);
} 

/* echo "<pre>";
print_r($results);
echo "</pre>"; */ 
?>

<?php
/* echo "Url DB List: <br><br>";


foreach($results as $key => $val){
	echo $val['created_at'] . "<br>";
	echo $val['id'] . "<br>";
		if(count($val['entities']['urls']) > 0){
			foreach($val['entities']['urls'] as $url){
				//echo $url['expanded_url'] . "<br>";
				echo $url['url'] . "<br>";
			}
		}
		echo "<br>";
	} */

/*
MYSQL Details
Pass : GlD25TEWZW
user :  admin_tw 
Database :  admin_tw 
Table : tw
*?
?>