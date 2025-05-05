<?php include '../view/header.php'; ?>
<main>

    <h2>Register Product</h2>
    <?php if (isset($message)) : ?>
		<p><?php echo $message; ?></p>
    <?php else: ?>
    <form action="index.php" method="post">
        <input type="hidden" name="action" value="register_product">
        <input type="hidden" name="customer_id" value="<?php echo htmlspecialchars($customer['customerID']); ?>">
        
        <p>
            <label for="customer_name">Customer:</label>
            <?php echo htmlspecialchars($customer['firstName']).' '. htmlspecialchars($customer['lastName']); ?>
        </p>
        
        <label for="product_code">Select Product:</label>
        <select name="product_code" id="product_code" required>
            <option value="">--Select a Product--</option>
            <?php foreach ($products as $product) : ?>
                <option value="<?php echo htmlspecialchars($product['productCode']); ?>">
                    <?php echo htmlspecialchars($product['name']); ?>
                </option>
            <?php endforeach; ?>
        </select>
        
        <button type="submit">Register Product</button>
    </form>
    <?php endif; ?>
	<p>You are logged in as <?php echo htmlspecialchars($customer['email']); ?></p>
	<form action="" method="post">
		<input type="hidden" name="action" value="logout">
		<input type="submit" value="logout">
	</form>

</main>
<?php include '../view/footer.php'; ?>