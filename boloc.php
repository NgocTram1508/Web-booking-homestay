<?php 
    include('connect.php');
    $idLoai = isset($_GET['idloai']) ? $_GET['idloai'] : 0;

?>

<?php  

// Tiếp theo, bạn có thể sử dụng giá trị này để truy vấn cơ sở dữ liệu hoặc hiển thị giá trong trang của bạn
//echo "location ID: " . $idLoai . "<br>";

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="css/boloc.css">
<title>Lọc SP</title>
</head>
<body>
    <?php include('header.php'); ?>
    <div class="khung">
    <form id="form_loc" name="form_loc" method="get">
        <label for="idloai">Tôi muốn đến  </label>
        <select name="idloai" id="idloai" onChange="form_loc.submit()">
            <option value="" <?php if ($idLoai == 0) echo 'selected'; ?>>Tất cả các tỉnh</option>
                <?php
                // Truy vấn tất cả các tỉnh từ bảng locations
                $sl1 = "SELECT location_id, city FROM locations";
                $kq1 = mysqli_query($link, $sl1);

                // Lấy giá trị từ GET và gán cho biến $idLoai

                
                // Hiển thị các tỉnh trong danh sách dropdown
                while ($d1 = mysqli_fetch_array($kq1)) {
                    ?>
                    <option value="<?php echo $d1["location_id"]; ?>" <?php if ($idLoai == $d1['location_id']) echo 'selected'; ?>>
                        <?php echo $d1["city"]; ?>
                    </option>
                <?php } ?>
        </select>

        <label for="idloai">  để du lịch!</label>
    </form>

            <?php
            // Kiểm tra nếu có giá trị tỉnh được chọn
            if ($idLoai > 0) {
                // Truy vấn thông tin theo location_id được chọn
                $sl2 = "SELECT locations.location_id, locations.city, homestay.homestay_id 
                        FROM locations 
                        JOIN homestay ON locations.location_id = homestay.location_id 
                        JOIN homes ON homes.homestay_id = homestay.homestay_id 
                        WHERE locations.location_id = $idLoai
                        AND homes.home_status = 'available'
                        AND homestay.status = 'active'";
                $kq2 = mysqli_query($link, $sl2);

                // Hiển thị kết quả từ cơ sở dữ liệu
                
            }
            ?>
        </tbody>
    </table>

    <div class="tour-khung">
        <?php
        // Truy vấn lấy dữ liệu từ bảng locations kết hợp với homestay
        // Nếu không chọn tỉnh (idLoai = 0), sẽ lấy tất cả các homestay.
        if ($idLoai > 0) {
            // Khi có tỉnh được chọn, lọc theo location_id
            $query = "SELECT locations.location_id, locations.city, homestay.homestay_id, homestay.homestay_name, homestay.image, homes.price ,homes.capacity, homes.home_type,homes.home_id
                      FROM locations
                      JOIN homestay ON locations.location_id = homestay.location_id
                      JOIN homes ON homestay.homestay_id = homes.homestay_id
                      WHERE locations.location_id = $idLoai
                        AND homes.home_status = 'available'
                        AND homestay.status = 'active'";
        } else {
            // Khi không chọn tỉnh, hiển thị tất cả các homestay
            $query = "SELECT locations.location_id, locations.city, homestay.homestay_id, homestay.homestay_name, homestay.image, homes.price ,homes.capacity, homes.home_type,homes.home_id
                        FROM locations 
                        JOIN homestay ON locations.location_id = homestay.location_id 
                        JOIN homes ON homes.homestay_id = homestay.homestay_id 
                        AND homes.home_status = 'available'
                        AND homestay.status = 'active'";
        }

        // Thực hiện truy vấn
        $result = mysqli_query($link, $query);

        // Kiểm tra kết quả truy vấn
        if (!$result) {
            die("Truy vấn thất bại: " . mysqli_error($link));
        }

        // Hiển thị dữ liệu
        while ($d = mysqli_fetch_assoc($result)) { // Lấy dữ liệu dạng mảng liên kết
        ?>
        <div class="tour-item" onclick="window.location.href='page.php?id=<?php echo $d['homestay_id']; ?>&price=<?php echo $d['price']; ?>&home_type=<?php echo urlencode($d['home_type']); ?>&capacity=<?php echo $d['capacity'];?>&home_id=<?php echo $d['home_id'] ;?>';">
            <img src="<?php echo $d['image']; ?>" alt="<?php echo $d['homestay_name']; ?>" class="tour-image">
            <div class="tour-info">
                <h2 class="tour-name"><?php echo $d['homestay_name']; ?></h2>
                <p class="tour-price">Giá: <?php echo number_format($d['price'], 0, ',', '.'); ?> VNĐ</p>
            </div>
        </div>
        <?php 
        } 
        ?>
    </div>
    </div>
    <?php include('footer.php'); ?>
</body>
</html>