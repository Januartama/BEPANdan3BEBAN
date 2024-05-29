<?php
include('session.php')
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/styleadmin.css">
    <title>Warung Online</title>
</head>


<body>
    <div class="wrapper">
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
        <h1>Welcome Admin <?php echo $user_row["admin_name"] ?></h1>
    </div>
</div>
    
</body>

</html>