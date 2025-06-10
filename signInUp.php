<?php
$loginError = isset($_GET['error']) ? $_GET['error'] : '';
?>
<html>
<head>
    <title>Sign In/Up Form</title>
    <style>
        * { box-sizing: border-box; }
        body {
            background: #f6f5f7;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Montserrat', sans-serif;
            height: 100vh; /* 1vh=9px */
            margin: 0;
        }
        h1 { font-weight: bold; margin: 0; }
        h2 { text-align: center; }
        p, span { font-size: 14px; font-weight: 100; letter-spacing: 0.5px; }
        a { color: #333; font-size: 14px; text-decoration: none; margin: 15px 0; }
        button {
            border-radius: 20px; background-color: #0000FF; color: #FFF; font-size: 12px;
            font-weight: bold; padding: 12px 45px; text-transform: uppercase;
            transition: transform 80ms ease-in; border: 1px solid #0000FF; 
        }
        button:active { transform: scale(0.95); } /*scale(0.95): thu  button nhỏ xuống 95%  button ban đầu*/
        button:focus { outline: none; } /*xóa đường viền tiêu điểm mặc định xung quanh phần tử  button khi nó được lấy nét.*/
        button.ghost { background-color: transparent; border-color: #FFF; } 
        form {
            background-color: #FFF; display: flex; align-items: center; justify-content: center;
            flex-direction: column; padding: 0 50px; height: 100%; text-align: center; /*Thiết lập flex-directionđể column làm trục chính theo chiều dọc.*/
        }
        input { background-color: #eee; border: none; padding: 12px 15px; margin: 8px 0; width: 100%; }
        .container {
            background-color: #FFF; border-radius: 10px; box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);
            position: relative; overflow: hidden; width: 768px; max-width: 100%; min-height: 480px;
        }
        .form-container { position: absolute; top: 0; height: 100%; transition: all 0.5s ease-in-out; }/*ease-in-out: chỉ định hiệu ứng chuyển tiếp với sự bắt đầu và kết thúc chậm */
        .sign-in-container { left: 0; width: 50%; z-index: 2; }/*z-index: 2;đặt phần tử lên trên các phần tử có z-index giá trị thấp hơn */
        .container.right-panel-active .sign-in-container { transform: translateX(100%); }
        .sign-up-container { left: 0; width: 50%; opacity: 0; z-index: 1; }
        .container.right-panel-active .sign-up-container { transform: translateX(100%); opacity: 1; z-index: 5; animation: show 0.6s; }
        @keyframes show { 0%, 49.99% { opacity: 0; z-index: 1; } 50%, 100% { opacity: 1; z-index: 5; } }
        .overlay-container {
            position: absolute; top: 0; left: 50%; width: 50%; height: 100%;
            overflow: hidden; transition: transform 0.6s ease-in-out; z-index: 100;
        }
        .container.right-panel-active .overlay-container { transform: translateX(-100%);}
        .overlay {
            background: linear-gradient(to right, #0033FF, #0066FF); color: #FFF;
            position: relative; left: -100%; height: 100%; width: 200%;
            transform: translateX(0); transition: transform 0.6s ease-in-out;
        }
        .container.right-panel-active .overlay { transform: translateX(50%); }
        .overlay-panel {
            position: absolute; display: flex; align-items: center; justify-content: center;
            flex-direction: column; padding: 0 40px; text-align: center;
            top: 0; height: 100%; width: 50%; transform: translateX(0); transition: transform 0.5s ease-in-out;
        }
        .overlay-left { transform: translateX(-20%); }
        .container.right-panel-active .overlay-left { transform: translateX(0); }
        .overlay-right { right: 0; transform: translateX(0); }
        .container.right-panel-active .overlay-right { transform: translateX(20%); }
        
    </style>
</head>
<body>
    <div class="container" id="container">
        <div class="form-container sign-up-container">
        <form action="signup.php" method="POST">
    <h1>Đăng ký</h1>
    <span>Nhập thông tin cá nhân của bạn vào để đăng ký</span>
    <input type="text" name="name" placeholder="Name" required />
    <input type="email" name="email" placeholder="Email" required />
    <input type="password" name="password" placeholder="Password" required />
    <button type="submit">Đăng ký </button>
</form>

        </div>
        <div class="form-container sign-in-container">
        <form action="signin.php" method="POST">
    <h1>Đăng nhập</h1>
   
    <span>Nhập thông tin dưới đây để đăng nhập </span>
    <input type="email" name="email" placeholder="Email" required />
    <input type="password" name="password" placeholder="Password" required />
    <a href="#">Quên mật khẩu?</a>
    <button type="submit">Đăng nhập </button>
</form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Chào mừng bạn đã trở lại!</h1>
                    <p>Bạn đã có tài khoản? Đăng nhập ngay thôi.</p>
                    <button class="ghost" id="signIn">Đăng nhập </button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Chào bạn!</h1>
                    <p>Bạn chưa có tài khoản? Hãy đăng ký ngay để có những trải nghiệm tốt nhất!</p>
                    <button class="ghost" id="signUp">Đăng ký </button>
                </div>
            </div>
        </div>
    </div>
    <?php if ($loginError): ?>
        <p style="color:red; text-align:center;"><?php echo $loginError; ?></p>
    <?php endif; ?>
    <script>
        const signUpButton = document.getElementById('signUp');
        const signInButton = document.getElementById('signIn');
        const container = document.getElementById('container');

        signUpButton.addEventListener('click', () => container.classList.add('right-panel-active'));
        signInButton.addEventListener('click', () => container.classList.remove('right-panel-active'));



    </script>
        <a href="index.php" class = "Index_Btn"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                <path d="M575.8 255.5c0 18-15 32.1-32 32.1l-32 0 .7 160.2c0 2.7-.2 5.4-.5 8.1l0 16.2c0 22.1-17.9 40-40 40l-16 0c-1.1 0-2.2 0-3.3-.1c-1.4 .1-2.8 .1-4.2 .1L416 512l-24 0c-22.1 0-40-17.9-40-40l0-24 0-64c0-17.7-14.3-32-32-32l-64 0c-17.7 0-32 14.3-32 32l0 64 0 24c0 22.1-17.9 40-40 40l-24 0-31.9 0c-1.5 0-3-.1-4.5-.2c-1.2 .1-2.4 .2-3.6 .2l-16 0c-22.1 0-40-17.9-40-40l0-112c0-.9 0-1.9 .1-2.8l0-69.7-32 0c-18 0-32-14-32-32.1c0-9 3-17 10-24L266.4 8c7-7 15-8 22-8s15 2 21 7L564.8 231.5c8 7 12 15 11 24z"/>
        </svg></a>
    <style>
        .Index_Btn svg{
            padding: 1%;
            width: 4%;
            position: fixed;
            inset: 87% 3% 0px auto;
            display: grid;
            grid-template-rows: 35px 1fr 35px; 
            z-index: 100;

            box-shadow: 0 4px 8px rgba(0.5, 0.5, 0.5, 0.5);
            background-color:aliceblue;
            border-radius: 50%;
        }


        .Index_Btn svg:hover{
            background-color: #2A96D5;
        }
        </style>

</body>
</html>