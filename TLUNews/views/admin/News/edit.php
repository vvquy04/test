<?php
session_start();
require_once APP_ROOT.'TLUNews/models/News.php';
require_once APP_ROOT.'TLUNews/models/Category.php';

// Kiểm tra đăng nhập
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 1) {
    header('Location: admin/login');
    exit();
}

$newsModel = new News();
$categoryModel = new Category();

// Lấy thông tin tin tức cần sửa
$news_id = $_GET['id'] ?? null;
$news = $newsModel->getNewsById($news_id);

if (!$news) {
    header('Location: admin/dashboard');
    exit();
}

$categories = $categoryModel->getAllCategories();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $category_id = $_POST['category_id'];
    $image = ''; // Xử lý upload ảnh nếu cần

    // Sửa tin tức trong CSDL (bạn cần bổ sung phương thức này trong model)
    $result = $newsModel->updateNews($news_id, $title, $content, $image, $category_id);

    if ($result) {
        header('Location: admin/dashboard');
        exit();
    } else {
        $error = "Sửa tin tức thất bại";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Sửa Tin Tức</title>
</head>
<body>
    <h1>Sửa Tin Tức</h1>
    
    <?php if(isset($error)): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data">
        <div>
            <label>Tiêu đề:</label>
            <input type="text" name="title" value="<?php echo htmlspecialchars($news['title']); ?>" required>
        </div>
        <div>
            <label>Nội dung:</label>
            <textarea name="content" required><?php echo htmlspecialchars($news['content']); ?></textarea>
        </div>
        <div>
            <label>Danh mục:</label>
            <select name="category_id" required>
                <?php foreach($categories as $category): ?>
                    <option value="<?php echo $category['id']; ?>" 
                        <?php echo ($category['id'] == $news['category_id']) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($category['name']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div>
            <label>Ảnh:</label>
            <input type="file" name="image">
            <?php if($news['image']): ?>
                <img src="<?php echo htmlspecialchars($news['image']); ?>" width="100">
            <?php endif; ?>
        </div>
        <button type="submit">Lưu Thay Đổi</button>
    </form>
</body>
</html>