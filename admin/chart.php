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
            <h3 class="card-title">Customer Chart</h3>
            <table class="table1" width="100%">
                <tr>
                    <th>No</th>
                    <th>Customer</th>
                    <th>Product Category</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Picture</th>
                    <th>Amount</th>
                    <th>Total</th>
                </tr>
                <?php
                    $no = 1;
                    $produk = mysqli_query($conn, "SELECT admin_name, (jml *product_price) AS total, chart_id, category_name, product_name, product_price, product_image, jml 
                    FROM tb_product, tb_category, tb_chart, tb_admin WHERE tb_category.category_id=tb_product.category_id AND tb_chart.product_id=tb_product.product_id AND
                    tb_admin.admin_id=tb_chart.admin_id");
                    while($row = mysqli_fetch_array($produk)){
                        ?>
                        <tr>
                                <td><?php echo $no++ ?></td>
                                <td><?php echo $row['admin_name'] ?></td>
                                <td><?php echo $row['category_name'] ?></td>
                                <td><?php echo $row['product_name'] ?></td>
                                <td>Rp. <?php echo number_format($row['product_price']) ?></td>
                                <td><a href ="../produk/<?php echo $row['product_image']?>" target="_blank"> <img src="../produk/<?php echo $row['product_image'] ?>" width="50px" height="50px"> </a></td>
                                <td><?php echo $row['jml'] ?></td> 
                                <td>Rp. <?php echo number_format($row['total']) ?></td>
                        </tr>
                        <?php } ?>
            </table>
        </div>
    </div>
</body>
</html>
            