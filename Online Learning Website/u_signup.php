<?php
session_start(); 

$connection = mysqli_connect("localhost", "root", "", "online");
if (!$connection) {
    die("Could not connect: " . mysqli_connect_error());
}

$sql = "CREATE TABLE IF NOT EXISTS client (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    Username VARCHAR(30) NOT NULL,
    Email VARCHAR(50) NOT NULL,
    Password VARCHAR(255) NOT NULL
)";

if (mysqli_query($connection, $sql)) {
} else {
    echo "Error creating table: " . mysqli_error($connection);
}

if (isset($_POST['signup'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $check = "SELECT * from client where Username='$name'";
    $res = mysqli_query($connection, $check);
    if (mysqli_num_rows($res) > 0) {
        echo "<script>alert('User already exists');window.location.href='u_login.php';</script>";
    } else {
        $insert = "INSERT INTO client(Username,Email,Password) values('$name','$email','$pass')";
        if (mysqli_query($connection, $insert)) {
            echo "Values inserted successfully";
            $_SESSION['username'] = $name;
            $_SESSION['email'] = $email; // Set the session variable
            header('Location: mainpage.php');
            exit();
        } else {
            echo "Error: " . mysqli_error($connection);
        }
    }
}
mysqli_close($connection);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <style>
        .container1 {
            border: 1px solid gray;
            width: 40%;
            background-color: white;
            height: 550px;
            margin: auto;
        }
        .container {
            width: 100%;
            height: auto;
            display: flex;
            margin: auto;
        }
        .div1 {
            width: 50%;
            text-align: center;
        }
        #div2 {
            text-align: center;
        }
        button {
            width: 100%;
            cursor: pointer;
        }
        button:hover {
            background-color: lightgray;
        }
        .form {
            margin-bottom: 20px;
        }
        .input {
            margin: auto;
            display: block;
            width: 90%;
            padding: 3px;
            margin-top: 5px;
            font-size: 1rem;
            line-height: 2.5;
            color: #495057;
            background-color: rgb(249, 247, 247);
            background-clip: padding-box;
            border: 1px solid black;
            border-radius: 0.25rem;
        }
        label {
            font-size: 20px;
            padding: 20px;
        }
        .show {
            margin-left: 20px;
        }
        .btn {
            margin-top: 20px;
            font-size: 20px;
            padding: 15px;
            width: 100%;
        }
        .flex {
            width: 100%;
            display: flex;
        }
        .btn {
            width: 100%;
        }
    </style>
</head>
<body style="background-color:#495057">
    <div class="container1" style="margin-top: 70px;">
        <div class="container">
            <div class="div1"><a href="u_login.php"><button><h1>SIGN IN</h1></button></a></div>
            <div class="div1"><a href="u_signup.php"><button><h1>SIGN UP</h1></button></a></div>
        </div><br>
        <p style="margin-left: 20px">Please fill in this form to create an account.</p>
        <form action="u_signup.php" method="post">
            <div class="form">
                <label for="Username"><b>Username</b></label>
                <input type="text" class="input" name="name" placeholder="Enter Username" required>
            </div>
            <div class="form">
                <label for="email"><b>Email</b></label>
                <input type="email" class="input" name="email" id="email" placeholder="Enter Email" required><br>
            </div>
            <div class="form" id="passwordSection">
                <label for="password"><b>Create Password</b></label>
                <input type="password" class="input" name="password" id="password" placeholder="Enter Password" title="Password should contain at least 8 characters" required><br>
                <input type="checkbox" value="showpassword" onclick="show()" class="show">Show password
                <br>
            </div>
            <input type="submit" name="signup" value="Submit" class="input" style="margin-top: 20px; color: white; background-color: green;">
        </form>
    </div>
    <script>
        function show() {
            var createPasswordInput = document.getElementById('password');
            if (createPasswordInput.type === 'password') {
                createPasswordInput.type = 'text';
            } else {
                createPasswordInput.type = 'password';
            }
        }
    </script>
</body>
</html>
