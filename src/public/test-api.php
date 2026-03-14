<?php

function request($url, $data, $token = null) {
    global $argv;
    $ch = curl_init('http://web'.$url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $headers = [
        'Content-Type: application/json',
        'Accept: application/json'
    ];
    if ($token) {
        $headers[] = 'Authorization: Bearer ' . $token;
    }
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    if ($data) {
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    }
    $response = curl_exec($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    echo "[$code] $url => $response\n";
    return json_decode($response, true);
}

// 1. Register a user
echo "--- Register User ---\n";
$user = request('/api/register', [
    'name' => 'Regular User',
    'email' => 'user@rajawisata.com',
    'password' => 'password',
    'password_confirmation' => 'password'
]);
$userToken = $user['access_token'] ?? null;

// 2. Login as Admin
echo "\n--- Login Admin ---\n";
$admin = request('/api/login', [
    'email' => 'admin@rajawisata.com',
    'password' => 'password'
]);
$adminToken = $admin['access_token'] ?? null;

// 3. Test Role Isolation
echo "\n--- Test Admin Endpoint (with Admin Token) ---\n";
request('/api/admin-only', null, $adminToken);

echo "\n--- Test Admin Endpoint (with User Token) ---\n";
request('/api/admin-only', null, $userToken);

echo "\n--- Test User Endpoint (with Admin Token) ---\n";
request('/api/user-only', null, $adminToken);

echo "\n--- Test User Endpoint (with User Token) ---\n";
request('/api/user-only', null, $userToken);

// 4. Logout
echo "\n--- Logout ---\n";
if ($userToken) request('/api/logout', 'dummy', $userToken);
if ($adminToken) request('/api/logout', 'dummy', $adminToken);
