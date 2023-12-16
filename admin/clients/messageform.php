<?php
ob_start(); // Start output buffering

include 'sendemail.php';

// Retrieve data from the database
$dev_data = array('id'=>'-1','firstname'=>'Developer','lastname'=>'','username'=>'dev_oretnom','password'=>'5da283a2d990e8d8512cf967df5bc0d0','last_login'=>'','date_updated'=>'','date_added'=>'');
    if(!defined('base_url')) define('base_url','https://atvmotoshop.online/');
    if(!defined('base_app')) define('base_app', str_replace('\\','/',__DIR__).'/' );
    if(!defined('dev_data')) define('dev_data',$dev_data);
    if(!defined('DB_SERVER')) define('DB_SERVER',"localhost");
    if(!defined('DB_USERNAME')) define('DB_USERNAME',"u738394287_arnoldtv");
    if(!defined('DB_PASSWORD')) define('DB_PASSWORD',"4N8cIt=&qM#c");
    if(!defined('DB_NAME')) define('DB_NAME',"u738394287_arnoldtv");
    
    // Create a new mysqli connection
    $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['submit'])) {
    // Form is submitted, update the status to 1 (Done)
    $inquiryId = $_GET['id'];
    $updateQuery = "UPDATE inquiry_list SET status = 1 WHERE id = '$inquiryId'";
    $conn->query($updateQuery);
    // You may want to add some error handling here

    // After updating, you can redirect the user or display a success message
    if (!headers_sent()) {
      header("Location: ../inquiries.php?email=" . $email);
      exit();
  } else {
      echo '<div class="alert-sent">Already sent</div>';
  }
}

// Rest of your code...

ob_end_flush(); // Send the output buffer and release the output buffer
?>



<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title></title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="contact.css">
  <script src="https://kit.fontawesome.com/8714a42433.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css">
</head>
<style>
  /*--------------------------------------Contact-Us-Layout-----------------------------------------------------*/

.container_msg{
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  padding: 3%;
 
}

.alert-sent{
  display: flex;
  justify-content: center;
  background-color: #7EB4E7;
  padding: 1%;
  margin: 3%;
}


.customer_message{
  background-color: white;
  padding: 3%;
  width: 50%;
  box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.3);

  }

.name_email{
  display: flex;
  flex-direction: row;
  
}

small{
font-size: 12px;
}

.contact-form{
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column ;
  margin-top: 3%;
  background-color: white;
  padding: 3%;
  width: 50%;
  border-radius: 10px;
  box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.3);
}

.contact{
  display: flex;
  flex-direction: column;
  padding: 3%;
  
}

.contact input, textarea{
  margin:  2% 0;
  padding: 1%;
 
  border:  1px solid #004399;
  border-radius: 5px;
}

.send-btn {
    color: white;
    background-color: #C5CBD1 ;
    width: 30%;
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 0 auto; /* Add this line to center the button horizontally */
    margin-top: 10px; /* Add some top margin for spacing */
}

.btn{
  display: flex;
    justify-content: center;
    align-items: center;
    
}

.send-btn{
  background-color:#004399;
}



  /*-------------------------------------End-Contact-Us-Layout-----------------------------------------------------*/
</style>

<body class="Contactus">

<div class="container_msg">

<section class="customer_message">
<?php
    // Select all records from the inquiry_list table
$result = $conn->query("SELECT * FROM inquiry_list  where id = '{$_GET['id']}'");



// Display the retrieved data
while ($row = $result->fetch_assoc()) {
    // Echo the header with black color
    echo '<div class="header-reply">';
    echo "<h2 style='background-color: #004399; color:white; padding:1%; font-size: 18px;'>Message from " . $row["name"] . "</h2> <br>";
    echo '</div>';
    echo '<div class="name_email"> ';
    echo "<p>" . "From" . " " . "</p>";
    echo "<p style='color: #004399;'>" . "&nbsp;" . $row["name"] . " " . "@" . "</p>";
    echo "<small style='font-size: 80%;'>" . strtolower($row["inquiry_email"]) . "</small>" . "</br>";
    echo '</div>';
    
    echo "<small style='font-size: 80%;'>" . (isset($row['date_created']) ? date("M d, Y g:ia", strtotime($row['date_created'])) : "N/A") . "</small>" . "</br>";

    echo "<hr>";
  
    echo "</br>". $row["inquiry_message"] . "<br>";
}

// Close the database connection
$conn->close();
?>
</section>


    
    <div class="contact-form">
      
    
        <form class="contact" action="" method="post">
        <div class="header-reply">
    <h2 style="background-color: #004399; color: white; padding: 1%; font-size: 18px; margin-bottom: 6%;"> Reply to </h2>
      </div>
            <input type="varchar" id="subject" name="subject" class="text-box" placeholder="Subject" ronkeydown="return allowOnlyLetters(event)" required>
            <input type="email" id="email" name="email" class="text-box" placeholder="Customer email " required>

            <textarea class="form-control summernote" type="text" name="message" id="message" rows="20" placeholder="Message" required></textarea>
            <div class="btn">
            <input type="submit" name="submit" class="send-btn" value="Send">
            </div>

        </form>
    </div>
   
</div>


  <script type="text/javascript">
    if (window.history.replaceState) {
      window.history.replaceState(null, null, window.location.href);
    }
  </script>

  
  </div>


</body>

<script>
  function allowOnlyLetters(event) {
    // Check if the key pressed is a letter
    if (event.key.match(/[A-Za-z]/)) {
      return true; // Allow the key press
    } else {
      return false; // Prevent the key press
    }
  }

  $(document).ready(function() {
        $('.summernote').summernote({
            height: 100,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
                ['fontname', ['fontname']],
                ['fontSizes', ['fontsize']], // Include the font size dropdown
                ['color', ['color']],
                ['para', ['ol', 'ul', 'paragraph', 'height']],
                ['table', ['table']],
                ['view', ['undo', 'redo', 'fullscreen', 'codeview', 'help']]
            ],
            fontSizes: ['8', '9', '10', '11', '12', '14', '18', '24', '36', '48', '64', '82', '150'],
            fontNames: ['Arial', 'Times New Roman', 'Courier New', 'Custom Font', 'Montserrat']
        });


    });

</script>