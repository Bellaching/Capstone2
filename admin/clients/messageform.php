<?php
include 'sendemail.php';

// Retrieve data from the database
$conn = new mysqli("localhost", "root", "", "capstone_two_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}




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
  
 
 

  padding: 3%;
  border
}


.customer_message{
  background-color: white;
  padding: 3%;
}

.name_email{
  display: flex;
  flex-direction: row;
}

small{
font-size: 12px;
}

.contact-form{
  margin-top: 3%;
  background-color: white;
}

.contact{
  display: flex;
  flex-direction: column;
  padding: 3%;
}

.contact input, textarea{
  margin: 1%;
  padding: 1%;
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
    echo  "<h2>" .$row["subject"] . "</h2> <br>";
    echo '<div class="name_email"> ';

    
    echo "<h6>" . "From " . $row["name"] ." "."@" . "</h6> ";
    echo "<small style='font-size: 80%;'>" . strtolower($row["inquiry_email"]) . "</small>". "</br>";
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
            <input type="varchar" id="subject" name="subject" class="text-box" placeholder="Subject" ronkeydown="return allowOnlyLetters(event)" required>
            <input type="email" id="email" name="email" class="text-box" placeholder="Reply to " required> </input>
            <textarea class="form-control summernote" type="text" name="message" id="message" rows="5" placeholder="Message" required></textarea>
            <input type="submit" name="submit" class="send-btn" value="Send">

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
        var summernoteInstance = $('.summernote').summernote({
            toolbar: [
                ['style', ['style']],

                ['fontname', ['fontname']],
                ['fontsize', ['fontsize']], // Include the font size dropdown
                ['color', ['color']],


                ['view', ['undo', 'redo', 'fullscreen', 'codeview', 'help']]
            ],
            fontSizes: ['8', '9', '10', '11', '12', '14', '16', '18', '24', '36', '48', '64', '82', '150'],
            fontNames: ['Arial', 'Times New Roman', 'Courier New', 'Custom Font', 'Montserrat'],
        });

  });

</script>