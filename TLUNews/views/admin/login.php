<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng Nhập Quản Trị</title>
</head>
<body>
    <h1>Đăng Nhập Quản Trị</h1>
    
    <?php if(isset($error)): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>

    <form method="POST" action="">
        <div>
            <label>Tên đăng nhập:</label>
            <input type="text" name="username" required>
        </div>
        <div>
            <label>Mật khẩu:</label>
            <input type="password" name="password" required>
        </div>
        <button type="submit">Đăng Nhập</button>
    </form>
</body>
</html>