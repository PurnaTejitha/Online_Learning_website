<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eagle Mentoring - Faculty</title>
    <!-- CSS styles -->
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

        .faculty-section {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            margin-top: 20px;
        }

        .faculty-box {
            width: 18%; /* Adjust width to fit 5 items in a row */
            margin-bottom: 20px;
            text-align: center;
            padding: 10px;
        }

        .faculty-box img {
            max-width: 100%;
            border-radius: 10px;
        }

        .faculty-details {
            background-color: #f9f9f9;
            padding: 10px;
            border-radius: 10px;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.2);
            margin-bottom: 10px; /* Adjust space between faculty boxes */
        }

        .faculty-details h3 {
            margin-top: 10px;
            font-size: 18px;
        }

        .faculty-details p {
            margin: 5px 0;
            font-size: 16px;
        }

        .add-course-btn {
            display: inline-block;
            background-color: #333;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .add-course-btn:hover {
            background-color: #555;
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
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
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
            <div style="margin-left:470px;margin-top:23px;font-size:20px">
                <a href="home.html" style="color:white;text-decoration:none">Home</a>
            </div>
        </div>

        <div class="nav-links">
            <ul>
                <li>
                    <form action="search.php" method="get">
                        <input type="text" placeholder="Search Course" name="course_search" style="border-radius:5px;width:150px;height:30px">
                        <input type="submit" value="Search">
                    </form>
                </li>
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
        <?php
        $connection = mysqli_connect("localhost", "root", "", "university");

        if (!$connection) {
            die("Could not connect: " . mysqli_connect_error());
        }

        $sql = "SELECT * FROM faculty";
        $result = mysqli_query($connection, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="faculty-box">';
                echo '<div class="faculty-details">';
                echo '<img src="' . $row['pic'] . '" alt="' . $row['name'] . '" style="width: 150px; height: 150px; border-radius: 50%;">';
                echo '<h3>' . $row['name'] . '</h3>';
                echo '<p>' . $row['course'] . '</p>';
                echo '<p>' . $row['qualification'] . '</p>';
                echo '<a href="course.php?course=' . $row['course'] . '" class="add-course-btn">Add Course</a>'; // Add course button
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo "No faculty found.";
        }

        mysqli_close($connection);
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
