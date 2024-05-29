<?php include('session.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warung Online</title>
    <link rel="stylesheet" type="text/css" href="../css/styleadmin.css">
</head>

<body>
    <div class="wrapper">
        <div class="header"></div>
        <div class="sidebar">
            <div class="sidebar-title"><b>Jnrtma Admin</b></div>
            <ul>
                <?php include 'sidebar.php' ?>
            </ul>
        </div>
        <div class="section">
            <div class="container">
                <?php
                $kategori_id = $_GET['id']; // Perbaikan disini, tambahkan id dari parameter URL
                $kategori = mysqli_query($conn, "SELECT * FROM tb_category WHERE category_id = '$kategori_id'");
                if (mysqli_num_rows($kategori) == 0) {
                    echo '<script>window.location="admin/kategori_data.php"</script>';
                }
                $k = mysqli_fetch_object($kategori);
                ?>

                <form action="" method="post">
                    <h3>Edit Category Data</h3>
                    <fieldset>
                        <label> Category Name</label>
                        <input type="text" name="nama" value="<?php echo $k->category_name ?>" class="form-control" required>
                    </fieldset>
                    <fieldset>
                        <button name="submit" type="submit" id="contact-submit" data-submit="...sending">Edit</button>
                    </fieldset>
                </form>

                <?php
                if (isset($_POST['submit'])) {
                    $nama = $_POST['nama'];

                    $update = mysqli_query($conn, "UPDATE tb_category SET category_name ='$nama' WHERE category_id = '$kategori_id'");

                    if ($update) {
                        echo '<script>alert("Edit data berhasil")</script>';
                        echo '<script>window.location="kategori_data.php"</script>';
                    } else {
                        echo 'gagal ' . mysqli_error($conn);
                    }
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>