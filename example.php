require_once("Mandrill.php");


try {
    
    $mandrill = new Mandrill('YOU_API_HERE');
    $from_email = 'YOUR_FROM_EMAIL_HERE';
    $async = false;
    $ip_pool = 'Main Pool';
    $send_at = '2014-09-01 00:01:01'; //date in the past to send sync
    $return_path_domain = null;
    
    $message = array(
        'html' => nl2br($body), //to change from new line - plain text to <br> tag 
        'subject' => $subject,
        'from_email' => $from_email,
        'to' => array(array('email' => $to_email, "type"=>"to")),
        'headers' => array('Reply-To' => $from_email),
        'important' => false,
        'track_opens' => null,
        'track_clicks' => null,
        'auto_text' => null,
        'auto_html' => true,
        'return_path_domain' => null
    );
    $async = false;
    $ip_pool = 'Main Pool';
    $send_at = '2014-09-01 01:00:01';

    $result = $mandrill->messages->send($message, $async, $ip_pool, $send_at);
    
    //uncoment to see the log syslog(1, "Email sent via  Mandrill - $to_email, $subject, mg=".json_encode($message)." e result=".json_encode($result));

    return true;
    
	} catch(Mandrill_Error $e) {
	    // Mandrill errors are thrown as exceptions
	    syslog(1, "Problems to send Mandrill - $to_email, $subject, $body erro=". get_class($e) . " - " . $e->getMessage());
	    // A mandrill error occurred: Mandrill_Unknown_Subaccount - No subaccount exists with the id 'customer-123'
	    return false;
	}
