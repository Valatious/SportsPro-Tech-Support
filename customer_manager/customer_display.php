<?php include '../view/header.php';?>
<main>
    
    <!-- Customer information table display page -->
    <h2>View/Update Customer</h2>
    <form action="." method="post" id="aligned">
        <input type="hidden" name="action" value="update_customer">
        <input type="hidden" name="customerID"
               value="<?php echo htmlspecialchars($customer['customerID']); ?>">
        
        <label>First Name:</label>
        <input type="text" name="first_name"
               value="<?php echo htmlspecialchars($customer['firstName']); ?>"><br>
               <span class="error"><?php echo $error_messages['first_name'] ??'';?></span>
        
        <label>Last Name:</label>
        <input type="text" name="last_name"
               value="<?php echo htmlspecialchars($customer['lastName']); ?>"><br>
               <span class="error"><?php echo $error_messages['last_name'] ??'';?></span>
        
        <label>Address:</label>
        <input type="text" name="address"
               value="<?php echo htmlspecialchars($customer['address']); ?>"
               size="50"><br>
               <span class="error"><?php echo $error_messages['address'] ??'';?></span>
        
        <label>City:</label>
        <input type="text" name="city"
               value="<?php echo htmlspecialchars($customer['city']); ?>"><br>
               <span class="error"><?php echo $error_messages['city'] ??'';?></span>
        
        <label>State:</label>
        <input type="text" name="state"
               value="<?php echo htmlspecialchars($customer['state']); ?>"><br>
               <span class="error"><?php echo $error_messages['state'] ??'';?></span>
        
        <label>Postal Code:</label>
        <input type="text" name="postal_code"
               value="<?php echo htmlspecialchars($customer['postalCode']); ?>"><br>
               <span class="error"><?php echo $error_messages['postal_code'] ??'';?></span>
        
        <!-- Country Drop-Down -->
        <label>Country:</label>
        <select name="country_code">
            <?php
            // Loop through all the countries and display them in the select list
            foreach ($countries as $country) {
                // Set the 'selected' attribute if the country code matches the customer's country code
                $selected = ($country['countryCode'] == $customer['countryCode']) ? 'selected' : '';
                echo "<option value=\"" . htmlspecialchars($country['countryCode']) . "\" $selected>" . htmlspecialchars($country['countryName']) . "</option>";
            }
            ?>
        </select><br>
        
        <label>Phone:</label>
        <input type="text" name="phone"
               value="<?php echo htmlspecialchars($customer['phone']); ?>"><br>
               <span class="error"><?php echo $error_messages['phone'] ??'';?></span>
        
        <label>Email:</label>
        <input type="text" name="email"
               value="<?php echo htmlspecialchars($customer['email']); ?>"
               size="50"><br>
               <span class="error"><?php echo $error_messages['email'] ??'';?></span>
        
        <label>Password:</label>
        <input type="text" name="password"
               value="<?php echo htmlspecialchars($customer['password']); ?>"><br>
               <span class="error"><?php echo $error_messages['password'] ??'';?></span>
        
        <label>&nbsp;</label>
        <input type="submit" value="Update Customer"><br>
    </form>
    <p><a href="">Search Customers</a></p>

</main>
<?php include '../view/footer.php'; ?>