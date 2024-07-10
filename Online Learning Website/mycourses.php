<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect to login page if not logged in
    header('Location: u_login.php');
    exit();
}

// Database connection
$conn = mysqli_connect("localhost", "root", "", "university");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$username = $_SESSION['username'];

// Fetch courses for the logged-in user
$sql = "SELECT * FROM courses WHERE username = '$username'";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eagle Mentoring</title>
    <style>
        /* CSS styles */
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
        .faculty-shape {
            padding-left: 60px; 
            width: 200px;
            margin-bottom: 20px;
            text-align: center;
        }

        .faculty-shape img {
            max-width: 100%;
            border-radius: 10px;
        }

        .faculty-details {
            margin-top: 10px;
        }
        .course-box {
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.2);
            margin-bottom: 20px;
            text-align: center;
            width: 30%; /* Set the width for each box */
            margin-right: 2%; /* Add margin between boxes */
            display: inline-block; /* Display boxes inline */
        }

        .course-box h3 {
            font-size: 18px;
            margin-top: 0;
        }

        .course-box p {
            margin: 5px 0;
            font-size: 16px;
            color: #666;
        }

        /* Responsive CSS */
        @media (max-width: 768px) {
            .course-box {
                width: 45%; 
                margin-right: 5%; 
            }
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
    <br><br>
    <main>
        <div class="faculty-section">
            <!-- PHP code to display faculty details -->
            <!-- PHP code to display faculty details -->
            <div class="faculty-section">
            <!-- PHP code to display faculty details -->
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<div class="course-box">';
                    echo '<h3>' . $row['course_name'] . '</h3>';
                    echo '<p>Faculty: ' . $row['faculty_name'] . '</p>';
                    echo '<p>Qualification: ' . $row['qualification'] . '</p>';
                    // Add "Go to Course" button
                    echo '<form action="gocourse.php" method="post">';
                    echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
                    echo '<input type="hidden" name="course" value="' . $row['course_name'] . '">';
                    echo '<input type="submit" value="Go to Course">';
                    echo '</form>';
                    echo '</div>';
                }
            } else {
                echo '<p>No courses found.</p>';
            }
            ?>
        </div>
    </main>

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
    </script>
</body>
</html>

<?php
// Close the database connection
mysqli_close($conn);
?>
