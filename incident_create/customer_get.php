<?php include '../view/header.php'; ?>
<main>

    <h2>Get Customer</h2>
    <p>You must enter the customer's email address to select the customer.</p>
    
    <!-- Form to get customer by email -->
    <form action="index.php" method="post">
        <input type="hidden" name="action" value="get_customer">
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        
        <br><br>
        
        <!-- Submit button -->
        <input type="submit" value="Get Customer">
    </form>

</main>
<?php include '../view/footer.php'; ?>