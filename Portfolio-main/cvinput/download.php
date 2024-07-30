<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Resume Display</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }
        #resume-content {
            width: 210mm; /* A4 size in mm */
            max-width: 800px;
            padding: 20px;
            margin: 20px auto;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            margin-top: 0;
        }
        p {
            margin: 5px 0;
        }
        .button-container {
            text-align: center;
            margin: 20px 0;
        }
        .button-container button, .button-container input[type="submit"] {
            padding: 10px 20px;
            font-size: 16px;
            margin: 0 10px;
            cursor: pointer;
            border: none;
            border-radius: 4px;
        }
        .download-btn {
            background-color: #007bff;
            color: white;
        }
        .edit-btn {
            background-color: #28a745;
            color: white;
        }
    </style>
    <script>
        window.jsPDF = window.jspdf.jsPDF;

        function downloadResume() {
            const resumeContent = document.getElementById('resume-content');
            const pdf = new jsPDF('p', 'mm', 'a4');
            html2canvas(resumeContent).then(canvas => {
                const imgData = canvas.toDataURL('image/png');
                const imgWidth = 210; // A4 width in mm
                const pageHeight = 295; // A4 height in mm
                const imgHeight = canvas.height * imgWidth / canvas.width;
                let heightLeft = imgHeight;
                let position = 0;

                pdf.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
                heightLeft -= pageHeight;

                while (heightLeft >= 0) {
                    position = heightLeft - imgHeight;
                    pdf.addPage();
                    pdf.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
                    heightLeft -= pageHeight;
                }

                pdf.save('resume.pdf');
            }).catch(error => {
                console.error("Error generating PDF: ", error);
            });
        }
    </script>
</head>
<body>
    <div id="resume-content">
        <h2>Resume Details</h2>
        <p><strong>Name:</strong> <?php echo $row['name']; ?></p>
        <p><strong>Address:</strong> <?php echo $row['address']; ?></p>
        <p><strong>Phone:</strong> <?php echo $row['phone']; ?></p>
        <p><strong>Email:</strong> <?php echo $row['email']; ?></p>
        <p><strong>LinkedIn:</strong> <a href="<?php echo $row['linkedin']; ?>"><?php echo $row['linkedin']; ?></a></p>
        <p><strong>GitHub:</strong> <a href="<?php echo $row['github']; ?>"><?php echo $row['github']; ?></a></p>
        <p><strong>Objective:</strong> <?php echo nl2br($row['objective']); ?></p>
        <p><strong>Institute Name:</strong> <?php echo $row['institute_name1']; ?></p>
        <p><strong>Average GPA / Percentage:</strong> <?php echo $row['average_gpa1']; ?></p>
        <p><strong>University Name:</strong> <?php echo $row['university_name']; ?></p>
        <p><strong>Institute Name (if any):</strong> <?php echo $row['institute_name2']; ?></p>
        <p><strong>Skills & Abilities:</strong> <?php echo nl2br($row['skills_abilities']); ?></p>
        <p><strong>Projects:</strong> <?php echo nl2br($row['projects']); ?></p>
        <p><strong>Extracurricular Activities:</strong> <?php echo nl2br($row['extracurricular']); ?></p>
        <p><strong>Training:</strong> <?php echo nl2br($row['training']); ?></p>
        <p><strong>Hobbies & Interests:</strong> <?php echo nl2br($row['hobbies_interests']); ?></p>
        <p><strong>Place:</strong> <?php echo $row['place']; ?></p>
    </div>

    <div class="button-container">
        <button class="download-btn" onclick="downloadResume()">Download Resume</button>
        <form method="get" action="edit.php" style="display:inline;">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="submit" class="edit-btn" value="Edit Resume">
        </form>
    </div>
</body>
</html>
