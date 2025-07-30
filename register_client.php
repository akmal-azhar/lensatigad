<?php
session_start();
include 'includes/db.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name     = trim($_POST['name']);
    $email    = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm  = $_POST['confirm'];

    if ($password !== $confirm) {
        $errors[] = "Kata laluan tidak sepadan.";
    }

    // Semak jika email dah wujud
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    if ($stmt->get_result()->num_rows > 0) {
        $errors[] = "Email telah didaftarkan.";
    }

    if (empty($errors)) {
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $type = 'client';

        $stmt = $conn->prepare("INSERT INTO users (name, email, password, type) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $email, $hashed, $type);
        $stmt->execute();

        $_SESSION['user'] = [
            'id' => $stmt->insert_id,
            'name' => $name,
            'email' => $email,
            'type' => $type
        ];

        header("Location: login_client.php?registered=1");
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Daftar Client</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- Penting untuk responsive -->
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

        .register-box {
            background: #ffffff;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
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

        .link-login {
            text-align: center;
            margin-top: 15px;
        }

        .link-login a {
            text-decoration: none;
            color: #4a69bd;
        }

        .link-login a:hover {
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
            .register-box {
                padding: 25px 20px;
            }
        }
    </style>
</head>
<body>

<div class="register-box">
    <h3><i class="bi bi-person-plus-fill"></i> Sign Up as User</h3>

    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php foreach ($errors as $e): ?>
                    <li><?= $e ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="POST" onsubmit="return validateForm()">
        <div class="mb-3">
            <label class="form-label">Username</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                <input type="text" name="name" id="name" class="form-control" placeholder="Username" required>
            </div>
        </div>

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

        <div class="mb-3">
            <label class="form-label">Confirm Password</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                <input type="password" name="confirm" id="confirm" class="form-control" placeholder="Confirm Password" required>
            </div>
        </div>

        <button type="submit" class="btn btn-primary"><i class="bi bi-check-circle-fill"></i> Sign Up</button>
    </form>

    <div class="link-login">
        <p>Already have an account? <a href="login_client.php"><i class="bi bi-box-arrow-in-right"></i> Log In Here</a></p>
    </div>
</div>

<script>
function validateForm() {
    const email = document.getElementById("email").value.trim();
    const password = document.getElementById("password").value;
    const confirm = document.getElementById("confirm").value;

    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (!emailPattern.test(email)) {
        alert("Please enter a valid email.");
        return false;
    }

    if (password.length < 6) {
        alert("Password must be at least 6 characters.");
        return false;
    }

    if (password !== confirm) {
        alert("Password and verification do not match.");
        return false;
    }

    return true;
}
</script>

</body>
</html>
