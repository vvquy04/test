<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Tin Tức</title>
</head>
<body>
    <h1>Danh Sách Tin Tức</h1>
    <a href="index.php?page=admin&action=add">Thêm Tin Tức</a>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Tiêu Đề</th>
            <th>Danh Mục</th>
            <th>Hình Ảnh</th>
            <th>Thao Tác</th>
        </tr>
        <?php foreach ($news as $item): ?>
            <tr>
                <td><?= $item['id'] ?></td>
                <td><?= $item['title'] ?></td>
                <td><?= $item['category_name'] ?></td>
                <td><img src="images/<?= $item['image'] ?>" alt="" width="100"></td>
                <td>
                    <a href="index.php?page=admin&action=edit&id=<?= $item['id'] ?>">Sửa</a> | 
                    <a href="index.php?page=admin&action=delete&id=<?= $item['id'] ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
