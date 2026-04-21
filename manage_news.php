<?php
include 'config.php';
// Админ нэвтэрсэн эсэхийг шалгах
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

// 1. НЭМЭХ ҮЙЛДЭЛ (Create)
if (isset($_POST['add'])) {
    $t = mysqli_real_escape_string($conn, $_POST['title']);
    $d = mysqli_real_escape_string($conn, $_POST['desc']);
    mysqli_query($conn, "INSERT INTO projects (title, description) VALUES ('$t', '$d')");
    header("Location: manage_news.php");
}

// 2. УСТГАХ ҮЙЛДЭЛ (Delete)
if (isset($_GET['del'])) {
    $id = $_GET['del'];
    mysqli_query($conn, "DELETE FROM projects WHERE id=$id");
    header("Location: manage_news.php");
}

// 3. ЗАСАХ (Update) ҮЙЛДЭЛ
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $t = mysqli_real_escape_string($conn, $_POST['title']);
    $d = mysqli_real_escape_string($conn, $_POST['desc']);
    mysqli_query($conn, "UPDATE projects SET title='$t', description='$d' WHERE id=$id");
    header("Location: manage_news.php");
}

// Засах өгөгдлийг формонд татаж гаргах
$edit_data = null;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $res = mysqli_query($conn, "SELECT * FROM projects WHERE id=$id");
    $edit_data = mysqli_fetch_assoc($res);
}
?>
<!DOCTYPE html>
<html lang="mn">

<head>
    <meta charset="UTF-8">
    <title>Мэдээ удирдах</title>
    <style>
        body {
            font-family: sans-serif;
            background: #f4f7f6;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        input,
        textarea {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .btn {
            padding: 10px 25px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            color: white;
        }

        .btn-save {
            background: #28a745;
        }

        .btn-update {
            background: #ffc107;
            color: black;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
        }

        th,
        td {
            border-bottom: 1px solid #eee;
            padding: 15px;
            text-align: left;
        }

        th {
            background: #f8f9fa;
        }

        .edit-link {
            color: #f39c12;
            text-decoration: none;
            margin-right: 15px;
        }

        .del-link {
            color: #e74c3c;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2><?php echo $edit_data ? "Мэдээ засах" : "Шинэ мэдээ/төсөл нэмэх"; ?></h2>

        <form method="POST">
            <input type="hidden" name="id" value="<?php echo $edit_data['id'] ?? ''; ?>">

            <input type="text" name="title" placeholder="Мэдээний гарчиг"
                value="<?php echo $edit_data['title'] ?? ''; ?>" required>
            <textarea name="desc" placeholder="Агуулга / Тайлбар" rows="6"
                required><?php echo $edit_data['description'] ?? ''; ?></textarea>

            <?php if ($edit_data): ?>
                <button type="submit" name="update" class="btn btn-update">Шинэчлэн хадгалах</button>
                <a href="manage_news.php" style="margin-left:10px; color:#666;">Цуцлах</a>
                <?php else: ?>
                <button type="submit" name="add" class="btn btn-save">Нийтлэх</button>
                <?php endif; ?>
        </form>

        <h3>Нийтлэгдсэн мэдээллүүд</h3>
        <table>
            <tr>
                <th>Гарчиг</th>
                <th>Үйлдэл</th>
            </tr>
                <?php
                $projects = mysqli_query($conn, "SELECT * FROM projects ORDER BY id DESC");
                while ($p = mysqli_fetch_assoc($projects)) {
                    echo "<tr>
                <td>{$p['title']}</td>
                <td>
                    <a href='?edit={$p['id']}' class='edit-link'>Засах</a>
                    <a href='?del={$p['id']}' class='del-link' onclick='return confirm(\"Устгах уу?\")'>Устгах</a>
                </td>
            </tr>";
                }
                ?>
        </table>
        <br>
        <a href="dashboard.php" style="text-decoration:none; color:#3498db;">← Админ удирдлага руу буцах</a>
    </div>
</body>

</html>