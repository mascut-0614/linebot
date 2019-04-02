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
                'text' => '【'.$msg_text.'】っておいしい？'
:
