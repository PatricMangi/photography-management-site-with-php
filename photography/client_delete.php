<?php
include "connection/connection.php";

function function_alert($message)
{

    // Display the alert box
    echo "<script>alert('$message');</script>";

    // header("Location:client.php");
    // exit;
}

$id = $_GET['id'];
if ($id) {
    $pdo->prepare("DELETE FROM clients WHERE id=?")->execute([$id]);
    //echo $stmt->rowCount() . ' row(s) was deleted successfully.';
    header('Location: client.php');
    exit();
}

?>

<!-- success message-->
