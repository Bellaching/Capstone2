<?php
if (isset($_GET['id'])) {
    $qry = $conn->query("SELECT * FROM `product_reviews` where id = '{$_GET['id']}'");
    if ($qry->num_rows > 0) {
        foreach ($qry->fetch_array() as $k => $v) {
            if (!is_numeric($k))
                $$k = $v;
        }
    }
}
?>










<body class="Contactus">

<div class="container_msg">

<div class="card-header">
        <h3 class="card-title"><b>Review Details</b></h3>
        <div class="card-tools">
            <button class="btn btn-primary btn-flat btn-sm"  type="button"  id="update_status">  <i class="fa fa-edit"></i> Update Status</button>
            <button class="btn btn-danger btn-flat btn-sm" type="button" id="delete_review"><i class="fa fa-trash"></i> Delete</button>
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
            echo "<h2>Rate from " . htmlspecialchars($row["author_name"], ENT_QUOTES, 'UTF-8') . "</h2> <br>";
            echo "<small style='font-size: 80%;'>" . (isset($row['date_created']) ? date("M d, Y g:ia", strtotime($row['date_created'])) : "N/A") . "</small>" . "</br>";
            echo "<small>" . htmlspecialchars($row["product_name"], ENT_QUOTES, 'UTF-8') . "</small> <br>";
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
                        <option value="1">Reject</option>
                        <option value="1">Accept</option>
                       
                      
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
      
        $('#delete_review').click(function(){
            _conf("Are you sure to delete this order permanently?","delete_review",[])
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

  function delete_review(){
        start_loader();
        $.ajax({
            url:_base_url_+"classes/Master.php?f=delete_review",
            data:{id : "<?= isset($id) ? $id : '' ?>"},
            method:'POST',
            dataType:'json',
            error:err=>{
                console.error(err)
                alert_toast('An error occurred.','error')
                end_loader()
            },
            success:function(resp){
                if(resp.status == 'success'){
                    location.replace('./?page=clients/customers_reviews')
                }else if(!!resp.msg){
                    alert_toast(resp.msg,'error')
                }else{
                    alert_toast('An error occurred.','error')
                }
                end_loader();
            }
        })
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