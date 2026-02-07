<?php

namespace ClassTest\Helpers;

class Auth {
    public static function login($user) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['user_role'] = $user['role'];
        $_SESSION['logged_in'] = true;
    }
    
    public static function logout() {
        session_destroy();
        session_start();
    }
    
    public static function check() {
        return isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
    }
    
    public static function user() {
        if (!self::check()) {
            return null;
        }
        
        return [
            'id' => $_SESSION['user_id'],
            'name' => $_SESSION['user_name'],
            'email' => $_SESSION['user_email'],
            'role' => $_SESSION['user_role']
        ];
    }
    
    public static function isAdmin() {
        $user = self::user();
        return $user && $user['role'] === 'admin';
    }
    
    public static function isStudent() {
        $user = self::user();
        return $user && $user['role'] === 'student';
    }
}
