<?php

include "config.php";

// Function to sanitize user inputs
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Process the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $owner_name = sanitize_input($_POST["owner_name"]);
    $shop_name = sanitize_input($_POST["shop_name"]);
    $phone_number = sanitize_input($_POST["phone_number"]);
    $latitude = floatval($_POST["latitude"]);
    $longitude = floatval($_POST["longitude"]);

    // Perform validation
    $errors = array();

    if (empty($owner_name)) {
        $errors[] = "Owner name is required.";
    }

    if (empty($shop_name)) {
        $errors[] = "Shop name is required.";
    }

    if (empty($phone_number)) {
        $errors[] = "Phone number is required.";
    } elseif (!preg_match("/^\d{10}$/", $phone_number)) {
        $errors[] = "Phone number must be a 10-digit number.";
    }

    if ($latitude < -90 || $latitude > 90 || $longitude < -180 || $longitude > 180) {
        $errors[] = "Invalid latitude or longitude values.";
    }

    if (empty($errors)) {
        // Insert the data into the database
        $sql = "INSERT INTO shops (OwnerName, shopName, phoneNo, latitude, longitude, status)
                VALUES ('$owner_name', '$shop_name', '$phone_number', $latitude, $longitude, 1)";

        if ($conn->query($sql) === TRUE) {
            echo "Shop information has been successfully stored in the database.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        // Display validation errors
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
    }

    // Close the database connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Shop Information Form</title>
    <script>
        function validateForm() {
            var shopName = document.forms["myForm"]["shop_name"].value;
            var ownerName = document.forms["myForm"]["owner_name"].value;
            var phoneNumber = document.forms["myForm"]["phone_number"].value;
            var latitude = parseFloat(document.forms["myForm"]["latitude"].value);
            var longitude = parseFloat(document.forms["myForm"]["longitude"].value);

            var errors = [];

            if (shopName === "") {
                errors.push("Shop Name is required.");
            }

            if (ownerName === "") {
                errors.push("Owner Name is required.");
            }

            if (phoneNumber === "") {
                errors.push("Phone Number is required.");
            } else if (!/^[6789]\d{9}$/.test(phoneNumber)) {
                errors.push("Phone Number must start with 6, 7, 8, or 9 and be 10 digits long.");
            }

            if (isNaN(latitude) || latitude < -90 || latitude > 90) {
                errors.push("Invalid Latitude value.");
            }

            if (isNaN(longitude) || longitude < -180 || longitude > 180) {
                errors.push("Invalid Longitude value.");
            }

            if (errors.length > 0) {
                // Display validation errors
                var errorText = "Please fix the following errors:\n";
                for (var i = 0; i < errors.length; i++) {
                    errorText += "- " + errors[i] + "\n";
                }
                alert(errorText);
                return false; // Prevent form submission
            }

            return true; // Allow form submission if validation passes
        }
    </script>
</head>
<body>
    <h2>Shop Information Form</h2>
    <form name="myForm" method="post" onsubmit="return validateForm()" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        Shop Name: <input type="text" name="shop_name"><br>    
        Owner Name: <input type="text" name="owner_name"><br>
        Phone Number: <input type="text" name="phone_number"><br>
        Latitude: <input type="text" name="latitude"><br>
        Longitude: <input type="text" name="longitude"><br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>
