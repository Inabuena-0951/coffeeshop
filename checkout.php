<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Checkout</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 700px;
            margin: 40px auto;
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        h1, h2 {
            text-align: center;
            color: #444;
        }

        ul {
            list-style: none;
            padding: 0;
        }

        li.cart-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #f1f1f1;
            margin: 10px 0;
            padding: 10px 15px;
            border-radius: 8px;
        }

        .item-info {
            flex-grow: 1;
        }

        .quantity-controls {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .quantity-controls button {
            background: #007bff;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
        }

        .quantity-controls input {
            width: 40px;
            text-align: center;
            font-size: 1em;
        }

        .remove-item {
            background: none;
            border: none;
            font-size: 20px;
            color: #dc3545;
            cursor: pointer;
            margin-left: 10px;
        }

        form {
            margin-top: 30px;
            display: flex;
            flex-direction: column;
        }

        input, select {
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 1em;
        }

        button[type="submit"] {
            background-color:: #ffffcc;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 6px;
            font-size: 1em;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button[type="submit"]:hover {
            background-color: #218838;
        }

        .total-display {
            font-weight: bold;
            font-size: 1.2em;
            text-align: right;
            margin-top: 20px;
        }

        a {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Checkout</h1>
    <h2>Your Cart</h2>

    <ul id="cart">
        <?php
        $total = 0;
        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $index => $cartItem) {
                $quantity = isset($cartItem['quantity']) ? $cartItem['quantity'] : 1;
                $price = $cartItem['price'];
                $subtotal = $price * $quantity;
                $total += $subtotal;

                echo "
                <li class='cart-item' data-index='$index' data-price='$price'>
                    <div class='item-info'>
                        {$cartItem['item']} - \$<span class='item-price'>$price</span>
                    </div>
                    <div class='quantity-controls'>
                        <button type='button' class='decrease'>–</button>
                        <input type='text' class='qty' value='$quantity' readonly />
                        <button type='button' class='increase'>+</button>
                    </div>
                    <button class='remove-item' data-index='$index'>❌</button>
                </li>";
            }
        } else {
            echo "<li>Your cart is empty.</li>";
        }
        ?>
    </ul>

    <div class="total-display">
        Total: $<span id="total"><?php echo number_format($total, 2); ?></span>
    </div>

    <form action="process_checkout.php" method="POST" onsubmit="return handleSubmit();">
        <input type="text" name="name" placeholder="Full Name" required />
        <input type="email" name="email" placeholder="Email Address" required />
        <input type="text" name="address" placeholder="Shipping Address" required />

        <select name="payment_method" required>
            <option value="">Select Payment Method</option>
            <option value="credit_card">Credit Card</option>
            <option value="paypal">PayPal</option>
            <option value="cash">Cash on Delivery</option>
        </select>

        <button type="submit">Proceed to Payment</button>
    </form>

    <a href="coffee.php">← Go Back to Menu</a>
</div>

<script>
    function handleSubmit() {
        alert("Order is preparing");
        window.location.href = "checkout.php";
        return false;
   
        let total = 0;
        document.querySelectorAll('.cart-item').forEach(item => {
            const price = parseFloat(item.dataset.price);
            const qty = parseInt(item.querySelector('.qty').value);
            total += price * qty;
        });
        document.getElementById('total').innerText = total.toFixed(2);};

    document.querySelectorAll('.cart-item').forEach(item => {
        const index = item.dataset.index;
        const qtyInput = item.querySelector('.qty');
        const increaseBtn = item.querySelector('.increase');
        const decreaseBtn = item.querySelector('.decrease');
        const removeBtn = item.querySelector('.remove-item');

        increaseBtn.addEventListener('click', () => {
            let qty = parseInt(qtyInput.value);
            qty++;
            qtyInput.value = qty;
            updateTotal();
        });

        decreaseBtn.addEventListener('click', () => {
            let qty = parseInt(qtyInput.value);
            if (qty > 1) {
                qty--;
                qtyInput.value = qty;
                updateTotal();
            }
        });

        removeBtn.addEventListener('click', () => {
            item.remove();
            updateTotal();

            fetch('remove_item.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'index=' + index
            })
            .then(response => response.json())
            .then(data => console.log(data.message));
        });
    });
</script>

</body>
</html>