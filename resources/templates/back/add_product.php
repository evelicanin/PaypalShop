
			 
	<!-- forma za dodavanje producta -->     		 
	<form action="" method="post" enctype="multipart/form-data">

		<h1 class="page-header">Add product
			<div class="form-group pull-right">
				<input type="submit" name="draft" class="btn btn-warning btn-lg" value="Draft">
				<input type="submit" name="publish" class="btn btn-primary btn-lg" value="Publish">
			</div>
		</h1>

		<div class="col-md-8">

			<div class="form-group">
				<label for="product-title">Product Title </label>
				<input type="text" name="product_title" class="form-control">	   
			</div>
				
			<div class="form-group">
				   <label for="product-title">Product Short Description</label>
			  <textarea name="short_desc" id="" cols="30" rows="3" class="form-control"></textarea>
			</div>
			
			<div class="form-group">
				<label for="product-title">Product Description</label>
				<textarea name="product_description" id="" cols="30" rows="10" class="form-control"></textarea>
			</div>
			
		</div><!--Main Content-->

		<!-- SIDEBAR-->
		<aside id="admin_sidebar" class="col-md-4">

			 <!-- Product Categories-->
			<div class="form-group">
				<label for="product-title">Product Category</label>
				<select name="product_category_id" id="" class="form-control">
					<option value="">Select Category</option>

					<?php show_categories_add_product_page(); ?><!-- pozivamo funkcija koja ce prikazati sve kategorijje u dropdown listi -->
				   
				</select>
			</div>
			
			<!-- Product Price -->
			<div class="form-group">
				<label for="product-price">Product Price</label>
				<input type="number" step="0.01" min="0" name="product_price" class="form-control">
			</div>
			
			<!-- Product Quantity-->
			<div class="form-group">
				<label for="product-title">Product Quantity</label>
				<input type="number" min=0 name="product_quantity" class="form-control">
			</div>

			<!-- Product Image -->
			<div class="form-group">
				<label for="product-title">Product Image</label>
				<input type="file" name="file">   

			</div>

		</aside>
		<!--SIDEBAR-->
	  
	</form>


	<?php 
	       
		 add_product();
		 
    ?><!-- pozivamo funkciju za dodavanje producta -->
