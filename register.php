
<?php
    include "service/database.php";
    session_start();

    $register_massage = "";
    if (isset($_SESSION["is_login"])){
        header("location: dashboard.php");
    }
    if(isset($_POST["register"])){
        $username=$_POST['username'];
        $password=$_POST['password'];
        $hash_password =hash("sha256", $password);

        try{
            $sql ="INSERT INTO user (username,password) VALUES ('$username','$hash_password')";  
            if($db->query($sql))
            {
                $register_massage = "Akun berhasil dibuat silahkan login ";
            }else{
                $register_massage ="Daftar akun gagal silahkan coba lagi ";
            }
        }catch(mysqli_sql_exception $e){
            $register_massage = "username sudah digunakan";
        } 
        $db->close();

    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
        include "layout/header.html";
     ?>
    <h3>dafter akun</h3>
    <i><?= $register_massage ?></i>

    <form action="register.php" method="POST">
        <input type="text" placeholder="username" name="username">
        <input type="password" placeholder="password" name="password">
        <button type="submit" name="register">daftar sekarang </button>
    </form>
    <?php include "layout/footer.html" ?>
</body>
</html>