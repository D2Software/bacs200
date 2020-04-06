<?php
//index.php

$error = '';
$name = '';
$website = '';
$message = '';

function clean_text($string)
{
 $string = trim($string);
 $string = stripslashes($string);
 $string = htmlspecialchars($string);
 return $string;
}

if(isset ($_POST["submit"]))
{
 if(empty($_POST["name"]))
 {
  $error .= '<p><label class="text-danger">Please Enter your Name</label></p>';
 }
 else
 {
  $name = clean_text($_POST["name"]);
  if(!preg_match("/^[a-zA-Z ]*$/",$name))
  {
   $error .= '<p><label class="text-danger">Only letters and white space allowed</label></p>';
  }
 }
 if(empty($_POST["website"]))
 {
  $error .= '<p><label class="text-danger">Please Enter your website</label></p>';
 }
 else
 {
  $email = clean_text($_POST["website"]);
 }
 if(empty($_POST["message"]))
 {
  $error .= '<p><label class="text-danger">Message is required</label></p>';
 }
 else
 {
  $message = clean_text($_POST["message"]);
 }

 if($error == '')
 {
  $file_open = fopen("review.csv", "a");
  $no_rows = count(file("review.csv"));
  if($no_rows > 1)
  {
   $no_rows = ($no_rows - 1) + 1;
  }
  $form_data = array(
   'sr_no'  => $no_rows,
   'name'  => $name,
   'website'  => $website,
   'message' => $message
  );
  fputcsv($file_open, $form_data);
  $error = '<label class="text-success">Thank you for Your input</label>';
  $name = '';
  $website = '';
  $message = '';
 }
}

?>
<!DOCTYPE html>
<html>
 <head>
  <title>D2 Software Review Form</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 </head>
 <body>
  <br />
  <div class="container">
   <h2 align="center">How to Store Form data in CSV File using PHP</h2>
   <br />
   <div class="col-md-6" style="margin:0 auto; float:none;">
    <form method="post">
     <h3 align="center">Contact Form</h3>
     <br />
     <?php echo $error; ?>
     <div class="form-group">
      <label>Enter First Name</label>
      <input type="text" name="name" placeholder="Enter First Name" class="form-control" value="<?php echo $name; ?>" />
     </div>
     <div class="form-group">
      <label>Enter Page Reviewed</label>
      <input type="text" name="website" class="form-control" placeholder="Enter Page Reviewed" value="<?php echo $website; ?>" />
     </div>
     <div class="form-group">
      <label>Enter Review</label>
      <textarea name="message" class="form-control" placeholder="Enter review"><?php echo $message; ?></textarea>
     </div>
        <br>
        <input type="checkbox" name="requirement_1" id="id_requirement_1" checked="" value="Reviewed page does not load"> &nbsp; <label>Reviewed page loads</label>
        <br>
        <input type="checkbox" name="requirement_2" id="id_requirement_2" checked="" value="List links do not work"> &nbsp; <label>List links work</label>
        <br>
        <input type="checkbox" name="requirement_3" id="id_requirement_3" checked="" value="Bad page flow"> &nbsp; <label>Good page flow</label>
        <br>
        <input type="checkbox" name="requirement_4" id="id_requirement_4" checked="" value="Page not appeaing"> &nbsp; <label>Page looks appealing</label>
        <br>
        <input type="checkbox" name="requirement_5" id="id_requirement_5" checked="" value="Incorrect title"> &nbsp; <label>Correct title</label>
        <br>
        <input type="checkbox" name="requirement_6" id="id_requirement_6" checked="" value="Page links do not work"> &nbsp; <label>Page links work</label>
        <br>
        <input type="checkbox" name="requirement_7" id="id_requirement_7" checked="" value="No wordpress access"> &nbsp; <label>Can access wordpress</label>
        <br>
        <input type="checkbox" name="requirement_8" id="id_requirement_8" checked="" value="No profile photo"> &nbsp; <label>Page profile photo exists</label>
        <br>
        <input type="checkbox" name="requirement_9" id="id_requirement_9" checked="" value="Footer icons inop"> &nbsp; <label>Footer icon links work</label>
        <br>
        <input type="checkbox" name="requirement_10" id="id_requirement_10" checked="" value="HTML does not validate"> &nbsp; <label>HTML validates</label>
     <div class="form-group" align="center">
      <input type="submit" name="submit" class="btn btn-info" value="Submit" />
     </div>
    </form>
   </div>
  </div>
 </body>
</html>
