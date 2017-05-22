<?php

// PHPMailer
require "../extensions/PHPMailer/PHPMailerAutoload.php";
require_once "x3.config.inc.php";
$x3_config = getX3Config();
$settings = $x3_config["back"]["mail"];
//header('Content-Type: application/json');
//echo(json_encode($mail_config));

function array_filter_key(array $array, $callback){
	$matchedKeys = array_filter(array_keys($array), $callback);
	return array_intersect_key($array, array_flip($matchedKeys));
}

// get recipient
$to = $settings['to'];
if(isset($to) && !empty($to)){
	$to_array = explode(',', $to);
	$to_first = $to_array[0];
}

// condition
if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])
	&& $_SERVER["REQUEST_METHOD"] == "POST"
	&& strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
	&& empty($_POST['honey1'])
	&& $_POST['honey2'] == "googooforgaga"
	&& filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)
	&& filter_var($_POST['page'], FILTER_VALIDATE_URL)

	&& isset($to_first) 
	&& filter_var($to_first, FILTER_VALIDATE_EMAIL) 
	//&& filter_var($settings['to'], FILTER_VALIDATE_EMAIL) 

	&& isset($_SERVER['HTTP_REFERER'])
	&& strpos($_SERVER['HTTP_REFERER'],$_SERVER['HTTP_HOST']) !== false
	) {

	// vars
	if(isset($_POST['name']) && !empty($_POST['name'])) {
		$name = strip_tags(trim($_POST["name"]));
		$name = str_replace(array("\r","\n"),array(" "," "),$name);
	} else {
		$name = '';
	}
	$email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
	$template_strict = false;
	if(isset($_POST['template_strict']) && !empty($_POST['template_strict'])) {
		$template_strict = true;
		$template = trim($_POST['template_strict']);
	} else if(isset($_POST['template']) && !empty($_POST['template'])){
		$template = trim($_POST['template']);
	} else {
		$template = $settings['template'] ? $settings['template'] : false;
	}
	if(isset($_POST['template_subject']) && !empty($_POST['template_subject'])) {
		$subject = $_POST['template_subject'];
	} else {
		$subject = $settings['subject'] ?: '%domain% | New message from %name%';
	}
	$subject = strip_tags(trim($subject));
	//$to = filter_var(trim($settings['to']), FILTER_SANITIZE_EMAIL);
	if(isset($settings['from'])) $from = filter_var(trim($settings['from']), FILTER_SANITIZE_EMAIL);

	// Initiate PHPMailer
	$mail = new PHPMailer;
	$mail->CharSet = 'UTF-8';

	// From
	if(isset($from)) $mail->setFrom($from);

	// To
	foreach($to_array AS $entry) {
		$item = filter_var($entry, FILTER_SANITIZE_EMAIL);
		if(filter_var($item, FILTER_VALIDATE_EMAIL)) {
			$mail->addAddress($item);
		}
	}
	//$mail->addAddress($to);

	// ReplyTo
	$mail->addReplyTo($email, $name);

	// SUBJECT replace hardcoded
	$subject = str_replace('%name%', $name, $subject);
	$subject = str_replace('%email%', $email, $subject);
	$subject = str_replace('%domain%', $_SERVER['HTTP_HOST'], $subject);

	// MESSAGE replace hardcoded
	$message = '';
	if($template){
		$message = str_replace('%name%', $name, $template);
		$message = str_replace('%email%', $email, $message);
	}

	// CUSTOM fields
	$ignore = array('honey1', 'honey2', 'template', 'template_strict', 'template_subject');
	$custom = array_filter_key($_POST, function($a) use ($ignore){
		return !in_array($a, $ignore);
	});
	foreach ($custom as $key => $value) {
		$val = nl2br(strip_tags(trim($value)));
		if(!empty($val)){

			// subject
			if(stripos($subject, '%'.$key.'%') !== false) $subject = str_ireplace('%'.$key.'%', $val, $subject);

			// message
			if($template && stripos($template, '%'.$key.'%') !== false){
	    	$message = str_ireplace('%'.$key.'%', $val, $message);
	    } else if(!$template_strict){
	    	if(!empty($message)) $message .= '<br><br>';
	    	$message .= '<strong>' . str_ireplace('_', ' ', $key) . '</strong><br>' . $val;
	    	//$message .= '<strong>' . $key . '</strong><br>' . $val;
	    }
		}
	}

	// Set msg
	$mail->msgHTML($message);
	$mail->Subject = $subject;

	// SMTP
	if($settings['use_smtp']) {
		$mail->isSMTP();
		$mail->Host = $settings['host'] ?: 'smtp.gmail.com';
		$mail->SMTPAuth = $settings['SMTPAuth'] ?: true;
		$mail->Username = trim($settings['username']);
		$mail->Password = trim($settings['password']);
		$mail->SMTPSecure = $settings['SMTPSecure'] ?: 'tls'; // tls, ssl or empty
		$mail->Port = $settings['port'] ?: 587; // 25|587|465
		$mail->SMTPDebug = ($settings['debug'] ? 3 : 0); // 0|1|2|3
	}

	// SEND!
	if(!$mail->send()) {
		echo 'Message could not be sent.';
		echo 'Mailer Error: ' . $mail->ErrorInfo;
	} else {
		//var_dump($_POST);
		echo 'true';
	}

} else {
	echo 'xtruex';
}
?>