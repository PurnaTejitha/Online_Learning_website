<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Course</title>
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

        .course-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            padding: 20px;
        }

        .course-box {
            width: 30%;
            margin-bottom: 20px;
            padding: 10px;
            background-color: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        .course-box h3 {
            font-size: 18px;
            margin-top: 0;
        }

        .video-container {
            position: relative;
            overflow: hidden;
            padding-top: 56.25%; /* 16:9 aspect ratio (adjust as needed) */
        }

        .video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
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

    <div class="course-container">
        <?php
        // Retrieve video links from the database based on the searched course name
        $conn = mysqli_connect("localhost", "root", "", "university");
        if ($conn) {
            if (isset($_POST['course'])) {
                $searched_course = $_POST['course'];
                $sql = "SELECT * FROM videos WHERE course_name LIKE '%$searched_course%'";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<div class="course-box">';
                        echo '<h3>' . $row['course_name'] . '</h3>';
                        echo '<div class="video-container">';
                        echo '<iframe width="560" height="315" src="' . $row['video_link'] . '" frameborder="0" allowfullscreen></iframe>';
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo '<p>No videos found for the searched course.</p>';
                }
            } else {
                echo '<p>Please enter a course name to search for videos.</p>';
            }
            mysqli_close($conn);
        } else {
            echo '<p>Database connection error.</p>';
        }
        ?>
    </div> 
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
