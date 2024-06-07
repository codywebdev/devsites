<?
	//echo 'Sending email...<br />';	
	
	$name = htmlspecialchars(isset($_POST["name"])? $_POST["name"] : "");
	$company = htmlspecialchars(isset($_POST["company"])? $_POST["company"] : "");
	$phone = htmlspecialchars(isset($_POST["phone"])? $_POST["phone"] : "");
	$email = htmlspecialchars(isset($_POST["email"])? $_POST["email"] : "");
	$message = htmlspecialchars(isset($_POST["message"])? $_POST["message"] : "");
	$ipaddress = htmlspecialchars(isset($_SERVER['REMOTE_ADDR'])? $_SERVER['REMOTE_ADDR'] : '');



	$name .= ' (' . $ipaddress . ')';
	$to = "contactme@codyswebdesign.com";
	$subject = 'Contact Form Message';
	$from = "contactme@codyswebdesign.com";
	$headers = "From: CodysWebDesign.com <".$from.">"."\r\n"."Bcc: adamscb85@hotmail.com";
	$message = 'Name: '.$name."
Company: ".$company."
Phone: ".$phone."
Email: ".$email."
Message: ".$message;


// Verify Google reCAPTCHA
if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])):
    if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])):
        //your site secret key
        $secretKey = '6LdLgw4UAAAAAKZ_obHnX1PpRnn5B2OwzOE4p_RZ';
        //get verify response data
        $verifydata = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=6LdLgw4UAAAAAKZ_obHnX1PpRnn5B2OwzOE4p_RZ&response='.$_POST['g-recaptcha-response']);
        $response= json_decode($verifydata);
        if($response->success):
            //contact form submission code
            $success = 'Your contact form have submitted successfully.';
			//Send email
			mail($to,$subject,$message,$headers);
        else:
            $error = 'Robot verification failed, please try again.';
        endif;
    else:
        $error = 'Please select Google reCAPTCHA.';
    endif;
else:
    $error = '';
    $success = '';
endif;

	
?>