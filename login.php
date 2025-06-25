<?php
$login = 0;
$invalid = 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'config.php';
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM `registration` WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $num = mysqli_num_rows($result);
        if ($num > 0) {
            $login = 1;
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['login_success'] = true;
            header('location:dashboard.php');
            exit;
        } else {
            $invalid = 1;
        }
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Page</title>

    <!-- Bootstrap & Font Awesome -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            background: linear-gradient(to right, #74ebd5, #ACB6E5);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-box {
            background-color: #fff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        .login-box h2 {
            margin-bottom: 30px;
            text-align: center;
            color: #333;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #4e73df;
        }

        .input-group-text {
            background-color: #4e73df;
            color: white;
            border: none;
        }
    </style>
</head>
<body>

<div class="login-box">
    <h2>Đăng nhập</h2>

    <?php if ($login): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Thành công!</strong> Đăng nhập thành công.
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    <?php endif; ?>

    <?php if ($invalid): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Lỗi!</strong> Tên đăng nhập hoặc mật khẩu không đúng.
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    <?php endif; ?>

    <form method="POST" action="login.php">
        <div class="form-group">
            <label for="username">Tên đăng nhập</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                </div>
                <input type="text" name="username" class="form-control" placeholder="Nhập tên đăng nhập" required>
            </div>
        </div>

        <div class="form-group">
            <label for="password">Mật khẩu</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                </div>
                <input type="password" name="password" class="form-control" placeholder="Nhập mật khẩu" required>
            </div>
        </div>

        <button type="submit" class="btn btn-primary btn-block">Đăng nhập</button>
    </form>
</div>

<!-- JS -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
