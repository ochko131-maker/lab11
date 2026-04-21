<?php include 'config.php';
is_logged_in(); ?>
<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            background: #f4f7f6;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: Arial;
        }

        .dashboard {
            background: white;
            padding: 50px;
            border-radius: 15px;
            text-align: center;
            width: 350px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .btn {
            display: block;
            margin: 10px 0;
            padding: 15px;
            background: #fff;
            border: 1px solid #3498db;
            color: #3498db;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }

        .btn:hover {
            background: #3498db;
            color: white;
        }
    </style>
</head>

<body>
    <div class="dashboard">
        <h1>Админ удирдлага</h1>
        <a href="manage_menu.php" class="btn">Цэс удирдах</a>
        <a href="manage_news.php" class="btn">Мэдээ удирдах</a>
        <a href="logout.php" style="color: #666; text-decoration: none;">Гарах</a>
    </div>
</body>

</html>