<?php
$access_token='1N3AcyxVAGjcEX7jYzAuRLTbyhCFH84ZOZSvoVogPgIa0VqnJg+eh7q9MrsWUeFKKj1oDSB1qMznR7D66RAiqncYuxrGLnncaGyBG4rR1YJe4Kedi0inAp/eUH8YRIsP3nt/00MzSru9ClXdH17EKwdB04t89/1O/w1cDnyilFU=';
require_once('./database.php');
$json_str=file_get_contents('php://input');
$json_obj = json_decode($json_str);

$reply_token = $json_obj->{'events'}[0]->{'replyToken'};

$type = $json_obj->{'events'}[0]->{'type'};

if($type=="message"){
        $msg_text=$json_obj->{'events'}[0]->{'message'}->{'text'};
        error_log($msg_text);
        $message = array(
            'type' => 'text',
	    'text' => '【'.$msg_text.'】かぁ〜');
	insert_database($msg_text,1);
}
$postdata=array('replyToken'=>$reply_token,'messages'=>array($message));
error_log(json_encode($postdata));
$ch = curl_init('https://api.line.me/v2/bot/message/reply');
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postdata));
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charser=UTF-8','Authorization: Bearer ' . $access_token));
$result = curl_exec($ch);
error_log($result);
curl_close($ch);
?>
