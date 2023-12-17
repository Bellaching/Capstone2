<?php
require_once('./config.php');
if (isset($_GET['id'])) {
    $qry = $conn->query("SELECT * FROM `order_list` where id = '{$_GET['id']}'");
    if ($qry->num_rows > 0) {
        foreach ($qry->fetch_array() as $k => $v) {
            if (!is_numeric($k))
                $$k = $v;
        }
    }
}
?>
<?php
if (!isset($_GET['id'])) {
    $_settings->set_flashdata('error', 'No order ID Provided.');
    redirect('admin/?page=orders');
}
$order = $conn->query("SELECT o.*,concat(c.firstname,' ',c.lastname) as fullname, a.id as appointment_id, a.dates, a.hours, a.status as appointment_status FROM `order_list` o inner join client_list c on c.id = o.client_id left join appointment a on a.order_id = o.id where o.id = '{$_GET['id']}' ");
if ($order->num_rows > 0) {
    foreach ($order->fetch_assoc() as $k => $v) {
        $$k = $v;
    }
} else {
    $_settings->set_flashdata('error', 'Order ID provided is Unknown');
    redirect('admin/?page=orders');
}
?>
<style>
    #uni_modal .modal-footer {
        display: none;
    }

    .prod-cart-img {
        width: 7em;
        height: 7em;
        object-fit: scale-down;
        object-position: center center;
    }

    .rating {
        display: flex;
        align-items: center;
    }

    .rating>.rating-stars {
        display: flex;
        flex-direction: row-reverse;
        margin-left: 10px;
    }

    .rating>.rating-stars>input {
        visibility: hidden;
    }

    .rating>.rating-stars>label {
        position: relative;
        font-size: 2rem;
        color: #f7d72c;
        cursor: pointer;
    }

    .rating>.rating-stars>label::before {
        content: "\2605";
        position: absolute;
        opacity: 0;
    }

    .rating>.rating-stars>label:hover:before,
    .rating>.rating-stars>label:hover~label:before {
        opacity: 1 !important;
    }

    .rating>.rating-stars>input:checked~label:before {
        opacity: 1;
    }

    .rating>.rating-stars>:hover>input:checked~label:before {
        opacity: 0.4;

    }

    @media print {
        .print-btn {
            display: none !important;
        }
    }

    .proof_payment_container input[type="file"] {
        border: 1px solid #d5d5d5;
        padding: 7px;
        border-radius: 10px;
        margin-bottom: 13px;
    }
