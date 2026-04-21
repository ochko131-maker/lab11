<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="mn">

<head>
    <meta charset="UTF-8">
    <title>Миний Вэб</title>
    <style>
        body {
            background: #0a192f;
            color: white;
            font-family: sans-serif;
            margin: 0;
        }

        nav {
            background: #0a192f;
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid #1e2d44;
        }

        nav a {
            color: #f1c40f;
            margin: 0 15px;
            text-decoration: none;
            font-weight: bold;
        }

        .content {
            padding: 50px;
            text-align: center;
        }

        .project-card {
            background: #112240;
            padding: 20px;
            margin: 20px auto;
            max-width: 700px;
            border-radius: 10px;
            border-left: 5px solid #f1c40f;
            text-align: left;
        }
    </style>
</head>

<body>
    <nav>
        <?php
        $menus = mysqli_query($conn, "SELECT * FROM menus");
        while ($m = mysqli_fetch_assoc($menus)) {
            echo "<a href='{$m['menu_link']}'>" . mb_strtoupper($m['menu_name']) . "</a>";
        }
        ?>
    </nav>

    <div class="content">
        <h1>Сайн уу!</h1>
        <p>Админ хэсэгт нэмэгдсэн мэдээллүүд доор харагдаж байна:</p>

        <?php
        $projs = mysqli_query($conn, "SELECT * FROM projects");
        while ($p = mysqli_fetch_assoc($projs)) {
            echo "<div class='project-card'>
                    <h2 style='color:#f1c40f'>{$p['title']}</h2>
                    <p>{$p['description']}</p>
                  </div>";
        }
        ?>
    </div>
</body>

</html>