<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "university");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $address = $_POST['address'];
    
    // Store form data in session for display after redirection
    $_SESSION['form_data'] = $_POST;
    
    // Redirect to update_profile.php for processing
    header("Location: update_profile.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: beige;
            font-family: calibri;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 10px 0;
        }

        .logo img {
            max-height: 80px;
            width: 120px;
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .nav-links ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
        }

        .nav-links ul li {
            margin-right: 20px;
        }

        .form{
            margin-bottom: 20px;
        }
        .input{
            margin:auto;
            display: block;
            width: 90%;
            padding: 3px;
            margin-top:5px;
            font-size: 1rem;
            line-height: 2.5;
            color: #495057;
            background-color: rgb(249, 247, 247);
            background-clip: padding-box;
            border: 1px solid black;
            border-radius: 0.25rem;
        }
        label{
            font-size:20px;
            padding:30px;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }
        
        .dropbtn {
            background-color: #333;
            color: white;
            padding: 10px;
            border: none;
            cursor: pointer;
            font-size: 15px;
        }
        
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }
        
        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }
        
        .dropdown-content a:hover {
            background-color: #ddd;
        }
        
        .show {
            display: block;
        }
        .container1{
            width:50%;
            background-color: white;
            height:auto;
            margin:auto;
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <div style="display:flex">
                <div class="logo">
                    <img src="logo.jpg" alt="Eagle Mentoring Logo">
                </div>
                <div>
                    <h2 style="color: rgb(231, 214, 113);margin-left:10px">EAGLE MENTORING</h2>
                </div>
            </div>
            <div class="nav-links">
                <ul>
                    <li>
                        <div class="dropdown">
                            <button onclick="toggleDropdown()" class="dropbtn">My Account</button>
                            <div id="myDropdown" class="dropdown-content">
                                <a href="profile.php">Profile</a>
                                <a href="mycourses.php">My Courses</a>
                                <a href="mainpage.php">Main Page</a>
                                <a href="u_login.php">Logout</a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <div class="container1" style="margin-top:70px;padding:15px">
    <form action="update_profile.php" method="post">
    <div class="form">
        <label for="name"><b>Name</b></label>
        <input type="text" class="input" name="name" placeholder="Enter Username" value="<?php echo isset($_SESSION['name']) ? $_SESSION['name'] : ''; ?>">
    </div>
    <div class="form">
        <label for="email"><b>E-mail</b></label>
        <input type="email" class="input" name="email" placeholder="Enter E-mail" value="<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?>" required>
    </div>

    <div class="form">
        <label for="phone_number"><b>Phone Number</b></label>
        <input type="text" class="input" name="phone_number" placeholder="Enter phone number" value="<?php echo isset($_SESSION['phone_number']) ? $_SESSION['phone_number'] : ''; ?>">
    </div>
    <div class="form">
        <label for="address"><b>Address</b></label>
        <input type="text" class="input" name="address" placeholder="Enter Address" value="<?php echo isset($_SESSION['address']) ? $_SESSION['address'] : ''; ?>">
    </div>
    <div>
        <input type="submit" value="Save" class="input" name="submit" style="width:20%;margin-top:20px;color:white;background-color:blue;margin-left:30px;font-size:20px">
        <button type="button" onclick="enableEdit()" class="input" style="width:20%;margin-top:20px;color:white;background-color:green;margin-left:30px;font-size:20px">Edit</button>
    </div>
    </form>

    </div>
    <br><br>

    <script>
        // Function to toggle the visibility of the dropdown menu
        function toggleDropdown() {
            document.getElementById("myDropdown").classList.toggle("show");
        }

        // Close the dropdown if the user clicks outside of it
        window.onclick = function(event) {
            if (!event.target.matches('.dropbtn')) {
                var dropdowns = document.getElementsByClassName("dropdown-content");
                var i;
                for (i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        }

        // Function to enable editing of form fields
        function enableEdit() {
            var inputs = document.getElementsByClassName("input");
            for (var i = 0; i < inputs.length; i++) {
                inputs[i].removeAttribute("readonly");
            }
        }
    </script>
</body>
</html>
