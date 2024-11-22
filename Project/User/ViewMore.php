<?php
include("../Connection/Connection.php");
include("Head.php");
if (isset($_GET['pid']) && isset($_GET['from_date']) && isset($_GET['to_date'])) {
    $plot_id = $_GET['pid'];
    $from_date = $_GET['from_date'];
    $to_date = $_GET['to_date'];

    // Fetch plot details and slot availability
    $query = "SELECT * FROM tbl_plot WHERE plot_id = '$plot_id'";
    $result = $Con->query($query);
    $plot = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Slot Selection</title>
    <script src="../Assets/JQ/jQuery.js"></script>
    <script>
        function updateSlots() {
            var vehicleType = document.getElementById('vehicle_type').value;
            var remainingSlots = 0;

            if (vehicleType == "car") {
                remainingSlots = <?php echo $plot['car_slots']; ?>;
            } else if (vehicleType == "bike") {
                remainingSlots = <?php echo $plot['bike_slots']; ?>;
            }

            if (remainingSlots > 0) {
                document.getElementById('available_slots').value = remainingSlots + " Slots Available";
                document.getElementById('slots_status').innerHTML = "Slots Available";
            } else {
                document.getElementById('available_slots').value = "0";
                document.getElementById('slots_status').innerHTML = "Slots Not Available";
            }
        }
    </script>
</head>
<body>
    <h2>Book a Slot</h2>
    <form method="post" action="confirmBooking.php">
    <h1 align="center">ViewMore</h1>
        <label for="vehicle_type">Select Vehicle Type:</label>
        <select name="vehicle_type" id="vehicle_type" onchange="updateSlots()" required>
            <option value="car">Car</option>
            <option value="bike">Bike</option>
        </select><br><br>
        
        <label for="available_slots">Available Slots:</label>
        <input type="text" id="available_slots" name="available_slots" readonly><br><br>
        
        <span id="slots_status"></span><br><br>
        
        <input type="hidden" name="plot_id" value="<?php echo $plot_id; ?>">
        <input type="hidden" name="from_date" value="<?php echo $from_date; ?>">
        <input type="hidden" name="to_date" value="<?php echo $to_date; ?>">
        
        <input type="submit" value="Book Slot">
    </form>
</body>
</html>
<?php
include("Foot.php");
?>