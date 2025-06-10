<?php
    $home_type=$_POST['home_type'];
    $capacity=$_POST['capacity'];
    $price_b=$_POST['price'];;
    $home_id=$_POST['home_id'];
    $homestay_id=$_POST['homestay_id'];
?>

<?php 
    session_start();
    include('connect.php');
    if(isset($_POST['submit'])){
        if(isset($_SESSION['customer_id'])){
            if($_SERVER['REQUEST_METHOD']==='POST'){
                $name=$_POST['name'];
                $ngayNhan=$_POST['ngayN'];
                $ngayTra=$_POST['ngayT'];
                $date1 = new DateTime($ngayNhan);
                $date2 = new DateTime($ngayTra);
                $price= $_POST['price'];
                $interval = $date1->diff($date2);
                $ngay = $interval->days; 
                $tien=$ngay*$price ;
                $sdt=$_POST['sdt'];
                $GT=$_POST['gioitinh'];
                $id=$_SESSION['customer_id'];
                $sql = "INSERT INTO confirm ( customer_id,phone_number,check_in_date,check_out_date,gender)
                    VALUES ('$id', '$sdt', '$ngayNhan', '$ngayTra','$GT')";
                mysqli_query($link, $sql);
                }
            }
            else{
            header("Location:signinUp.php");
        }
    }
    if(isset($_POST['trove']))
    {
        $query="SELECT MAX(confirm_id)AS max_cf FROM confirm";
        $rs=mysqli_query($link,$query);
        $d=mysqli_fetch_array($rs);
        $cf=$d['max_cf'];
        $sql="DELETE FROM confirm WHERE confirm_id=$cf";
        if(mysqli_query($link, $sql))
        {
            ?>
                 <script>
                window.onload = function() {
                window.location.href = "page.php?id=<?php echo $homestay_id; ?>&price=<?php echo $price_b; ?>&home_type=<?php echo $home_type; ?>&capacity=<?php echo $capacity; ?>&home_id=<?php echo $home_id; ?>";
            };
                </script>
       <?php }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
            body{
        font-family: Arial, Helvetica, sans-serif;
        background-color: #f3f4f6;
    }
    table{
        border-collapse: collapse;
        width: 50%;
        margin: auto;
        margin-top: 10px;
        height:350px;
        background-color: #ffff;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    /* tr{
        border: 1px solid black;
    } */
    td{
        /* border: 1px solid black; */
        padding: 12px;
        text-align: left;
        text-align: center;
        font-weight: bold;
        color: #333;
    }
    tr:hover{
        background-color: #F1F1F1;
    }

    input,select{
        padding: 8px;
        margin: 5px 0;
        box-sizing: border-box;
        border: 1px solid #ccc;
        border-radius: 4px;
        transition: all 0.3 ease;
        width: 100%;
        
    }


    input[type="text"]:focus,select:focus{
        border-color:#4CAF50 ;
        outline: none;
        box-shadow: 0 0 8px rgba(76,175,80,0.3);
    }
    .nut td{
        text-align: center;
        border: none;
        padding-top: 20px;
    }
    input[type="submit"]{
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 4px;
        padding: 10px 20px;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.3s ease;
        width: 100%;
    }
    input[type="submit"]:hover{
        background-color: #45a049;
    }
    h1{
        text-align: center;
        margin-top: 40px;
        color:#4CAF50 ;
    }

    .Index_Btn{
            width:5%;
            height: 10%;
            position: fixed;
            inset: 5% 90% 0 auto;
            z-index: 100;

            box-shadow: 0 4px 8px rgba(0.5, 0.5, 0.5, 0.5);
            background-color:aliceblue;
            
            align-content: center;
            border-radius: 50%; 
            border: transparent;
    }

    .Index_Btn:hover{
        background-color: green;
    }
    
    .Index_Btn svg{
            padding-top: 5%;
            width:75%;
            /* border-radius: 50%; */
    }

    </style>
</head>
<body>
    <form action="" method="post">
        <button class = "Index_Btn" name="trove" >
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
        <path  d="M209.4 39.5c-9.1-9.6-24.3-10-33.9-.9L33.8 173.2c-19.9 18.9-19.9 50.7 0 69.6L175.5 377.4c9.6 9.1 24.8 8.7 33.9-.9s8.7-24.8-.9-33.9L66.8 208 208.5 73.4c9.6-9.1 10-24.3 .9-33.9zM352 64c0-12.6-7.4-24.1-19-29.2s-25-3-34.4 5.4l-160 144c-6.7 6.1-10.6 14.7-10.6 23.8s3.9 17.7 10.6 23.8l160 144c9.4 8.5 22.9 10.6 34.4 5.4s19-16.6 19-29.2l0-64 32 0c53 0 96 43 96 96c0 30.4-12.8 47.9-22.2 56.7c-5.5 5.1-9.8 12-9.8 19.5c0 10.9 8.8 19.7 19.7 19.7c2.8 0 5.6-.6 8.1-1.9C494.5 467.9 576 417.3 576 304c0-97.2-78.8-176-176-176l-48 0 0-64z"/>
        </svg></button>
        <input type="hidden" name="price" value="<?php echo $price; ?>">
        <input type="hidden" name="home_id" value="<?php echo $home_id; ?>">
        <input type="hidden" name="homestay_id" value="<?php echo $homestay_id; ?>">
        <input type="hidden" name="home_type" value="<?php echo $home_type; ?>">
        <input type="hidden" name="capacity" value="<?php echo $capacity; ?>">
    </form>

    <h1>Thanh Toán</h1>
    <form action="trunggian.php" method="post">
        <table>
            <tr>
                <td><label for="name">Họ và tên</label></td>
                <td><?php echo ($name);?></td>
            </tr>
            <tr>
                <td>Ngày đặt phòng</td>
                <td><?php echo ($ngayNhan); ?></td>
            </tr>
            <tr>
                <td>Ngày nhận phòng</td>
                <td><?php echo ($ngayTra); ?></td>
            </tr>
            <tr>
                <td>Thương thức</td>
                <td>
                    <select name="pt" id="pt">
                        <option value="MOMO" <?php echo isset($pt) && $pt === 'MOMO' ? 'selected' : ''; ?>>MOMO</option>
                        <option value="VNPay"<?php echo isset($pt) && $pt === 'VNPay' ? 'selected' : ''; ?>>VNPay</option>
                        <option value="Vietcombank"<?php echo isset($pt) && $pt === 'Vietcombank' ? 'selected' : ''; ?>>Vietcombank</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Thành tiền</td>
                <td><?php echo number_format($tien, 0, ',', '.') . " VNĐ";?></td>
                <input type="hidden" name="tien" value="<?php echo $tien; ?>">
                <input type="hidden" name="home_id" value="<?php echo $home_id; ?>">
                <input type="hidden" name="homestay_id" value="<?php echo $homestay_id; ?>">
            </tr>
            <tr class="nut">
                <td colspan="2"><input type="submit" name="submit1" id="TT" value="Thanh Toán"></td>
            </tr>
        </table>
    </form>
</body>
</html>