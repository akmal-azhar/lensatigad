<?php
session_start();
include 'includes/db.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email    = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? AND type = 'client'");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($user = $result->fetch_assoc()) {
        if (password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user;
            header("Location: index.php");
            exit;
        } else {
            $error = "Kata laluan salah.";
        }
    } else {
        $error = "Akaun tidak dijumpai atau bukan client.";
    }
}
?>

<!DOCTYPE html>
<html lang="ms">
<head>
  <meta charset="UTF-8">
  <title>Login Client - Lensa TigaD</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Google Fonts & Style -->
  <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
  <style>
    * {
      box-sizing: border-box;
      font-family: 'Inter', sans-serif;
    }

    body {
      background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
      margin: 0;
      padding: 0;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      color: white;
      animation: fadeIn 1s ease;
    }

    .login-card {
      background-color: rgba(0, 0, 0, 0.75);
      padding: 40px;
      border-radius: 15px;
      box-shadow: 0 0 25px rgba(255, 255, 255, 0.1);
      width: 100%;
      max-width: 400px;
      animation: slideIn 0.7s ease;
    }

    .login-card h2 {
      text-align: center;
      margin-bottom: 25px;
      color: #00ffc8;
    }

    .login-card input {
      width: 100%;
      padding: 12px;
      margin-bottom: 15px;
      border: none;
      border-radius: 8px;
      font-size: 16px;
      background-color: #f4f4f4;
      color: #333;
    }

    .login-card button {
      width: 100%;
      padding: 12px;
      border: none;
      background-color: #00ffc8;
      color: black;
      font-weight: bold;
      border-radius: 8px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .login-card button:hover {
      background-color: #00c4a7;
    }

    .error {
      color: #ff6b6b;
      text-align: center;
      margin-bottom: 15px;
    }

    @keyframes fadeIn {
      from { opacity: 0; }
      to { opacity: 1; }
    }

    @keyframes slideIn {
      from {
        transform: translateY(40px);
        opacity: 0;
      }
      to {
        transform: translateY(0);
        opacity: 1;
      }
    }
  </style>
</head>
<body>

  <div class="login-card">
    <h2>Log Masuk Client</h2>

    <?php if ($error): ?>
      <div class="error"><?= $error ?></div>
    <?php endif; ?>

    <form method="post">
      <input type="email" name="email" placeholder="Email" required>
      <input type="password" name="password" placeholder="Kata laluan" required>
      <button type="submit">Log Masuk</button>
    </form>
  </div>

</body>
</html>
