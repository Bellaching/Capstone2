<?php
$qryVariations = false;
if (isset($_GET['id']) && $_GET['id'] > 0) {
	$qry = $conn->query("SELECT * from `product_list` where id = '{$_GET['id']}' ");
	$qryVariations = $conn->query("SELECT * from `product_variations` where product_id = '{$_GET['id']}' and default_flag = 0 ");
	if ($qry->num_rows > 0) {
		foreach ($qry->fetch_assoc() as $k => $v) {
			$$k = stripslashes($v);
		}
	}
}
?>
<style>
	div.variation-list .variation-container input:first-child {
		margin-right: 8px;
	}

	.border-left-3 {
		border-left-width: 3px !important;
	}

	div.variation-list .variation-container button {
		min-width: 35px;
		width: 35px;
	}

	.div-disabled {
		pointer-events: none;
	}

	.bg-disabled {
		background: #EEEE;
	}
</style>
<div class="card card-outline card-info rounded-0">
	<div class="card-header">
		<h3 class="card-title"><?php echo isset($id) ? "Update " : "Create New " ?> Product</h3>
	</div>
	<div class="card-body">
		<form action="" id="product-form">
			<input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
			<div class="form-group">
				<label for="brand_id" class="control-label">Brand</label>
				<select name="brand_id" id="brand_id" class="custom-select select2">
					<option value="" <?= !isset($brand_id) ? "selected" : "" ?> disabled></option>
					<?php
					$brands = $conn->query("SELECT * FROM brand_list where delete_flag = 0 " . (isset($brand_id) ? " or id = '{$brand_id}'" : "") . " order by `name` asc ");
					while ($row = $brands->fetch_assoc()) :
					?>
						<option value="<?= $row['id'] ?>" <?= isset($brand_id) && $brand_id == $row['id'] ? "selected" : "" ?>><?= $row['name'] ?> <?= $row['delete_flag'] == 1 ? "<small>Deleted</small>" : "" ?></option>
					<?php endwhile; ?>
				</select>
			</div>

			<div class="form-group">
				<label for="category_id" class="control-label">Category</label>
				<select name="category_id" id="category_id" class="custom-select select2">
					<option value="" <?= !isset($category_id) ? "selected" : "" ?> disabled></option>
					<?php
					$categories = $conn->query("SELECT * FROM categories where delete_flag = 0 " . (isset($category_id) ? " or id = '{$category_id}'" : "") . " order by `category` asc ");
					while ($row = $categories->fetch_assoc()) :
					?>
						<option value="<?= $row['id'] ?>" <?= isset($category_id) && $category_id == $row['id'] ? "selected" : "" ?>><?= $row['category'] ?> <?= $row['delete_flag'] == 1 ? "<small>Deleted</small>" : "" ?></option>
					<?php endwhile; ?>
				</select>
			</div>

			<div class="form-group">
				<label for="name" class="control-label">Name</label>
				<input name="name" id="name" type="text" class="form-control rounded-0" value="<?php echo isset($name) ? $name : ''; ?>" required>
			</div>
			<div class="form-group">
				<label for="models" class="control-label">Compatible for: <small>(model)</small></label>
				<input name="models" id="models" type="text" class="form-control rounded-0" value="<?php echo isset($models) ? $models : ''; ?>" required>
			</div>

			<div class="form-group">
				<label for="description" class="control-label">Description</label>
				<textarea name="description" id="description" type="text" class="form-control rounded-0 summernote" required><?php echo isset($description) ? $description : ''; ?></textarea>
			</div>

			<div class="form-group">
				<label for="price" class="control-label">Price</label>
				<input name="price" id="price" type="number" class="form-control rounded-0 text-left" value="<?php echo isset($price) ? $price : 0; ?>" required>
			</div>

			<label for="weight" class="control-label">Weight</label>
			<select id="weight" name="weight" class="weight form-control rounded-0 text-left">
				<option type="text" value="select">--Select Weight--</option>

				<option type="varchar" value="500g and below" <?= (isset($weight) && $weight == '500g and below') ? 'selected' : '' ?>>500g and below</option>
				<option type="varchar" value="500g – 1kg" <?= (isset($weight) && $weight == '500g – 1kg') ? 'selected' : '' ?>>500g – 1kg</option>
				<option type="varchar" value="1kg – 3kg" <?= (isset($weight) && $weight == '1kg – 3kg') ? 'selected' : '' ?>>1kg – 3kg</option>
				<option type="varchar" value="3kg – 4kg" <?= (isset($weight) && $weight == '3kg – 4kg') ? 'selected' : '' ?>>3kg – 4kg</option>
				<option type="varchar" value="4kg – 5kg" <?= (isset($weight) && $weight == '4kg – 5kg') ? 'selected' : '' ?>>4kg – 5kg</option>
				<option type="varchar" value="5kg – 6kg" <?= (isset($weight) && $weight == '5kg – 6kg') ? 'selected' : '' ?>>5kg – 6kg</option>
			</select>
			<div class="form-group">
				<label for="status" class="control-label">Status</label>
				<select name="status" id="status" class="custom-select selevt">
					<option value="1" <?php echo isset($status) && $status == 1 ? 'selected' : '' ?>>Active</option>
					<option value="0" <?php echo isset($status) && $status == 0 ? 'selected' : '' ?>>Inactive</option>
				</select>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group product-image-container">
							<label for="" class="control-label">Product Image</label>
							<div class="custom-file">
								<input type="file" class="custom-file-input rounded-circle" id="customFile" name="img" onchange="displayImg(this,$(this))">
								<label class="custom-file-label" for="customFile">Choose file</label>
							</div>
						</div>
						<div class="variation-list form-group">
							<div class="d-flex justify-content-between align-items-center">
								<label for="price" class="control-label mb-0">Variation </label>
								<button class="btn btn-link" type="button" onclick="addVariation();"><i class="fas fa-plus"></i> Add</button>
							</div>
							<?php
							$num = 0; // to make add button visible at first index
							$index = 0; // to use as additional entity for div.id
							if ($qryVariations) :
								while ($row = $qryVariations->fetch_assoc()) :
									$delete_flag = $row['delete_flag'];
							?>
									<?php $index++; ?>
									<div id="variationIndex-<?php echo $num ?>" class="variation-container d-flex mb-1 <?php if ($row['delete_flag'] == 1) : ?> border-left border-left-3 border-danger <?php endif; ?> ">
										<input class="invisible w-0" value="<?php echo $row['id'] ?>" required type="hidden" name="variation_id[]">
										<input class="invisible w-0" id="variation-<?php echo $num ?>" value="<?php echo $row['delete_flag'] ?>" required type="hidden" name="variation_delete_flag[]">
										<input placeholder="Variation name" class="<?php if ($row['delete_flag'] == 1) : ?> div-disabled bg-disabled <?php endif; ?> variations form-control rounded-0 mr-1" value="<?php echo $row['variation_name'] ?>" required type="text" name="variation_name[]">
										<input placeholder="Stocks" class="<?php if ($row['delete_flag'] == 1) : ?> div-disabled bg-disabled <?php endif; ?> variations form-control rounded-0 w-25" value="<?php echo $row['variation_stock'] ?>" required min="0" type="number" name="variation_stock[]">
										<button class="btn btn-link text-danger ml-1 <?php if ($delete_flag == 0) : ?> visible position-relative <?php else: ?> invisible position-absolute <?php endif; ?>" type="button" id="variation-remove-<?php echo $num ?>" onclick="removeVariation('variationIndex-<?php echo $num; ?>')">
											<i class="fas fa-times"></i>
										</button>
										<button class="btn btn-link text-info ml-1 <?php if ($delete_flag == 1) : ?> visible position-relative <?php else: ?> invisible position-absolute <?php endif; ?>" type="button" id="variation-res-<?php echo $num ?>" onclick="resVariation('variationIndex-<?php echo $num; ?>')">
											<i class="fas fa-check"></i>
										</button>
									</div>
									<?php $num++; ?>
							<?php endwhile;
							endif; ?>
						</div>
					</div>
					<div class="col-md-6">
						<div class="d-flex justify-content-center">
							<img src="<?php echo validate_image(isset($image_path) ? $image_path : "") ?>" alt="" id="cimg" class="img-fluid img-thumbnail">
						</div>
					</div>
				</div>
			</div>


		</form>
	</div>
	<div class="card-footer">
		<button class="btn btn-flat btn-primary" form="product-form">Save</button>
		<a class="btn btn-flat btn-default" href="?page=products">Cancel</a>
	</div>
