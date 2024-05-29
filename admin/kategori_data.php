<?php include('session.php'); ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Warung Online</title>
    <link rel="stylesheet" type="text/css" href="../css/styleadmin.css">
</head>

<body>
    <div class="wrapper">
        <div class="header">
        </div>
        <div class="sidebar">
            <div class="sidebar-title"><b>Jnrtma Admin</b></div>
            <ul>
                <?php include 'sidebar.php' ?>
            </ul>
        </div>



        <script>
    function toggleSidebar() {
        var sidebar = document.querySelector('.sidebar');
        sidebar.classList.toggle('open');
    }</script>



    <button class="openbtn" onclick="toggleSidebar()">☰</button>

    
        <div class="section">
            <h3 class="card-title">Category</h3>
            <p><a href="kategori_tambah.php">Add Category</a></p>
            <table class="table1" width="100%">
                <table  width="1697" height="30">
                    <tr>
                        <th>No</th>
                        <th>Category</th>
                        <th>Action</th>
                    </tr>
                    <?php
                    $no = 1;
                    $kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC");
                    if (mysqli_num_rows($kategori) > 0) {
                        while ($row = mysqli_fetch_array($kategori)) {
                    ?>

                            <tr>
                                <td><?php echo $no++ ?></td>
                                <td><?php echo $row['category_name'] ?></td>

                                <td>
                                    <a href="kategori_edit.php?id=<?php echo $row['category_id'] ?>">Edit</a> |
                                    <a href="hapus_proses.php? idk=<?php echo $row['category_id'] ?>" onclick="return confirm('Yakin Ingin Hapus ?')">Delete</a>
                                </td>
                            </tr>

                        <?php }
                    } else { ?>
                        <tr>
                            <td colspan="3">No Data Yet</td>
                        </tr>
                    <?php } ?>

                </table>
            </table>
        </div>
    </div>
</body>

</html>