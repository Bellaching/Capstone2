<?php 
require_once('./../../config.php');
if(isset($_GET['id'])){
    $qry = $conn->query("SELECT * FROM `order_list` where id = '{$_GET['id']}'");
    if($qry->num_rows > 0){
        foreach($qry->fetch_array() as $k => $v){
            if(!is_numeric($k))
            $$k = $v;
        }
    }
}
?>
<head>
    <!-- Other head elements -->

    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="path/to/bootstrap.min.css">
</head>

<div class="container-fluid">
    <form action="" id="update_order">
        <input type="hidden" name="id" value="<?= isset($id) ? $id : "" ?>">
        <input type="hidden" name="client_id" value="<?= isset($client_id) ? $client_id : "" ?>">
        <div class="form-group">
            <label for="status" class="control-label">Status</label>
            <select name="status" id="status" class="custom-select form-control-sm">
            
    <option value="0" <?= isset($status) && $status == 0 ? 'selected' : '' ?>>Pending</option>
    <option value="1" <?= isset($status) && $status == 1 ? 'selected' : '' ?>>Cancelled</option>
    <option value="2" <?= isset($status) && $status == 2 ? 'selected' : '' ?>>Confirmed</option>
   
    <option value="3" <?= isset($status) && $status == 3 ? 'selected' : '' ?>>Delivered</option>
    


            </select>
        </div>
    </form>
</div>

<script>$(function(){
    var statusSelect = $('#status');
    
    // Initial check to disable options based on the current status
    checkStatusOptions();

    $('#update_order').submit(function(e){
        e.preventDefault();
        var _this = $(this);
        $('.err-msg').remove();
        start_loader();
        $.ajax({
            url: _base_url_+"classes/Master.php?f=update_order_status",
            data: new FormData($(this)[0]),
            cache: false,
            contentType: false,
            processData: false,
            method: 'POST',
            type: 'POST',
            dataType: 'json',
            error: err => {
                console.log(err);
                alert_toast("An error occurred", 'error');
                end_loader();
            },
            success: function(resp){
                if(typeof resp == 'object' && resp.status == 'success'){
                    location.reload();
                } else if(resp.status == 'failed' && !!resp.msg){
                    var el = $('<div>')
                    el.addClass("alert alert-danger err-msg").text(resp.msg)
                    _this.prepend(el)
                    el.show('slow')
                    $("html, body").animate({ scrollTop: _this.closest('.card').offset().top }, "fast");
                    end_loader();
                } else {
                    alert_toast("An error occurred", 'error');
                    end_loader();
                    console.log(resp);
                }
            }
        });
    });

    // Function to check and disable options based on the selected status
    function checkStatusOptions() {
        var selectedStatus = statusSelect.val();
        
        // Disable options based on the selected status
        switch(selectedStatus) {
            case '0': // Pending
                statusSelect.find('option[value="0"]').prop('disabled', false); // Disable Confirmed
                statusSelect.find('option[value="2"]').prop('disabled', false); // Disable Confirmed
                statusSelect.find('option[value="3"]').prop('disabled', false); // Disable Delivered
            case '1': // Cancelled
                statusSelect.find('option[value="0"]').prop('disabled', true); // Disable Confirmed
                statusSelect.find('option[value="2"]').prop('disabled', true); // Disable Confirmed
                statusSelect.find('option[value="3"]').prop('disabled', true); // Disable Delivered

                break;
            case '2': // Confirmed
                statusSelect.find('option[value="0"]').prop('disabled', true); // Disable Confirmed
                statusSelect.find('option[value="1"]').prop('disabled', true); // Disable Confirmed
                
                break;
            case '3': // Delivered
                statusSelect.find('option[value="0"]').prop('disabled', true); // Disable Pending
                statusSelect.find('option[value="2"]').prop('disabled', true); // Disable Confirmed
                statusSelect.find('option[value="1"]').prop('disabled', true); // Disable Cancelled
                break;
            default:
                // Enable all options for other statuses
                statusSelect.find('option').prop('disabled', false);
        }
    }

    // Event handler for status change
    statusSelect.on('change', function(){
        checkStatusOptions();
    });
});

</script>


