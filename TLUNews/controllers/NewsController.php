<?php
require_once APP_ROOT. '/TLUNews/models/News.php';

class NewsController {
    public function detail($id) {
        $newsModel = new News();
        $news = $newsModel->getNewsById($id);

        require_once APP_ROOT. '/TLUNews/views/news/detail.php';
    }

    public function add() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = $_POST['title'];
            $content = $_POST['content'];
            $image = $_FILES['image']['name'];
            $category_id = $_POST['category_id'];
            
            // Xử lý tải ảnh lên
            // Kiểm tra và lưu dữ liệu
            $newsModel = new News();
            $result = $newsModel->addNews($title, $content, $image, $category_id);
            
            if ($result) {
                header('Location: list-news');
            } else {
                $error = 'Có lỗi xảy ra, vui lòng thử lại.';
            }
        }
        require_once APP_ROOT . '/TLUNews/views/admin/News/.php';
    }
    
}
?>