<?php  
include 'session.php';
include '../db.php';
?>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Janartama Shop</title>
<link rel="stylesheet" type="text/css" href="../css/style.css">
<link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
<link rel="icon" type="image/png" href="img/icon-nyayur.id.png">
</head>
<body>
<!--header-->
<header>
    <div class="container">
    <h1><a href="dashboard.php">Janartama Shop</a></h1>
    <ul>
        <?php include 'navbar.php' ?>
    </ul>
    </div>
</header>
<!--content-->
<div class="section">
    <div class="container">
        <h3>Your Cart Data</h3>
        <div class="box">
                <table border="1" cellspacing="0" class="table" width="100%">
                    <thead>
                        <tr>
                            <th width="60px">No</th>
                            <th>Category</th>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Image</th>
                            <th>QTY</th>
                            <th>Total</th>
                            <th width="150px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $admin_id = $_SESSION['id_login'];
                        $produk = mysqli_query($conn, "SELECT tb_chart.product_id, (jml*product_price) AS total, chart_id, category_name, product_name, product_price, product_image, jml
                            FROM tb_product, tb_category, tb_chart
                            WHERE tb_category.category_id=tb_product.category_id AND tb_chart.product_id=tb_product.product_id AND admin_id=$admin_id");
                        while($row = mysqli_fetch_array($produk)){
                        ?>
                        <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo $row['category_name'] ?></td>
                            <td><?php echo $row['product_name'] ?></td>
                            <td>Rp. <?php echo number_format($row['product_price']) ?></td>
                            <td><a href="../produk/<?php echo $row['product_image'] ?>" target="_blank">
                            <img src="../produk/<?php echo $row['product_image'] ?>" width="50px" height="60" ></a></td>
                            <td><?php echo $row['jml'] ?></td>
                            <td>Rp. <?php echo number_format($row['total']) ?></td>
                            <td>
                                <form method="post" action="">
                                <input type="hidden" name="jml[]" value="<?php echo $row['jml'] ?>">
                                <input type="hidden" name="product_id[]" value="<?php echo $row['product_id'] ?>">
                                <input type="hidden" name="admin_id[]" value="<?php echo $admin_id ?>">
                                
                                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="check[]" style="transform: scale(2.8)" style="background-color: brown;" value="<?php echo $row['chart_id']  ?>"></label>
                                       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="hapus_proses.php?idc=<?php echo $row['chart_id'] ?>" onclick="return confirm('Are you sure you want to delete it?')"><img src="../img/delete.png" width="33px" height="33px" title="delete"></a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table></br>       
                <button type="submit" class="btn" style="width:100%" name="save">Check Out Pilihan</button>
            </div> 
        <?php 
        if(isset($_POST['save'])){
            $checkbox = $_POST['check'];
            $jmll = $_POST['jml'];
            $product_idd = $_POST['product_id'];
            $admin_idd = $_POST['admin_id'];
            
            for($i=0; $i<count($checkbox);$i++) {
                $check_id       = $checkbox[$i];
                $jml            = $jmll[$i];
                $product_id     = $product_idd[$i];
                $admin_id       = $admin_idd[$i];
                mysqli_query($conn, "insert into tb_checkout_temp values  (
                    $check_id, $product_id, $jml, $admin_id )") or die (mysqli_error());

                mysqli_query($conn, "DELETE FROM tb_chart WHERE chart_id=$check_id")   or die (mysqli_error());
                }
            
            echo '<script>alert("Checkout Success")</script>';
            echo '<script>window.location="checkout.php"</script>';
        }
        ?>
    </div>
</div>
<!-- footer -->
<footer>
<div class="container">
    <small>Copyright &copy; 2023/2024 - Warung XD RPL.</small>
</div>
</footer>
</body>
</html>
