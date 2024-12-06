<?php
require_once dirname(__FILE__, 2) . '/Config/config.php';
require_once APP_ROOT . '/TLUNews/models/News.php';
require_once APP_ROOT . '/TLUNews/models/Category.php';

class HomeController
{
    public function index()
    {
        // Kiểm tra xem người dùng đã đăng nhập chưa
        if (!isset($_SESSION['user_id'])) {
            // Nếu chưa đăng nhập, hiển thị form đăng nhập
            require_once APP_ROOT . '/TLUNews/views/home/index.php';
        } else {
            // Nếu đã đăng nhập, hiển thị trang chủ (tin tức, v.v.)
            $newsModel = new News();
            $categoryModel = new Category();

            $news = $newsModel->getAllNews();
            $categories = $categoryModel->getAllCategories();

            require_once APP_ROOT . '/TLUNews/views/home/index.php';
        }
    }

    public function search()
    {
        $keyword = $_GET['search'] ?? '';
        $newsModel = new News();
        $news = $newsModel->searchNews($keyword);
        require_once APP_ROOT . '/TLUNews/views/home/search.php';
    }

}

$mm = new HomeController();
$mm->index();
