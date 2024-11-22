<?php
include('../Assets/Connection/Connection.php');
session_start();
include("Head.php");

$sel="select * from tbl_admin where admin_id='".$_SESSION['aid']."'";
$row=$Con->query($sel);
$data=$row->fetch_assoc();
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
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
            background-color:  #009CFF;
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
<form id="form1" name="form1" method="post" action="">
<p>&nbsp;</p>
<p>&nbsp;</p>
<h1 align="center" style="background-color:  #009CFF; color: white;">Myprofile</h1>

  <table  border="1" align="center">
  
    <tr>
      <td style="background-color:  #009CFF; color: white;">Name</td>
      <td><?php echo $data['admin_name']?></td>
    </tr>
    <tr>
      <td style="background-color:  #009CFF; color: white;">Email</td>
      <td><?php echo $data['admin_email']?></td>
    </tr>
   

  </table>
  
</form>
</div>
</body>
</html>
<?php
include("Foot.php");
?>