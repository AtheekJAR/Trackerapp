

<?php

// Get the email submitted by the user in signup.php
$email = $_POST['email'];

// Generate a 6-digit verification code
$verification_code = rand(100000, 999999);

// Email subject and message
$subject = "Verification Code";
$message = "Your verification code is: " . $verification_code;

// Send the email using PHP mail() function
mail($email, $subject, $message);

// Store the verification code in a session variable for verification in verify.php
session_start();
$_SESSION['verification_code'] = $verification_code;

// Redirect the user to verify.php
header('Location: verify.php');
exit;

?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>OTP</title>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    </head>
<body>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <form class="card-body">
                    <h2 class="mb-4 text-center text-gray text-lg font-weight-bold">Enter Your OTP here!!</h2>
                    <div class="form-group">
                        <label class="text-gray  font-weight-bold" for="username">
                            OTP
                        </label>
                        <input class="form-control" id="OTP" type="password" placeholder="000000">
                    </div>
                    <div class="align-items-center justify-content-between">
                        <button class="btn btn-warning" type="button">
                            SUbmit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>