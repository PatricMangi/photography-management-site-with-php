<?php
$PAGE_ID = "email";
$PAGE_HEADER = "Sending email to users";
if(isset($_POST['sendMail'])) {
    var_dump($_POST['clients']);exit();
}
require('headerPHP.php');

/** @var PDO $pdo Database connection */
?>
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800 pb-2">Sending email to users</h1>
        <p class="mb-4">This page allows you to send bulk email to all selected users. </p>
        <form method="post" action="client_email.php" id="send-emails">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Step 1: Select users you would like to send emails to</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <?php $users_stmt = $pdo->prepare("SELECT * FROM `clients`");
                        if ($users_stmt->execute() && $users_stmt->rowCount() > 0): ?>
                            <table class="table table-bordered" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th scope="col">ID</th>
                                    <th scope="col">Firstname</th>
                                    <th scope="col">Surname</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Phone Number</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Subscribe?</th>
                                    <th scope="col">Other info</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php while ($clients = $users_stmt->fetchObject()): ?>
                                    <tr>
                                        <td><input type="checkbox" name="clients[]" value="<?= $clients->id ?>" /></td>
                                        <td><?= $clients->id?></td>
                                        <td><?= $clients->client_Firstname?></td>
                                        <td><?= $clients->client_Surname ?></td>
                                        <td><?= $clients->client_Address ?></td>
                                        <td><?= $clients->client_Phone ?></td>
                                        <td><?= $clients->client_Email ?></td>
                                        <td><?= $clients->client_Subscribe ?></td>
                                        <td><?= $clients->client_Other_information ?></td>
                                        <td><a href="mailto: <?= $clients->client_Email ?>"> <?= $clients->client_Email ?></a></td>
                                    </tr>
                                <?php endwhile; ?>
                                </tbody>
                            </table>
                        <?php else: ?>
                            <p class="mb-4">There's no user in the database. </p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Step 2: Compose the email and send</h6>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="sendmailSubject">Subject</label>
                        <input type="text" class="form-control" id="sendmailSubject" name="subject" placeholder="Latest newsletter!" required>
                    </div>
                    <div class="form-group">
                        <label for="sendmailMessage">Message body</label>
                        <textarea class="form-control" id="sendmailMessage" name="body" rows="5" placeholder="Hi, &#10;&#10;...&#10;&#10;Regards" required></textarea>
                    </div>
                    <input type="submit" class="btn btn-primary" name="sendMail" value="Send email" />
                </div>
            </div>
        </form>
    </div>
    <!-- /.container-fluid -->
<?php require('footer.php'); ?>