<?php
include("header.php");




if(isset($_POST["login"]))
{


	
	include("connect.php");

	$username = $_POST["username"];
	$password = $_POST["password"];


	$values = array( $username);

	$stmt = $pdo->prepare("select * from customer where username=?");
	$stmt->execute($values);
	$user = $stmt->fetch();

	if(isset($user["id"]))
	{

	
		if(password_verify($password,$user["password"]))
		{
			
			$_SESSION["user"] = $user;

			header("Location:index.php");	
		}
		else
		{
			header("location:login_error.php");		
		}


		
	}
	else
	{
		header("location:login_error.php");
	}

	print_r($user);

	
}


?>



<h3>Please Login to Access the Application</h3>

<form method="POST">


<table>
<tr>
<td><label>Username</label></td>
<td><input type="text" name="username" /></td>
</tr>

<tr>
<td><label>Password</label></td>
<td><input type="password" name="password" /></td>
</tr>

<tr>
<td>&nbsp;</td>
<td><input type="submit" name="login" value="Login" /></td>
</tr>

</table>

</form>


<p>
Not yet Registered? <a href="user_register.php">Click Here to Register</a>
</p>



<?php
include("footer.php");
?>