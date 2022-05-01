<?php
require 'headerPHP.php';
$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: client.php');
    exit;
}

$id = $_GET['id'];

if (!$id) {
    header('Location: client.php');
    exit();
}

$stmt = $pdo->prepare("SELECT * FROM clients WHERE id=?");
$stmt->execute([$id]);
$client = $stmt->fetchObject();

?>
<div class="container-fluid">
<p>
    <a href="client.php" class="btn btn-default">Back to Clients</a>
</p>
<h1>View Client: <b><?php echo $client->client_Firstname ?></b></h1>

    <div class="form-group">
        <label>Firstname</label>
        <label><?php echo $client->client_Firstname ?></label>
    </div>
    <div class="form-group">
        <label>Surname</label>
        <label><?php echo $client->client_Surname ?></label>
    </div>
    <div class="form-group">
        <label>Contact</label>
        <label><?php echo $client->client_Phone?></label>
    </div>

    <div class="form-group">
        <label>Address</label>
        <label><?php echo $client->client_Address ?></label>
    </div>
    <div class="form-group">
        <label>Company</label>
        <label><?php echo $client->client_Other_information ?></label>
    </div>
</div>
<?php require 'footer.php';?>