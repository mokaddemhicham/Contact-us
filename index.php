<?php

    require_once 'mail.php';
    $errorFirstname = $errorLastname = $errorSubject = $errorEmail = $errorMessage = $firstname = $lastname = $subject = $email = $message = $emailvalid = $success =  $classFirstname = $classLastname = $classSubject = $classMessage = $classEmail = $feedback = "";

    if(isset($_POST['send'])){
        $firstname = checkInput($_POST['firstname']);
        $lastname = checkInput($_POST['lastname']);
        $subject = checkInput($_POST['subject']);
        $message = checkInput($_POST['message']);
        $email = checkInput($_POST['email']);
        $emailvalid = isEmail($email);

        if(empty($firstname)){
            $errorFirstname = "Please fill in your first name!";
            $classFirstname = "is-invalid";
            $feedback = "invalid-feedback";
        }else{
            $classFirstname = "is-valid";
            $errorFirstname = "Looks good!";
            $feedback = "valid-feedback";
        }
        if(empty($lastname)){
            $errorLastname = "Please fill in your last name!";
            $classLastname = "is-invalid";
            $feedback = "invalid-feedback";
        }else{
            $classLastname = "is-valid";
            $errorLastname = "Looks good!";
            $feedback = "valid-feedback";
        }
        if(empty($subject)){
            $errorSubject = "Please fill in your subject!";
            $classSubject = "is-invalid";
            $feedback = "invalid-feedback";
        }else{
            $classSubject = "is-valid";
            $errorSubject = "Looks good!";
            $feedback = "valid-feedback";
        }
        if(empty($message)){
            $errorMessage = "Please fill in your message!";
            $classMessage = "is-invalid";
            $feedback = "invalid-feedback";
        }else{
            $classMessage = "is-valid";
            $errorMessage = "Looks good!";
            $feedback = "valid-feedback";
        }
        if(empty($email)){
            $errorEmail = "Please fill in your email!";
            $classEmail = "is-invalid";
            $feedback = "invalid-feedback";
        }elseif(!$emailvalid){
            $errorEmail = "Please enter a valid email!";
            $classEmail = "is-invalid";
            $feedback = "invalid-feedback";
        }else{
            $classEmail = "is-valid";
            $errorEmail = "Looks good!";
            $feedback = "valid-feedback";
        }
        
        if(!empty($firstname) && !empty($lastname) && !empty($subject) && !empty($message) && $emailvalid){
            $mail->setFrom('hichammokaddem2018@gmail.com', $firstname . ' ' . $lastname);
            $mail->addAddress('hichammokaddem2001@gmail.com', 'Hicham Mokaddem');     // Add a recipient
            $mail->Subject = $subject;
            $mail->Body    = $message . "<br>Mon Email : " . $emailvalid;
            $mail->send();
            $success = '<p class="alert alert-success text-center">Your information has been sent successfully. thank you for contacting us</p>';

        
        }
        
    }



    function checkInput($data){
        $data = trim($data);
        $data = htmlspecialchars($data);
        $data = stripslashes($data);
        $data = filter_var($data, FILTER_SANITIZE_STRING);
        return $data;
    }

    function isEmail($mail){
        return filter_var($mail, FILTER_VALIDATE_EMAIL);
    }




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <title>Send Mail</title>
</head>
<body>
<div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <form action="" method="post" class="contact-form">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="firstname">First Name <span class="blue">*</span></label>
                            <input type="text" name="firstname" id="firstname" placeholder="Your First Name" class="form-control <?php echo $classFirstname ; ?>" value="<?php echo $firstname; ?>">
                            <div class="valid-feedback">
                                <?php echo $errorFirstname; ?>
                            </div>
                            <div class="invalid-feedback">
                                <?php echo $errorFirstname; ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="lastname">Last Name <span class="blue">*</span></label>
                            <input type="text" name="lastname" id="lastname" placeholder="Your Last Name" class="form-control <?php echo $classLastname ; ?>" value="<?php echo $lastname; ?>">
                            <div class="valid-feedback">
                                <?php echo $errorLastname; ?>
                            </div>
                            <div class="invalid-feedback">
                                <?php echo $errorLastname; ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="subject">Subject</label>
                            <input type="text" name="subject" id="subject" placeholder="Your Subject" class="form-control <?php echo $classSubject ; ?>" value="<?php echo $subject; ?>">
                            <div class="valid-feedback">
                                <?php echo $errorSubject; ?>
                            </div>
                            <div class="invalid-feedback">
                                <?php echo $errorSubject; ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="email">Email <span class="blue">*</span></label>
                            <input type="text" name="email" id="email" placeholder="Your Email" class="form-control <?php echo $classEmail ; ?>" value="<?php echo $emailvalid; ?>">
                            <div class="valid-feedback">
                                <?php echo $errorEmail; ?>
                            </div>
                            <div class="invalid-feedback">
                                <?php echo $errorEmail; ?>
                            </div>
                        </div>
                        <div class="col-md-12">
                        <label for="message">Message <span class="blue">*</span></label>
                            <textarea rows="4" name="message" id="message" placeholder="Your Message" class="form-control <?php echo $classMessage ; ?>"><?php echo $message; ?></textarea>
                            <div class="valid-feedback">
                                <?php echo $errorMessage; ?>
                            </div>
                            <div class="invalid-feedback">
                                <?php echo $errorMessage; ?>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="blue">
                                <strong>* This informations is required.</strong>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-outline-primary btn-block mt-3 mb-3 pt-2 pb-2" name="send">Send</button>
                        </div>
                        <div class="col-md-12">
                            <p><?php echo $success; ?></p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>




