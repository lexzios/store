<?php
/*
Name: 			Twitter Feed
Written by: 	Okler Themes - (http://www.okler.net)
Version: 		3.1.1
*/

session_start();
require_once("twitteroauth/twitteroauth.php");

// Replace the keys below - Go to https://dev.twitter.com/apps to create the Application
$consumerkey = "x0WGHNejnPeQTIi7j2wElsS6r";
$consumersecret = "eYBJ03ymToXWCmiOLg2iHa2dTCvCEmAqf4biOj1k8ZZdMxmKdq";
$accesstoken = "1071656497-iHYkupkOzmcI0ymQ9ZdF7RhDiAOy4ClmV34gaIt";
$accesssecret = "tRmh7QT1BcS6x9WQ1XjrWvjwgxfN87yhXUiDlzWlV7ges";

$twitteruser = $_GET['twitteruser'];
$notweets = $_GET['notweets'];

function getConnectionWithAccessToken($cons_key, $cons_secret, $oauth_token, $oauth_token_secret) {
	$connection = new TwitterOAuth($cons_key, $cons_secret, $oauth_token, $oauth_token_secret);
	return $connection;
}

$connection = getConnectionWithAccessToken($consumerkey, $consumersecret, $accesstoken, $accesssecret);
$tweets = $connection->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=".$twitteruser."&count=".$notweets);

echo json_encode($tweets);
?>