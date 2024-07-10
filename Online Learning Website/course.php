<?php
session_start();

// Check if user is logged in
$conn = mysqli_connect("localhost", "root", "", "university");

if (!$conn) {
    die("Could not connect: " . mysqli_connect_error());
}

if (!isset($_SESSION['username'])) {
    // Redirect to login page if not logged in
    header('Location:u_login.php');
    exit();
}

// Include database connection file


if (isset($_GET['course'])) {
    $course_name = $_GET['course'];
    $username = $_SESSION['username'];

    // Check if the course already exists in the user's courses
    $check_query = "SELECT * FROM courses WHERE course_name = '$course_name' AND username = '$username'";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        // Course already added, show message and redirect
        echo '<script>alert("You have already added this course.");</script>';
        echo '<script>window.location.href = "mycourses.php";</script>';
        exit();
    }

    // Fetch faculty details for the selected course
    $faculty_query = "SELECT * FROM faculty WHERE course = '$course_name'";
    $faculty_result = mysqli_query($conn, $faculty_query);
    $faculty_row = mysqli_fetch_assoc($faculty_result);

    if ($faculty_row) {
        // Insert course details into the courses table
        $insert_query = "INSERT INTO courses (faculty_name, course_name, qualification, username) VALUES ('{$faculty_row['name']}', '$course_name', '{$faculty_row['qualification']}', '$username')";
        if (mysqli_query($conn, $insert_query)) {
            // Registration successful, show message and redirect
            echo '<script>alert("Course registration successful.");</script>';
            echo '<script>window.location.href = "mycourses.php";</script>';
            exit();
        } else {
            // Error inserting course details
            echo '<script>alert("Error registering course.");</script>';
        }
    } else {
        // Faculty details not found for the selected course
        echo '<script>alert("Faculty details not found for this course.");</script>';
    }
} else {
    // Course parameter not provided
    echo '<script>alert("Invalid course.");</script>';
}

// Redirect to mycourses.html in case of errors
echo '<script>window.location.href = "mycourses.php";</script>';
exit();

mysqli_close($conn);
?>
