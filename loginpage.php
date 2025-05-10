<?php
// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

// DB connection
$conn = new mysqli('localhost', 'root', '', 'jake_coffee_shop');
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

$error_message = "";

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $query = "SELECT * FROM jake_coffee_shop WHERE email = ?";
    $stmt = $conn->prepare($query);
    if ($stmt) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows === 1) {
            $user = $result->fetch_assoc();

            if (password_verify($password, $user['password'])) {
                $_SESSION['email'] = $email;
                header('Location: jakecoffeeshop.php');
                exit();
            }
        }

        // Login failed
        $_SESSION['error_message'] = "Invalid email or password!";
        header("Location: loginpage.php");
        exit();
    } else {
        die("Database query error: " . $conn->error);
    }
}

// Display any stored error
if (isset($_SESSION['error_message'])) {
    $error_message = $_SESSION['error_message'];
    unset($_SESSION['error_message']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login</title>
  <style>
    html, body {
      height: 100%;
      margin: 0;
      font-family: Arial, sans-serif;
      background: transparent;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    h1 {
      margin-top: 20px;
      text-align: center;
    }

    .login-form {
      background: #ccaa66;
      padding: 50px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      width: 300px;
      text-align: center;
    }

    .login-form a {
      color: #007bff;
      text-decoration: none;
    }

    .login-form a:hover {
      text-decoration: underline;
    }

    .separator {
      text-align: center;
      margin: 20px 0;
      position: relative;
      font-weight: bold;
      color: #888;
    }

    .separator span {
      background: #fff;
      padding: 0 10px;
      position: relative;
      z-index: 1;
    }

    .separator::before {
      content: "";
      position: absolute;
      top: 50%;
      left: 10%;
      right: 10%;
      height: 1px;
      background: #ccc;
      z-index: 0;
    }

    .social-login {
      display: flex;
      justify-content: center;
      gap: 20px;
      margin-top: 10px;
    }

    .social-login a img {
      width: 40px;
      height: 40px;
      cursor: pointer;
    }

    .form-group {
      margin-bottom: 20px;
      text-align: left;
    }

    .form-group label {
      display: block;
      margin-bottom: 5px;
    }

    .form-input {
      width: 100%;
      padding: 10px;
      box-sizing: border-box;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    button {
      padding: 10px 20px;
      background-color: #805e00;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    button:hover {
      background-color: #604400;
    }
  </style>
</head>
<body>
  <div class="login-form">
    <h2>Jake's Coffee Shop</h2>
    <form method="POST" action="loginpage.php">
      <div class="form-group">
        <label for="email">Email:</label>
        <input
          type="email"
          name="email"
          id="email"
          class="form-input"
          required
        />
      </div>

      <div class="form-group">
        <label for="password">Password:</label>
        <input
          type="password"
          name="password"
          id="password"
          class="form-input"
          required
        />
      </div>

      <button type="submit">Log In</button>

      <?php
      if (isset($error_message)) {
          echo "<p style='color: red;'>$error_message</p>";
      }
      ?>
    </form>

    <h6>Don't have an account? <a href="signupform.php">Sign Up</a></h6>

    <div class="separator"><span>OR</span></div>

    <div class="social-login">
      <a href="/auth/google">
        <img src="https://img.icons8.com/color/48/000000/google-logo.png" alt="Google Login"/>
      </a>
      <a href="/auth/facebook">
        <img src="https://img.icons8.com/color/48/000000/facebook-new.png" alt="Facebook Login"/>
      </a>
    </div>
  </div>
</body>
</html>
