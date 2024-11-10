<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Checklist</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container mt-5">
        <div class="student-info">
            <p><strong>Student Name:</strong> Villa, Titus Daniel Q.</p>
            <p><strong>Student Number:</strong> 202211869</p>
            <p><strong>Contact Number:</strong> 09683486354 </p>
            <p><strong>Address:</strong> Marigold Street, Alta Homes Subdivision, Molino 3 Bacoor City Cavite </p>
            <p><strong>Age:</strong> 21 </p>
        </div>
        <div class="title-top">
        <h2>CvSU Bacoor Campus</h2>
        </div>
        <div class="title-mid">
        <h2>Student Checklist</h2>
        </div>
        <div class="year-sem">
            <form method="post" action="search.php">
                <label for="year">CHOOSE YEAR:</label>
                <select name="year" id="year">
                    <?php include_once 'database.php'; ?>
                    <?php include_once 'get_years.php'; ?>
                </select>
                <label for="semester">CHOOSE SEMESTER:</label>
                <select name="semester" id="semester">
                    <option value="1">1st Semester</option>
                    <option value="2">2nd Semester</option>
                </select>
                <div class="show-results">
                <input type="submit" value="Show Results">
            </form>
        </div>
        <div class="search-container mt-5">
            <h2>SEARCH BAR</h2>
            <form method="GET" action="">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search or type for the course code, subject, instructor, or grade information..." name="search">
                    <div class="search-find">
                        <button class="btn btn-primary" type="submit">Search or Find</button>
                    </div>
                </div>
            </form>
            <?php
            if (isset($_GET['search']) && !empty($_GET['search'])) {
                $search = $_GET['search'];
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "checklist";
                $conn = new mysqli($servername, $username, $password, $dbname);
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                $sql = "SELECT
                            s.course_code,
                            s.course_title,
                            s.sem_taken,
                            s.year_taken,
                            g.final_grade,
                            g.grade_description,
                            g.grade_range,
                            i.first_name AS instructor_first_name,
                            i.last_name AS instructor_last_name,
                            i.teaching_year AS instructor_teaching_year
                        FROM
                            subjects s
                        LEFT JOIN
                            grades g ON s.grade_id = g.grade_id
                        LEFT JOIN
                            instructors i ON s.instructor_id = i.instructor_id
                        WHERE
                            s.course_title LIKE '%$search%' OR
                            s.course_code LIKE '%$search%' OR
                            i.first_name LIKE '%$search%' OR
                            i.last_name LIKE '%$search%' OR
                            g.final_grade = '$search'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    echo "<h4>Search Results:</h4>";
                    echo "<table class='table table-striped'>";
                    echo "<tr>
                            <th>Course Code</th>
                            <th>Course Title</th>
                            <th>Semester Taken</th>
                            <th>Year Taken</th>
                            <th>Final Grade</th>
                            <th>Grade Description</th>
                            <th>Grade Range</th>
                            <th>Instructor First Name</th>
                            <th>Instructor Last Name</th>
                            <th>Instructor Teaching Year</th>
                          </tr>";
                    while ($row = $result->fetch_assoc()) {
                        echo "<div class='table-searchbar'>";
                        echo "<tr>";
                        echo "<td>" . $row['course_code'] . "</td>";
                        echo "<td>" . $row['course_title'] . "</td>";
                        echo "<td>" . $row['sem_taken'] . "</td>";
                        echo "<td>" . $row['year_taken'] . "</td>";
                        echo "<td>" . $row['final_grade'] . "</td>";
                        echo "<td>" . $row['grade_description'] . "</td>";
                        echo "<td>" . $row['grade_range'] . "</td>";
                        echo "<td>" . $row['instructor_first_name'] . "</td>";
                        echo "<td>" . $row['instructor_last_name'] . "</td>";
                        echo "<td>" . $row['instructor_teaching_year'] . "</td>";
                        echo "</tr>";
                        echo "</div>";
                    }
                    echo "</table>";
                } else {
                    echo "<p>No results found.</p>";
                }
                $conn->close();
            }
            ?>
        <img class="logo1" src="logo1.png" alt="Logo1">
        <img class="colorborder" src="colorborder.jpg" alt="Colorborder">
        <img class="colorborder2" src="colorborder2.jpg" alt="Colorborder2">
        <img class="colorborder3" src="colorborder3.jpg" alt="Colorborder3">
        <img class="colorborder4" src="colorborder4.jpg" alt="Colorborder4">
        <img class="colorborder5" src="colorborder5.jpg" alt="Colorborder5">
        <img class="colorborder6" src="colorborder6.jpg" alt="Colorborder6">
        <img class="colorborder7" src="colorborder7.jpg" alt="Colorborder7">
        <img class="colorborder8" src="colorborder8.jpg" alt="Colorborder8">
        <img class="colorborder9" src="colorborder9.jpg" alt="Colorborder9">
</body>
</html>
