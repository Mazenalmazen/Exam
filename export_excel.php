<?php
include 'config.php';
global $conn;
// check_api_key();

$exam_num = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($exam_num > 0) {
    $sql = "SELECT name_std, num_std, degre_std, answered_at, answers_data FROM answers WHERE exam_num = '$exam_num' ORDER BY degre_std DESC";
    $result = $conn->query($sql);
    
    $export_data = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $detail = json_decode($row['answers_data'], true);
            $record = [
                "اسم الطالب" => $row['name_std'],
                "رقم الطالب" => $row['num_std'],
                "الدرجة الكلية" => $row['degre_std'],
                "وقت الإرسال" => $row['answered_at'],
            ];
            // إضافة تفاصيل الإجابات إلى سجل Excel
            for ($i = 1; $i <= $detail['count_ask']; $i++) {
                // يفترض أن الأسئلة المخزنة في answers_data تتضمن الإجابة المختارة
                $record["سؤال {$i}"] = "تمت الإجابة"; 
            }
            $export_data[] = $record;
        }
        echo json_encode($export_data); // يجب أن يرد بمصفوفة JSON
    } else {
        echo 'false'; // لا يوجد نتائج للتصدير
    }
} else {
    echo 'false';
}
?>