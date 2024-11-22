<?php
include("../Assets/Connection/Connection.php");

include("Head.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Bookings</title>
</head>
<body>
<p>&nbsp;</p>
<p>&nbsp;</p>
    <h2 align="center">My Bookings</h2>

    <table border="1" align="center">
        <tr>
            <th>#</th>
            <th>Plot Address</th>
            <th>Slot Type</th>
            <th>Booking Date</th>
            <th>Booking For Date</th>
            <th>Booking Amount</th>
            <th>Owner Name</th>
            <th>Owner Email</th>
            <th>Owner Contact</th>
            <th>Booking Status</th>
            
        </tr>

        <?php
        // Initialize counter
        $i = 0;

        // Fetch bookings for the logged-in user with owner details
        $query = "
           select * from tbl_booking b inner join tbl_slot s on b.slot_id=s.slot_id inner join tbl_plot p on s.plot_id = p.plot_id inner join tbl_owner w on w.owner_id=p.owner_id
            WHERE b.user_id = '$_SESSION[uid]'
        ";
		
        $result = $Con->query($query);


        while ($data = $result->fetch_assoc()) {
            $i++;

       
            $slotType = ($data['slottype_id'] == 1) ? 'Car' : 'Bike';

       
            
        ?>

        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $data['plot_address']; ?></td>
            <td><?php echo $slotType; ?></td>
            <td><?php echo $data['booking_date']; ?></td>
            <td><?php echo $data['booking_fordate']; ?></td>
            <td><?php echo $data['booking_amount']; ?></td>
            <td><?php echo $data['owner_name']; ?></td>
            <td><?php echo $data['owner_email']; ?></td>
            <td><?php echo $data['owner_contact']; ?></td>
            <td><?php 
            if($data['booking_status']==0)
            {
                echo "Booked";
            }
            else if($data['booking_status']==1)
            {
                echo "Parked";
               ?>
               <p><a href="Payment.php?id=<?php echo $data['booking_id']?>">Pay</a>
                 <?Php
            }
            else if($data['booking_status']==2)
            {
              
               echo "Payment Completed";
			   ?>
               <a href="Rating.php?pid=<?php echo $data['plot_id'] ?>">Rating</a>
               
               
               <?php
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
