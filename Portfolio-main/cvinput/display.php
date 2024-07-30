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

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM resumes WHERE id=$id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        ?>

        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <title>Resume Display</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    margin: 0;
                    padding: 0;
                    background-color: #f4f4f4;
                }

                .container {
                    width: 60%;
                    margin: 50px auto;
                    padding: 20px;
                    background-color: #fff;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                }

                header {
                    text-align: center;
                    margin-bottom: 20px;
                }

                header h1 {
                    margin: 0;
                    font-size: 2em;
                }

                header p {
                    margin: 5px 0;
                    font-size: 1em;
                    color: #777;
                }

                section {
                    margin-bottom: 20px;
                }

                h2 {
                    border-bottom: 2px solid #4CAF50;
                    padding-bottom: 5px;
                }

                .job,
                .project {
                    margin-bottom: 10px;
                }

                .job h3,
                .project h3 {
                    margin: 0;
                    font-size: 1.2em;
                    color: #333;
                }

                .job p,
                .project p {
                    margin: 5px 0;
                    font-size: 1em;
                    color: #777;
                }

                ul {
                    list-style-type: disc;
                    margin: 10px 0 0 20px;
                    padding: 0;
                }

                ul li {
                    margin: 5px 0;
                }

                #editBtn {
                    padding: 10px 20px;
                    font-size: 16px;
                    background-color: #007bff;
                    color: #fff;
                    border: none;
                    border-radius: 4px;
                    cursor: pointer;
                    margin-top: 20px;
                }

                #editBtn:hover {
                    background-color: #000000;
                    transition: all 0.5s ease;
                    transform: scale(1.5);
                }

                .download-btn {
                    padding: 10px 20px;
                    font-size: 16px;
                    font-weight: bold;
                    border: none;
                    background: #333;
                    color: #fff;
                    cursor: pointer;
                }

                .download-btn:hover {
                    background-color: #007bff;
                    transition: all 0.5s ease;
                    transform: scale(1.1);
                }

                @media print {
                    #editBtn,
                    .download-btn {
                        display: none;
                    }
                }
            </style>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
            <script>
                function downloadResume() {
                    const { jsPDF } = window.jspdf;
                    const doc = new jsPDF();

                    const name = "<?php echo addslashes($row['name']); ?>";
                    const address = "<?php echo addslashes($row['address']); ?>";
                    const phone = "<?php echo addslashes($row['phone']); ?>";
                    const email = "<?php echo addslashes($row['email']); ?>";
                    const linkedin = "<?php echo addslashes($row['linkedin']); ?>";
                    const github = "<?php echo addslashes($row['github']); ?>";
                    const objective = "<?php echo addslashes(nl2br($row['objective'])); ?>";
                    const institute_name1 = "<?php echo addslashes($row['institute_name1']); ?>";
                    const average_gpa1 = "<?php echo addslashes($row['average_gpa1']); ?>";
                    const university_name = "<?php echo addslashes($row['university_name']); ?>";
                    const institute_name2 = "<?php echo addslashes($row['institute_name2']); ?>";
                    const skills_abilities = "<?php echo addslashes(nl2br($row['skills_abilities'])); ?>";
                    const projects = "<?php echo addslashes(nl2br($row['projects'])); ?>";
                    const extracurricular = "<?php echo addslashes(nl2br($row['extracurricular'])); ?>";
                    const training = "<?php echo addslashes(nl2br($row['training'])); ?>";
                    const hobbies_interests = "<?php echo addslashes(nl2br($row['hobbies_interests'])); ?>";
                    const place = "<?php echo addslashes($row['place']); ?>";

                    doc.text(`Name: ${name}`, 10, 10);
                    doc.text(`Address: ${address}`, 10, 20);
                    doc.text(`Phone: ${phone}`, 10, 30);
                    doc.text(`Email: ${email}`, 10, 40);
                    doc.text(`LinkedIn: ${linkedin}`, 10, 50);
                    doc.text(`GitHub: ${github}`, 10, 60);
                    doc.text(`Objective: ${objective}`, 10, 70);
                    doc.text(`Institute Name: ${institute_name1}`, 10, 80);
                    doc.text(`Average GPA: ${average_gpa1}`, 10, 90);
                    doc.text(`University Name: ${university_name}`, 10, 100);
                    if (institute_name2) {
                        doc.text(`Institute Name: ${institute_name2}`, 10, 110);
                    }
                    doc.text(`Skills & Abilities: ${skills_abilities}`, 10, 120);
                    doc.text(`Projects: ${projects}`, 10, 130);
                    doc.text(`Extracurricular Activities: ${extracurricular}`, 10, 140);
                    doc.text(`Training: ${training}`, 10, 150);
                    doc.text(`Hobbies & Interests: ${hobbies_interests}`, 10, 160);
                    doc.text(`Place: ${place}`, 10, 170);

                    doc.save("resume.pdf");
                }
            </script>
        </head>
        <body>
        <div class="container">
            <header>
                <h1><?php echo $row['name']; ?></h1>
                <p><?php echo $row['address']; ?></p>
                <p>Phone: <?php echo $row['phone']; ?> | Email: <?php echo $row['email']; ?></p>
                <p>LinkedIn: <a href="<?php echo $row['linkedin']; ?>"><?php echo $row['linkedin']; ?></a></p>
                <p>GitHub: <a href="<?php echo $row['github']; ?>"><?php echo $row['github']; ?></a></p>
            </header>

            <section>
                <h2>Objective</h2>
                <p><?php echo nl2br($row['objective']); ?></p>
            </section>

            <section>
                <h2>Education</h2>
                <div class="job">
                    <h3><?php echo $row['institute_name1']; ?></h3>
                    <p>Average GPA / Percentage: <?php echo $row['average_gpa1']; ?></p>
                    <p>University Name: <?php echo $row['university_name']; ?></p>
                </div>
                <?php if ($row['institute_name2']) { ?>
                    <div class="job">
                        <h3><?php echo $row['institute_name2']; ?></h3>
                    </div>
                <?php } ?>
            </section>

            <section>
                <h2>Skills & Abilities</h2>
                <p><?php echo nl2br($row['skills_abilities']); ?></p>
            </section>

            <section>
                <h2>Projects</h2>
                <p><?php echo nl2br($row['projects']); ?></p>
            </section>

            <section>
                <h2>Extracurricular Activities</h2>
                <p><?php echo nl2br($row['extracurricular']); ?></p>
            </section>

            <section>
                <h2>Training</h2>
                <p><?php echo nl2br($row['training']); ?></p>
            </section>

            <section>
                <h2>Hobbies & Interests</h2>
                <p><?php echo nl2br($row['hobbies_interests']); ?></p>
            </section>

            <section>
                <h2>Place</h2>
                <p><?php echo $row['place']; ?></p>
            </section>

            <button id="editBtn" onclick="window.location.href='edit.php?id=<?php echo $id; ?>'">Edit</button>
            <button class="download-btn" onclick="downloadResume()">Download as PDF</button>
        </div>
        </body>
        </html>

        <?php
    } else {
        echo "No record found.";
    }
} else {
    echo "Invalid ID.";
}

$conn->close();
?>
