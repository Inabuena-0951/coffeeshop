<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Jake Coffee Shop</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
      body {
        font-family: "Arial", sans-serif;
        margin: 0;
        padding: 0;
        background-color: transparent;
        color: #330000;
      }

      header {
        background-color: #ffffcc;
        color: #330000;
        text-align: center;
        padding: 20px;
      }

      header h1 {
        margin: 0;
      }

      header nav {
        text-align: center;
        margin-top: 10px;
      }

      header nav a {
        color: #E8D882;
        padding: 12px 20px;
        text-decoration: none;
        margin: 0 10px;
        text-transform: uppercase;
      }

      header nav a:hover {
        background-color: #555;
      }

      header .cart-icon {
        font-size: 24px;
        color: #E8D882;
        text-decoration: none;
        padding: 12px;
        transition: background-color 0.3s;
      }

      header .cart-icon:hover {
        background-color: #555;
        border-radius: 50%;
      }

      section {
        padding: 20px 20px;
        background-color: #ccaa66;
      }

      .menu,
      .contact {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        gap: 20px;
      }

      .menu-item,
      .contact-info {
        background-color: #ffffcc;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      }

      .menu-item h2 {
        margin-top: 20px;
      }

      .menu-item h3 {
        margin-top: 50px;
      }

      .menu-item p {
        color: #330000;
      }

      .hero {
        background-color: white;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        max-width: 800px;
        margin: 40px auto;
        text-align: center;
      }

      .hero img {
        width: 100%;
        max-width: 500px;
        height: auto;
        margin: 20px 0;
        border-radius: 8px;
      }

      .hero ul {
        text-align: left;
        display: inline-block;
        margin-top: 20px;
      }

      footer {
        background-color: #ffffcc;
        color: #ccaa66;
        text-align: center;
        padding: 10px 0;
        position: relative;
        width: 100%;
        bottom: 0;
      }

      button {
        background: none;
        border: none;
        cursor: pointer;
        font-size: 15px;
        color: #000;
      }

      button:hover {
        color: rgb(119, 121, 119);
      }

      /* Media Queries (Breakpoints) - No change in styles, just added for responsive layout */
      @media (min-width: 1200px) {
        /* No change to styles, only breakpoints added */
      }

      @media (min-width: 992px) and (max-width: 1199px) {
        /* No change to styles, only breakpoints added */
      }

      @media (min-width: 768px) and (max-width: 991px) {
        /* No change to styles, only breakpoints added */
      }

      @media (min-width: 600px) and (max-width: 767px) {
        /* No change to styles, only breakpoints added */
      }

      @media (max-width: 599px) {
        /* No change to styles, only breakpoints added */
      }
    </style>
  </head>
  <body>
    <header>
      <h1>Jake Coffee Shop</h1>
      <nav>
        <a href="jakecoffeeshop.php">Home</a> <!-- Home link -->
        <a href="#music">Music</a> <!-- Music link -->
        <a href="#add-to-cart" class="cart-icon" title="View Cart">
          <i class="fas fa-shopping-cart"></i> <!-- Cart icon -->
        </a>
      </nav>
    </header>

    <section id="music">
      <h2 style="text-align: center">Our Music</h2>
      <div class="menu">
        <div class="menu-item">
          <h3>Cappuccino</h3>
          <p>A rich espresso with steamed milk and topped with frothy foam.</p>
          <p><strong>₱180</strong></p> <!-- Updated price to Peso -->
          <button onclick="addToCart('Cappuccino', 180)" title="Add to Cart">
            <i class="fas fa-shopping-cart"></i>
          </button>
        </div>
        <div class="menu-item">
          <h3>Latte</h3>
          <p>A smooth blend of espresso and steamed milk, perfect for any time of the day.</p>
          <p><strong>₱160</strong></p> <!-- Updated price to Peso -->
          <button onclick="addToCart('Latte', 160)" title="Add to Cart">
            <i class="fas fa-shopping-cart"></i>
          </button>
        </div>
        <div class="menu-item">
          <h3>Americano</h3>
          <p>Strong espresso, watered down for a bold, smooth flavor.</p>
          <p><strong>₱150</strong></p> <!-- Updated price to Peso -->
          <button onclick="addToCart('Americano', 150)" title="Add to Cart">
            <i class="fas fa-shopping-cart"></i>
          </button>
        </div>
        <div class="menu-item">
          <h3>Espresso</h3>
          <p>A shot of rich, full-bodied espresso, perfect for a quick energy boost.</p>
          <p><strong>₱130</strong></p> <!-- Updated price to Peso -->
          <button onclick="addToCart('Espresso', 130)" title="Add to Cart">
            <i class="fas fa-shopping-cart"></i>
          </button>
        </div>
        <div class="menu-item">
          <h3>Mocha</h3>
          <p>Chocolate syrup combined with espresso and steamed milk for a sweet treat.</p>
          <p><strong>₱190</strong></p> <!-- Updated price to Peso -->
          <button onclick="addToCart('Mocha', 190)" title="Add to Cart">
            <i class="fas fa-shopping-cart"></i>
          </button>
        </div>
        <div class="menu-item">
          <h3>Flat White</h3>
          <p>Espresso with velvety steamed milk and a thin layer of microfoam.</p>
          <p><strong>₱170</strong></p> <!-- Updated price to Peso -->
          <button onclick="addToCart('FlatWhite', 170)" title="Add to Cart">
            <i class="fas fa-shopping-cart"></i>
          </button>
        </div>
      </div>
    </section>

    <script>
      function addToCart(item, price) {
        fetch('add_to_cart.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
          body: `item=${encodeURIComponent(item)}&price=${encodeURIComponent(price)}`
        })
        .then(response => response.json())
        .then(data => {
          if (data.status === 'success') {
            window.location.href = 'checkout.php';
          } else {
            alert('Failed to add item: ' + data.message);
          }
        })
        .catch(error => {
          console.error('Error:', error);
          alert('Something went wrong.');
        });
      }
    </script>
  </body>
</html>
