<?php 
    include("connect.php");
    session_start();

    // Kiểm tra nếu chưa đăng nhập
    if (!isset($_SESSION['customer_id'])) {
        header("Location:signinUp.php");
        exit();
    }
    $price=$_POST['price'];
    $homestay_id=$_POST['homestay_id'];
    $home_id=$_POST['home_id'];
    $home_type=$_POST['home_type'];
    $capacity=$_POST['capacity'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/XacNhan.css">

</head>
<body>
    <a onclick="window.location.href='page.php?id=<?php echo $homestay_id; ?>&price=<?php echo $price; ?>&home_type=<?php echo urlencode($home_type); ?>&capacity=<?php echo $capacity; ?>&home_id=<?php echo $home_id ?>';"
    class = "Index_Btn">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
        <path d="M209.4 39.5c-9.1-9.6-24.3-10-33.9-.9L33.8 173.2c-19.9 18.9-19.9 50.7 0 69.6L175.5 377.4c9.6 9.1 24.8 8.7 33.9-.9s8.7-24.8-.9-33.9L66.8 208 208.5 73.4c9.6-9.1 10-24.3 .9-33.9zM352 64c0-12.6-7.4-24.1-19-29.2s-25-3-34.4 5.4l-160 144c-6.7 6.1-10.6 14.7-10.6 23.8s3.9 17.7 10.6 23.8l160 144c9.4 8.5 22.9 10.6 34.4 5.4s19-16.6 19-29.2l0-64 32 0c53 0 96 43 96 96c0 30.4-12.8 47.9-22.2 56.7c-5.5 5.1-9.8 12-9.8 19.5c0 10.9 8.8 19.7 19.7 19.7c2.8 0 5.6-.6 8.1-1.9C494.5 467.9 576 417.3 576 304c0-97.2-78.8-176-176-176l-48 0 0-64z"/>
    </svg></a>

    <h1>Xác Nhận</h1>
    <form action="ThanhToan.php" method="post" id="xacnhan" name="xacnhan" onsubmit="return checkXN()">
        <table>
            <tr>
                <td>
                    <label for="name">Họ và Tên</label>
                </td>
                <td> <input type="text" name="name" id="name" value="<?php  echo $_SESSION['customer_name']?>"></td>
            </tr>
            <tr>
                <td><label for="sdt">Số điện thoại</label></td>
                <td><input type="text" name="sdt" id="sdt"></td>
            </tr>
            <tr>
                <td>Giới tính</td>
                <td><input type="radio" name="gioitinh"  value="Nam">Nam
                    <input type="radio" name="gioitinh"  value="Nu"> Nữ
                    <input type="radio" name="gioitinh"  value="K"> Khác</td>
            </tr>
            <tr>
                <td>Ngày nhận phòng</td>
                <td><input type="date" name="ngayN" id=""></td>
            </tr>
            <tr>
                <td>Ngày trả phòng</td>
                <td><input type="date" name="ngayT" id=""></td>
            </tr>
            <tr>
                <td>Gmail</td>
                <td><input type="text" name="gmail"></td>
                <input type="hidden" name="price" value="<?php echo $price; ?>">
                <input type="hidden" name="homestay_id" value="<?php echo $homestay_id; ?>">
                <input type="hidden" name="home_id" value="<?php echo $home_id; ?>">
                <input type="hidden" name="home_type" value="<?php echo $home_type; ?>">
                <input type="hidden" name="capacity" value="<?php echo $capacity; ?>">
            </tr>
            <tr class="nut">
                <td colspan="2">
                    <input type="reset" name="reset" value="Hủy" id="dy">&nbsp;&nbsp;
                    <input type="submit" name="submit" value="Đồng ý" id="dy">
                </td>
            </tr>
        </table>
    </form>

    <script>
    function checkXN() {
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Kiểm tra định dạng email
        const ngaynhan = document.xacnhan.ngayN.value ? new Date(document.xacnhan.ngayN.value) : null;
        const ngaytra = document.xacnhan.ngayT.value ? new Date(document.xacnhan.ngayT.value) : null;
        const today = new Date();
        today.setHours(0, 0, 0, 0); // Đặt giờ phút giây về 0 để so sánh chỉ theo ngày

        if (document.xacnhan.name.value === "") {
            alert("Bạn chưa nhập tên!");
            document.xacnhan.name.focus();
            return false;
        } else if (document.xacnhan.sdt.value === "") {
            alert("Bạn chưa nhập số điện thoại!");
            document.xacnhan.sdt.focus();
            return false;
        } else if (document.xacnhan.gmail.value === "") {
            alert("Bạn chưa nhập gmail!");
            document.xacnhan.gmail.focus();
            return false;
        } else if (!emailPattern.test(document.xacnhan.gmail.value)) {
            alert("Gmail không hợp lệ!");
            document.xacnhan.gmail.focus();
            return false;
        } else if (!ngaynhan) {
            alert("Bạn chưa chọn ngày nhận phòng!");
            document.xacnhan.ngayN.focus();
            return false;
        } else if (ngaynhan < today) {
            alert("Ngày nhận phòng không hợp lệ! Ngày nhận phải từ hôm nay trở đi.");
            document.xacnhan.ngayN.focus();
            return false;
        } else if (!ngaytra) {
            alert("Bạn chưa chọn ngày trả phòng!");
            document.xacnhan.ngayT.focus();
            return false;
        } else if (ngaynhan >= ngaytra) {
            alert("Ngày nhận và ngày trả phòng không hợp lệ! Ngày trả phải sau ngày nhận.");
            document.xacnhan.ngayN.focus();
            return false;
        } else if (!document.querySelector('input[name="gioitinh"]:checked')) {
            alert("Vui lòng chọn giới tính!");
            return false;
        }
        return true; // Nếu tất cả đều hợp lệ
    }
</script>
</body>
</html>