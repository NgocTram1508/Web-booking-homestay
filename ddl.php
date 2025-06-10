<?php 
include('connect.php'); 
session_start(); // Đảm bảo bắt đầu session để lấy customer_id

if (isset($_POST['binhluan'])) {
    if (isset($_SESSION['customer_id'])) {
        $customer_id = $_SESSION['customer_id'];
        $homestay_id = $_POST['homestay_id'];
        $home_id = $_POST['home_id'];
        $comments = $_POST['comments'];
        $price=$_POST['price'];
        $home_type=$_POST['home_type'];
        $capacity=$_POST['capacity'];
        // Thêm bình luận vào cơ sở dữ liệu
        $sql = "INSERT INTO sections (homestay_id,  home_id, customer_id, reviews)
                VALUES ('$homestay_id', '$home_id', '$customer_id', '$comments')";
        
        if (mysqli_query($link, $sql)) {
            ?>
        <script>
            window.onload = function() {
                window.location.href = "page.php?id=<?php echo $homestay_id; ?>&price=<?php echo $price; ?>&home_type=<?php echo $home_type; ?>&capacity=<?php echo $capacity; ?>&home_id=<?php echo $home_id; ?>";
            };
        </script>
           <?php  // Điều hướng về trang chi tiết
            exit();
        } else {
            echo "Lỗi: " . mysqli_error($link);
        }
    } else {
        echo "Bạn cần đăng nhập để gửi bình luận.";
        header("Location: signinUp.php");
        exit();
    }
} else {
    echo "Yêu cầu không hợp lệ.";
}
?>