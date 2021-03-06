<?php
//require_once('../../resources/functions.php');


$headers = getallheaders ();
if (!isset($headers['Content-Type']) || !$headers['Content-Type'] == 'application/json'){
	http_response_code(400);
	printJsonError(400 , 'Bad Request: Check the API documentation');
}

$incoming_data = json_decode(file_get_contents('php://input'), true);

$outgoing_data['smtpuser'] = $incoming_data['smtpuser'];
$outgoing_data['smtppass'] = $incoming_data['smtppass'];

foreach ($incoming_data['message'] as $e){
	if ($e['content_type'] == 'text/plain') {
		$outgoing_data['message']['text'] = $e['content'];
	}
	if ($e['content_type'] == 'text/html') {
		$outgoing_data['message']['html'] = $e['content'];
	}
}

foreach ($incoming_data['to'] as $e){
    if ($e['name'] == $e['email']){
        $e['name'] = '';
        $outgoing_data['to'][] = $e;
    } else {
        $outgoing_data['to'][] = $e;
    }
}

foreach ($incoming_data['cc'] as $e){
    if ($e['name'] == $e['email']){
        $e['name'] = '';
        $outgoing_data['cc'][] = $e;
    } else {
        $outgoing_data['cc'][] = $e;
    }
}

foreach ($incoming_data['reply-to'] as $e){
    if ($e['name'] == $e['email']){
        $e['name'] = '';
        $outgoing_data['reply-to'][] = $e;
    } else {
        $outgoing_data['reply-to'][] = $e;
    }
}

foreach ($incoming_data['from'] as $e){
    if ($e['name'] == $e['email']){
        $e['name'] = '';
        $outgoing_data['from'][] = $e;
    } else {
        $outgoing_data['from'][] = $e;
    }
}


$outgoing_data['datetime'] 		= $incoming_data['datetime'];
$outgoing_data['rcpttos'] 		= $incoming_data['rcpttos'];
$outgoing_data['subject'] 		= $incoming_data['subject'];
$outgoing_data['headers'] 		= $incoming_data['headers'];
$outgoing_data['attachments'] 	= $incoming_data['attachments'];

$outgoing_data = json_encode($outgoing_data);
                                                                                                                     
$ch = curl_init('https://www.sendsecure.org/APIv1/');                                                                      
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
curl_setopt($ch, CURLOPT_POSTFIELDS, $outgoing_data);                                                                  
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
    'Content-Type: application/json',                                                                                
    'Content-Length: ' . strlen($outgoing_data))                                                                       
);                                                                                                                   
                                                                                                                     
$result = curl_exec($ch);

print($result);


?>