<?php include '../view/header.php'; ?>
<main>

    <h2>Create Incident</h2>
    <?php if (!empty($message)) : ?>
    <p><?php echo $message; ?></p> <!-- Echo the message -->
    <?php else: ?>
    <form action="index.php" method="post"
        <input type="hidden" name="action" value="create_incident">
        <input type="hidden" name="customer_id" value="<?php echo $customer['customer_id']; ?>">
        
        <!-- Display first and last names. -->
        <p><strong>Customer Name: </strong><?php echo $customer['first_name'].' '.$customer['last_name']; ?></p>
        
        <label for="product_code">Select a Product:</label>
        <select name="product_code" id="product_code">
            <?php foreach ($products as $product) : ?>
            <option value="<?php echo $product['product_code']; ?>">
                <?php echo $product['product_name']; ?>
            </option>
            <?php endforeach; ?>
        </select>
        
        <br><br>
        
        <!-- HTML text input for title -->
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required>
        
        <br><br>
        
        <!-- HTML text input for description -->
        <label for="description">Description:</label>
        <textarea name="description" id="description" cols="40" rows="5" required</textarea>
        
        <br><br>
        
        <!-- Submit button -->
        <input type="submit" value="Submit Incident">
    </form>
    <?php endif; ?>

</main>
<?php include '../view/footer.php'; ?>