<?php
$connection = mysqli_connect("localhost", "root", "", "online");

if (!$connection) {
    die("Could not connect: " . mysqli_connect_error());
}

$sql = "CREATE TABLE IF NOT EXISTS faculty (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    pic VARCHAR(255) NOT NULL,
    name VARCHAR(50) NOT NULL,
    course VARCHAR(50) NOT NULL,
    qualification VARCHAR(50) NOT NULL
)";

if (mysqli_query($connection, $sql)) {
    echo "Table created successfully<br>";
    
    // Insert faculty details into the table
    $insertQuery = "INSERT INTO faculty (pic, name, course, qualification) VALUES
    ('p-1.jpg', 'John', 'Data Science', 'Msc DataScience'),
    ('p-2.jpg', 'Charan', 'Big Data', 'M.Tech'),
    ('p-3.jpg', 'Alexa', 'Cyber', 'Msc'),
    ('p-5.jpg', 'Jenny', 'Python', 'Btech from IIT'),
    ('p-6.jpg', 'Elina', 'UI/UX', 'BSC Computer science'),
    ('p-9.jpg', 'Jitesh', 'Maths', 'Msc Mathamatics'),
    ('p-10.jpg', 'Usha', 'AIML', 'M.Tech'),
    ('p-11.jpg', 'Abinash', 'VLSI', 'M.Tech ECE'),
    ('p-12.jpg', 'Rohit', 'DAA', 'B.Tech'),
    ('p-24.jpg', 'Anitha Rani', 'DBMS', 'M.TEch'),
    ('p-14.jpg', 'Salma', 'Java', 'PHD'),
    ('p-16.jpg', 'Satya', 'R Language', 'B.com'),
    ('p-17.jpg', 'Karthikeyan', 'IOT', 'Msc'),
    ('p-18.jpg', 'Amit', 'Chemistry', 'Msc Chemistry'),
    ('p-19.jpg', 'Pardha kumar', 'Biology', 'Bio Technology'),
    ('p-21.jpg', 'Sabyasachi', 'History', 'Degree HEC'),
    ('p-20.jpg', 'Lakshmi Narayana Patro', 'Physics', 'PHD'),
    ('p-22.jpg', 'Pradyut', 'Web development', 'Msc'),
    ('p-25.jpg', 'Hsin-Yi', 'Mandarin Chinese', 'Bachelors'),
    ('p-26.jpg', ' Priyanka.S', 'Psycology', 'Msc')";
    
    
    if (mysqli_query($connection, $insertQuery)) {
        echo "Faculty details inserted successfully";
    } else {
        echo "Error inserting faculty details: " . mysqli_error($connection);
    }
} else {
    echo "Error creating table: " . mysqli_error($connection);
}

mysqli_close($connection);
?>