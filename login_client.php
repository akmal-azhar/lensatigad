<?php
session_start();
require 'includes/db.php';

$success = '';
if (isset($_GET['registered']) && $_GET['registered'] == '1') {
    $success = "Registration successful. Please log in.";
}

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
            $error = "Wrong password.";
        }
    } else {
        $error = "Account not found or not a client.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Log Masuk Client</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #e9efff, #f9f9f9);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .login-box {
            background: #ffffff;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 450px;
            animation: fadeIn 1s ease-in-out;
        }

        h3 {
            font-weight: 600;
            text-align: center;
            margin-bottom: 25px;
            color: #333;
        }

        .form-label {
            font-weight: 500;
        }

        .btn-primary {
            width: 100%;
            padding: 10px;
            font-weight: 600;
            background-color: #4a69bd;
            border: none;
        }

        .btn-primary:hover {
            background-color: #3b54a0;
        }

        .btn-outline-secondary {
            padding: 8px 15px;
            font-weight: 500;
            border-radius: 8px;
        }

        .link-register {
            text-align: center;
            margin-top: 15px;
        }

        .link-register a {
            text-decoration: none;
            color: #4a69bd;
        }

        .link-register a:hover {
            text-decoration: underline;
        }

        .input-group-text {
            background-color: #e9ecef;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 576px) {
            .login-box {
                padding: 30px 20px;
            }

            h3 {
                font-size: 1.4rem;
            }
        }
    </style>
</head>
<body>

<div class="login-box">
    <h3><i class="bi bi-box-arrow-in-right"></i> Log in as User</h3>

    <?php if ($error): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <?php if ($success): ?>
        <div class="alert alert-success text-center"><?= $success ?></div>
    <?php endif; ?>

    <form method="POST" onsubmit="return validateForm()">
        <div class="mb-3">
            <label class="form-label">Email</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
                <input type="email" name="email" id="email" class="form-control" placeholder="Email" required>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                <input type="password" name="password" id="password" class="form-control" placeholder="Minimum 6 characters" required>
            </div>
        </div>

        <button type="submit" class="btn btn-primary"><i class="bi bi-box-arrow-in-right"></i> Log In</button>

        <div class="mt-3 text-center">
            <a href="index.php" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left-circle"></i> Back to Home
            </a>
        </div>
    </form>

    <div class="link-register">
        <p>Don't have account? <a href="register_client.php"><i class="bi bi-person-plus-fill"></i> Register Here</a></p>
    </div>
</div>

<script>
function validateForm() {
    const email = document.getElementById("email").value.trim();
    const password = document.getElementById("password").value;

    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (!emailPattern.test(email)) {
        alert("Please enter a valid email.");
        return false;
    }

    if (password.length < 6) {
        alert("Password must be at least 6 characters.");
        return false;
    }

    return true;
}
</script>

</body>
</html>
