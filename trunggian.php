<?php
    session_start();
    include('connect.php');
    if(isset($_POST['submit1']))
    {
        $query="SELECT MAX(confirm_id)AS max_cf FROM confirm";
        $rs=mysqli_query($link,$query);
        $d=mysqli_fetch_array($rs);
        $cf=$d['max_cf'];
        $cus=$_SESSION['customer_id'];
        $total=$_POST['tien'];
        $payment=$_POST['pt'];
        $home_id=$_POST['home_id'];
        $homestay_id=$_POST['homestay_id'];
        $sql1="UPDATE homes SET home_status='unavailable' WHERE home_id='$home_id' AND homestay_id='$homestay_id'";
        $sql = "INSERT INTO reservations (confirm_id,total_price,payment,customer_id)
        VALUES ('$cf', '$total', '$payment','$cus')";
            
        if(mysqli_query($link, $sql) && mysqli_query($link,$sql1))
        {
            header('Location:chuyen.php');
        }
        else{
            header('location:signinUp.php');
        }
    }
?>
