
<?php require_once("../resources/config.php"); ?>      <!-- konekcija na bazu i funkcije -->
<?php include(TEMPLATE_FRONT . DS . "header.php"); ?>  <!-- poziv header.php fajla iz TEMPLATE_FRONT -->

<?php  process_transaction(); ?>  <!-- Insert u ORDERS i u REPORTS nakon obrade transakcije -->

    <!-- Page Content -->
    <div class="container">

        <h1 class="text-center">THANK YOU</h1>

    </div>
    <!-- /.container -->

<?php include(TEMPLATE_FRONT . DS . "footer.php") ?>