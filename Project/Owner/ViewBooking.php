<?php
include("../Assets/Connection/Connection.php");

include("Head.php");

// When marking the intime (vehicle enters)
if(isset($_GET['id'])) {
    $upQry = "UPDATE tbl_booking SET booking_intime = CURTIME(), booking_status = '1' WHERE booking_id = " . $_GET['id'];
    if($Con->query($upQry)) {
        ?>
        <script>
            alert("Booking Time marked");
            window.location = "ViewBooking.php";
        </script>
        <?php
    }
}

// When marking the outtime (vehicle exits)
if(isset($_GET['outid'])) {
    // Fetch booking details
    $bookingId = $_GET['outid'];

    // Fetch the intime, slottype, and plot fees for the corresponding booking
    $fetchQuery = "
        SELECT 
            *
        FROM tbl_booking b
        INNER JOIN tbl_slot s ON b.slot_id = s.slot_id
        INNER JOIN tbl_plot p ON s.plot_id = p.plot_id
        WHERE b.booking_id = '$bookingId'
    ";
    $result = $Con->query($fetchQuery);
    $data = $result->fetch_assoc();

    if($data) {
        $intime = $data['booking_intime'];
        $slottypeId = $data['slottype_id'];
        $bikeFee = $data['bike_fee'];
        $carFee = $data['car_fee'];

        // Calculate the difference in hours between intime and current time (out-time)
        $timeDiffQuery = "
            SELECT TIMESTAMPDIFF(HOUR, CONCAT(CURDATE(), ' ', '$intime'), NOW()) AS hours_diff;
        ";
        $timeResult = $Con->query($timeDiffQuery);
        $timeData = $timeResult->fetch_assoc();
        $hoursParked = $timeData['hours_diff'];

        // Calculate fee based on slottype
        if($slottypeId == 1) {
            $totalFee = $hoursParked * $carFee; // Car fee
        } else {
            $totalFee = $hoursParked * $bikeFee; // Bike fee
        }

        // Update outtime and booking amount in the booking table
        $updateQuery = "
            UPDATE tbl_booking 
            SET booking_outtime = CURTIME(), 
                booking_amount = '$totalFee' 
            WHERE booking_id = '$bookingId'
        ";
        
        if($Con->query($updateQuery)) {
            ?>
            <script>
                alert("Out Time marked. Total Parking Fee: <?php echo $totalFee; ?>");
                window.location = "ViewBooking.php";
            </script>
            <?php
        }
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Owner Bookings</title>
</head>
<body>
</br>
</br>
</br>
</br>
</br>
    <h2 align="center">View Bookings </h2>

    <table border="1" align="center">
        <tr>
            <th>#</th>
            <th>User Name</th>
            <th>User Contact</th>
            <th>Plot Address</th>
            <th>Slot Type</th>
            <th>Booking Date</th>
            <th>Booking For Date</th>
            <th>Booking Status</th>
        </tr>

        <?php
        // Initialize counter
        $i = 0;

        // Fetch bookings for the plots owned by the logged-in owner
        $query = "
            SELECT 
                *
            FROM tbl_booking b 
            INNER JOIN tbl_slot ON b.slot_id = tbl_slot.slot_id
            INNER JOIN tbl_plot ON tbl_slot.plot_id = tbl_plot.plot_id
            INNER JOIN tbl_user u ON b.user_id = u.user_id
            WHERE tbl_plot.owner_id = '$_SESSION[oid]'
        ";

        $result = $Con->query($query);

        while ($data = $result->fetch_assoc()) {
            $i++;

            // Determine slot type
            $slotType = ($data['slottype_id'] == 1) ? 'Car' : 'Bike';

            // Check if the booking date is for today
            $isToday = (date('Y-m-d') == $data['booking_fordate']);
        ?>

        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $data['user_name']; ?></td>
            <td><?php echo $data['user_contact']; ?></td>
            <td><?php echo $data['plot_address']; ?></td>
            <td><?php echo $slotType; ?></td>
            <td><?php echo $data['booking_date']; ?></td>
            <td><?php echo $data['booking_fordate']; ?></td>
            <td>
            <?php
            if ($data['booking_status'] == 0 && $isToday && !$data['booking_intime']) {
                // Show "Add Intime" if today and intime is not marked yet
                echo "Booked"; 
                ?>
                <a href="ViewBooking.php?id=<?php echo $data['booking_id'] ?>">Add Intime</a>
                <?php
            } elseif ($data['booking_status'] == 1 && $data['booking_intime'] && !$data['booking_outtime']) {
                // Show "Out Time" if intime is marked but outtime is not
                ?>
                <a href="ViewBooking.php?outid=<?php echo $data['booking_id'] ?>">Out Time</a>
                <?php
            } elseif ($data['booking_outtime'] && $data['booking_status'] == 1) {
                // Show the total amount and "Waiting for Payment"
                echo "Total Fee: " . $data['booking_amount'] . " - Waiting for Payment";
                
            } elseif ($data['booking_status'] == 2) {
                // Payment received
                echo "Payment Received. Slot is now free.";
            }
            ?>
            </td>
        </tr>

        <?php } ?>
    </table>
</body>
</html>
<?php
include("Foot.php");
?>
