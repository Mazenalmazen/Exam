<?php
// عرض الأخطاء للتصحيح
ini_set('display_errors', 1);
error_reporting(E_ALL);

// إعدادات الاتصال والأمان
define('API_KEY', 'AlzaSyCh5FyMdQLD-SA4t2o7VJSVKbLcAwDw7U');
define('DB_HOST', 'sqlxxx.infinityfree.com');  // عدّل حسب بياناتك
define('DB_USER', 'if0_xxxxxx');               // عدّل حسب بياناتك
define('DB_PASS', 'your_db_password');         // عدّل حسب بياناتك
define('DB_NAME', 'if0_xxxxxx_exams');         // عدّل حسب بياناتك

// إعداد رؤوس CORS المطلوبة
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-API-Key");
header("Content-Type: application/json");

// التعامل مع طلبات OPTIONS (Preflight)
if (_SERVER['REQUEST_METHOD'] === 'OPTIONS') 
    http_response_code(200);
    exit();


// إنشاء اتصال قاعدة البياناتconn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if (conn->connect_error) 
    http_response_code(500);
    echo json_encode(["error" => "Database Connection Failed: " .conn->connect_error]);
    exit();
}

// التحقق من API Key (إلغاء التعليق إذا أردت التفعيل)
/*
function check_api_key() {headers = getallheaders();apiKey = isset(headers['X-API-Key']) ?headers['X-API-Key'] : (isset(headers['x-api-key']) ?headers['x-api-key'] : '');
    if ($apiKey !== API_KEY) {
        http_response_code(401);
        echo json_encode(["error" => "Unauthenticated: Invalid API Key"]);
        exit();
    }
}
check_api_key();
*/
?>
