
<?php
session_start();

if (isset($_POST['submit']))
{
	$email = $_POST['email'];
	$password = md5($_POST['password']);

	require_once("connection.php");

	$query = "SELECT * FROM user_info WHERE email = '$email' AND password = '$password'";

	$result = mysqli_query($conn,$query);

	while($row = mysqli_fetch_assoc($result))
	{
		$mail = $row['email'];
		$pwd = $row['password'];
        $id = $row['user_id'];
		if ($email == $mail && $password == $pwd)
		{
			$_SESSION['user'] = $id;
			header("location: testDashboard.php");
            exit();
		}
		else
		{
			echo('wrong e-mail id or password');
		}
	}

	
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login/Signup Page</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-gray-200">
    <div class="container">
        <div class="row justify-content-center align-items-center h-100">
            <div class="col-md-6">
            <form class="bg-white shadow rounded px-4 py-3" method="POST" action="">
                    <h2 class="mb-4 text-center text-secondary">Welcome Back!</h2>
                    <div class="form-group">
                        <label class="text-secondary" for="email">Email address</label>
                        <input class="form-control" id="email" type="email" placeholder="email" name="email">
                    </div>
                    <div class="form-group">
                        <label class="text-secondary" for="password">Password</label>
                        <input class="form-control" id="password" type="password" placeholder="Password" name="password">
                    </div>
                    <div class="form-group">
                    <button class="btn btn-primary btn-block" name="submit">Sign In</button>
                    </div>
                </form>
                <div class="text-secondary text-center mt-4">
                    Don't have an account? <a href="signup.php" class="font-weight-bold">Sign Up Here</a>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"
            integrity="sha256-HODZTnTJyxRm+YltzF1lT3q/F3QeX9sPj+HJZhRxwN4="
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
