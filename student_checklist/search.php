<?php
if (!isset($conn)) {
    include_once 'database.php';
}
$search = isset($_POST['search']) ? $_POST['search'] : '';
$sql = "SELECT
            s.course_code,
            s.course_title,
            s.sem_taken,
            s.year_taken,
            i.first_name AS instructor_first_name,
            i.last_name AS instructor_last_name,
            g.final_grade,
            g.grade_description
        FROM
            subjects s
        LEFT JOIN
            instructors i ON s.instructor_id = i.instructor_id
        LEFT JOIN
            grades g ON s.grade_id = g.grade_id
        WHERE
            (s.course_code LIKE '%$search%'
            OR s.course_title LIKE '%$search%'
            OR CONCAT(i.first_name, ' ', i.last_name) LIKE '%$search%')";
if (isset($_POST['year']) && $_POST['year'] != '') {
    $sql .= " AND s.year_taken = '{$_POST['year']}'";
}
if (isset($_POST['semester']) && $_POST['semester'] != '') {
    $semester = $_POST['semester'] == '1' ? '1st Semester' : '2nd Semester';
    $sql .= " AND s.sem_taken = '$semester'";
}
$sql .= " ORDER BY s.course_code";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search Results</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container mt-5">
        <div class="search-results">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='result-item'>";
                    echo "<h3>Course Code: " . $row["course_code"] . "</h3>";
                    echo "<p>Course Title: " . $row["course_title"] . "</p>";
                    echo "<p>Instructor: " . $row["instructor_first_name"] . " " . $row["instructor_last_name"] . "</p>";
                    echo "<p>Year Taken: " . $row["year_taken"] . "</p>";
                    echo "<p>Semester Taken: " . $row["sem_taken"] . "</p>";
                    echo "<p>Final Grade: " . $row["final_grade"] . "</p>";
                    echo "<p>Grade Description: " . $row["grade_description"] . "</p>";
                    echo "</div>";
                }
                echo '<form method="post" action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '" class="clear-btn">';
                echo '<input type="submit" name="clear_results" value="Clear Results">';
                echo '</form>';
            } else {
                echo "<p>No results found.</p>";
            }
            if (isset($_POST['clear_results'])) {
                $_POST['search'] = '';
                // Redirect to index.php
                echo "<script>window.location = 'index.php';</script>";
                exit; 
            }
            $conn->close();
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
        <img class="colorborder10" src="colorborder10.jpg" alt="Colorborder10">
        <img class="colorborder11" src="colorborder11.jpg" alt="Colorborder11">
        <img class="colorborder12" src="colorborder12.jpg" alt="Colorborder12">
        <img class="colorborder13" src="colorborder13.jpg" alt="Colorborder13">
</body>
</html>
