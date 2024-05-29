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
        <div class="header"></div>
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
            <h3 class="card-title">Produk</h3>
            <p><a href="produk_tambah.php">Add Data</a></p>
            <table class="table1" width="100%">
                <table  width="1690" height="30">
                    <tr>
                        <th>No</th>
                        <th>Kategori</th>
                        <th>Nama Produk</th>
                        <th>Detail Produk</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Gambar</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                    <?php
                    $no = 1;
                    $produk = mysqli_query($conn, "SELECT * FROM tb_product LEFT JOIN tb_category USING (category_id) ORDER BY product_id DESC");
                    if (mysqli_num_rows($produk) > 0) {
                        while ($row = mysqli_fetch_array($produk)) {
                    ?>
                        <tr>
                                <td><?php echo $no++ ?></td>
                                <td><?php echo $row['category_name'] ?></td>
                                <td><?php echo $row['product_name'] ?></td>
                                <td><?php echo $row['product_description'] ?></td>
                                <td>Rp. <?php echo number_format($row['product_price']) ?></td>
                                <td><?php echo $row['stok'] ?></td>
                                <td><a href ="produk/<?php echo $row['product_image']?>" target="_blank"> <img src="../produk/<?php echo $row['product_image'] ?>" width="50px" height="50px"> </a></td>
                                <td><?php echo ($row['product_status'] == 0) ? 'Tidak Aktif' : 'Aktif'; ?></td>
                                <td>
                                    <a href="produk_edit.php?id=<?php echo $row['product_id'] ?>">Edit</a> || <a href="hapus_proses.php?idp=<?php echo $row ['product_id'] ?>" onclick="return confirm('Yakin ingin hapus?')">Hapus</a>
                                </td>
                        </tr>
                        <?php }
                    } else { ?>
                    <tr>
                        <td colspan="7">Tidak ada data</td>
                    </tr>
                <?php } ?>
                    </table>
                    </div>
                    </div>
                    </body>
                    </html>