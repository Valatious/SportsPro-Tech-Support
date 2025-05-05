<?php include '../view/header.php';?>
<main>

    <h2>Customer Login</h2>
    <p>You must login before you can register a product.</p>
    <form action="index.php" method="post">
        <input type="hidden" name="action" value="get_customer">
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        
        <button type="submit">Login</button>
    </form>

</main>
<?php include '../view/footer.php'; ?>