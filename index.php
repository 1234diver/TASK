<?php 
        // Include database connection
     require_once 'database.php';

     // Fetch products from the database
     $result = $conn->query("SELECT * FROM products ORDER BY date_added DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BOOKS</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <header>
        <h1> ARUSHA BOOK CENTER</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <!-- <li><a href="#">Men's</a></li>
                <li><a href="#">Women's</a></li>
                <li><a href="#">Sale</a></li> -->
                <li><a href="view_cart.php">Cart (<?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?>)</a></li>
                <li><a href='login.php'>Logout</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="products">
            <?php
                  // The old hard-coded $products array is GONE.
                // Now we loop through the database results.
                if ($result->num_rows > 0) {
                    while($product = $result->fetch_assoc()) {
                        echo '<div class="product-card">';
                        echo '<img src="' . htmlspecialchars($product['image_path']) . '" alt="' . htmlspecialchars($product['name']) . '">';
                        echo '<h3>' . htmlspecialchars($product['name']) . '</h3>';
                        echo '<p>$' . number_format($product['price'], 2) . '</p>';
                        // Add to Cart Form
                        echo '<form action="cart_logic.php" method="post">';
                        // We ONLY need to send the ID. The rest can be fetched from the DB.
                        echo '<input type="hidden" name="product_id" value="' . $product['id'] . '">';
                        echo '<button type="submit" name="add_to_cart">Add to Cart</button>';
                        echo '</form>';
                        echo '</div>';
                    }
                } else {
                    echo "<p>No products found.</p>";
                }
                $conn->close(); // Close the database connection
            ?>

        </section>
    </main>
   

    <footer>
        <p>&copy; 2025 LIFE IS BINARY</p>
    </footer>

</body>
</html>