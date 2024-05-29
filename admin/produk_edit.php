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
            <div class="sidebar-title"><b>Warung Online</b></div>
            <ul>
                <?php include 'sidebar.php' ?>
            </ul>
        </div>
        <div class="section">
            <div class="container">
                <?php 
                $produk = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_id = '".$_GET['id']. "' ");
                if(mysqli_num_rows($produk) == 0){
                    echo '<script>window.location="admin/produk_data.php"</script>';
                }
                $k = mysqli_fetch_object($produk);
                ?>

                <form action="" method="post" enctype="multipart/form-data">
                    <h3>Edit Data Produk</h3>
                    <hr>
                    <fieldset>
                        <label>Kategori</label>
                        <select class="form-control" name="kategori" required> <?php 
                        $kategori = mysqli_query($conn, "SELECT * FROM 
                        tb_category ORDER BY category_id DESC");
                        while ($r = mysqli_fetch_array($kategori)) {
                            ?>
                            <option value="<?php echo $r['category_id'] ?>">
                                <?php echo $r['category_name'] ?>
                            </option> 
                            <?php } ?>
                        </select>
                    </fieldset>
                    <fieldset>
                        <label>Nama Produk</label>
                        <input type="text" name="product_name" value="<?php echo $k->product_name ?>" class="form-control" required>
                    </fieldset>
                    <fieldset>
                        <label>Harga</label>
                        <input type="text" name="product_price" value="<?php echo $k->product_price ?>" class="form-control" required>
                    </fieldset> 
                    <fieldset>
                        <label>stok</label>
                        <input type="number" name="stok" value="<?php echo $k->stok ?>" class="form-control" required>
                    </fieldset> 
                    <fieldset>
                        <label>Gambar Produk</label>
                        <input type="file" name="product_image" value="<?php echo $k->product_image ?>" class="form-control" required>
                    </fieldset> 
                    <fieldset>
                        <label>Deskripsi Produk</label>
                        <input type="text" name="product_description" value="<?php echo $k->product_description ?>" class="form-control" required>
                    </fieldset> 
                    <fieldset>
                    <label> Status </label>
                    <select class="form-control" name="status">
                        <option value="">-- pilih --</option>
                        <option value="1">Aktif</option>
                        <option value="0">Tidak Aktif</option>
                    </select>
                    </fieldset>
                    <fieldset>
                    <!-- Replace "buttom" with "button" -->
                    <button name="submit" type="submit" id="contact-submit" data-submit="...Sending">Simpan</button>
                    <button><a href="produk_data.php">Cancel</a></button>
                    </fieldset>
                </form>
                <?php 
                if(isset($_POST['submit'])){
                    $kategori = ($_POST['kategori']);
                    $nama_produk = ($_POST['product_name']);
                    $harga = ($_POST['product_price']);
                    $stok = ($_POST['stok']);
                    $deskripsi_produk = ($_POST['product_description']);
                    $status = ($_POST['status']);
                    
                    //file upload handling 
                    $gambar = ($_FILES['product_image']['name']);
                    $file_tmp = $_FILES['product_image']['tmp_name'];

                    if($gambar != "") {
                        $ekstensi_diperbolehkan = array('png', 'jpg');
                        $x = explode('.', $gambar);
                        $ekstensi = strtolower(end($x));
                        $file_tmp = $_FILES['product_image']['tmp_name'];
                        $angka_acak = rand(1,999);
                        $nama_gambar_baru = $angka_acak. '-' .$gambar;
                    
                    
                            if(in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
                                move_uploaded_file($file_tmp, '../produk/'. $nama_gambar_baru);

                                $update = mysqli_query($conn, "UPDATE tb_product SET category_id = '$kategori', product_name = '$nama_produk', 
                                product_price = '$harga', stok = '$stok', product_image = '$nama_gambar_baru', 
                                product_description = '$deskripsi_produk', product_status = '$status' 
                                WHERE product_id = '" . $k->product_id . "' ");

                            if ($update) {
                                echo '<script>alert("Edit Data Produk Berhasil")</script>';
                                echo '<script>window.location="produk_data.php"</script>';
                            }else{
                                echo 'gagal' . mysqli_error($conn);
                            }
                        }else{
                            echo 'File gambar harus berformat PNG atau JPG ';
                        }
                    }else{
                        $update = mysqli_query($conn, "UPDATE tb_product SET category_id = '".$kategori."', product_name = '".$nama_produk."', 
                        product_price = '".$harga."', stok = '".$stok."', product_image = '".$gambar."', product_description = '".$deskripsi_produk."', 
                        product_status = '".$status."' WHERE product_id = '" .$k->product_id."' ");
                         
                        if($update){
                            echo '<script>alert("Edit Data Produk Berhasil")</script>';
                            echo '<script>window.location="produk_data.php"</script>';
                        }else{
                            echo 'gagal' .mysqli_error($conn);   
                        
                        }      
                    }
                }
            ?>
            </div>
        </div>
    </div>
</body>
</html>
