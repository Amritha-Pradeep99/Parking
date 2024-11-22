<?php
include("../Assets/Connection/Connection.php");

include("Head.php");

if(isset($_POST['btnSubmit'])) {
  
    $slot_id = $_GET['sid'];
    $user_id = $_SESSION['uid'];
    $for_date = $_POST['for_date'];

    
    $slotQuery = "SELECT plot_id FROM tbl_slot WHERE slot_id = '$slot_id'";
    $slotResult = $Con->query($slotQuery);
    $slotData = $slotResult->fetch_assoc();
    $plot_id = $slotData['plot_id'];

   
    $plotQuery = "SELECT car_fee, bike_fee FROM tbl_plot WHERE plot_id = '$plot_id'";
    $plotResult = $Con->query($plotQuery);
    $plotData = $plotResult->fetch_assoc();
    
   
    $slotTypeQuery = "SELECT slottype_id FROM tbl_slot WHERE slot_id = '$slot_id'";
    $slotTypeResult = $Con->query($slotTypeQuery);
    $slotTypeData = $slotTypeResult->fetch_assoc();
    $slotType = $slotTypeData['slottype_id'];

   
    if($slotType == 1) {
        $booking_amount = $plotData['car_fee'];
    } else {
        $booking_amount = $plotData['bike_fee'];
    }

    
    //$Con->begin_transaction();

   
    $insertQuery = "INSERT INTO tbl_booking (booking_date, booking_fordate, booking_status, booking_amount, user_id, slot_id) 
                    VALUES (CURDATE(), '$for_date', 0, '$booking_amount', '$user_id', '$slot_id')";

    
    // $updateSlotQuery = "UPDATE tbl_slot SET slot_status = 1 WHERE slot_id = '$slot_id'";

  
    if($Con->query($insertQuery)) {
        
        // if($Con->query($updateSlotQuery))
         {
          
           
            echo "<script>alert('Booking successful! '); window.location.href='MyBooking.php';</script>";
        } 
        // else {
            
        //     echo "<script>alert('Failed to update slot status. Booking cancelled.');</script>";
        // }
    } else {
        
        echo "<script>alert('Booking failed! Please try again.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Page</title>
</head>
<body>
    <form action="" method="post">
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <h1 align="center">BookingDate</h1>
        <table align="center" border="1">
            <tr>
                <td>Booking For Date:</td>
                <td><input type="date" name="for_date" required></td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <input type="submit" name="btnSubmit" value="Book Now">
                </td>
            </tr>
        </table>
    </form>
</body>
</html>
<?php
include("Foot.php");
?>
