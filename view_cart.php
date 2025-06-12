<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Shopping Cart</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <header>
        <h1>Shopping Cart</h1>
        <nav>
            <ul>
                <li><a href="index.php">Continue Shopping</a></li>
            </ul>
        </nav>
    </header>

    <main class="cart-container">
        <?php if (empty($_SESSION['cart'])): ?>
            <p>Your cart is empty.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $total_price = 0;
                        foreach ($_SESSION['cart'] as $product_id => $item):
                            $item_total = $item['price'] * $item['quantity'];
                            $total_price += $item_total;
                    ?>
                        <tr>
                            <td>
                                <img src="<?php echo $item['image']; ?>" alt="<?php echo $item['name']; ?>" width="50">
                                <?php echo $item['name']; ?>
                            </td>
                            <td>$<?php echo number_format($item['price'], 2); ?></td>
                            <td>
                                <form action="cart_logic.php" method="post">
                                    <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                                    <input type="number" name="quantity" value="<?php echo $item['quantity']; ?>" min="1">
                                    <button type="submit" name="update_cart">Update</button>
                                </form>
                            </td>
                            <td>$<?php echo number_format($item_total, 2); ?></td>
                            <td>
                                <form action="cart_logic.php" method="post">
                                    <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                                    <button type="submit" name="remove_from_cart">Remove</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div class="cart-summary">
                <h3>Total: $<?php echo number_format($total_price, 2); ?></h3>
                <div id="paypal-button-container"></div>
            </div>
        <?php endif; ?>
    </main>

    <footer>
        <p>&copy; 2025 Urban Threads</p>
    </footer>

    <script src="https://www.paypal.com/sdk/js?client-id=AcmU7CtEBCebCkVvM8N599CRoOEhwBl-s8sMqac9ijAQdBIJT3Vw78T8bkwc2QxzRjIH1PuIYrsboVOA"></script>
    <script>
        paypal.Buttons({
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: '<?php echo number_format($total_price, 2, '.', ''); ?>'
                        }
                    }]
                });
            },
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(details) {
                    // Clear the cart via AJAX
                    fetch('clear_cart.php')
                        .then(response => response.text())
                        .then(data => {
                            alert('Transaction completed by ' + details.payer.name.given_name);
                            // Reload the page to show empty cart
                            window.location.reload();
                        });
                });
            }
        }).render('#paypal-button-container');
    </script>

</body>
</html>