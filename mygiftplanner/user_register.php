<?php
include("header.php");


if(isset($_POST["submit"]))
{
  include("connect.php");


  $username = $_POST["username"];
  $email = $_POST["email"];
  $password = $_POST["password"];

  $password = password_hash($password,PASSWORD_DEFAULT);



  $first_name = $_POST["FirstName"];
  $last_name = $_POST["LastName"];



  $username = sanitizeString($username);
  $email = sanitizeString($email);
  $password = sanitizeString($password);
  $first_name = sanitizeString($FirstName);
  $last_name = sanitizeString($LastName);



  if($username=="" || $email=="" || $password=="")
  {
    header("Location:user_register.php?error=Validation Error!");
  }


  if(strlen($username)<6)
  {
    header("Location:user_register.php?error=Username must be at least 6 chars!"); 
  }
  if(strlen($password)<8)
  {
    header("Location:user_register.php?error=Password must be at least 8 chars!"); 
  }
  if(!preg_match("/[A-Z]/",$password))
  {
    header("Location:user_register.php?error=Password must contain an uppercase!"); 
  }
  if(!preg_match("/[a-z]/",$password))
  {
    header("Location:user_register.php?error=Password must contain a lower case!"); 
  }
  if(!preg_match("/[0-9]/",$password))
  {
    header("Location:user_register.php?error=Password must contain a numeric digit!"); 
  }




  
  $stmt = $pdo->prepare("select count(id) 'count' from users where username=?");
  $stmt->execute([$username]);
  $row = $stmt->fetch();

  if($row["count"]==0) 
  {
    $sql = "insert into users(username, email, password, first_name, last_name) values(?,?,?,?,?)";


    

    $values = array( $username , $email , $password , $FirstName , $LastName );

    try
    {
      $pdo->prepare($sql)->execute($values);
      header("Location:registered.php");
    }
    catch(Exception $e)
    {
      print_r($e);
    }

  }
  else 
  {
    header("Location:user_register.php?error=Username Exists!");
  }
  
  
  
}

?>


  <script>




  function validate(form)
  {

    var errors = new Array();





    var username = document.getElementById("username").value.trim();

    
    var email = document.getElementById("email").value.trim();

    var password = document.getElementById("password").value.trim();

    var cpassword = document.getElementById("cpassword").value.trim();



    if(username=="")
    {
      errors.push("Username must be filled in");
    }
    if(email=="")
    {
      errors.push("Email is required");
    }
    if(password=="")
    {
      errors.push("Please enter a password");
    }


    if(username.length<6)
    {
      errors.push("Username must be at least 6 characters");
    }
    if(password.length<8)
    {
      errors.push("Password must be at least 8 Characters");
    }
    
   

    if(password!=cpassword)
    {
      errors.push("Password and Confirm Password must match!");
    }


    var error_message = errors.join(", ");


    document.getElementById("error").innerHTML = error_message;


    if(errors.length>0)
    {
      return false;
    }
    else
    {
      return true;
    }


  }

  </script>

  
  <h3>New User Registration</h3>
  <div>Fields marked with an asterisk (*) are mandatory</div>

  <form method="POST" onsubmit="return validate(this)">


    <div id="error"></div>

    <table>
      <tr>
        <td><label>First Name</label></td>
        <td><input type="text" name="FirstName" id="FirstName" /></td>
      </tr>

      <tr>
        <td><label>Last Name</label></td>
        <td><input type="text" name="LastName" id="LastName" /></td>
      </tr>

      <tr>
        <td><label>Username *</label></td>
        <td><input type="text" name="username" id="username" required /></td>
      </tr>

      <tr>
        <td><label>Email *</label></td>
        <td><input type="email" name="email" id="email" required /></td>
      </tr>

      <tr>
        <td><label>Password *</label></td>
        <td><input type="password" name="password" id="password" required /></td>
      </tr>

      <tr>
        <td><label>Confirm Password *</label></td>
        <td><input type="password" name="cpassword" id="cpassword" required  /></td>
      </tr>

      <tr>
        <td>&nbsp;</td>
        <td><input type="submit" name="submit" value="Register" /></td>
      </tr>

    </table>

  </form>

  <p>Already a registered user? <a href="login.php">Login Here</a></p>

  <script>
  <?php
  if(isset($_GET["error"]))
  {
    echo "document.getElementById('error').innerHTML = '".$_GET["error"]."';";
  }
  ?>
  </script>


<?php include("footer.php"); ?>