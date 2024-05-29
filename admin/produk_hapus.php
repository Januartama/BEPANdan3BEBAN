<?php

    include '../db.php';

    if(isset($_GET['idp'])){
        $delete = mysqli_query($conn, "DELETE FROM tb_product WHERE product_id = '" .$_GET['idp']."' ");
        echo '<script>window.location="produk_data.php"</script>';
}

?>