<?php
include("../Assets/Connection/Connection.php");

if ($_POST) {
    $plot_id = $_POST['plot_id'];
    $from_date = $_POST['from_date'];
    $to_date = $_POST['to_date'];
    $vehicle_type = $_POST['vehicle_type'];

    // Fetch current slot availability
    $query = "SELECT * FROM tbl_plot WHERE plot_id = '$plot_id'";
    $result = $Con->query($query);
    $plot = $result->fetch_assoc();

    if ($vehicle_type == "car" && $plot['car_slots'] > 0) {
        // Book a car slot
        $new_car_slots = $plot['car_slots'] - 1;
        $updateQuery = "UPDATE tbl_plot SET car_slots = '$new_car_slots' WHERE plot_id = '$plot_id'";
        $Con->query($updateQuery);

        // Insert booking record
        $insertQuery = "INSERT INTO tbl_booking (plot_id, from_date, to_date, vehicle_type) 
                        VALUES ('$plot_id', '$from_date', '$to_date', 'car')";
        $Con->query($insertQuery);

        echo "Car slot booked successfully!";
    } elseif ($vehicle_type == "bike" && $plot['bike_slots'] > 0) {
        // Book a bike slot
        $new_bike_slots = $plot['bike_slots'] - 1;
        $updateQuery = "UPDATE tbl_plot SET bike_slots = '$new_bike_slots' WHERE plot_id = '$plot_id'";
        $Con->query($updateQuery);

        // Insert booking record
        $insertQuery = "INSERT INTO tbl_booking (plot_id, from_date, to_date, vehicle_type) 
                        VALUES ('$plot_id', '$from_date', '$to_date', 'bike')";
        $Con->query($insertQuery);

        echo "Bike slot booked successfully!";
    } else {
        echo "No slots available for the selected vehicle.";
    }
}
?>
