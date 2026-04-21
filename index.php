<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="mn">

<head>
    <meta charset="UTF-8">
    <title>Миний Портфолио</title>
    <style>
        body {
            background: #0a192f;
            color: white;
            font-family: sans-serif;
            margin: 0;
        }

        nav {
            background: #0a192f;
            padding: 25px;
            text-align: center;
            border-bottom: 1px solid #1e2d44;
            position: sticky;
            top: 0;
        }

        nav a {
            color: #f1c40f;
            margin: 0 20px;
            text-decoration: none;
            font-weight: bold;
            font-size: 14px;
        }

        .container {
            max-width: 1000px;
            margin: auto;
            padding: 50px 20px;
            text-align: center;
        }

        h2 {
            color: #ccd6f6;
            margin-bottom: 40px;
        }

        .skills-grid {
            display: flex;
            justify-content: center;
            gap: 15px;
            flex-wrap: wrap;
        }

        .skill-item {
            background: #112240;
            padding: 20px 40px;
            border: 1px solid #f1c40f;
            color: #f1c40f;
            border-radius: 5px;
            min-width: 100px;
        }

        .project-card {
            background: #112240;
            padding: 30px;
            margin: 20px 0;
            border-radius: 10px;
            text-align: left;
            border-left: 5px solid #f1c40f;
        }
    </style>
</head>

<body>
    <nav>
        <?php
        $menus = mysqli_query($conn, "SELECT * FROM menus");
        while ($m = mysqli_fetch_assoc($menus))
            echo "<a href='{$m['menu_link']}'>" . mb_strtoupper($m['menu_name']) . "</a>";
        ?>
    </nav>

    <div class="container">
        <h1>Сайн уу! </h1>

        <h2>Миний Ур Чадварууд</h2>
        <div class="skills-grid">
            <?php
            $skills = mysqli_query($conn, "SELECT * FROM skills");
            while ($s = mysqli_fetch_assoc($skills))
                echo "<div class='skill-item'>{$s['skill_name']}</div>";
            ?>
        </div>

        <h2 style="margin-top: 80px;">Бүтээсэн төсөл</h2>
        <?php
        $projects = mysqli_query($conn, "SELECT * FROM projects");
        while ($p = mysqli_fetch_assoc($projects)) {
            echo "<div class='project-card'>
                    <h3 style='color:#f1c40f'>{$p['title']}</h3>
                    <p>{$p['description']}</p>
                  </div>";
        }
        ?>
    </div>
</body>

</html>