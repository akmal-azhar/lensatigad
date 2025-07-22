<?php
session_start();
require '../includes/db.php';

$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = 'admin';

    if (!empty($name) && !empty($email) && !empty($_POST['password'])) {
        $stmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $email, $password, $role);
        $stmt->execute();
        $success = true;
    } else {
        $error = "Sila isi semua medan.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Daftar Admin</title>
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
        }

        .register-box {
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
    </style>
</head>
<body>

<div class="register-box">
    <h3><i class="bi bi-person-plus-fill"></i> Register as Admin</h3>

    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST" onsubmit="return validateForm()">
        <div class="mb-3">
            <label class="form-label">Name</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                <input type="text" name="name" id="name" class="form-control" placeholder="Full Name" required>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
                <input type="email" name="email" id="email" class="form-control" placeholder="Email Address" required>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                <input type="password" name="password" id="password" class="form-control" placeholder="Minimum 6 characters" required>
            </div>
        </div>

        <button type="submit" class="btn btn-primary"><i class="bi bi-check-circle-fill"></i> Register</button>
    </form>

    <div class="link-login">
        <p>Already have an account? <a href="login_admin.php">Log in Here</a></p>
    </div>
</div>

<?php if ($success): ?>
<script>
    alert("Pendaftaran berjaya! Sila log masuk.");
    window.location.href = "login_admin.php";
</script>
<?php endif; ?>

<script>
function validateForm() {
    const email = document.getElementById("email").value.trim();
    const password = document.getElementById("password").value;

    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (!emailPattern.test(email)) {
        alert("Sila masukkan emel yang sah.");
        return false;
    }

    if (password.length < 6) {
        alert("Katalaluan mesti sekurang-kurangnya 6 aksara.");
        return false;
    }

    return true;
}
</script>

</body>
</html>
