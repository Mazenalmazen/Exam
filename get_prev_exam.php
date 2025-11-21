<?php
include 'config.php';
global $conn;
// check_api_key(); 

$num = $conn->real_escape_string($_POST['num'] ?? '');
$pass = $conn->real_escape_string($_POST['pass'] ?? '');
$email = $conn->real_escape_string($_POST['email'] ?? '');

$sql = "SELECT exam_data FROM exams WHERE t_num = '$num' AND t_email = '$email' LIMIT 1";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $exam_data_str = $row['exam_data'];
    $exam_data_obj = json_decode($exam_data_str, true);
    
    // التحقق من كلمة مرور المعلم المخزنة في الـ JSON
    if (isset($exam_data_obj['t_pass_start']) && $exam_data_obj['t_pass_start'] == $pass) {
        // إرجاع بيانات الاختبار (كما يتوقع JS القديم)
        echo $exam_data_str; 
    } else {
        echo 'no'; // كلمة مرور غير صحيحة
    }
} else {
    echo 'noResult'; 
}
?>