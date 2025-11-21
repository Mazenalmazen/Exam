<?php
include 'config.php';
// check_api_key();

if (isset($_FILES['file'])) {
    $file = $_FILES['file'];
    $file_name = uniqid() . '_' . basename($file['name']);
    $target_dir = "../uploadIMG/"; // يجب أن يكون مجلد 'uploadIMG' موجوداً في جذر الاستضافة

    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }
    
    $target_file = $target_dir . $file_name;

    if (move_uploaded_file($file['tmp_name'], $target_file)) {
        echo $file_name; // يرد باسم الملف المخزن
    } else {
        http_response_code(500);
        echo json_encode(["error" => "Failed to upload file."]);
    }
} else {
    http_response_code(400);
    echo json_encode(["error" => "No file uploaded."]);
}
?>