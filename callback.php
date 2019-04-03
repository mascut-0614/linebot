<?php
$access_token='1N3AcyxVAGjcEX7jYzAuRLTbyhCFH84ZOZSvoVogPgIa0VqnJg+eh7q9MrsWUeFKKj1oDSB1qMznR7D66RAiqncYuxrGLnncaGyBG4rR1YJe4Kedi0inAp/eUH8YRIsP3nt/00MzSru9ClXdH17EKwdB04t89/1O/w1cDnyilFU='

$json_string = file_get_contents('php://input');

$json_obj = json_decode($json_string);

$reply_token = $json_obj->{'events'}[0]->{'replyToken'};

$type = $json_obj->{'events'}[0]->{'type'};

if($type=="message"){
        $msg_text=$json_obj->{'events'}[0]->{'message'}->{'text'};
        if($msg_text === '予約') {
            $message = array(
                'type' => 'template',
                'altText' => 'いつのご予約ですか？',
                'template' => array(
                    'type' => 'confirm',
                    'text' => 'いつのご予約ですか？',
                    'actions' => array(
                        array(
                            'type' => 'postback',
                            'label' => '予約しない',
                            'data' => 'action=back'
                        ), array(
                            'type' => 'datetimepicker',
                            'label' => '期日を指定',
                            'data' => 'datetemp',
                            'mode' => 'date'// date：日付を選択します。time：時刻を選択します。datetime：日付と日時を選択します。
                        )
                    )
                )
            );
        } else {
            $message = array(
                'type' => 'text',
                'text' => '【'.$msg_text.'】っておいしい？');
        }
}elseif($type=="postback"){
  $postback = $json_obj->{'events'}[0]->{'postback'}->{'data'};
  if($postback === 'datetemp') {
      $message = array('type' => 'text','text' => '【'.$json_obj->{'events'}[0]->{'postback'}->{'params'}->{'date'}.'】にご予約を承りました。');
  }elseif($postback === 'action=back'){
      $message=array('type'=> 'text','text'=>'何もしませんでした。');
  }
}
$postdata=array('replyToken'=>$reply_token,'messages'=>array($massage));
$ch = curl_init('https://api.line.me/v2/bot/message/reply');
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charser=UTF-8','Authorization: Bearer ' . $access_token));
$result = curl_exec($ch);
curl_close($ch);
?>
