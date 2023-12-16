<?php
include 'sendemail.php';

// Initialize $alert to an empty string
$alert = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Retrieve form data
    $name = $_POST['name'];
    $inquiry_email = $_POST['inquiry_email'];
    $subject = $_POST['subject'];
    $inquiry_message = $_POST['inquiry_message'];
    $client_id = $_settings->userdata('id'); // Assuming client_id is stored in $_settings

    // Connect to the database (Update the username and password if needed)
    $conn = new mysqli("localhost", "u738394287_arnoldtv", "", "4N8cIt=&qM#c");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_settings->userdata('id') > 0 && $_settings->userdata('login_type') == 2) {
        // Insert form data into the database
        $sql = "INSERT INTO inquiry_list (client_id, name, inquiry_email, subject, inquiry_message) VALUES ('$client_id', '$name', '$inquiry_email', '$subject', '$inquiry_message')";

        if ($conn->query($sql) === TRUE) {
            $alert = "Record added successfully!";
        } else {
            $alert = "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        // Display an alert if the user is not logged in
        echo '<script>alert("Please Login First!");</script>';
    }

    // Close the database connection
    $conn->close();
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


  .contact-info {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    justify-content: space-around;
    align-items: stretch;
    padding: 1%;
  }

  .contact-info h1 {
    font-size: 24px;
  }



  .Address p {
    font-size: 11px;
  }

  .contact-h1 {
    display: flex;
    justify-content: flex-start;
    align-items: center;
    flex-direction: column;
    text-align: center;
    color: #fff;
    background-color: #004399;
    height: 40px;
    width: 100%;
    height: 300px;
  }


  .contact-h1 h1 {
    margin-top: 3%;
  }

  .contact-h1 p {
    margin-top: 1%;
  }

  .contact-info>div {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-align: center;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.619);

    margin: 40px;
    margin-top: -150px;
    border-radius: 10px;
    background-color: rgb(255, 255, 255);
  }

  .contact-info>div img {
    max-width: 100%;
    height: auto;
  }

  .contact-info h1,
  .contact-info p {
    margin: 5px 0;
  }

  .connect-with-us {
    position: fixed;
    bottom: 0;
    left: 0;
  }

  .messenger-icon {
    display: flex;
    align-items: center;



    padding: 10px;
    /* Adjust padding as needed */
    border-radius: 10px;
    /* Add border-radius for rounded corners */
  }

  .messenger-icon i {
    color: #EF4A98;
    /* Add some spacing between the icon and the background */
    font-size: 54px;

    margin: 10%;
  }

  .contact-section {
    display: flex;
    flex-direction: row;

    justify-content: center;
    align-items: center;

  }

  .contact-form,
  .map{
    width: 50%;
  }

  .contact {
    display: flex;
    flex-direction: column;
    padding: 4%;
  }

  .map{
   display: flex;
  
    padding: 4%;
   
    width: 50%;
  }

  .connect-with-us a {
    margin-top: 1%;
    margin-bottom: 1%;
    color: #004399;
    font-size: 24px;
  }

  .contact-section {
    display: flex;
    flex-direction: row;

    justify-content: center;
    align-items: center;

  }



  .contact-form {

    width: 50%;
    margin: 5%;
    border: none;
    background-color: white;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.619);
  }



  .text-box,
  textarea {
    border-radius: 25px;
    padding: 2%;
    border: none;
    background-color: #D4EEFA;
    margin: 2% 0;
  }

  .send-btn {
    background-color: #004399;
    color: white;
    border-radius: 25px;
    padding: 2%;
    border: none;
  }

  /*-------------------------------------End-Contact-Us-Layout-----------------------------------------------------*/
</style>

<body class="Contactus">

  <!--END-OF-HEADER--------------------------------------------------------------------------------->

  <!--Contact--------------------------------------------------------------------------------------->
  
  <div class="contact-container">
    <div class="contact-h1">
      <h1>Contact us</h1>
      <p>Reach out to us through our provided phone number, address, and email for direct communication with our shop.</p>
    </div>

    <div class="contact-info">

      <div class="Phone">
        <img src="images/phone.png" alt="Phone">
        <h1>Phone</h1>
        <?php echo $_settings->info('phonenumber') ?>
      </div>

      <div class="Address">
        <img src="images/address.png" alt="Address">
        <h1>Address</h1>
        <?php echo $_settings->info('address') ?>
      </div>

      <div class="Email">
        <img src="images/email.png" alt="Email">
        <h1>Email</h1>
        <?php echo $_settings->info('email') ?>
      </div>


    </div>
   

    <?php if (!empty($alert)) : ?>
      <div class="alert"><?php echo $alert; ?></div>
    <?php endif; ?>
    <div class="connect-with-us">
      <a href="<?php echo $_settings->info('link') ?>" class="messenger-icon">
        <i class="fab fa-facebook-messenger"></i>
      </a>
    </div>

  </div>



 <div class="contact-section">

    
    <div class="contact-form">
      
        <form class="contact" action="" method="post">
            <input type="varchar" id="name" name="name" class="text-box" placeholder="Your Name" ronkeydown="return allowOnlyLetters(event)" required>
            <input type="email" id="inquiry_email" name="inquiry_email" class="text-box" placeholder="Your Email" required>
            <input type="varchar" id="subject" name="subject" class="text-box" placeholder="Subject" required>
            <textarea type="text" name="inquiry_message" id="inquiry_message" rows="5" placeholder="Message" required></textarea>

            <input type="submit" name="submit" class="send-btn" value="Send">

        </form>
    </div>

    <div class="map">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15827434.052939586!2d102.47337735000002!3d14.420265899999992!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397d3fa43913f35%3A0x41df7312dc1ace88!2sThe%20Legian%20Imus%202D!5e0!3m2!1sen!2sph!4v1702599437775!5m2!1sen!2sph" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>


    </div>
   
</div>

    


  <script type="text/javascript">
    if (window.history.replaceState) {
      window.history.replaceState(null, null, window.location.href);
    }
  </script>

<script type="text/javascript">
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }

    // Check if the form is submitted in JavaScript
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelector('.contact').addEventListener('submit', function (e) {
            if (document.getElementById('name').value === '' || document.getElementById('inquiry_email').value === '' || document.getElementById('subject').value === '' || document.getElementById('inquiry_message').value === '') {
                e.preventDefault();
                alert('All fields must be filled out!');
            }
        });
    });
</script>


</body>


