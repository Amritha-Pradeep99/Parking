<?php 
include('../Assets/Connection/Connection.php');
include("Head.php");
if(isset($_POST['btn_submit']))
{
    $slot_type = $_POST['slot_type']; 
    $slot_count = $_POST['slot_count'];  
    $plot_id = $_GET['pid'];  
   

    $insQry = "INSERT INTO tbl_slot (slot_count, slottype_id, plot_id) 
               VALUES ('".$slot_count."', '".$slot_type."', '".$plot_id."')";
    
    if($Con->query($insQry))
    {
        ?>
        <script>
        alert("Slot inserted successfully");
        window.location="Addslot.php?pid=<?php echo $plot_id; ?>";
        </script>
        <?php
    }
}

if(isset($_GET['id']))
{
    $delQry = "DELETE FROM tbl_slot WHERE slot_id = '".$_GET['id']."'";
    if($Con->query($delQry))
    {
        ?>
        <script>
        alert("Slot deleted successfully");
        window.location="Addslot.php?pid=<?php echo $_GET['pid']; ?>";
        </script>
        <?php
    }
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Add Slot</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        h1 {
            text-align: center;
        }
        table {
            width: 400px;
            border-collapse: collapse;
            margin: auto;
            margin-bottom: 20px;
        }
        td {
            padding: 10px;
            border: 1px solid #ccc;
        }
    </style>
</head>

<body>
    <h1>Add Slot</h1>
    <form id="form1" name="form1" method="post" action="" onsubmit="return validateForm()">
        <table>
            <tr>
                <td>Slot Type</td>
                <td>
                    <select name="slot_type" id="slot_type" required>
                        <option value="">--select--</option>
                        <?php 
                        $selQry = "SELECT * FROM tbl_slottype";
                        $row = $Con->query($selQry);
                        while ($data = $row->fetch_assoc()) {
                        ?>
                            <option value="<?php echo $data['slottype_id']; ?>"><?php echo $data['slottype_name']; ?></option>
                        <?php } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Slot Count</td>
                <td>
                    <input type="number" name="slot_count" id="slot_count" min="1" required />
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <div align="center">
                        <input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
                    </div>
                </td>
            </tr>
        </table>

        <table>
            <tr>
                <td>#</td>
                <td>Slot Type</td>
                <td>Slot Count</td>
                <td>Action</td>
            </tr>
            <?php
            $i = 0;
            $selQry = "SELECT * FROM tbl_slot s INNER JOIN tbl_slottype t ON s.slottype_id = t.slottype_id WHERE plot_id = '".$_GET['pid']."'";
            $row = $Con->query($selQry);
            while ($data = $row->fetch_assoc()) {
                $i++;
            ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $data['slottype_name']; ?></td>
                    <td><?php echo $data['slot_count']; ?></td>
                    <td><a href="Addslot.php?id=<?php echo $data['slot_id']; ?>&pid=<?php echo $_GET['pid']; ?>">Delete</a></td>
                </tr>
            <?php } ?>
        </table>
    </form>

    <script>
        function validateForm() {
            const slotCount = document.getElementById('slot_count').value;
            if (slotCount <= 0) {
                alert('Please enter a valid Slot Count (greater than 0).');
                return false;
            }
            return true;
        }
    </script>
</body>
</html>
<?php
include("Foot.php");
?>
