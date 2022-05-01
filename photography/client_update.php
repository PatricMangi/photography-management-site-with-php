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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id = $_POST['id'];
    $firstname = $_POST['firstname'];
    $surname = $_POST['surname'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];
    $company = $_POST['company'];

    if (!$firstname) {
        $errors[] = 'firstname is required';
    }

    if (!$surname) {
        $errors[] = 'surname is required';
    }

    if (empty($errors)) {
        $stmt = $pdo->prepare("UPDATE clients SET client_Firstname = :client_Firstname,
                                        client_Surname = :client_Surname,
                                        client_Address = :client_Address,
                  client_Phone = :client_Phone , client_Other_information=:client_Other_information WHERE id = :id");
        $stmt->bindValue(':client_Firstname', $firstname);
        $stmt->bindValue(':client_Surname', $surname);
        $stmt->bindValue(':client_Address', $address);
        $stmt->bindValue(':client_Phone', $contact);
        $stmt->bindValue(':client_Other_information', $company);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        header('Location: client.php');
    }

} else {
    $stmt = $pdo->prepare("SELECT * FROM clients WHERE id=?");
    $stmt->execute([$id]);
    $client = $stmt->fetchObject();
}
?>
<div class="container-fluid">
<p>
    <a href="client.php" class="btn btn-default">Back to products</a>
</p>
<h1>Edit Client: <b><?php echo $client->client_Firstname ?></b></h1>

<?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        <?php foreach ($errors as $error): ?>
            <div><?php echo $error ?></div>
        <?php endforeach;?>
    </div>
<?php endif;?>

    <form method="post">
        <div class="form-group">
            <label>Firstname</label>
            <input type="text" name="firstname" class="form-control" value="<?php echo $client->client_Firstname ?>">
        </div>
        <div class="form-group">
            <label>Surname</label>
            <textarea class="form-control" name="surname"><?php echo $client->client_Surname ?></textarea>
        </div>
        <div class="form-group">
            <label>Contact</label>
            <input type="text"  name="contact" class="form-control" value="<?php echo $client->client_Phone?>">
        </div>

        <div class="form-group">
            <label>Address</label>
            <input type="text"  name="address" class="form-control" value="<?php echo $client->client_Address ?>">
        </div>
        <div class="form-group">
            <label>Company</label>
            <input type="text"  name="company" class="form-control" value="<?php echo $client->client_Other_information ?>">
        </div>
        <input type="hidden" name="id" value="<?= $client->id ?>" />
        <input type="submit" class="btn btn-primary" value="Update" />
    </form>
</div>
<?php require 'footer.php';?>