</style>
<div class="container-fluid" id="orderDetailsContainer">

    <div class="row">
        <div class="col-md-6">
            <label for="" class="text-muted">Name</label>
            <div class="ml-3"><b><?= isset($fullname) ? $fullname : "N/A" ?></b></div>
            <label for="" class="text-muted">Appointment Date</label>
            <div class="ml-3"><b><?= isset($dates) && isset($hours) ? $dates . ' ' . $hours : "-- --" ?></b></div>
            <?php if (isset($appointment_status)) : ?>
                <label for="" class="text-muted">Appointment Status</label>
                <div class="ml-3">
                    <?php switch (strval($appointment_status)):
                        case 0: ?>
                            <span class="badge badge-secondary px-3 rounded-pill p-2 bg-secondary">Pending</span>
                        <?php break;
                        case 2: ?>
                            <span class="badge badge-secondary px-3 rounded-pill p-2 bg-info">Confirmed</span>
                        <?php break;
                        case 1: ?>
                            <span class="badge badge-secondary px-3 rounded-pill p-2 bg-warning">Cancelled</span>
                        <?php break;
                        case 3: ?>
                            <span class="badge badge-secondary px-3 rounded-pill p-2 bg-warning">Rejected</span>
                        <?php break;
                        default: ?>
                            <span class="badge badge-secondary px-3 rounded-pill p-2 bg-secondary">Pending</span>
                            <?php break; ?>
                    <?php endswitch; ?>
                </div>
            <?php endif; ?>
        </div>
        <div class="col-md-6">
            <label for="" class="text-muted">Reference Code</label>
            <div class="ml-3">
                <b><?= isset($ref_code) ? $ref_code : "N/A" ?></b>
            </div>
          
        </div>
        <div class="col-md-6">
            <label for="" class="text-muted">Date Ordered</label>
            <div class="ml-3"><b><?= isset($date_created) ? date("M d, Y h:i A", strtotime($date_created)) : "N/A" ?></b></div>
        </div>

        <div class="col-md-6">
                            <?php
                            //get province name
                            $api_url = 'https://ph-locations-api.buonzz.com/v1/provinces';
                            $response = file_get_contents($api_url);

                            $provinces = json_decode($response, true);

                            $provinceCode = $province;

                            $provinceName = null;

                            foreach ($provinces['data'] as $province) {
                                if ($province['id'] === $provinceCode) {
                                    $provinceName = $province['name'];
                                    break;
                                }
                            }

                            //get city name
                            $api_url2 = 'https://ph-locations-api.buonzz.com/v1/cities';
                            $response2 = file_get_contents($api_url2);

                            $cities = json_decode($response2, true);

                            $cityCode = $city;

                            $cityName = null;

                            foreach ($cities['data'] as $city) {
                                if ($city['id'] === $cityCode) {
                                    $cityName = $city['name'];
                                    break;
                                }
                            }

                            echo '<label for="" class="text-muted">Client Address</label>';
                            echo '<div class="ml-3" id="prov"> ', '<b>' . $cityName .',' .$provinceName.'</b>', '</div>';

                            echo '<label for="" class="text-muted">Customer Number:</label>';
                            echo '<div class="ml-3" id="contact">' . $contact . '</div>';
                            if ($addressline1) {

                                echo '<label for="" class="text-muted">Address Line 1</label>';

                                echo '<div class="ml-3" id="adr1">', $addressline1, '</div>';
                            }
                            if ($addressline2) {
                                echo '<label for="" class="text-muted">Address Line 2</label>';

                                echo '<div class="ml-3" id="adr2">' . $addressline2 . '</div>';
                            }
                            ?>

                        </div>
                    </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label for="" class="text-muted">Status</label>
            <div class="ml-3">
                <?php if (isset($status)) : ?>
                    <?php if ($status == 0) : ?>
                        <span class="badge badge-secondary px-3 rounded-pill p-2 bg-secondary">Pending</span>
                    <?php elseif ($status == 1) : ?>
                        <span class="badge badge-secondary px-3 rounded-pill p-2 bg-info">Cancelled</span>

                    <?php elseif ($status == 2) : ?>
                        <span class="badge badge-secondary px-3 rounded-pill p-2 bg-success">Confirmed</span>
                    <?php elseif ($status == 3) : ?>
                        <span class="badge badge-secondary px-3 rounded-pill p-2 bg-warning">Shipped</span>
                    <?php elseif ($status == 4) : ?>
                        <span class="badge badge-secondary px-3 rounded-pill p-2 bg-warning">For Return/Refund</span>
                    <?php else : ?>
                        <span class="badge badge-secondary px-3 rounded-pill p-2 bg-success">Received</span>
                    <?php endif; ?>
                <?php else : ?>
                    N/A
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="clear-fix my-2"></div>
    <div class="row">
        <div class="col-12">

            <div class="w-100" id="order-list">
                <?php
                $total = 0;
                if (isset($id)) :
                    $order_item = $conn->query(
                        "SELECT 
                        o.*,
                        p.name,
                        pv.variation_price as price,
                        pv.variation_name,
                        p.image_path,b.name as brand,
                        cl.firstname,
                        cl.lastname,
                        cl.email,
                        cc.category
                    FROM `order_items` o
                        inner join product_list p on o.product_id = p.id
                        inner join brand_list b on p.brand_id = b.id
                        inner join categories cc on p.category_id = cc.id
                        inner join order_list ol on ol.id = o.order_id
                        inner join client_list cl on cl.id = ol.client_id
                        inner join product_variations pv on pv.id = o.variation_id 
                    where o.order_id = '{$id}' order by p.name asc
                "
                    );
                    while ($row = $order_item->fetch_assoc()) :
                        $total += ($row['quantity'] * $row['price']);
                ?>
                        <div class="card mb-3">
                            <div class="d-flex flex-column">

                                <div class="d-flex align-items-center w-100 border cart-item px-3" data-id="<?= $row['id'] ?>">

                                    <div class="col-auto flex-grow-1 flex-shrink-1 px-1 py-1">

                                        <div class="d-flex align-items-center w-100 ">

                                            <div class="col-auto">

                                                <img src="<?= validate_image($row['image_path']) ?>" alt="Product Image" class="img-thumbnail prod-cart-img">

                                            </div>
                                            <div class="col-auto flex-grow-1 flex-shrink-1 ms-3">

                                                <a href="./?p=products/view_product&id=<?= $row['product_id'] ?>" class="h4 text-muted" target="_blank">
                                                
                                                    <p class="text-truncate-1 m-0"><?= $row['name'] ?></p>

                                                </a>
                                                <small><?= $row['brand'] ?></small><br>

                                                <small><?= $row['category'] ?></small><br>

                                                <div class="d-flex align-items-center w-100 mb-1">

                                                    <span><?= number_format($row['quantity']) ?></span>

                                                    <span class="ml-2">X <?= number_format($row['price'], 2) ?></span>

                                                </div>
                                            </div>
                                            <div class="col-auto text-right">
                                                <h3><b><?= number_format($row['quantity'] * $row['price'], 2) ?></b></h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <?php if (!$row['rated'] && $status == 6) : ?>
                                    <div class="accordion" id="accordionExample-<?= $row['id'] ?>">
                                        <div class="card">
                                            <div class="card-header" id="reviewContent">
                                                <h2 class="mb-0">
                                                    <button class="btn btn-link btn-block text-primary text-left" type="button" data-toggle="collapse" data-target="#reviewSection-<?= $row['id'] ?>" aria-expanded="false" aria-controls="reviewSection-<?= $row['id'] ?>">
                                                        Submit a review
                                                    </button>
                                                </h2>
                                            </div>
                                            <div id="reviewSection-<?= $row['id'] ?>" class="collapse" aria-labelledby="reviewContent" data-parent="#accordionExample-<?= $row['id'] ?>">
                                                <form id="submit-review-<?= $row['id'] ?>" action="">
                                                    <div class="card-body">
                                                        <input class="invisible w-0" value="<?= $row['product_id'] ?>" required type="hidden" name="product_id">
                                                        <input class="invisible w-0" value="<?= $row['variation_id'] ?>" required type="hidden" name="variation_id">
                                                        <input class="invisible w-0" value="<?= $row['name'] ?>" required type="hidden" name="product_name">
                                                        <input class="invisible w-0" value="<?= $row['lastname'], ', ', $row['firstname'] ?>" required type="hidden" name="author_name">
                                                        <input class="invisible w-0" value="<?= $row['email'] ?>" required type="hidden" name="author_email">
                                                        <input class="invisible w-0" value="<?= $row['id'] ?>" required type="hidden" name="order_id">
                                                        <div class="rating">
                                                            <label class="mt-1">Rate: </label>
                                                            <div class="rating-stars">
                                                                <input type="radio" name="rate_level" value="5" id="5-<?= $row['id'] ?>"><label for="5-<?= $row['id'] ?>">☆</label>
                                                                <input type="radio" name="rate_level" value="4" id="4-<?= $row['id'] ?>"><label for="4-<?= $row['id'] ?>">☆</label>
                                                                <input type="radio" name="rate_level" value="3" id="3-<?= $row['id'] ?>"><label for="3-<?= $row['id'] ?>">☆</label>
                                                                <input type="radio" name="rate_level" value="2" id="2-<?= $row['id'] ?>"><label for="2-<?= $row['id'] ?>">☆</label>
                                                                <input type="radio" name="rate_level" value="1" id="1-<?= $row['id'] ?>"><label for="1-<?= $row['id'] ?>">☆</label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleFormControlTextarea1">Comments: </label>
                                                            <textarea class="form-control" name="author_comments" id="exampleFormControlTextarea1" rows="3"></textarea>
                                                        </div>
                                                        <button class="btn btn-flat btn-primary mt-3" onclick="submitReview('submit-review', '<?= $row['id'] ?>')" type="button">Submit</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                    <?php endwhile; ?>
                <?php endif; ?>
                <?php if (isset($order_item) && $order_item->num_rows <= 0) : ?>
                    <div class="d-flex align-items-center w-100 border justify-content-center">
                        <div class="col-12 flex-grow-1 flex-shrink-1 px-1 py-1">
                            <small class="text-muted">No Data</small>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="d-flex align-items-center justify-content-end w-100 border px-3">
                    <h3> TOTAL:
                        <b class="text-primary"><?= number_format($total, 2) ?></b> PHP
                    </h3>
                </div>
            </div>
            <?php
            if (isset($_GET['id']) && $_GET['id'] > 0) :
                $order_result = $conn->query("SELECT ol.id AS id, p.id AS product_id, pv.id AS variation_id,
                        p.name,
                        cl.firstname,
                        cl.lastname,
                        cl.email
                    FROM order_list ol
                        INNER JOIN order_items oi ON oi.order_id = ol.id
                        INNER JOIN product_list p ON oi.product_id = p.id
                        inner join client_list cl on cl.id = ol.client_id
                        inner join product_variations pv on pv.id = oi.variation_id 
                        WHERE ol.id = '{$_GET['id']}'");

            ?>
                <?php if ($row = $order_result->fetch_assoc()) : ?>
                    <!-- Start Return/Refund -->
                    <?php if ($status == 3) : ?>
                        <div class="accordion" id="accordionExample-<?= $row['id'] ?>">
                            <div class="card">
                                
                                <div id="returnSection-<?= $row['id'] ?>" class="collapse" aria-labelledby="returnContent" data-parent="#accordionExample-<?= $row['id'] ?>">
                                    <form id="submit-return-<?= $row['id'] ?>" action="">
                                        <div class="card-body">
                                            <input class="invisible w-0" value="<?= $row['product_id'] ?>" required type="hidden" name="product_id">
                                            <input class="invisible w-0" value="<?= $row['variation_id'] ?>" required type="hidden" name="variation_id">
                                            <input class="invisible w-0" value="<?= $row['name'] ?>" required type="hidden" name="product_name">
                                            <input class="invisible w-0" value="<?= $row['lastname'], ', ', $row['firstname'] ?>" required type="hidden" name="author_name">
                                            <input class="invisible w-0" value="<?= $row['email'] ?>" required type="hidden" name="author_email">
                                            <input class="invisible w-0" value="<?= $row['id'] ?>" required type="hidden" name="order_id">
                                            <div class="form-group">
                                                <label for="exampleFormControlTextarea1">Reason For Return/Refund: </label>
                                                <textarea class="form-control" name="author_comments" id="exampleFormControlTextarea1" rows="3"></textarea>
                                            </div>
                                            <button class="btn btn-flat btn-primary mt-3" onclick="submitReturn('submit-return', '<?= $row['id'] ?>')" type="button">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
    <div class="clear-fix my-2"></div>
    <div class="row">
        <div class="col-12 text-right">
            <?php if (isset($status)  && $status == 0) : ?>
                <button class="btn btn-danger btn-flat btn-sm" id="btn-cancel" type="button">Cancel Order</button>
            <?php elseif (isset($status)  && $status == 3) : ?>
                <button class="btn btn-danger btn-flat btn-sm" onclick="receiveOrder(<?= $id ?>)" id="btn-received" type="button">Order Received</button>
            <?php endif; ?>
            <button class="btn btn-dark btn-flat btn-sm" type="button" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
        </div>
    </div>
</div>
<script>
    $('#btn-cancel').click(function() {
        _conf("Are you sure to cancel this order?", "cancel_order", [])
    })

    function submitReview(form, formId) {
        console.log(`${form}-${formId}`)
        var elements = document.getElementById(`${form}-${formId}`).elements;
        var obj = {};
        for (var i = 0; i < elements.length; i++) {
            var item = elements.item(i);
            if (item.name === 'rate_level') {
                if (item.checked) {
                    obj[item.name] = item.value;
                }
            } else {
                obj[item.name] = item.value;
            }
        }
        const formData = new FormData();
        for (var key in obj) {
            formData.append(key, obj[key]);
        }

        $.ajax({
            url: _base_url_ + "classes/Master.php?f=submit_review",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            method: 'POST',
            type: 'POST',
            dataType: 'json',
            error: err => {
                console.log(err)
                alert_toast("An error occured", 'error');
                end_loader();
            },
            success: function(resp) {
                console.log(resp);
                if (resp.status == 'success') {
                    $(`#reviewSection-${formId}`).removeClass('show')
                    $(`#accordionExample-${formId}`).css('display', 'none');
                    alert_toast(resp.msg, 'success')
                } else if (resp.status === 'failed') {
                    console.log(resp.error)
                    alert_toast(resp.msg, 'error')
                } else {
                    alert_toast('An error occurred.', 'error')
                }
            }
        })
    }

    function submitReturn(form, formId) {
        var elements = document.getElementById(`${form}-${formId}`).elements;
        var obj = {};
        for (var i = 0; i < elements.length; i++) {
            var item = elements.item(i);
            if (item.name) {
                obj[item.name] = item.value;
            }
        }
        const formData = new FormData();
        for (var key in obj) {
            formData.append(key, obj[key]);
        }
        // Log each key-value pair in the FormData object
        for (var pair of formData.entries()) {
            console.log(pair[0] + ', ' + pair[1]);
        }

        $.ajax({
            url: _base_url_ + "classes/Master.php?f=submit_return",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            method: 'POST',
            type: 'POST',
            dataType: 'json',
            error: err => {
                console.log(err)
                alert_toast("An error occured", 'error');
                end_loader();
            },
            success: function(resp) {
                console.log(resp);
                if (resp.status == 'success') {
                    $(`#returnSection-${formId}`).removeClass('show')
                    $(`#accordionExample-${formId}`).css('display', 'none');
                    alert_toast(resp.msg, 'success')
                } else if (resp.status === 'failed') {
                    console.log(resp.error)
                    alert_toast(resp.msg, 'error')
                } else {
                    alert_toast('An error occurred.', 'error')
                }
            }
        })
    }

    function receiveOrder(orderId) {
        console.log(orderId);
        $.ajax({
            url: _base_url_ + "classes/Master.php?f=order_received",
            method: 'POST',
            dataType: 'json',
            data: {
                order_id: orderId
            },
            error: err => {
                console.log(err);
                alert_toast("An error occurred", 'error');
                end_loader();
            },
            success: function(resp) {
                console.log(resp);
                if (resp.status == 'success') {
                    // Your success logic
                } else if (resp.status === 'failed') {
                    // Your failed logic
                } else {
                    alert_toast('An error occurred.', 'error');
                }
            }
        });
    }




    function cancel_order() {
        start_loader();
        $.ajax({
            url: _base_url_ + 'classes/Master.php?f=cancel_order',
            data: {
                id: "<?= isset($id) ? $id : '' ?>"
            },
            method: 'POST',
            dataType: 'json',
            error: err => {
                console.error(err)
                alert_toast('An error occurred.', 'error')
                end_loader()
            },
            success: function(resp) {
                if (resp.status == 'success') {
                    location.reload()
                } else if (!!resp.msg) {
                    alert_toast(resp.msg, 'error')
                } else {
                    alert_toast('An error occurred.', 'error')
                }
                end_loader();
            }
        })
    }

    $(document).ready(function() {
        // Product submission
        $('#proof_form').submit(function(e) {
            e.preventDefault();
            var _this = $(this)
            $('.err-msg').remove();
            const formData = new FormData($(this)[0]);
            start_loader();
            $.ajax({
                url: _base_url_ + "classes/Master.php?f=save_proof_payment",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                dataType: 'json',
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log("AJAX Error:");
                    console.log("Status: " + textStatus);
                    console.log("Error: " + errorThrown);
                    console.log("Response Text: " + jqXHR.responseText);
                    alert_toast("An error occurred. Check the console for details.", 'error');
                    end_loader();
                },
                success: function(resp) {
                    console.log(resp);
                    if (typeof resp == 'object' && resp.status == 'success') {
                        location.href = "./?page=products";
                    } else if (resp.status == 'failed' && !!resp.msg) {
                        var el = $('<div>')
                        el.addClass("alert alert-danger err-msg").text(resp.msg)
                        _this.prepend(el)
                        el.show('slow')
                        $("html, body").animate({
                            scrollTop: _this.closest('.card').offset().top
                        }, "fast");
                        end_loader()
                    } else {
                        alert_toast("An error occured", 'error');
                        end_loader();
                        console.log(resp)
                    }
                }
            })
        })

    })
</script>