<?php
// إعدادات الاتصال والأمان
define('API_KEY', 'AlzaSyCh5FyMdQLD-SA4t2o7VJSVKbLcAwDw7U');

// بيانات الاتصال بقاعدة البيانات (عدّلها حسب مزود الخدمة الجديد)
define('DB_HOST', 'your-db-host.com');       // مثال: db.render.com أو أي مزود خارجي
define('DB_USER', 'your_db_username');       // اسم المستخدم
define('DB_PASS', 'your_db_password');       // كلمة المرور
define('DB_NAME', 'your_db_name');           // اسم قاعدة البيانات

// ---------------- CORS Configuration (Mandatory) ----------------
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-API-Key");
header("Content-Type: application/json");

// Handle preflight OPTIONS request
if (_SERVER['REQUEST_METHOD'] == 'OPTIONS') 
    http_response_code(200);
    exit();


// —————- Database Connection —————-conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($conn->connect_error) {
    http_response_code(500);
echo json_encode(["error" => "Database Connection Failed: " .conn->connect_error]);
    exit();
}

// ---------------- API Key Check ----------------
function check_api_key() {
    headers = getallheaders();apiKey = isset(headers['X-API-Key']) ?headers['X-API-Key'] : (isset(headers['x-api-key']) ?headers['x-api-key'] : '');
    
    if ($apiKey !== API_KEY) {
        http_response_code(401);
        echo json_encode(["error" => "Unauthenticated: Invalid API Key"]);
        exit();
    }
}
// check_api_key(); 
?>
