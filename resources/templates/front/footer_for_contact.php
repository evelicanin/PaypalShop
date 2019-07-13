    <div class="container">

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Your Website 2014</p>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
	<!-- validation -->
	<script src="js/jquery.validate.min.js"></script>
	
	<script>
	$.validator.setDefaults({
        submitHandler: function(form) 
		            {  
                           if ($(form).valid()) 
                               form.submit(); 
                           return false; // prevent normal form posting
                    }
	});

	$().ready(function() {

		// validacija forme as custom porukama
		$("#contactForm").validate({
			//debug: true;
			rules: {
				name: "required",	
				email: {
					required: true,
					email: true
				},				
				phone: {
					required: true
				},	
				subject: "required",					
				message: "required",					
			},
			messages: {
				name: "Name is required",	
				email: "Please enter a valid e-mail adress",				
				phone: {
					required: "Please enter a phone number"
				},
				subject: "Subject is required",				
				message: "Message is required",
			}
		});
	});
	</script>
</body>

</html>