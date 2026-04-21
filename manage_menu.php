<?php include 'config.php';
is_logged_in();

// Нэмэх
if (isset($_POST['add'])) {
    $n = $_POST['m_name'];
    $l = $_POST['m_link'];
    mysqli_query($conn, "INSERT INTO menus (menu_name, menu_link) VALUES ('$n', '$l')");
}
// Устгах
if (isset($_GET['del'])) {
    $id = $_GET['del'];
    mysqli_query($conn, "DELETE FROM menus WHERE id=$id");
}
// Засах
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $n = $_POST['m_name'];
    $l = $_POST['m_link'];
    mysqli_query($conn, "UPDATE menus SET menu_name='$n', menu_link='$l' WHERE id=$id");
    header("Location: manage_menu.php");
}

$edit_data = null;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $edit_res = mysqli_query($conn, "SELECT * FROM menus WHERE id=$id");
    $edit_data = mysqli_fetch_assoc($edit_res);
}
?>
<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: Arial;
            padding: 20px;
            background: #f4f4f4;
        }

        .box {
            background: white;
            padding: 20px;
            border-radius: 8px;
            max-width: 600px;
            margin: auto;
        }

        input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            box-sizing: border-box;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            color: white;
            border-radius: 4px;
        }

        .btn-add {
            background: #28a745;
        }

        .btn-edit {
            background: #ffc107;
            color: black;
        }

        .btn-del {
            background: #dc3545;
        }
    </style>
</head>

<body>
    <div class="box">
        <h2><?php echo $edit_data ? 'Цэс засах' : 'Цэс нэмэх'; ?></h2>
        <form method="POST">
            <input type="hidden" name="id" value="<?php echo $edit_data['id'] ?? ''; ?>">
            <input type="text" name="m_name" placeholder="Цэсний нэр"
                value="<?php echo $edit_data['menu_name'] ?? ''; ?>" required>
            <input type="text" name="m_link" placeholder="Холбоос" value="<?php echo $edit_data['menu_link'] ?? ''; ?>"
                required>
            <button type="submit" name="<?php echo $edit_data ? 'update' : 'add'; ?>" class="btn btn-add">
                <?php echo $edit_data ? 'Шинэчлэх' : 'Нэмэх'; ?>
            </button>
        </form>

        <table>
            <tr>
                <th>Нэр</th>
                <th>Холбоос</th>
                <th>Үйлдэл</th>
            </tr>
            <?php
            $res = mysqli_query($conn, "SELECT * FROM menus");
            while ($r = mysqli_fetch_assoc($res)) {
                echo "<tr>
                    <td>{$r['menu_name']}</td>
                    <td>{$r['menu_link']}</td>
                    <td>
                        <a href='?edit={$r['id']}'>Засах</a> | 
                        <a href='?del={$r['id']}' onclick='return confirm(\"Устгах уу?\")'>Устгах</a>
                    </td>
                </tr>";
            }
            ?>
        </table>
        <p><a href="dashboard.php">Буцах</a></p>
    </div>
</body>

</html>