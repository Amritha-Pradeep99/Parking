<?php
include("../Assets/Connection/Connection.php");
include("Head.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Slots</title>
</head>
<body>
    <form action="" method="post">
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <h1 align="center">View Slots</h1>
        <table border=1 align="center">
            <tr>
                <td>#</td>
                <td>Slot Type</td>
                <td>Total Slots</td>
                <td>Available Slots</td>
                <td>Action</td>
            </tr>

            <?php
            $i = 0;
            // Fetch all slots for the selected plot
            $sel = "SELECT * FROM tbl_slot WHERE plot_id='" . $_GET['pid'] . "'";
            $row = $Con->query($sel);

            while($data = $row->fetch_assoc()) {
                $i++;

                // Get the slot type (assuming slottype_id 1 = car, 2 = bike)
                $slotType = $data['slottype_id'] == 1 ? 'Car' : 'Bike';

                // Total slots
                $totalSlots = $data['slot_count'];

                // Get the count of booked slots using inner join with tbl_slot and tbl_booking
                $bookedQuery = "
                    SELECT COUNT(tbl_booking.booking_id) AS booked
                    FROM tbl_booking
                    INNER JOIN tbl_slot ON tbl_booking.slot_id = tbl_slot.slot_id
                    WHERE tbl_booking.slot_id = '" . $data['slot_id'] . "' 
                    AND tbl_booking.booking_status = 0
                    
                ";
                $bookedResult = $Con->query($bookedQuery);
                $booked = $bookedResult->fetch_assoc()['booked'];

                // Calculate available slots
                $availableSlots = $totalSlots - $booked;

                // If slot status is 1 (unavailable), mark all slots as unavailable
                if($data['slot_status'] == 1) {
                    $availableSlots = 0;
                }
            ?>

            <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $slotType ?></td>
                <td><?php echo $totalSlots ?></td>
                <td><?php echo $availableSlots ?></td>
                <td>
                    <?php if($availableSlots > 0) { ?>
                        <a href="BookingDates.php?sid=<?php echo $data['slot_id']?>">Book</a>
                    <?php } else { ?>
                        Slots Full
                    <?php } ?>
                </td>
            </tr>

            <?php } ?>
        </table>
    </form>
</body>
</html>
<?php
include("Foot.php");
?>
