<?php
    include("connect.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website</title>
    <link rel="stylesheet" href="css/css.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/header.css">
    
</head>

<body>
<!--  -->
<?php include('header.php')?>

<!--  -->
    <div class="content">
        <div class="div-lpicture">
            <div class="images">
                <img src="img/1.jpg" alt="" class="anh">
                <img src="img/2.jpg" alt="" class="anh">
                <img src="img/3.jpg" alt="" class="anh">
                <img src="img/4.jpg" alt="" class="anh">
            </div>
            <div class="btns">
                <div class="btnL btn">
                    <i class='bx bx-chevron-left'></i>
                </div>
                <div class="btnR btn">
                    <i class='bx bx-chevron-right'></i>
                </div>
            </div>
            <div class="index-img">
                <div class="index-item index-item-0 active" ></div>
                <div class="index-item index-item-1"></div>
                <div class="index-item index-item-2"></div>
                <div class="index-item index-item-3"></div>
            </div>
        </div>
    </div>
    <div class="khung">
        <br>
        <h2 id="diadiem"></h2><br>
        <h2 >ĐỀ CỬ ĐỊA ĐIỂM</h2><br>
        <!-- /////// -->
        <div class="list">
            <div class="listimages">
                <?php 
                    $location = mysqli_query($link, "SELECT * FROM locations ORDER BY location_id ASC");
                    while ($diadiem = mysqli_fetch_array($location)) {
                ?>
                    <div class="anh_container" onclick="window.location.href='boloc.php?idloai=<?php echo $diadiem['location_id']; ?>';" >
                    <img src="<?php echo $diadiem['location_image']; ?>" alt="" class="anh">
                    <p class="comment"><?php echo htmlspecialchars($diadiem['city']);?></p>
                </div>
                <?php 
                    }
                ?>
            </div>
            <div class="btns1">
                <div class="btnL1 btn1">
                    <i class='bx bx-chevron-left'></i>
                </div>
                <div class="btnR1 btn1">
                    <i class='bx bx-chevron-right'></i>
                </div>
            </div>
        </div>

        <h2 id="homestay"></h2>
        <br>
        <h2>MỘT SỐ HOMESTAY TIÊU BIỂU</h2>
        <p>Được đề cử bởi các du khách trong và ngoài nước</p><br>
        <div class="tour-khung">
            <?php
            $sd = 8;
            $sl = "SELECT *
            FROM homestay 
            JOIN homes ON homestay.homestay_id = homes.homestay_id 
            WHERE homes.home_status = 'available'
            and homestay.status = 'active'";
            $kq = mysqli_query($link, $sl);
            $tsp = mysqli_num_rows($kq); 
            $tst = ceil($tsp / $sd);     

            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $page = max(1, min($page, $tst)); 

            // Tính vị trí bắt đầu
            $vt = ($page - 1) * $sd;

            // Truy vấn dữ liệu cho trang hiện tại
            $sl2 = "SELECT homestay.homestay_id, homestay.homestay_name, homestay.image, homes.price,homes.capacity, homes.home_type, homes.home_id, homes.home_status 
            FROM homestay 
            JOIN homes ON homestay.homestay_id = homes.homestay_id 
            WHERE homes.home_status = 'available'
            and homestay.status = 'active'
            LIMIT $vt, $sd";
            $kq2 = mysqli_query($link, $sl2);
            if (!$kq2) {
                die("Truy vấn thất bại: " . mysqli_error($link));
            }

            // Hiển thị dữ liệu
            while ($d = mysqli_fetch_assoc($kq2)) {
                ?>
                <div class="tour-item" onclick="window.location.href='page.php?id=<?php echo $d['homestay_id']; ?>&price=<?php echo $d['price']; ?>&home_type=<?php echo urlencode($d['home_type']); ?>&capacity=<?php echo $d['capacity']; ?>&home_id=<?php echo $d['home_id'] ?>';">
                    <img src="<?php echo $d['image']; ?>" alt="<?php echo $d['homestay_name']; ?>" class="tour-image">
                    <div class="tour-info">
                        <h2 class="tour-name"><?php echo $d['homestay_name']; ?></h2>
                        <p class="tour-price">Giá: <?php echo number_format($d['price'], 0, ',', '.'); ?> VNĐ</p>
                    </div>
                </div>
            <?php } ?>
        </div>
        <!-- Hiển thị phân trang -->
        <div class="phantrang">
            <div class="pagination">
                <?php if ($page > 1): ?>
                <a href="?page=<?php echo $page - 1; ?>#homestay" class="prev">« Trang trước</a>
                <?php endif; ?>
                <?php for ($i = 1; $i <= $tst; $i++): ?>
                <a href="?page=<?php echo $i; ?>#homestay" class="<?php echo $i == $page ? 'active' : ''; ?>"><?php echo $i; ?></a>
                <?php endfor; ?>
                <?php if ($page < $tst): ?>
                <a href="?page=<?php echo $page + 1; ?>#homestay" class="next">Trang sau »</a>
                <?php endif; ?>
            </div>
        </div>
        <br><br>

        <h2>CẢNH ĐẸP QUANH TA</h2>
        <p>Mỗi ngày, dù chúng ta có bận rộn đến đâu, vẫn có những vẻ đẹp thiên nhiên, 
        những khoảnh khắc bình dị mà đôi khi ta không để ý, nhưng lại có thể khiến tâm hồn ta nhẹ nhàng hơn, 
        cảm nhận được sự an yên và hạnh phúc.</p>
        <div class="layout2">
            <div class="layoutitem">
                <img src="img/phongcanh/1.jpg" alt="" class="layoutimage">
            </div>
            <div class="layoutitem">
                <img src="img/phongcanh/2.jpg" alt="" class="layoutimage">
            </div>
            <div class="layoutitem">
                <img src="img/phongcanh/3.jpg" alt="" class="layoutimage">
            </div>
            <div class="layoutitem">
                <img src="img/phongcanh/4.jpg" alt="" class="layoutimage">
            </div>
            <div class="layoutitem">
                <img src="img/phongcanh/5.jpg" alt="" class="layoutimage">
            </div>
            <div class="layoutitem">
                <img src="img/phongcanh/6.jpg" alt="" class="layoutimage">
            </div>
        </div>
    </div>

    <?php include('footer.php') ?>
    <script src="index.js"></script><script src="diadiem.js"></script>
</body>
</html>