</div>
<script>
	window.displayImg = function(input, _this) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
				$('#cimg').attr('src', e.target.result);
				_this.siblings('.custom-file-label').html(input.files[0].name)
			}

			reader.readAsDataURL(input.files[0]);
		} else {
			$('#cimg').attr('src', "<?php echo validate_image(isset($image_path) ? $image_path : "") ?>");
			_this.siblings('.custom-file-label').html("Choose file")
		}
	}

	$(document).ready(function() {
		$('.select2').select2({
			width: '100%',
			placeholder: "Please Select Here"
		})

		// Product submission
		$('#product-form').submit(function(e) {
			e.preventDefault();
			var _this = $(this)
			$('.err-msg').remove();
			const formData = new FormData($(this)[0]);
			start_loader();
			$.ajax({
				url: _base_url_ + "classes/Master.php?f=save_product",
				data: new FormData($(this)[0]),
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
					if (typeof resp == 'object' && resp.status == 'success') {
						location.href = "./?page=products/view_product&id=" + resp.id;
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

		$('.summernote').summernote({
			height: 200,
			toolbar: [
				['style', ['style']],
				['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
				['fontname', ['fontname']],
				['fontsize', ['fontsize']],
				['color', ['color']],
				['para', ['ol', 'ul', 'paragraph', 'height']],
				['table', ['table']],
				['view', ['undo', 'redo', 'fullscreen', 'codeview', 'help']]
			]
		})
	})

	var resVariation = function(id) {
		console.log("Res", id);
		const variationIndex = document.getElementById(id);
		const variationFlag = document.getElementById(`variation-${id.slice(15)}`);
		const variationResBtn = document.getElementById(`variation-res-${id.slice(15)}`);
		const variationRemBtn = document.getElementById(`variation-remove-${id.slice(15)}`);
		variationResBtn.classList.replace('visible', 'invisible');
		variationResBtn.classList.replace('position-relative', 'position-absolute');
		variationRemBtn.classList.replace('invisible', 'visible');
		variationRemBtn.classList.replace('position-absolute', 'position-relative');
		variationFlag.value = 0;
		const nodes = variationIndex.getElementsByTagName('input');
		for (var i = 0; i < nodes.length; i++) {
			nodes[i].style.pointerEvents = 'unset';
			nodes[i].style.background = 'unset';
		}
		variationIndex.classList.remove('border-left');
		variationIndex.classList.remove('border-left-3');
		variationIndex.classList.remove('border-danger');
	}
	var removeVariation = function(id) {
		console.log("Remove", id);
		const variationIndex = document.getElementById(id);
		const variationFlag = document.getElementById(`variation-${id.slice(15)}`);
		const variationResBtn = document.getElementById(`variation-res-${id.slice(15)}`);
		const variationRemBtn = document.getElementById(`variation-remove-${id.slice(15)}`);
		variationRemBtn.classList.replace('visible', 'invisible');
		variationRemBtn.classList.replace('position-relative', 'position-absolute');
		variationResBtn.classList.replace('invisible', 'visible');
		variationResBtn.classList.replace('position-absolute', 'position-relative');
		variationFlag.value = 1;
		const nodes = variationIndex.getElementsByTagName('input');
		for (var i = 0; i < nodes.length; i++) {
			nodes[i].style.pointerEvents = 'none';
			nodes[i].style.background = '#EEEE';
		}
		variationIndex.classList.add('border-left');
		variationIndex.classList.add('border-left-3');
		variationIndex.classList.add('border-danger');
	}
	var addVariation = function() {
		const lastVariationIndex = document.querySelectorAll(".variation-container:last-child");
		const lastIndex = lastVariationIndex && lastVariationIndex.length > 0 ? lastVariationIndex[0].id.slice(15) : 0;
		console.log(lastIndex)
		var parent = document.body;
		// Get variation main container
		var fieldgroup = document.querySelector("div.variation-list");
		// Create variation container
		var variationContainer = document.createElement("div");
		variationContainer.id = `variationIndex-${parseInt(lastIndex)+1}`;
		variationContainer.className = "variation-container d-flex mb-1";
		// add variation id placeholder input
		var variationId = document.createElement("input");
		variationId.className = "invisible";
		variationId.type = "hidden";
		variationId.required = true;
		variationId.name = `variation_id[]`;
		variationContainer.appendChild(variationId);
		// add variation delete flag placeholder input
		var variationDeleteFlag = document.createElement("input");
		variationDeleteFlag.className = "invisible";
		variationDeleteFlag.type = "hidden";
		variationDeleteFlag.required = true;
		variationDeleteFlag.id = `variation-${parseInt(lastIndex)+1}`;
		variationDeleteFlag.name = `variation_delete_flag[]`;
		variationContainer.appendChild(variationDeleteFlag);
		variationDeleteFlag.value = 0; // set value
		// Add variation name input
		var variationName = document.createElement("input");
		variationName.className = "variations form-control rounded-0";
		variationName.style = "display: block;";
		variationName.type = "text";
		variationName.required = true;
		variationName.name = `variation_name[]`;
		variationName.placeholder = "Variation name";
		variationContainer.appendChild(variationName);
		// Add variation stock input
		var variationStock = document.createElement("input");
		variationStock.className = "stocks form-control rounded-0 w-25";
		variationStock.style = "display: block;";
		variationStock.type = "number";
		variationStock.min = 0;
		variationStock.required = true;
		variationStock.name = `variation_stock[]`;
		variationStock.placeholder = "Stocks";
		variationStock.value = "0";
		variationContainer.appendChild(variationStock);
		// Add variation remove button
		var variationRemoveBtn = document.createElement("button");
		variationRemoveBtn.className = "btn btn-link text-danger"
		variationRemoveBtn.type = "button";
		variationRemoveBtn.onclick = function() {
			removeVariation(variationContainer.id)
		};
		var variationRemoveBtnIcon = document.createElement("i");
		variationRemoveBtnIcon.className = "fas fa-times";
		variationRemoveBtn.appendChild(variationRemoveBtnIcon);
		variationContainer.appendChild(variationRemoveBtn);
		fieldgroup.appendChild(variationContainer);
	}
</script>