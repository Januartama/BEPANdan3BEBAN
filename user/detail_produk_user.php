<?php
error_reporting(0); 
include 'session.php';
include '../db.php';
$kontak = mysqli_query($conn, "SELECT admin_telp, admin_email, admin_address FROM tb_admin WHERE admin_id = 1");
$a = mysqli_fetch_object($kontak);

$produk = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_id = '" . $_GET['id']  . "' ");
$p = mysqli_fetch_object($produk);
?> 
<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Bukawarung</title>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <link href="https://fonts.googleapis.com/css?family=Quicksand&display=swap" rel="stylesheet"> 
        <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
    </head>

<body> 
<header>

    <div class="container">
        <h1><a href="../index.php">Bukawarung</a></h1>
        <ul>
            <?php include 'navbar.php' ?>
        </ul>
    </div> 
</header>

<!-- Pencarian --> 
<div class="search">
    <div class="container">
        <form action="produk_user.php">
            <input type="text" name="search" placeholder="Cari Produk" value="<?php echo $_GET['search'] ?>">
            <input type="hidden" name="kat" value="<?php echo $_GET['kat'] ?>">
            <input type="submit" name="cari" value="Cari Produk">
        </form>
    </div>
</div>

<!-- Detail Produk -->
<div class="section">
    <div class="container">
        <h3>Detail Produk</h3>
        <div class="box">
            <div class="col-2">
                <img src="../produk/<?php echo $p->product_image ?>" width="100%">
            </div>
            <div class="col-2">
                <h3><?php echo $p->product_name ?></h3>
                <h4>Rp. <?php echo number_format($p->product_price) ?></h4> 
                <h3>Stok <?php echo number_format($p->stok) ?></h3>
                <p>Deskripsi: <br><?php echo $p->product_description ?></p>
                
                <form action="chart_proses.php" method="POST">-
                    <input type="hidden" name="stok" class="form-control" value="<?php echo $p->stok; ?>">
                    <input type="hidden" name="product_id" class="form-control" value="<?php echo $p->product_id; ?>">
                    <input type="hidden" name="admin_id" class="form-control" value="<?php echo $_SESSION['id_login']; ?>">
                    <input type="number" min="1" name="jml" style="width: 60px; height: 20px;" autofocus required>
                    <p>
                    
                    &nbsp;&nbsp;
                    <a href="cart.php"><img src="../img/basket.png" width="44px" height="44px" title="Tambahkan Keranjang"></a>&nbsp;&nbsp;&nbsp;
                    <a href="https://api.whatsapp.com/send?phone=<?php echo $a->admin_telp ?>&text=Hai, saya tertarik dengan produk Anda." target="_blank"><img src="../img/wa.png" width="40px" height="40px" Contact via Whatsapp, Click Here.</a>
                </p>
                </form>
            </div>
        </div>
    </div>
</div>

<footer>
    <div class="container">
        <small>Copyright &copy; 2023/2024 - Warung XD RPL.</small>
    </div>
</footer>
</body>
</html>
