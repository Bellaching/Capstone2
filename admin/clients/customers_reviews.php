<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<div class="card card-outline card-primary">
	<div class="card-header">
		<h3 class="card-title">Customers Review</h3>
		
	</div>
	<div class="card-body">
		<div class="container-fluid">
        <div class="container-fluid">
			<table class="table table-bordered table-stripped">
				<colgroup>
					<col width="5%">
					<col width="25%">
					<col width="20%">
					<col width="30%">
					<col width="15%">
                    <col width="15%">
					<col width="10%">
                    <col width="10%">
				</colgroup>
				<thead>
					<tr>
						<th>#</th>
						<th>Date Created</th>
						<th>Product Name</th>
						<th>Name</th>
                       
						<th>Email</th>
                        <th>Status</th>
                        <th>Action</th>
					</tr>
				</thead>
				<tbody>
    <?php 
    $i = 1;
    $qry = $conn->query("SELECT * from `product_reviews` where delete_flag = 0 order by date_created asc ");
    while($row = $qry->fetch_assoc()):
    ?>
        <tr>
            <td class="text-center"><?php echo $i++; ?></td>
            <td><?php echo isset($row['date_created']) ? date("M d, Y g:ia", strtotime($row['date_created'])) : "N/A"; ?></td>
            <td><?php echo $row['product_name'] ?></td>
            <td><?php echo $row['author_name'] ?></td>
            <td><?php echo $row['author_email'] ?></td>
            <td class="text-center">
                <?php $status = $row['status']; ?>
                <?php if ($status == 0) : ?>
                    <span class="badge badge-secondary px-3 rounded-pill">Pending</span>
                <?php elseif ($status == 1) : ?>
                    <span class="badge badge-danger px-3 rounded-pill">Rejected</span>
                <?php else : ?>
                    <span class="badge badge-success px-3 rounded-pill">Accepted</span>
                <?php endif; ?>
            </td>
            <td align="center">
                <a class="dropdown-item btn-flat btn-sm btn-default border confirm_modal" href="?page=clients/manage_review&id=<?php echo $row['id'] ?>"><i class="fa fa-eye"></i>View</a>
            </td>
        </tr>
    <?php endwhile; ?>
</tbody>

			</table>
		</div>
		</div>
	</div>
</div>

