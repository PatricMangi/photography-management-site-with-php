<?php
$PAGE_ID = "client_insert";
$PAGE_HEADER = "Clients_insert";

require 'headerPHP.php';

/** @var PDO $dbh Database connection */
?>


<?php

if (empty($_POST["client_Firstname"]) || empty($_POST["client_Surname"] || empty($_POST["client_Email"] || empty($_POST["client_Phone"] || empty($_POST["client_Subscribe"]))))):
    $errors = [];
    ?>

	<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $first_name = $_POST['client_Firstname'];
    }
    ?>

	<div class="container-fluid px-4">
	    <h1>Create New Client </h1>

	    <form action="client_insert.php" method="post">
	        <div class="mb-3">
	            <label> ID </label>
	            <input type="number" class="form-control" name="id" >
	        </div>
	        <div class="mb-3">
	            <label>Name</label>
	            <input type="text" step=".01" class="form-control" name="client_Firstname" >
	        </div>

	        <div class="mb-3">
	            <label>Surname</label>
	            <input type="text"  class="form-control" name="client_Surname" >
	        </div>

	        <div class="mb-3">
	            <label>Address</label>
	            <input type="text"  class="form-control" name="client_Address" >
	        </div>

	        <div class="mb-3">
	            <label>Phone</label>
	            <input type="number" step=".01" class="form-control" name="client_Phone" >
	        </div>
	        <div class="mb-3">
	            <label>Subscribe</label>
	            <input type="number" class="form-control" name="client_Subscribe" >
	        </div>
	        <div class="mb-3">
	            <label>Email</label>
	            <input type="email"  class="form-control" name="client_Email" >
	        </div>
	        <div class="mb-3">
	            <label>Other Information</label>
	            <input type="text"  class="form-control" name="client_Other_information" >
	        </div>

	        <button type="submit" class="btn btn-primary" name="insert">Submit</button>
	    </form>


	    <?php else:
            if (isset($_POST['insert'])) {

                $_SESSION['message'] = "Record has been saved";
                $_SESSION['msg_type'] = "success";

                echo "connection success!";
                $query = "INSERT INTO `clients` (`id`,`client_Firstname`,`client_Surname`,`client_Address`,`client_Phone`,`client_Email`,`client_Subscribe`,`client_Other_information`) VALUES ('$_POST[id]','$_POST[client_Firstname]','$_POST[client_Surname]','$_POST[client_Address]','$_POST[client_Phone]','$_POST[client_Email]','$_POST[client_Subscribe]','$_POST[client_Other_information]')";

                $stmt = $pdo->prepare($query);
                $stmt->execute();
                $result = $stmt->fetch(\PDO::FETCH_ASSOC);
            }

            ?>
	        <!-- success message-->
	        <div class="alert alert-success">
	            <strong>Success!</strong> A new client has been added
	        </div>
	    <?php endif;?>
    <?php require 'footer.php';?>