<?php include 'config.php';
is_logged_in();

// Нэмэх
if (isset($_POST['add_news'])) {
    $t = $_POST['title'];
    $d = $_POST['desc'];
    mysqli_query($conn, "INSERT INTO projects (title, description) VALUES ('$t', '$d')");
}
// Устгах
if (isset($_GET['del'])) {
    $id = $_GET['del'];
    mysqli_query($conn, "DELETE FROM projects WHERE id=$id");
}
// Засах
if (isset($_POST['update_news'])) {
    $id = $_POST['id'];
    $t = $_POST['title'];
    $d = $_POST['desc'];
    mysqli_query($conn, "UPDATE projects SET title='$t', description='$d' WHERE id=$id");
    header("Location: manage_news.php");
}

$edit_news = null;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $res = mysqli_query($conn, "SELECT * FROM projects WHERE id=$id");
    $edit_news = mysqli_fetch_assoc($res);
}
?>
<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: Arial;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: auto;
        }

        input,
        textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2><?php echo $edit_news ? 'Мэдээ засах' : 'Мэдээ нэмэх'; ?></h2>
        <form method="POST">
            <input type="hidden" name="id" value="<?php echo $edit_news['id'] ?? ''; ?>">
            <input type="text" name="title" placeholder="Гарчиг" value="<?php echo $edit_news['title'] ?? ''; ?>"
                required>
            <textarea name="desc" placeholder="Агуулга"
                required><?php echo $edit_news['description'] ?? ''; ?></textarea>
            <button type="submit" name="<?php echo $edit_news ? 'update_news' : 'add_news'; ?>">Хадгалах</button>
        </form>

        <table>
            <tr>
                <th>Гарчиг</th>
                <th>Үйлдэл</th>
            </tr>
            <?php
            $res = mysqli_query($conn, "SELECT * FROM projects");
            while ($r = mysqli_fetch_assoc($res)) {
                echo "<tr>
                    <td>{$r['title']}</td>
                    <td>
                        <a href='?edit={$r['id']}'>Засах</a> | 
                        <a href='?del={$r['id']}'>Устгах</a>
                    </td>
                </tr>";
            }
            ?>
        </table>
        <p><a href="dashboard.php">Буцах</a></p>
    </div>
</body>

</html>