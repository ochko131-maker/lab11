<?php include 'config.php';
is_logged_in(); ?>
<!DOCTYPE html>
<html lang="mn">

<head>
    <meta charset="UTF-8">
    <title>Админ удирдлага</title>
    <style>
        body {
            font-family: sans-serif;
            background: #eef2f3;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .dashboard-card {
            background: white;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            width: 350px;
            text-align: center;
        }

        .btn {
            display: block;
            padding: 15px;
            margin: 12px 0;
            background: white;
            color: #3498db;
            text-decoration: none;
            border-radius: 10px;
            border: 1px solid #3498db;
            font-weight: bold;
            transition: 0.3s;
        }

        .btn:hover {
            background: #3498db;
            color: white;
        }
    </style>
</head>

<body>
    <div class="dashboard-card">
        <h1>Админ удирдлага</h1>
        <a href="manage_menu.php" class="btn">Цэс удирдах</a>
        <a href="manage_skills.php" class="btn">Ур чадвар удирдах</a>
        <a href="manage_news.php" class="btn">Мэдээ удирдах</a>
        <a href="logout.php" style="color: #666; text-decoration: none; font-size: 14px;">Гарах</a>
    </div>
</body>

</html>