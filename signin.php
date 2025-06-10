<?php
// Kết nối tới cơ sở dữ liệu
$link = mysqli_connect("localhost", "root", "", "databooking");
if (!$link) {
    die("Không thể kết nối đến máy chủ: " . mysqli_connect_error());
}

// Xử lý khi biểu mẫu được gửi qua POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = mysqli_real_escape_string($link, $_POST['email']);
    $password = $_POST['password'];

    $stmt = mysqli_prepare($link, "SELECT customer_id, customer_name FROM customers WHERE email = ? AND password = ?");
    mysqli_stmt_bind_param($stmt, "ss", $email, $password);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);

        // Bắt đầu session và lưu thông tin người dùng
        session_start();
        $_SESSION['customer_id'] = $user['customer_id'];
        $_SESSION['customer_name'] = $user['customer_name'];
        echo "Đăng nhập thành công!";
        header("Location: index.php");
    } else {
        echo "Email hoặc mật khẩu không chính xác. Vui lòng thử lại.";
    }

    mysqli_stmt_close($stmt);
}

// Đóng kết nối
mysqli_close($link);
?>