<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($news['title']); ?></title>
</head>

<body>
    <div>
        <div class="news-list">
            <?php if (isset($news) && $news): ?>
                <?php foreach ($news as $item): ?>
                    <div class="news-item">
                        <h3>
                            <a href="news/detail/<?php echo $item['id']; ?>">
                                <?php echo htmlspecialchars($item['title']); ?>
                            </a>
                        </h3>
                        <img src="<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['title']); ?>">
                        <p><?php echo substr(htmlspecialchars($item['content']), 0, 200); ?>...</p>
                        <small>Danh mục: <?php echo htmlspecialchars($item['category_name']); ?></small>
                        <small>Ngày đăng: <?php echo date('d/m/Y', strtotime($item['created_at'])); ?></small>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Không có tin tức nào.</p>
            <?php endif; ?>
        </div>
       
</body>

</html>