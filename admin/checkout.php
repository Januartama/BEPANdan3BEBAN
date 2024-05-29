<?php include ('session.php');

include 'fungsi_indotgl.php';?>
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
            <h3 class="card-title">Data Checkout Menunggu Valdasi dan Pengiriman </h3>
            <table class="table1" width="100%">
                <table  width="1697" height="30">
                <tr>
                    <th>No</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Picture</th>
                    <th>Amount</th>
                    <th>Total</th>
                    <th>Date</th>
                    <th>Proof</th>
                    <th>Validation</th>
                    <th>Delivery</th>
                    <th>Customer</th>
                    <th>address</th>
                    <th>No. Hp</th>
                </tr>
                <?php
                $no = 1;
                $admin_id=$_SESSION['id_login'];
                $produk = mysqli_query($conn, "SELECT admin_name, admin_telp, admin_address, (jml*product_price) AS total,tgl, ck_id, product_name,product_price, product_image, jml, bukti, validasi, status FROM tb_product, tb_checkout, tb_admin WHERE tb_admin.admin_id=tb_checkout.admin_id AND tb_checkout.product_id=tb_product.product_id AND status != 'Selesai' AND status != 'Batal'"); 
                while($row= mysqli_fetch_array($produk)){
                    ?>
                    <tr>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo $row['product_name'] ?></td>
                        <td>Rp. <?php echo number_format($row['product_price']) ?></td>
                        <td><a href="../produk/<?php echo $row['product_image'] ?>" target="_blank"> <img src="../produk/<?php echo $row ['product_image'] ?>" width="50px"> </a></td>
                        <td><?php echo $row['jml'] ?></td>
                        <td>Rp. <?php echo number_format($row['total']) ?></td>
                        <td><?php echo tgl_indo($row['tgl']) ?></td>
                        <td><a href="../bukti_transfer/<?php echo $row['bukti'] ?>" target="_blank"> <img src="../bukti_transfer/<?php echo $row ['bukti'] ?>" width="50px"> </a></td>
                        <?php if($row['validasi']=='Menunggu') {?>
                        <td>
                            <mark><?php echo $row['validasi'] ?></mark><br>
                            <a class="text-black" href="proses.php?ck_id=<?php echo $row ['ck_id'] ?>" onclick="return" confirm('Yakin bukti valid?')">
                            <strong>Valid?</strong></a><br>

                            <a class="text-black" href="proses_nonvalid.php?ck_id=<?php echo $row ['ck_id'] ?>" onclick="return" confirm('Yakin bukti tidak valid?')">
                            <strong>Tidak?</strong></a>
                        </td>
                        <?php }else{ ?>
                            <td><mark><?php echo $row['validasi'] ?> </mark><br></td>
                            <?php } ?>
                            <td><?php echo $row['status'] ?></td>
                            <td><?php echo $row['admin_name'] ?></td>
                            <td><?php echo $row['admin_address'] ?></td>
                            <td><?php echo $row['admin_telp'] ?></td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</body>
</html>