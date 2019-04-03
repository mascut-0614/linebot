<?php
$access_token='1N3AcyxVAGjcEX7jYzAuRLTbyhCFH84ZOZSvoVogPgIa0VqnJg+eh7q9MrsWUeFKKj1oDSB1qMznR7D66RAiqncYuxrGLnncaGyBG4rR1YJe4Kedi0inAp/eUH8YRIsP3nt/00MzSru9ClXdH17EKwdB04t89/1O/w1cDnyilFU='
$json_str=file_get_contents('php://input');
$json_obj = json_decode($json_str);

$reply_token = $json_obj->{'events'}[0]->{'replyToken'};

$type = $json_obj->{'events'}[0]->{'type'};

if($type=="message"){
        $msg_text=$json_obj->{'events'}[0]->{'message'}->{'text'};
        $message = array(
            'type' => 'text',
            'text' => '【'.$msg_text.'】かぁ〜');
}
$postdata=array('replyToken'=>$reply_token,'messages'=>array($massage));
$ch = curl_init('https://api.line.me/v2/bot/message/reply');
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postdata));
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charser=UTF-8','Authorization: Bearer ' . $access_token));
$result = curl_exec($ch);
curl_close($ch);
?>
