<?php 
include('../Assets/Connection/Connection.php');

include("Head.php");

if(isset($_POST['btn_submit']))
{
	
	$district=$_POST['txt_dist'];
	$insQry="insert into tbl_district(district_name)values('".$district."')";
	if($Con->query($insQry))
	{
		?>
        <script>
		alert("inserted")
		window.location="District.php"
		</script>
        <?php
	}
}
if(isset($_GET['id']))
{
	$delQry="delete from tbl_district where district_id='".$_GET['id']."'";
	if($Con->query($delQry))
	{
		?>
        <script>
		alert("Deleted")
		window.location="District.php"
		</script>
        <?php
	}
}
?>








<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title align="center">District Form</title>
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
            background-color: #009CFF;
        }
        input[type="text"] {
            width: calc(100% - 22px);
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #009CFF;
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
        <h1 align="center">District</h1>
        <form id="form1" name="form1" method="post" action="">
            <table align="center">
                <tr>
                    <td>District</td>
                    <td>
                        <input type="text" name="txt_dist" id="txt_dist" required 
                               title="District name should start with a capital letter and contain only alphabets and spaces."
                               pattern="^[A-Z][a-zA-Z ]*$" />
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div style="text-align: center;">
                            <input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
                        </div>
                    </td>
                </tr>
            </table>
        </form>
        
        <table>
            <tr>
                <th>#</th>
                <th>District</th>
                <th>Action</th>
            </tr>
            <?php
            $i = 0;
            $selQry = "SELECT * FROM tbl_district";
            $row = $Con->query($selQry);
            while ($data = $row->fetch_assoc()) {
                $i++;
            ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo htmlspecialchars($data['district_name']); ?></td>
                <td><a href="District.php?id=<?php echo $data['district_id']; ?>">Delete</a></td>
            </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>

<?php include("Foot.php"); ?>
