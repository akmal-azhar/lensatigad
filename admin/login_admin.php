<?php
session_start();
require('../includes/db.php');

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_role'] = $user['role'];

            if ($user['role'] == 'admin') {
                header("Location: dashboard_new.php");
            } else {
                header("Location: index.php");
            }
            exit;
        } else {
            $error = "Password salah.";
        }
    } else {
        $error = "Email tak dijumpai.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login - Lensa TigaD</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Inter', sans-serif;
    }

    body {
      background-color: #fdf6ec; /* beige background */
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      color: #3e2f20; /* coklat gelap */
    }

    .login-container {
      background-color: #fffaf3;
      padding: 40px;
      border-radius: 16px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
      width: 100%;
      max-width: 400px;
      animation: fadeIn 0.6s ease;
    }

    .login-container h2 {
      text-align: center;
      margin-bottom: 24px;
      color: #a47148; /* coklat keemasan */
    }

    .input-group {
      position: relative;
      margin-bottom: 18px;
    }

    .input-group i {
      position: absolute;
      top: 12px;
      left: 12px;
      color: #c6a27e; /* gold highlight */
    }

    .login-container input {
      width: 100%;
      padding: 12px 12px 12px 40px;
      border: 1px solid #dbc8b4;
      border-radius: 8px;
      background: #fffdf8;
      font-size: 16px;
      color: #3e2f20;
    }

    .login-container input:focus {
      border-color: #a47148;
      outline: none;
      background-color: #fffaf3;
    }

    .login-container button {
      width: 100%;
      padding: 12px;
      background-color: #a47148;
      border: none;
      border-radius: 8px;
      font-size: 16px;
      color: #ffffff;
      font-weight: 600;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .login-container button:hover {
      background-color: #8c5e3c;
    }

    .error-msg {
      color: #b91c1c;
      text-align: center;
      margin-bottom: 16px;
    }

    .register-link {
      text-align: center;
      margin-top: 20px;
    }

    .register-link a {
      color: #a47148;
      text-decoration: underline;
      font-size: 14px;
    }

    .register-link a:hover {
      color: #8c5e3c;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
  </style>
</head>
<body>

  <div class="login-container">
    <h2>Login Admin</h2>

    <?php if ($error): ?>
      <p class="error-msg"><?= $error ?></p>
    <?php endif; ?>

    <form method="POST" action="" onsubmit="return validateForm()">
      <div class="input-group">
        <i class="bi bi-envelope-fill"></i>
        <input type="email" id="email" name="email" placeholder="Email" required>
      </div>
      <div class="input-group">
        <i class="bi bi-lock-fill"></i>
        <input type="password" id="password" name="password" placeholder="Password" required>
      </div>
      <button type="submit">Login</button>
    </form>

    <div class="register-link">
      <p>Don't have an account yet? <a href="register_admin.php">Register Here</a></p>
    </div>
  </div>

  <script>
    function validateForm() {
      const email = document.getElementById('email').value.trim();
      const password = document.getElementById('password').value.trim();
      const emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;

      if (!emailPattern.test(email)) {
        alert("Sila masukkan email yang sah.");
        return false;
      }

      if (password.length < 6) {
        alert("Password mesti sekurang-kurangnya 6 aksara.");
        return false;
      }

      return true;
    }
  </script>
</body>
</html>
