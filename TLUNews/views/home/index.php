<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Trang Chủ</title>
</head>

<body>
    <h1>Danh Sách Tin Tức</h1>

    <div class="categories">
        <h2>Danh Mục</h2>
        <?php if (isset($categories) && !empty($categories)): ?>
            <?php foreach ($categories as $category): ?>
                <a href="category/<?php echo $category['id']; ?>">
                    <?php echo htmlspecialchars($category['name']); ?>
                </a>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Không có danh mục nào.</p>
        <?php endif; ?>
    </div>
    <?php
     include APP_ROOT . '/TLUNews/views/news/detail.php';
     ?>
</body>

</html>