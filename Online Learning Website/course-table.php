<?php
// Database connection
$conn = mysqli_connect("localhost", "root", "", "university");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// SQL query to create courses table
$sql = "CREATE TABLE courses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    faculty_name VARCHAR(255) NOT NULL,
    course_name VARCHAR(255) NOT NULL,
    qualification VARCHAR(255) NOT NULL,
    username VARCHAR(255) NOT NULL,
    registration_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

// Execute SQL query
if (mysqli_query($conn, $sql)) {
    echo "Table courses created successfully";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}

// Close connection
mysqli_close($conn);
?>
