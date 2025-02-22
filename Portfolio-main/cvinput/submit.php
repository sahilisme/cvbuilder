<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "resume_details";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $linkedin = $_POST['linkedin'];
    $github = $_POST['github'];
    $objective = $_POST['objective'];
    $institute_name1 = $_POST['institute_name1'];
    $average_gpa1 = $_POST['average_gpa1'];
    $university_name = $_POST['university_name'];
    $institute_name2 = $_POST['institute_name2'];
    $skills_abilities = $_POST['skills_abilities'];
    $projects = $_POST['projects'];
    $extracurricular = $_POST['extracurricular'];
    $training = $_POST['training'];
    $hobbies_interests = $_POST['hobbies_interests'];
    $place = $_POST['place'];

    $stmt = $conn->prepare("INSERT INTO resumes (name, address, phone, email, linkedin, github, objective, institute_name1, average_gpa1, university_name, institute_name2, skills_abilities, projects, extracurricular, training, hobbies_interests, place) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssssssssssss", $name, $address, $phone, $email, $linkedin, $github, $objective, $institute_name1, $average_gpa1, $university_name, $institute_name2, $skills_abilities, $projects, $extracurricular, $training, $hobbies_interests, $place);

    if ($stmt->execute() === TRUE) {
        $last_id = $stmt->insert_id;
        header("Location: display.php?id=$last_id");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
