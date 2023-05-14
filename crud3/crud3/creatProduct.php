<?php
// Include config file
require_once 'config.php';

// Define variables and initialize with empty values
$product_name = $product_code = $product_price = $product_image = $product_qty = $product_discount="";
$product_name_err = $product_code_err = $product_price_err = $product_image_err = $product_qty_err = $product_discount_err="";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate name
    $input_product_name = trim($_POST["product_name"]);
    if (empty($input_product_name)) {
        $product_name_err = "Please enter a name.";
    } elseif (!filter_var(trim($_POST["product_name"]), FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z'-.\s ]+$/")))) {
        $product_name_err = 'Please enter a valid name.';
    } else {
        $product_name = $input_product_name;
    }
    // Validate code
    $input_product_code = trim($_POST["product_code"]);
    if (empty($input_product_code)) {
        $product_code_err = "Please enter a name.";
    } elseif (!filter_var(trim($_POST["product_code"]), FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z'-.\s ]+$/")))) {
        $product_code_err = 'Please enter a valid name.';
    } else {
        $product_code = $input_product_code;
    }

    // Validate price
    $input_product_price = trim($_POST["product_price"]);
    if (empty($input_product_price)) {
        $product_price_err = "Please enter a name.";
    } elseif (!filter_var(trim($_POST["product_price"]), FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z'-.\s ]+$/")))) {
        $product_price_err = 'Please enter a valid name.';
    } else {
        $product_price = $input_product_price;
    }
// Validate image
$input_product_image = trim($_POST["product_image"]);
if (empty($input_product_image)) {
    $product_image_err = "Please enter a name.";
} elseif (!filter_var(trim($_POST["product_image"]), FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z'-.\s ]+$/")))) {
    $product_image_err = 'Please enter a valid name.';
} else {
    $product_image = $input_image_code;
}
// Validate password
$input_product_qty = trim($_POST["product_qty"]);
if (empty($input_product_qty)) {
    $product_qty_err = "Please enter a name.";
} elseif (!filter_var(trim($_POST["product_qty"]), FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z'-.\s ]+$/")))) {
    $product_qty_err = 'Please enter a valid name.';
} else {
    $product_qty = $input_qty_code;
}

$input_product_discount = trim($_POST["product_discount"]);
if (empty($input_product_discount)) {
    $product_discount_err = "Please enter a name.";
} elseif (!filter_var(trim($_POST["product_discount"]), FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z'-.\s ]+$/")))) {
    $product_discount_err = 'Please enter a valid name.';
} else {
    $product_discount = $input_product_discount;
}
    // Check input errors before inserting in database
    // if (empty($name_err) && empty($avatar_err) && empty($email_err) && empty($address_err)) {
        // Prepare an insert statement
        $sql = "INSERT INTO products (product_name, product_code , product_price, product_image,product_qty,product_discount) VALUES (?,  ?,? ,?,?,?)";

        if ($stmt = $mysqli->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("ssssss", $param_product_name, $param_product_code, $param_product_price, $param_product_image, $param_product_qty,$param_product_discount);

            // Set parameters
            $param_product_name = $product_name;
            $param_product_code= $product_code;
            $param_product_price = $product_price;
            $param_product_image = $product_image;
            $param_product_qty = $product_qty;
            $param_product_discount=$product_discount;
        
            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Records created successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else {
                echo "Something went wrong. Please try again later.";
            }
        }

        // Close statement
        $stmt->close();
    }

    // Close connection
    $mysqli->close();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper {
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Create Record</h2>
                    </div>
                    <p>Please fill this form and submit to add user record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($product_name_err)) ? 'has-error' : ''; ?>">
                            <label>Product Name</label>
                            <input type="text" name="product_name" class="form-control" value="<?php echo $product_name; ?>">
                            <span class="help-block">
                                <?php echo $product_name_err; ?>
                            </span>
                        </div>

                        <div class="form-group <?php echo (!empty($product_code_err)) ? 'has-error' : ''; ?>">
                            <label>Product Code</label>
                            <input type="text" name="product_code" class="form-control" value="<?php echo $product_code; ?>">
                            <span class="help-block">
                                <?php echo $product_code_err; ?>
                            </span>
                        </div>
                     

                        <div class="form-group <?php echo (!empty($product_price_err)) ? 'has-error' : ''; ?>">
                            <label>Product Price</label>
                            <input type="text" name="product_price" class="form-control" value="<?php echo $product_price; ?>">
                            <span class="help-block">
                                <?php echo $product_price_err; ?>
                            </span>
                        </div>
                        <div class="form-group <?php echo (!empty($product_image_err)) ? 'has-error' : ''; ?>">
                            <label>Product Image</label>
                            <input type="text" name="product_image" class="form-control" value="<?php echo $product_image; ?>">
                            <span class="help-block">
                                <?php echo $product_image_err; ?>
                            </span>
                        </div>
                       
                        <div class="form-group <?php echo (!empty($product_qty_err)) ? 'has-error' : ''; ?>">
                            <label>Product Image</label>
                            <input type="text" name="product_qty" class="form-control" value="<?php echo $product_qty; ?>">
                            <span class="help-block">
                                <?php echo $product_qty_err; ?>
                            </span>
                        </div>
                        
                        <div class="form-group <?php echo (!empty($product_discount_err)) ? 'has-error' : ''; ?>">
                            <label>product discount</label>
                            <input type="text" name="product_discount" class="form-control" value="<?php echo $product_discount; ?>">
                            <span class="help-block">
                                <?php echo $product_discount_err; ?>
                            </span>
                        </div>
                        <input type="submit" class="btn btn-danger" value="Submit">
                        <a href="index.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>