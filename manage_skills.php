<?php include 'config.php';
is_logged_in();

if (isset($_POST['add'])) {
    $name = mysqli_real_escape_string($conn, $_POST['skill_name']);
    mysqli_query($conn, "INSERT INTO skills (skill_name) VALUES ('$name')");
}
if (isset($_GET['del'])) {
    $id = $_GET['del'];
    mysqli_query($conn, "DELETE FROM skills WHERE id=$id");
    header("Location: manage_skills.php");
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Ур чадвар</title>
    <style>
        body {
            font-family: Arial;
            padding: 30px;
            background: #f4f4f4;
        }

        .box {
            background: white;
            padding: 25px;
            border-radius: 10px;
            max-width: 500px;
            margin: auto;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border-bottom: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
    </style>
</head>

<body>
    <div class="box">
        <h2>Ур чадвар нэмэх</h2>
        <form method="POST">
            <input type="text" name="skill_name" placeholder="Жишээ: React, PHP" required>
            <button type="submit" name="add"
                style="background:#2ecc71; color:white; border:none; padding:10px; width:100%; cursor:pointer; border-radius:5px;">Нэмэх</button>
        </form>
        <table>
            <tr>
                <th>Нэр</th>
                <th>Үйлдэл</th>
            </tr>
            <?php
            $res = mysqli_query($conn, "SELECT * FROM skills");
            while ($r = mysqli_fetch_assoc($res)) {
                echo "<tr><td>{$r['skill_name']}</td><td><a href='?del={$r['id']}' style='color:red;'>Устгах</a></td></tr>";
            }
            ?>
        </table>
        <br><a href="dashboard.php">← Буцах</a>
    </div>
</body>

</html>