<?php
// Database connection parameters (same as before)
include "config.php";
function calculateDistance($lat1, $lon1, $lat2, $lon2, $unit) {

    $theta = $lon1 - $lon2;
    $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
    $dist = acos($dist);
    $dist = rad2deg($dist);
    $miles = $dist * 60 * 1.1515;
    $unit = strtoupper($unit);

    if ($unit == "K") {
        return ($miles * 1.609344);
    } else if ($unit == "N") {
        return ($miles * 0.8684);
    } else {
        return $miles;
    }
}

// Process user input and calculate distance
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $currentLat = floatval($_POST["current_lat"]);
    $currentLon = floatval($_POST["current_lon"]);
    if($currentLat !=0 && $currentLon!=0){
    // SQL query to fetch shop data from the database (same as before)
    $sql = "SELECT * FROM shops";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output data of each row (same as before)
        while ($row = $result->fetch_assoc()) {
            $shopLat = $row["latitude"];
            $shopLon = $row["longitude"];

            // Calculate the distance (same as before)
            $distance = calculateDistance($currentLat, $currentLon, $shopLat, $shopLon,"K");
            $row["distance"] = $distance;
            $shopsWithDistances[] = $row;

            // Display the shop name and the calculated distance (same as before)
           // echo "Shop Name: " . $row["shopName"] . "<br>";
           // echo "Distance: " . round($distance, 2) . " kilometers<br>";
           // echo "<hr>";
        }
        
        // Sort the array by distance
        usort($shopsWithDistances, function ($a, $b) {
            return $a["distance"] - $b["distance"];
        });

        // Display the sorted shop data
        foreach ($shopsWithDistances as $shop) {
            echo "Shop Name: " . $shop["shopName"] . "<br>";
            echo "Distance: " . round($shop["distance"], 2) . " kilometers<br>";
            echo "<hr>";
        }
    } else {

        echo "No shops found in the database.";
    }
}else{
    echo "Error: Latitude and longitude are required and must be valid";

}
    
    
    // Close the database connection (same as before)
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Distance Calculator</title>
    <script>
        function validateForm() {
            var currentLat = parseFloat(document.forms["myForm"]["current_lat"].value);
            var currentLon = parseFloat(document.forms["myForm"]["current_lon"].value);

            if (isNaN(currentLat) || isNaN(currentLon) || currentLat === 0 || currentLon === 0 || currentLat < -90 || currentLat > 90 || currentLon < -180 || currentLon > 180) {
                alert("Error: Latitude and longitude are required and must be valid.");
                return false;
            }


            return true;
        }
    </script>
</head>
<body>
    <h2>Distance Calculator</h2>
    <form name="myForm" method="post" onsubmit="return validateForm()" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        Enter Current Latitude: <input type="text" name="current_lat" ><br>
        Enter Current Longitude: <input type="text" name="current_lon" ><br>
        <input type="submit" value="Calculate Distance">
    </form>
</body>
</html>
