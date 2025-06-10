<?php
$loginError = isset($_GET['error']) ? $_GET['error'] : '';
?>
<html>
<head>
    <title>Admin Login</title>
    <style>
        * { box-sizing: border-box; }
        body {
            background: #f6f5f7;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Montserrat', sans-serif;
            height: 100vh;
            margin: 0;
        }
        h1 { font-weight: bold; margin: 0; }
        p { font-size: 14px; font-weight: 100; letter-spacing: 0.5px; }
        button {
            border-radius: 20px; background-color: #0000FF; color: #FFF; font-size: 12px;
            font-weight: bold; padding: 12px 45px; text-transform: uppercase;
            transition: transform 80ms ease-in; border: 1px solid #0000FF;
        }
        button:active { transform: scale(0.95); }
        button:focus { outline: none; }
        form {
            background-color: #FFF; display: flex; align-items: center; justify-content: center;
            flex-direction: column; padding: 0 50px; height: 100%; text-align: center;
            border-radius: 10px; box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);
            width: 300px;
        }
        input {
            background-color: #eee; border: none; padding: 12px 15px; margin: 8px 0; width: 100%;
        }
        .container {
            display: flex; flex-direction: column; align-items: center; justify-content: center;
            text-align: center; width: 100%; max-width: 400px;
        }
        .error-message {
            color: red;
            font-size: 14px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <form action="admin.php" method="POST">
            <h1>Admin Login</h1>
            <p>Use your admin credentials to log in</p>
            <input type="email" name="email" placeholder="Email" required />
            <input type="password" name="password" placeholder="Password" required />
            <?php if ($loginError): ?>
                <p class="error-message">Invalid login. Please try again.</p>
            <?php endif; ?>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
