<?php
include 'config.php';
global $conn;
// check_api_key();

$sql = "SELECT stat_key, stat_value FROM app_stats";
$result = $conn->query($sql);

$stats = [];
if ($result && $result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $stats[$row['stat_key']] = $row['stat_value'];
    }
} else {
    $stats = ["Ads" => 0, "Exams" => 0, "Answers" => 0]; // قيمة احتياطية
}
echo json_encode($stats);
?>