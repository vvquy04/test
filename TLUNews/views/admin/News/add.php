

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm Tin Tức Mới</title>
</head>
<body>
    <h1>Thêm Tin Tức Mới</h1>
    
    <?php if(isset($error)): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data">
        <div>
            <label>Tiêu đề:</label>
            <input type="text" name="title" required>
        </div>
        <div>
            <label>Nội dung:</label>
            <textarea name="content" required></textarea>
        </div>
        <div>
            <label>Danh mục:</label>
            <select name="category_id" required>
                <?php foreach($categories as $category): ?>
                    <option value="<?php echo $category['id']; ?>">
                        <?php echo htmlspecialchars($category['name']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div>
            <label>Ảnh:</label>
            <input type="file" name="image">
        </div>
        <button type="submit">Thêm Tin Tức</button>
    </form>
</body>
</html>