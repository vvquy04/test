<?php
require_once APP_ROOT. '/TLUNews/models/User.php';

class AdminController {
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $userModel = new User();
            $user = $userModel->login($username, $password);

            if ($user && $user['role'] == 1) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['role'] = $user['role'];
                header('Location: dashboard');
                exit();
            } else {
                $error = "Sai thông tin đăng nhập";
            }
        }
        require_once APP_ROOT. '/TLUNews/views/admin/login.php';
    }

    public function dashboard() {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 1) {
            header('Location: login');
            exit();
        }
        require_once APP_ROOT. '/TLUNews/views/admin/dashboard.php';
    }

    public function logout() {
        session_unset();
        session_destroy();
        header('Location: login');
        exit();
    }
}
?>