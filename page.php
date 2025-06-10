<?php 
    include('connect.php');
    if(isset($_POST['datphong'])){
        if(!isset($_SESSION['customer_id'] ))
        {
            header("Location:signinUp.php");
            exit();
        }
        else{
           
           header("Location:XacNhan.php");
           exit();
        }
    }
?>
<?php 
    if(!isset($_GET['id'])){
        header("Location:index.php");
    }
?>
<?php
$homestay_id = $_GET['id']; 
$_SESSION['home_id']=$_GET['home_id'];
$_SESSION['price'] = $_GET['price']; 
$price=$_GET['price'];    // Lấy giá
$home_type = $_GET['home_type'];
$capacity = $_GET['capacity'];
$home_id = $_GET['home_id'];

// Tiếp theo, bạn có thể sử dụng giá trị này để truy vấn cơ sở dữ liệu hoặc hiển thị giá trong trang của bạn
?>
<?php  include('connect.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page</title>
    <link rel="stylesheet" href="css/css.css">
    <link rel="stylesheet" href="css/binhluan.css">
</head>
<body>
    <?php include('header.php'); ?>
    <?php 
        $query = "SELECT * FROM homestay WHERE homestay_id = $homestay_id";
        $result = mysqli_query($link, $query);
        if ($result && $data = mysqli_fetch_assoc($result)) {
            // Dữ liệu phòng lấy từ CSDL
            //$room_type = $data['room_type'];
            $homestay_name = $data['homestay_name'];
            //$num_people = $data['num_people'];
            //$price = $data['price'];
            $description = $data['description'];
            $image = $data['image'];
            $status = $data['status'];
        } else {
            echo "Không tìm thấy dữ liệu cho ID: $id";
            exit;}
    ?>

    <div class="khung" style="padding-top: 40px;">
    <?php $mota= "SELECT * FROM homes WHERE homes.home_id='$home_id' AND homestay_id =' $homestay_id'";
        $doanvan = mysqli_query($link, $mota);
        $cauvan = mysqli_fetch_array($doanvan);
    ?>
        <div>
            <div class="ST_title">
                <div class = "ST_name">
                    <p><?php echo $data['homestay_name']; ?></p>
                </div>

                <div class="ST_dis">
                    <p><?php echo $data['description']; ?></p>
                </div>
            </div>

            <div class = "ST_Pic" name="ảnh">
                <div class="main-img">
                    <img src="<?php echo $data['image'];?>" alt="Room 1">
                    <img src="<?php echo $cauvan['home_image'];?>" alt="Room 2">
                </div>
            </div>

        <!--  -->
        <div class = "ST_Mota">
            <form action="XacNhan.php" method="post">
                <input type="hidden" name="price" value="<?php echo $price; ?>">
                <input type="hidden" name="home_id" value="<?php echo $home_id; ?>">
                <input type="hidden" name="homestay_id" value="<?php echo $homestay_id; ?>">
                <input type="hidden" name="home_type" value="<?php echo $home_type; ?>">
                <input type="hidden" name="capacity" value="<?php echo $capacity; ?>">
                <button class = "ST_PrS" >
                    <div class = "ST_Price">
                        <p><?php echo  number_format($price, 0, ',', '.') . " VNĐ"."<br>"; ?></p>
                    </div>
                    <div class = "ST_Status">
                        <p><?php if ($cauvan["home_status"] == "available") {echo "(Còn căn)";}?></p>
                    </div>
                </button>   
            </form>
            <div class="ST_In4">
                <table style="border: 2px solid grey">
                    <tr>
                        <th class = "Table1" id="thongtin">MÔ TẢ PHÒNG</th>
                        <th class = "Table2">THÍCH HỢP CHO</th>
                        <th class = "Table3">LOẠI PHÒNG</th>
                    </tr>
                    <tr class="In4_Row">
                        <td class = "T_Col1" style="text-align: left"><?php echo $cauvan['home_description'];?></td>
                        <td><?php echo $capacity . " người";?></td>
                        <td><?php echo $cauvan['home_type'];?></td>
                    </tr>
                </table>
            </div>
        </div>



        <div style="clear:both">
        <br><br><br>
        </div>


        <!-- Đánh giá khách hàng -->
        <div class="review-form">
            <form action="ddl.php" method="POST">
                <input type="hidden" name="homestay_id" value="<?php echo $homestay_id; ?>">
                <input type="hidden" name="home_id" value="<?php echo $home_id; ?>">
                <input type="hidden" name="price" value="<?php echo $price; ?>">
                <input type="hidden" name="home_type" value="<?php echo $home_type; ?>">
                <input type="hidden" name="capacity" value="<?php echo $capacity; ?>">
                <button type="submit" class="submit-btn" name="binhluan">Gửi đánh giá</button>
                <div class="form-group">
                    <textarea id="comments" name="comments" placeholder="Nhập nội dung đánh giá của bạn" required></textarea>
                </div>
            </form>
        </div>
        <!--  -->
        
        <div class="binhluan">
            <h2>Khách lưu trú ở đây thích điều gì?</h2>
            <div class="Commment">
                <?php 
                $query = "SELECT customers.customer_name, sections.reviews
                        FROM customers
                        JOIN sections ON customers.customer_id = sections.customer_id
                        WHERE sections.home_id = '$home_id' 
                        ";
                $result = mysqli_query($link, $query);
                $flag = true;
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_array($result)) {
                        if (!empty($row['reviews'])){
                            ?>
                            <div class="Name_tag">
                            <?php 
                            echo "<div style = 'font-size:150%;'>".
                            "<svg style = 'width:5%; padding-right:2%;'
                            xmlns='http://www.w3.org/2000/svg' viewBox='0 0 448 512'>
                            <path d='M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512l388.6 0c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304l-91.4 0z'/></svg>".
                            "<strong>" . htmlspecialchars($row['customer_name']) . ": </strong>" . 
                            "</div>".
                            "<br>".htmlspecialchars($row['reviews']);
                            ?>
                            </div>
                        <?php 
                        $flag = false;
                        }
                    }
                } 
                if( $flag ) {
                    echo "Chưa có đánh giá nào.";
                }
                ?>
            </div>
        </div>
    </div>

    <div style="clear:both">
    </div>
    </div>

    <?php include('footer.php')?>
</body>
</html>