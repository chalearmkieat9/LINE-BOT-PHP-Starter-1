<?php
$access_token = 'L0M5+YN1uoAJxEmNB5QyKRj5HT3JnTNuoVdDQVejTjadoAOKYCW9IpJ3mLYGEbQZjD5kwIp/j0nRFVi01TR/l6c3D9jAqf4zbl+3WyrxqO5U3t/LnKzCd+EIs6i9p4Pjt6/2sWu3nsefZFtGqrBUjgdB04t89/1O/w1cDnyilFU=';
// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get text sent
			$receive_text = $event['message']['text'];
			// Get replyToken
			$replyToken = $event['replyToken'];
			// Get userId
			$userId = $event['source']['userId'];
			// Get groupId
			$groupId = $event['source']['groupId'];
			
			$text = 'userId: '.$userId."\r\ngroupId: ".$groupId;
			// Build message to reply back
			$messages = [
				'type' => 'text',
				'text' => json_encode($event)//$text
			];

			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];
		}
		else if($event['type'] == 'join' && $event['source']['type'] == 'group') { // join group
			// Get replyToken
			$replyToken = $event['replyToken'];
			// Get groupId
			$groupId = $event['source']['groupId'];
			
			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/push';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];
		}
	}
}

		// Build message to reply back
// 		$messages = [
// 			'type' => 'text',
// 			'text' => json_encode($event)//$text
// 		];

// 		// Make a POST Request to Messaging API to reply to sender
// 		$url = 'https://api.line.me/v2/bot/message/push';
// 		$data = [
// 			'to' => 'U8179e1dadec0da8c8b3b5cb1f370b14d',
// 			'messages' => [$messages],
// 		];

// 		$post = json_encode($data);
// 		$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);
// 		$ch = curl_init($url);
// 		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
// 		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// 		curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
// 		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
// 		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
// 		$result = curl_exec($ch);
// 		curl_close($ch);
// 		echo $result . "\r\n";
?>
