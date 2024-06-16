<?php



@include '../dbConnect.php';

if (isset($_POST['submit'])) {

   // Retrieve and sanitize user input
   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $address = mysqli_real_escape_string($conn, $_POST['address']);
   $phone = mysqli_real_escape_string($conn, $_POST['phone']);
   $dob = mysqli_real_escape_string($conn, $_POST['dob']);
   $sex = mysqli_real_escape_string($conn, $_POST['sex']);
   $pass = mysqli_real_escape_string($conn, $_POST['password']);
   $cpass = mysqli_real_escape_string($conn, $_POST['cpassword']);

   // Check if the user already exists
   $select = "SELECT * FROM users WHERE email = ?";
   $stmt = $conn->prepare($select);
   $stmt->bind_param("s", $email);
   $stmt->execute();
   $result = $stmt->get_result();

   if ($result->num_rows > 0) {
      $error[] = 'User already exists!';
   } else {
      if ($pass != $cpass) {
         $error[] = 'Passwords do not match!';
      } else {
         // Hash the password
         $hashed_pass = password_hash($pass, PASSWORD_BCRYPT);

         // Insert new user into the database
         $insert = "INSERT INTO users (name, email, address, phoneNumber, dateOfBirth, sex, password) VALUES (?, ?, ?, ?, ?, ?, ?)";
         $stmt = $conn->prepare($insert);
         $stmt->bind_param("sssssss", $name, $email, $address, $phone, $dob, $sex, $hashed_pass);
         // $stmt->bind_param("sssssss", $name, $email, $address, $phone, $dob, $sex, $hashed_pass);
         $stmt->execute();


         if ($stmt->affected_rows > 0) {
            header('Location: login.php');
            exit();
         } else {
         }
      }
   }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Register Form</title>
   <link rel="stylesheet" href="../Css/registerUser.css">

   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Mulish:ital,wght@0,200..1000;1,200..1000&display=swap"
      rel="stylesheet">
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

   <style>

   </style>


</head>

<body>


   <div class="wrapper" style="background-image: url('../pictures/bg-registration-form-2.jpg');">

      <div class="container">
         <div class="where">
            <div class="form-container">
               <form action="" method="post">
                  <h3 class="text-center">Registration Form</h3>
                  <?php
                  if (isset($error)) {
                     foreach ($error as $errorMsg) {
                        echo '<span class="error-msg">' . $errorMsg . '</span>';
                     }
                  }
                  ?>
                  <div class="form-group">
                     <label for="">Name</label>
                     <input type="text" name="name" class="textbox" required>
                  </div>
                  <div class="form-group">
                     <label for="exampleInputEmail1">Email address</label>
                     <input type="email" name="email" class="textbox" id="exampleInputEmail1"
                        aria-describedby="emailHelp" placeholder="Enter email" required>
                     <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                        else.</small>
                  </div>
                  <div class="form-group">
                     <label for="">Address</label>
                     <input type="text" name="address" class="textbox" required>
                  </div>
                  <div class="row">
                     <div class="form-group col-12 col-sm-6">
                        <label for="">Phone Number</label>
                        <input type="text" name="phone" class="textbox" required>
                     </div>
                     <div class="form-group col-12 col-sm-6">
                        <label for="">Date of Birth</label>
                        <input type="date" name="dob" class="textbox" required>
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="">Sex</label>
                     <select name="sex" class="textbox" required>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                     </select>
                  </div>
                  <div class="form-group">
                     <label for="">Password</label>
                     <input type="password" name="password" class="textbox" required>
                  </div>
                  <div class="form-group">
                     <label for="">Confirm Password</label>
                     <input type="password" name="cpassword" class="textbox" required>
                  </div>
                  <div class="form-check">
                     <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
                     <label class="form-check-label" for="exampleCheck1">I accept the Terms of Use & Privacy
                        Policy.</label>
                  </div>
                  <button type="submit" name="submit" class="button">Submit</button>
                  <p class="text-center mt-3">Already have an account? <a href="login.php">Login now</a></p>
               </form>
            </div>
         </div>
      </div>
   </div>

</body>

</html>