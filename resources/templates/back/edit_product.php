

	<?php 
	
		if(isset($_GET['id'])) 
		{
			// dohvatimo product za proslijedjeni id koji se pokupi na stranici prodzcts.php
			$query = query("SELECT * FROM products WHERE product_id = " . escape_string($_GET['id']) . " ");
			confirm($query);

			// setujemo varijable podacima iz baze koji odgovaraju productu s id-em kojeg smo dobili od products.php
			// ove varijable cemo postaviti u formu za editovanje producta, tako da cim dodjemo na edit_product.php, forma bude popunjea
			// sa podacima onog producta kod kojeg je korisnik kliknuo na EDIT ikonicu i time proslijedio ID
			while($row = fetch_array($query))
			{

				$product_title          = escape_string($row['product_title']);
				$product_category_id    = escape_string($row['product_category_id']);
				$product_price          = escape_string($row['product_price']);
				$product_description    = escape_string($row['product_description']);
				$short_desc             = escape_string($row['short_desc']);
				$product_quantity       = escape_string($row['product_quantity']);
				$product_image          = escape_string($row['product_image']);
				
			 // $product_image = display_image($row['product_image']);
			 
			}
		}
		
	 ?>

	<!-- forma za editovanje producta -->     
	<form action="" method="post" enctype="multipart/form-data">

		<h1 class="page-header">Edit Product
			 <div class="form-group pull-right">
			   <input type="submit" name="draft" class="btn btn-warning btn-lg" value="Draft">
				<input type="submit" name="update" class="btn btn-primary btn-lg" value="Update">
			</div>
		</h1>
		
		<div class="col-md-8">

			<div class="form-group">
				<label for="product-title">Product Title </label>
				<input type="text" name="product_title" class="form-control" value="<?php echo $product_title; ?>">
			</div>

			<div class="form-group">
				<label for="product-title">Product Short Description</label>
				<textarea name="short_desc" id="" cols="30" rows="3" class="form-control"><?php echo $short_desc; ?></textarea>
			</div>
			
			<div class="form-group">
				<label for="product-title">Product Description</label>
				<textarea name="product_description" id="" cols="30" rows="10" class="form-control"><?php echo $product_description; ?></textarea>
			</div>

		</div><!--Main Content-->


		<!-- SIDEBAR-->
		<aside id="admin_sidebar" class="col-md-4">
		
			<!-- Product Categories-->
			<div class="form-group">
				 <label for="product-title">Product Category</label>

				<select name="product_category_id" id="" class="form-control">
					  

					<option value="<?php echo $product_category_id; ?>"><?php echo show_product_category_title($product_category_id); ?></option>

					<?php show_categories_add_product_page(); ?>
				   
				</select>

			</div>
			
			<!-- Product Price-->
			<div class="form-group ">
				<label for="product-price">Product Price</label>
				<input type="number" step="0.01" min="0" name="product_price" class="form-control" size="60" value="<?php echo $product_price; ?>">
			 </div>

			<!-- Product Quantity-->
			<div class="form-group">
			  <label for="product-title">Product Quantity</label>
				<input type="number" name="product_quantity" class="form-control" value="<?php echo $product_quantity; ?>">
			</div>

			<!-- Product Image -->
			<div class="form-group">
				<label for="product-title">Product Image</label>
				<input type="file" name="file"> <br>

				<img width='200' src="../../resources/uploads/<?php echo $product_image; ?>" alt="">
			  
			</div>

		</aside><!--SIDEBAR-->

	</form>

	<?php 

		update_product(); // updatujemo product pomocu funkcije update_product()

	 ?>
