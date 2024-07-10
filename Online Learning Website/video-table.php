<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "online";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to create the videos table
$sql = "CREATE TABLE videos (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    course_name VARCHAR(255) NOT NULL,
    video_link VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

// Execute the SQL query
if ($conn->query($sql) === TRUE) {
    echo "Table videos created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

// SQL query to insert video links
$sqlinsert = "INSERT INTO videos (course_name, video_link) VALUES 
    ('python', 'https://www.youtube.com/embed/eezLhJ5oGYg'),
    ('python', 'https://www.youtube.com/embed/-gxUjXAG96U'),
    ('Data Science', 'https://www.youtube.com/embed/RBSUwFGa6Fk'),
    ('Data Science', 'https://www.youtube.com/embed/X3paOmcrTjQ'),
    ('Big Data', 'https://www.youtube.com/embed/bAyrObl7TYE'),
    ('Big Data', 'https://www.youtube.com/embed/bY6ZzQmtOzk'),
    ('cyber', 'https://www.youtube.com/watch?v=FARSxWjlPkk'),
    ('cyber', 'https://www.youtube.com/embed/hXSFdwIOfnE'),
    ('UI/UX', 'https://www.youtube.com/embed/c9Wg6Cb_YlU'),
    ('UI/UX', 'https://www.youtube.com/embed/55NvZjUZIO8'),
    ('AIML', 'https://www.youtube.com/embed/ukzFI9rgwfU'),
    ('AIML', 'https://www.youtube.com/embed/wnqkfpCpK1g'),
    ('Maths', 'https://www.youtube.com/embed/mRCXh__pexQ'),
    ('Maths', 'https://www.youtube.com/embed/W1uKClY3sN4'),
    ('VLSI', 'https://www.youtube.com/embed/ONU-zFBzlXo'),
    ('VLSI', 'https://www.youtube.com/embed/b75At6VGQzQ'),
    ('DAA', 'https://www.youtube.com/embed/JImy2EspbGI'),
    ('DAA', 'https://www.youtube.com/embed/WOCSibinb18'),
    ('DBMS', 'https://www.youtube.com/embed/kBdlM6hNDAE'),
    ('DBMS', 'https://www.youtube.com/embed/ZaaSa1TtqXY'),
    ('JAVA', 'https://www.youtube.com/embed/yRpLlJmRo2w'),
    ('JAVA', 'https://www.youtube.com/embed/_3GP0qyTbsI'),
    ('C++', 'https://www.youtube.com/embed/j8nAHeVKL08'),
    ('C++', 'https://www.youtube.com/embed/z9bZufPHFLU'),
    ('R++', 'https://www.youtube.com/embed/oPjZK4Apgug'),
    ('R++', 'https://www.youtube.com/embed/dgmCiZvdI_4'),
    ('IOT', 'https://www.youtube.com/embed/6mBO2vqLv38'),
    ('IOT', 'https://www.youtube.com/embed/APH6Nrar27w'),
    ('Chemistry', 'https://www.youtube.com/embed/5iTOphGnCtg'),
    ('Chemistry', 'https://www.youtube.com/embed/Feap2zbEz_k'),
    ('Biology', 'https://www.youtube.com/embed/bXGPCb0kkso'),
    ('Biology', 'https://www.youtube.com/embed/RoSIsqQISJE'),
    ('History', 'https://www.youtube.com/embed/eHEv5aF5td8'),
    ('History', 'https://www.youtube.com/embed/GuBX0juCRgQ'),
    ('Physics', 'https://www.youtube.com/embed/QPEZFEW74vw'),
    ('Physics', 'https://www.youtube.com/embed/yJ9kmW4dV98'),
    ('Web Development', 'https://www.youtube.com/embed/m4WLln2UMzk'),
    ('Web Development', 'https://www.youtube.com/embed/tVzUXW6siu0'),
    ('Psycology','https://www.youtube.com/embed/watch?v=KV4ul-YSudI'),
    ('Psycology','https://www.youtube.com/watch?v=eXhWR4UIFxk'),
    ('Mandarin Chinese','https://www.youtube.com/embed/watch?v=McZW0iDsZns&list=PLWXyZU_NJb_chvMZ13hgOPB3Vcz7xhW3q'),
    ('Mandarin Chinese','https://www.youtube.com/embed/watch?v=QOpQf3fi2N4')";

// Execute the SQL query
if ($conn->query($sqlinsert) === TRUE) {
    echo " Video links inserted successfully";
} else {
    echo "Error inserting video links: " . $conn->error;
}

// Close the connection
$conn->close();
?>
