<?php

function console_log( $data ){
    echo '<script>';
    echo 'console.log('. json_encode( $data ) .')';
    echo '</script>';
  }

$data = [];
if ($_POST) {
    $name = "";
    $email = "";
    $subject = "";
    $comments = "";
    $recipient="lance.a.smithacc@gmail.com"; // Your email comes here

    if (isset($_POST['name'])) {
        $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
        console_log('made it to name check');
    }

    if (isset($_POST['email'])) {
        $email = str_replace(array("\r", "\n", "%0a", "%0d"), '', $_POST['email']);
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);
        console_log('made it to email check');
    }

    if (isset($_POST['subject'])) {
        $subject = filter_var($_POST['subject'], FILTER_SANITIZE_STRING);
        console_log('made it to subject check');
    }

    if (isset($_POST['comments'])) {
        $comments = htmlspecialchars($_POST['comments']);
        console_log('made it to comments check');
    }


    if (mail($recipient, $subject, $comments)) {
        console_log('made it to the end');
        $data = array(
            'status' => 'Congratulation',
            'message' => 'Your message sent successfully.'
        );
    } else {
        $data = array(
            'status' => 'Error',
            'message' => 'Your message did not send.'
        );
    }
} else {
	$data = array(
		'status' => 'Warning',
		'message' => 'Something went wrong, Please try again.'
	);
}
echo json_encode($data);
>