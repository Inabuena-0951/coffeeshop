<?php
// Process form if submitted
if (isset($_POST['submit'])) {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $message = $_POST['message'] ?? '';
    // Here you could handle form data (e.g., store it in a database, send an email, etc.)
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Jake's Coffee Shop</title>
    <link href="style.css" type="text/css" rel="stylesheet" />
  </head>
  <body>
    <div id="container">
      <div id="logo">
        <h1>Jake's Coffee Shop</h1>
      </div>
      <div class="main-content">
        <div id="leftcolumn">
          <!-- Ensure the href links are valid -->
          <a class="navBar" href="#">Home</a>
          <a class="navBar" href="menu.php">Menu</a> <!-- Correct the link here -->
          <a class="navBar" href="music.php">Music</a>
          <a class="navBar" href="jobs.">Jobs</a>
        </div>
        <div id="rightcolumn">
          <p>Come in and experience...</p>
          <img
            id="CoffeePic"
            class="floatright"
            src="/image/coffee.jpeg"
            alt="coffee cup"
            width="200"
            height="200"
          />
          <ul>
            <li>Specialty Coffee and Tea</li>
            <li>Freshly Made Sandwiches</li>
            <li>Bagels, Muffins, and Organic Snacks</li>
            <li>Music and Poetry Reading</li>
            <li>Open Mic Nights</li>
            <li>...</li>
          </ul>

          <!-- Contact Form -->
          <h3>Contact Us</h3>
          <?php if (isset($response)) { echo "<p style='color: green;'>$response</p>"; } ?>
          <form method="POST" action="">
            <label>Name: <input type="text" name="name" required></label><br>
            <label>Email: <input type="email" name="email" required></label><br>
            <label>Message:<br>
              <textarea name="message" required></textarea>
            </label><br>
            <button type="submit" name="submit">Send Message</button>
          </form>

          <p>
            23 Pine Road <br />
            Nottingham, NG1 5YU <br />
            0115 9324567
          </p>
        </div>
      </div>

      <div id="footer">
        Copyright &copy; 2011 Jake's Coffee House <br />
        <a href="mailto:jake@jcoffee.com">jake@jcoffee.com</a>
      </div>
    </div>
  </body>
</html>
