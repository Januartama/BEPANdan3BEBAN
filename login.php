<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN Januartama Shop</title>
    <link href="https://fonts.googleapis.com/css?family=Quicksand&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body id="bg-login">
   <div class="box-login">
    <h2>Login<h2>
    <form action="" method="post">
        <input type="text" name="user" placeholder="Username" class="input-control"><br>
        <input type="password" name="pass" placeholder="Password" class="input-control"><br>
        <input type="submit" name="submit" value="LOGIN" class="btn">
        <p>
            <label>Don't Have An Account?</label> 
            <p><a href="register.php"><strong>Click Here to Register</strong></a>
    </form>

    <?php
    include('db.php');
    if(isset($_POST['submit'])){
        $username = $_POST['user'];
        $password = $_POST['pass'];

        $sql = mysqli_query($conn, "SELECT * FROM tb_admin WHERE username='$username' AND password='$password'")
        or die(mysqli_error($conn));
        if(mysqli_num_rows($sql) == 0){
            echo "<script>alert('Username atau Password anda Salah')</script>";
            echo '<script type="text/javascript">window.location="login.php"</script>';
        
    }else{
        session_start();
        $row = mysqli_fetch_assoc($sql);
        $_SESSION['id_login'] = $row['admin_id'];
        $_SESSION['level'] = $row['level'];
        $_SESSION['status_login'] = true;

        if($row['level'] == 'admin'){
            echo "<script>alert('Login Sukses')</script>";
            echo '<script type="text/javascript">window.location="admin/dashboard.php"</script>';
        }elseif($row['level'] == 'pelanggan'){
            echo "<script>alert('Login Sukses')</script>";
            echo '<script type="text/javascript">window.location="user/dashboard_user.php"</script>';
        }else{
            header('location:index.php');
        }
        }
    }
    ?>
    </div>
</body>
</html>