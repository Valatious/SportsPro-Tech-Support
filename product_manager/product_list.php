<?php include '../view/header.php'; ?>
<main>
    <h1>Product List</h1>

        <table>
            <tr>
                <th>Code</th>
                <th>Name</th>
                <th>Version</th>
                <th>Release Date</th>
                <th>&nbsp;</th>
            </tr>
            <?php foreach ($products as $product) : ?>
            <tr>
                <td><?php echo $product['productCode']; ?></td>
                <td><?php echo $product['name']; ?></td>
                <td><?php echo $product['version']; ?></td>
                <td><?php $releaseDate = new DateTime($product['releaseDate']);
					echo $releaseDate->format('n-j-Y');?></td>
                <td><form action="." method="post">
                    <input type="hidden" name="action"value="delete_product">
                    <input type="hidden" name="productCode" value="<?php echo htmlspecialchars($product['productCode']); ?>">
                    <input type="submit" value="Delete">
                </form></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <p><a href="index.php?action=show_add_form">Add Product</a></p>        
    </section>
</main>
<?php include '../view/footer.php'; ?>