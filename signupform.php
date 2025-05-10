<?php
// Show all PHP errors (for development only — remove in production)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

// Connect to the database
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'jake_coffee_shop';  // Correct database name

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = htmlspecialchars(trim($_POST['email']));
    $password = $_POST['password'];
    $confirm = $_POST['confirm_password'];

    // Form validation
    if (empty($email) || empty($password) || empty($confirm)) {
        $error = "All fields are required.";
    } elseif ($password !== $confirm) {
        $error = "Passwords do not match.";
    } else {
        // Check if the email already exists
        $check = $conn->prepare("SELECT * FROM jake_coffee_shop WHERE email = ?");
        $check->bind_param("s", $email);
        $check->execute();
        $result = $check->get_result();

        if ($result && $result->num_rows > 0) {
            $error = "Email is already registered.";
        } else {
            // Hash the password before inserting
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Debugging: Print the hashed password to check what is being generated
            echo "Hashed password: " . $hashed_password . "<br>";

            // Debugging: Print email and password data
            echo "Email: " . $email . "<br>";
            echo "Password: " . $hashed_password . "<br>";

            // Insert into the database (jake_coffee_shop table)
            $stmt = $conn->prepare("INSERT INTO jake_coffee_shop (email, password) VALUES (?, ?)");
            $stmt->bind_param("ss", $email, $hashed_password);

            if ($stmt->execute()) {
                echo "<script>
                    alert('Registered successfully');
                    window.location.href = 'loginpage.php';
                </script>";
                exit();
            } else {
                $error = "Insert failed: " . $stmt->error;
            }
        }
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Sign Up</title>
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

    .signup-form {
      background: #ccaa66;
      padding: 40px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      width: 300px;
      text-align: center;
    }

    .signup-form label {
      font-weight: bold;
      margin-bottom: 5px;
      display: block;
      text-align: left;
    }

    .signup-form input {
      width: 100%;
      padding: 10px;
      box-sizing: border-box;
      border: 1px solid #ccc;
      border-radius: 4px;
      margin-bottom: 20px;
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

    p.error {
      color: red;
      margin-top: 10px;
    }
  </style>

  <script>
    function validateForm() {
      var password = document.getElementById("password").value;
      var confirmPassword = document.getElementById("confirm-password").value;
      var errorMessage = "";

      if (password !== confirmPassword) {
        errorMessage = "Passwords do not match.";
      } else if (password.length < 6) {
        errorMessage = "Password must be at least 6 characters long.";
      }

      if (errorMessage) {
        document.getElementById("error-message").innerText = errorMessage;
        return false;
      }

      return true;
    }
  </script>
</head>
<body>
  <div class="signup-form">
    <h2>Sign Up</h2>
    <form method="POST" action="signupform.php" onsubmit="return validateForm()">
      <label for="email">Email:</label>
      <input type="email" name="email" id="email" required />

      <label for="password">Password:</label>
      <input type="password" name="password" id="password" required />

      <label for="confirm-password">Confirm Password:</label>
      <input type="password" name="confirm_password" id="confirm-password" required />

      <button type="submit">Register</button>

      <p id="error-message" class="error"></p>

      <?php
      if (isset($error)) {
          echo "<p class='error'>$error</p>";
      }
      ?>
    </form>
  </div>
</body>
</html>
