<?php
include 'config.php';
global $conn;
// check_api_key(); 

$exam_num = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($exam_num > 0) {
    $sql = "SELECT * FROM answers WHERE exam_num = '$exam_num' ORDER BY answered_at ASC";
    $result = $conn->query($sql);
    
    if ($result && $result->num_rows > 0) {
        // بناء جدول النتائج كما يتوقعه JS القديم
        while ($row = $result->fetch_assoc()) {
            $row_data = htmlspecialchars(json_encode($row));
            
            echo "
            <tr id='row_{$row['answers_id']}'>
                <td>{$row['num_std']}</td>
                <td>{$row['name_std']}</td>
                <td>0</td> <!-- Placeholder for CAP_test count -->
                <td>0</td> <!-- Placeholder for Wifi_test count -->
                <td>0</td> <!-- Placeholder for OUT_test count -->
                <td>{$row['degre_std']}</td>
                <td style='display:none;'>
                    <button class='desine-btn' onclick='start_exam(\"{$row['exam_num']}\", {$row_data}, \"demo\")'>عرض</button>
                </td>
            </tr>
            ";
        }
    } else {
        echo '<tr><td colspan="6">لا توجد نتائج حتى الآن !</td></tr>';
    }
} else {
    echo '<tr><td colspan="6">رقم اختبار غير صحيح</td></tr>';
}
?>