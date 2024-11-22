<?php 
include('../Assets/Connection/Connection.php');

session_start();
if(isset($_POST['btn_login']))
{
	$email = $_POST["txt_email"];
	$password = $_POST["txt_password"];
	
	$selQry = "select * from tbl_user where user_email ='".$email."' and user_password='".$password."'";
	$result = $Con->query($selQry);
	
	$selQry1 = "select * from tbl_owner where owner_email ='".$email."' and owner_password='".$password."'";
	$result1 = $Con->query($selQry1);
	
	$selQry2 = "select * from tbl_admin where admin_email ='".$email."' and admin_password='".$password."'";
	$result2 = $Con->query($selQry2);
	
	if($data=$result->fetch_assoc())
	{
		$_SESSION['uid']=$data['user_id'];
		//$_SESSION['uname']=$data['user_name'];
		header("Location:../User/HomePage.php");
	}
	else if($data1=$result1->fetch_assoc())
	{
		$_SESSION['oid']=$data1['owner_id'];
		$_SESSION['oname']=$data1['owner_name'];
		header("Location:../Owner/HomePage.php");
	}
	else if($data2=$result2->fetch_assoc())
	{
		$_SESSION['aid']=$data2['admin_id'];
		$_SESSION['aname']=$data2['admin_name'];
		header("Location:../Admin/HomePage.php");
	}
	else
	{
		echo "invalid login";
	}
	
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            background: linear-gradient(to bottom, #4a4a4a, #d4d700); /* Dark gray to greenish-yellow gradient */
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            padding: 20px;
            width: 300px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .input-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
            transition: border-color 0.3s;
            background-color: #f9f9f9;
        }

        input[type="email"]:focus,
        input[type="password"]:focus {
            border-color: #d4d700; /* Greenish-yellow border on focus */
            outline: none;
        }

        .button-group {
            text-align: center;
        }

        input[type="submit"] {
            background-color: #4a4a4a; /* Dark gray button */
            color: white;
            border: none;
            border-radius: 4px;
            padding: 10px 15px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #383838; /* Darker gray on hover */
        }
    </style>
</head>
<body>
    <div class="container">
        <form name="form1" method="post" action="">
            <h1>Login</h1>
            <div class="input-group">
                <label for="txt_email">Email</label>
                <input type="email" name="txt_email" id="txt_email" required 
                       title="Please enter a valid email address.">
            </div>
            <div class="input-group">
                <label for="txt_password">Password</label>
                <input type="password" name="txt_password" id="txt_password" required 
                       pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
                       title="Password must contain at least one number, one uppercase letter, one lowercase letter, and at least 8 characters.">
            </div>
            <div class="button-group">
                <input type="submit" name="btn_login" id="btn_login" value="Submit">
            </div>
        </form>
    </div>
</body>
</html>

