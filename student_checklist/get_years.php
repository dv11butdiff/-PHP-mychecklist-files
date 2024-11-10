<?php
if (!isset($conn)) {
    include_once 'database.php';
}
$sql = "SELECT DISTINCT year_taken FROM subjects WHERE year_taken != 'Mid Year' ORDER BY year_taken";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $selected = '';
        if (isset($_POST['year']) && $_POST['year'] == $row['year_taken']) {
            $selected = 'selected';
        }
        echo "<option value='" . $row['year_taken'] . "' $selected>" . $row['year_taken'] . "</option>";
    }
} else {
    echo "<option value=''>No Years Found</option>";
}
$conn->close();
?>