
<?php
// Check if the form was submitted
if (isset($_POST['submit'])) {
    
    // Retrieve the form data
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $confirm_password = md5($_POST['confirm_password']);


    // Check if the passwords match
    if ($password !== $confirm_password) {
    echo "Error: Passwords do not match";
    exit();
    }
    else
    {
         // Build the SQL INSERT statement
    $sql = "INSERT INTO user_info (username, email, password) VALUES ('$username', '$email', '$password')";
    
    // Connect to the database
    require_once 'connection.php';
    
    // Execute the SQL statement
    if (mysqli_query($conn, $sql)) {
        // Redirect to the login page
        header("Location: index.php?signup=success");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    
    // Close the database connection
    mysqli_close($conn);


    }

    
   
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Page</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <h2 class="mb-4">Create an account</h2>
                <form action="signup.php" method="POST">
                    <div class="form-group">
                        <label for="username">User Name</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">Confirm Password</label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                    </div>
                    <button type="submit" class="btn btn-primary" name="submit">Create Account</button>
                </form>
                <p class="mt-3">Already have an account? <a href="index.php">Sign in here</a></p>
            </div>
        </div>
    </div>
</body>
</html>
