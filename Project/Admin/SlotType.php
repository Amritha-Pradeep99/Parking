<?php 
include('../Assets/Connection/Connection.php');
include('Head.php');
if(isset($_POST['btn_submit']))
{
	
	$slottype=$_POST['txt_type'];
	$insQry="insert into tbl_slottype(slottype_name)values('".$slottype."')";
	if($Con->query($insQry))
	{
		?>
        <script>
		alert("inserted")
		window.location="SlotType.php"
		</script>
        <?php
	}
}
if(isset($_GET['id']))
{
	$delQry="delete from tbl_slottype where slottype_id='".$_GET['id']."'";
	if($Con->query($delQry))
	{
		?>
        <script>
		alert("Deleted")
		window.location="SlotType.php"
		</script>
        <?php
	}
}
?>








<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Slot Type Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
            color:black;
        }
        th {
            background-color:#009CFF;
        }
        input[type="text"] {
            width: calc(100% - 22px);
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color:#009CFF;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
        }
        input[type="submit"]:hover {
            background-color: #4cae4c;
        }
        a {
            color:  #009CFF;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
<div class="container">
    <h1 align="center">Slot Type</h1>
    <form id="form1" name="form1" method="post" action="">
        <table width="200" border="1" align="center">
            <tr>
                <td>Slot Type</td>
                <td>
                    <label for="txt_type"></label>
                    <input type="text" name="txt_type" id="txt_type" required 
                           title="Slot type must start with a capital letter and contain only letters and spaces."
                           pattern="^[A-Z][a-zA-Z ]*$" placeholder="Enter slot type" />
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
        <p>&nbsp;</p>
        <table width="200" border="1" align="center">
            <tr>
                <td style="background-color: #009CFF; color: white;">#</td>
                <td style="background-color: #009CFF; color: white;">Slot Type</td>
                <td style="background-color: #009CFF; color: white;">Action</td>
            </tr>
            <?php
            $i = 0;
            $selQry = "SELECT * FROM tbl_slottype";
            $row = $Con->query($selQry);
            while ($data = $row->fetch_assoc()) {
                $i++;
            ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $data['slottype_name']; ?></td>
                <td><a href="SlotType.php?id=<?php echo $data['slottype_id']; ?>">Delete</a></td>
            </tr>
            <?php } ?>
        </table>
        <p>&nbsp;</p>
    </form>
    </div>
</body>
</html>
<?php
           include("Foot.php");
           ?>