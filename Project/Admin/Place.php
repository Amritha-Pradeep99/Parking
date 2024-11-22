<?php

include('../Assets/Connection/Connection.php');
include('Head.php');
if(isset($_POST['btn_save']))
	{
		$place = $_POST['txt_place'];
		$district = $_POST['sel_district'];
		
		
				$ins = "insert into tbl_place (place_name,district_id) values('".$place."','".$district."')";
			if($Con->query($ins))
		{
			?>
			<script>
			alert("inserted")
			window.location="Place.php"
			</script>
			<?php
		}
		
		
		
	}

	
	if(isset($_GET['did']))
	{
		$del = "delete from tbl_place where place_id = '".$_GET['did']."'";
		if($Con->query($del))
		{
			?>
        <script>
		alert("Deleted")
		window.location="Place.php"
		</script>
        <?php
		}
	}

?>




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Place Form</title>
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
            background-color:  #06400E;
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
    <h1 align="center">Place</h1>
    <form id="form1" name="form1" method="post" action="">
        <table width="200" border="1" align="center">
            <tr>
                <td>District</td>
                <td>
                    <label for="sel_district"></label>
                    <select name="sel_district" id="sel_district" required>
                        <option value="">-----Select-----</option>
                        <?php
                        $selquery = "SELECT * FROM tbl_district";
                        $row = $Con->query($selquery);
                        while ($data = $row->fetch_assoc()) {
                        ?>
                            <option value="<?php echo $data['district_id']; ?>">
                                <?php echo $data['district_name']; ?>
                            </option>
                        <?php
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Place</td>
                <td>
                    <label for="txt_place"></label>
                    <input type="text" name="txt_place" id="txt_place" required 
                           title="Place name should start with a capital letter and contain only alphabets and spaces."
                           pattern="^[A-Z][a-zA-Z ]*$" />
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <div align="center">
                        <input type="submit" name="btn_save" id="btn_save" value="Submit" />
                    </div>
                </td>
            </tr>
        </table>
        <p>&nbsp;</p>
        <table width="200" border="1" align="center">
            <tr>
            <td style="background-color: #009CFF; color: white;">#</td>

                <td style="background-color: #009CFF; color: white;">District</td>
                <td style="background-color: #009CFF; color: white;">Place</td>
                <td style="background-color: #009CFF; color: white;">Action</td>
            </tr>
            <?php
            $i = 0;
            $sel = "SELECT * FROM tbl_place p INNER JOIN tbl_district d ON p.district_id = d.district_id";
            $row = $Con->query($sel);
            while ($data = $row->fetch_assoc()) {
                $i++;
            ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $data['district_name']; ?></td>
                    <td><?php echo $data['place_name']; ?></td>
                    <td><a href="place.php?did=<?php echo $data['place_id']; ?>">Delete</a></td>
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
