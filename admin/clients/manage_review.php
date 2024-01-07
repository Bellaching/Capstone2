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
    $updateQuery = "UPDATE product_reviews SET status = 1 WHERE id = '$inquiryId'";
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



</style>

<body class="Contactus">

<div class="container_msg">

<div class="card-header">
        <h3 class="card-title"><b>Review Details</b></h3>
        <div class="card-tools">
            <button class="btn btn-primary btn-flat btn-sm"  type="button"  id="update_status">  <i class="fa fa-edit"></i> Update Status</button>
          
            <a class="btn btn-default btn-flat border btn-sm" href="<?php echo base_url ?>admin/?page=clients/customers_reviews"><i class="fa fa-angle-left"></i> Back to List</a>
        </div>
    </div>

<section class="customer_message">
<?php
    // Check if 'id' is set in the URL and is a valid positive integer
    $productId = isset($_GET['id']) ? intval($_GET['id']) : 0;

    if ($productId > 0) {
        // Assuming $conn is your database connection

        // Use prepared statements to prevent SQL injection
        $stmt = $conn->prepare("SELECT * FROM product_reviews WHERE id = ?");
        $stmt->bind_param("i", $productId);
        $stmt->execute();
        $result = $stmt->get_result();

        // Display the retrieved data
        while ($row = $result->fetch_assoc()) {
            echo '<div class="header-reply">';
            echo "<h2 style='background-color: #004399; color:white; padding:1%; font-size: 18px;'>Rate from " . htmlspecialchars($row["author_name"], ENT_QUOTES, 'UTF-8') . "</h2> <br>";
            echo "<small style='font-size: 80%;'>" . (isset($row['date_created']) ? date("M d, Y g:ia", strtotime($row['date_created'])) : "N/A") . "</small>" . "</br>";
            echo '</div>';
            echo '<div class="author_rate"> ';

            // Use a switch statement to generate star ratings
            switch (strval($row['author_rate'])) {
                case "1":
                    echo '<i class="fa fa-star checked"></i>';
                    echo '<i class="fa fa-star-o"></i>';
                    echo '<i class="fa fa-star-o"></i>';
                    echo '<i class="fa fa-star-o"></i>';
                    echo '<i class="fa fa-star-o"></i>';
                    break;
                case "2":
                    echo '<i class="fa fa-star checked"></i>';
                    echo '<i class="fa fa-star checked"></i>';
                    echo '<i class="fa fa-star-o"></i>';
                    echo '<i class="fa fa-star-o"></i>';
                    echo '<i class="fa fa-star-o"></i>';
                    break;
                case "3":
                    echo '<i class="fa fa-star checked"></i>';
                    echo '<i class="fa fa-star checked"></i>';
                    echo '<i class="fa fa-star checked"></i>';
                    echo '<i class="fa fa-star-o"></i>';
                    echo '<i class="fa fa-star-o"></i>';
                    break;
                case "4":
                    echo '<i class="fa fa-star checked"></i>';
                    echo '<i class="fa fa-star checked"></i>';
                    echo '<i class="fa fa-star checked"></i>';
                    echo '<i class="fa fa-star checked"></i>';
                    echo '<i class="fa fa-star-o"></i>';
                    break;
                case "5":
                    echo '<i class="fa fa-star checked"></i>';
                    echo '<i class="fa fa-star checked"></i>';
                    echo '<i class="fa fa-star checked"></i>';
                    echo '<i class="fa fa-star checked"></i>';
                    echo '<i class="fa fa-star checked"></i>';
                    break;
                default:
                    // Handle the default case if needed
                    break;
            }

            echo '</div>';

            // Additional code for reviewer comments
            echo '<div class="review-details">';
            echo '<p class="reviewer-comments mt-3">' . ucfirst($row['author_comment']) . '</p>';
            echo '</div>';
        }

        // Close the prepared statement
        $stmt->close();
    } else {
        // Handle invalid or missing 'id'
        echo "Invalid product ID";
    }

    // Close the database connection
    $conn->close();
?>
</section>


<div class="modal fade" id="update_status" role='dialog'>
    <div class="modal-dialog modal-lg modal-dialog-end" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Update appointment</h3>
            </div>
            <form id="update-appt-status" action="">
                <div class="modal-body">
                    <input type="hidden" id="appointment_id" name="appointment_id">
                    <select class="form-control" id="status" name="status">
                        <option value="0">Pending</option>
                        <option value="1">Rejected</option>
                        <option value="2">Accepted</option>
                      
                    </select>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
            </form>
        </div>
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

$(function() {
        $('#update_status').click(function() {
            uni_modal("Update Review Status", "clients/updateReview.php?id=<?= isset($id) ? $id : '' ?>?client_id=<?= isset($client_id) ? $client_id : '' ?>")
        })
      
      
    })

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