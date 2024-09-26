<?php
    class SessionManager {
        public static function startSession() {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
        }
    
        public static function get($key) {
            self::startSession(); // Garante que a sessão foi iniciada
            return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
        }
    
        public static function set($key, $value) {
            self::startSession(); // Garante que a sessão foi iniciada
            $_SESSION[$key] = $value;
        }
    
        public static function destroySession() {
            if (session_status() == PHP_SESSION_ACTIVE) {
                session_destroy();
            }
        }
    }
    