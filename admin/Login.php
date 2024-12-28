<!DOCTYPE html>
<html>
<head>
    <title>Đăng nhập</title>
    <link rel="stylesheet" type="text/css" href="../style/style.css">
</head>
<body>
    <div class="login-container">
        <h2>Đăng nhập</h2>
        <?php if (isset($_GET['error'])): ?>
            <p class="error" style="color:red; display: flex; justify-content: center;">
                <?php echo htmlspecialchars($_GET['error']); ?>
            </p>
        <?php endif; ?>
        <form method="post" action="../admin/src_xuli/XulyLogin.php"> 
            <input type="text" name="username" placeholder="Tên đăng nhập">
            <input type="password" name="password" placeholder="Mật khẩu">
            <input type="submit" value="Đăng nhập">
        </form>
    </div>
</body>
</html>
