
<?php
require_once __DIR__ . '/db_config.php';
if(count($_FILES) > 0) {
if(is_uploaded_file($_FILES['profileimg']['tmp_name'])) {
$fname=$_POST['fname']; 
$mname=$_POST['mname'];  
$lname=$_POST['lname'];  
$email=$_POST['email']; 
$password=$_POST['password'];
$confirmpassword=$_POST['confirmpassword'];
$sex=$_POST['sex']; 
$address=$_POST['address']; 
$phoneno=$_POST['phoneno'];  
$imgData =addslashes(file_get_contents($_FILES['profileimg']['tmp_name']));
$imageProperties = getimageSize($_FILES['profileimg']['tmp_name']);
if($password==$confirmpassword){
$query=mysqli_query($con,"select * from user_account WHERE email='$email'");
$rows = mysqli_num_rows($query);
if ($rows >=1) {
?>
					<div class="card-body">
										<div class="sufee-alert alert with-close alert-primary alert-dismissible fade show">
											<span class="badge badge-pill badge-primary">Success</span>
											<?php echo"The Email ".$email."  is already registered! Please register again!";?>
											<button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
<?php
}
else {
$sql = "INSERT INTO user_account(imagetype ,image,fname,mname,lname,email,sex,password,address,phoneno,date)
    VALUES('{$imageProperties['mime']}', '{$imgData}','$fname','$mname','$lname','$email','$sex','$password','$address','$phoneno',NOW())";
$current_id = mysqli_query($con,$sql) or die("<b>Error:</b> Sorry! You are not registered.<br/>" .        

    mysqli_error($con));
if(isset($current_id)) {
echo" You are successfully registered";
}
}
}
else {
echo "password and conformation password does not match";
}
}

}

mysqli_close($con);
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Register</title>

    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

  

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">

</head>

<body class="animsition">
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                            <a href="#">
                            </a>
                        </div>
                        <div class="login-form">
                            <form  enctype="multipart/form-data" action="" method="post">
                                <div class="form-group">
								<table>
								 <tr><td><label>First Name</label></td>
                                    <td><input class="au-input au-input--full" type="text" name="fname" placeholder="Your name" required></td></tr>
									 <tr><td><label>Middle Name</label></td>
                                    <td><input class="au-input au-input--full" type="text" name="mname" placeholder="Father name "required></td></tr>
									 <tr><td><label>Last Name</label></td>
                                    <td><input class="au-input au-input--full" type="text" name="lname" placeholder="Grandfather"required></td></tr>
                                    <tr>  <td><label>Email Address</label>  </td>
                                      <td><input class="au-input au-input--full" type="email" name="email" placeholder="Email"required></td></tr>
                                   <tr><td> <label>Password</label></td>
                                   <td> <input class="au-input au-input--full" type="password" name="password" placeholder="Password"required></td></tr>
                                   <tr><td> <label>Confirm Password</label></td>
                                    <td><input class="au-input au-input--full" type="password" name="confirmpassword" placeholder="re-enter password"required></td></tr>
                                   <tr><td> <label>Address</label></td>
                                    <td><input class="au-input au-input--full" type="text" name="address" placeholder="Address"required></td></tr>
								 <tr><td><label>Sex</label></td>
                                    <td><select class="au-input au-input--full" name="sex"> 
									<option value="Male">Male</option>  <option value="Female">Female</option></select></td> </tr>
									<tr><td> <label>Phone Number</label></td>
                                    <td><input class="au-input au-input--full" type="text" name="phoneno" placeholder="Phone number"required></td></tr>
									<tr><td> <label>Profile image</label></td>
                                    <td><input class="input-file" type="file" name="profileimg" id="file"></td></tr>
                                    </table>
                                </div>
                                <div class="login-checkbox">
                                    <label>
                                        <input type="checkbox" name="agree" required>Agree the terms and policy
                                    </label>
                                </div>
		                     <div class="register-link">
                                <p>Already have account?
                                    <a href="user_login.php">Sign In</a>
                                </p><br>
                            </div>
                                <input type="submit" class="au-btn au-btn--block au-btn--green m-b-20" value="register">
                            </form>
                        </div>
                    </div>
                </div>
            </div>

    </div>
<!-- Jquery JS-->
	<script src="vendor/jquery-3.2.1.min.js"></script>
	<!-- Bootstrap JS-->
	<script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="vendor/animsition/animsition.min.js"></script>




    <!-- Main JS-->
    <script src="js/main.js"></script>

</body>

</html>
<!-- end document-->