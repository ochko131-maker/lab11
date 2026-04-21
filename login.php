<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="mn">

<head>
    <meta charset="UTF-8">
    <title>Нэвтрэх</title>
    <style>
        body {
            background: #a2d2df;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: Arial;
        }

        .login-card {
            background: white;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            width: 320px;
            text-align: center;
        }

        input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ddd;
            background: #eef3ff;
            border-radius: 8px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 12px;
            background: #7c69b3;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }
    </style>
</head>

<body>
    <div class="login-card">
        <h2>Нэвтрэх</h2>
        <form method="POST">
            <input type="text" name="user" placeholder="Хэрэглэгчийн нэр" required>
            <input type="password" name="pass" placeholder="Нууц үг" required>
            <button type="submit" name="login">Нэвтрэх</button>
        </form>
    </div>
</body>

</html>
<?php
if (isset($_POST['login'])) {
    $u = mysqli_real_escape_string($conn, $_POST['user']);
    $p = mysqli_real_escape_string($conn, $_POST['pass']);
    $res = mysqli_query($conn, "SELECT * FROM users WHERE username='$u' AND password='$p'");
    if (mysqli_num_rows($res) > 0) {
        $_SESSION['admin'] = $u;
        header("Location: dashboard.php");
    } else {
        echo "<script>alert('Нэвтрэх нэр эсвэл нууц үг буруу!');</script>";
    }
}
?>