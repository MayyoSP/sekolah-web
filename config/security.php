<?php
// File: config/security.php
// Fungsi keamanan untuk website

// Fungsi untuk membersihkan input
function cleanInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Fungsi validasi email
function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// Fungsi untuk generate CSRF token
function generateCSRFToken() {
    if(!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

// Fungsi untuk verifikasi CSRF token
function verifyCSRFToken($token) {
    return isset($_SESSION['csrf_token']) && 
           hash_equals($_SESSION['csrf_token'], $token);
}

// Fungsi untuk rate limiting
function checkRateLimit($action, $limit = 5, $timeframe = 300) {
    $ip = $_SERVER['REMOTE_ADDR'];
    $key = $action . '_' . $ip;
    
    if(!isset($_SESSION['rate_limit'][$key])) {
        $_SESSION['rate_limit'][$key] = [
            'count' => 1,
            'first_attempt' => time()
        ];
        return true;
    }
    
    $data = $_SESSION['rate_limit'][$key];
    
    // Reset jika sudah melewati timeframe
    if(time() - $data['first_attempt'] > $timeframe) {
        $_SESSION['rate_limit'][$key] = [
            'count' => 1,
            'first_attempt' => time()
        ];
        return true;
    }
    
    // Cek apakah sudah melebihi limit
    if($data['count'] >= $limit) {
        return false;
    }
    
    $_SESSION['rate_limit'][$key]['count']++;
    return true;
}

// Fungsi untuk log aktivitas
function logActivity($action, $details = '') {
    $log_file = 'logs/activity.log';
    $timestamp = date('Y-m-d H:i:s');
    $ip = $_SERVER['REMOTE_ADDR'];
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    
    $log_entry = "[$timestamp] IP: $ip | Action: $action | Details: $details | User-Agent: $user_agent\n";
    
    file_put_contents($log_file, $log_entry, FILE_APPEND | LOCK_EX);
}
?>