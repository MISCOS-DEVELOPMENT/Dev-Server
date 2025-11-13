<?php
class SessionManager {
    private $timeout = 3600;
    
    public function startSecureSession() {
        ini_set('session.cookie_httponly', 1);
        ini_set('session.cookie_secure', 1);
        ini_set('session.use_strict_mode', 1);
        
        session_start();
        
        if (!$this->validateSession()) {
            $this->destroySession();
            return false;
        }
        
        $_SESSION['last_activity'] = time();
        
        return true;
    }
    
    private function validateSession() {
        if (!isset($_SESSION['u_id']) || !isset($_SESSION['u_name'])) {
            return false;
        }
        
        if (isset($_SESSION['last_activity']) && 
            (time() - $_SESSION['last_activity']) > $this->timeout) {
            return false;
        }
        
        if (!isset($_SESSION['created'])) {
            return false;
        }
        
        return true;
    }
    
    public function destroySession() {
        $_SESSION = array();
        
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        
        session_destroy();
    }
    
    public function isLoggedIn() {
        return isset($_SESSION['u_id']) && isset($_SESSION['u_name']);
    }
    
    public function redirectToLogin() {
        header("Location: admin_login.php");
        exit;
    }
}

$sessionManager = new SessionManager();
?>