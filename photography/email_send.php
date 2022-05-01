<?php
$PAGE_ID = "email";
$PAGE_HEADER = "Sending email to users";

require('headerPHP.php');

/** @var PDO $dbh Database connection */

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST['subject'])) {
        $sendmail_error = true;
        $sendmail_error_message = 'Subject cannot be empty';
    }
    if (empty($_POST['body'])) {
        $sendmail_error = true;
        $sendmail_error_message = 'Message body cannot be empty';
    }
    if (empty($_POST['user_ids'])) {
        $sendmail_error = true;
        $sendmail_error_message = 'You must select at least one user as recipient';
    }

    // Getting emails of selected users
    $query_placeholders = trim(str_repeat("?,", count($_POST['user_ids'])), ",");
    $query = "SELECT * FROM `users` WHERE `id` in (" . $query_placeholders . ")";
    $stmt = $dbh->prepare($query);
    if ($stmt->execute($_POST['user_ids'])) {
        if ($stmt->rowCount() != count($_POST['user_ids'])) {
            $sendmail_error = true;
            $sendmail_error_message = 'One of the selected user does not exist';
        } else {
            $email_recipients = [];
            while ($row = $stmt->fetchObject()) $email_recipients[] = $row->client_Firstname . " <" . $row->client_Email . ">";
            $email_recipients = implode(",", $email_recipients);
            $email_subject = $_POST['subject'];
            // Process email body when necessary (i.e. on Windows server)
            $email_body = $_POST['body'];
            if (stristr(PHP_OS, 'WIN')) $email_body = str_replace("\n.", "\n..", $_POST['body']);
            // Finally, send the email!
            if (!@mail($email_recipients, $email_subject, $email_body)) {
                $sendmail_error = true;
                $sendmail_error_message = error_get_last()['message'];
            }
        }
    } else {
        $sendmail_error = true;
        $sendmail_error_message = $stmt->errorInfo()[2];
    }

} else {
    $sendmail_invalid = true;
}

?>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800 pb-2">Sending email to users</h1>
        <p class="mb-4">This page allows you to send bulk email to all selected users. </p>

        <?php if (isset($sendmail_invalid) && $sendmail_invalid): ?>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-warning">Invalid request! </h6>
                </div>
                <div class="card-body">
                    <p>It seems the request to send emails is invalid. </p>
                    <p>Please fix any issues or contact the administrator for help. </p>
                    <p>Click the button below to go back to the previous page. </p>
                    <a href="client_email.php" class="btn btn-warning btn-icon-split">
                        <span class="icon text-white-50"><i class="fas fa-arrow-alt-circle-left"></i></span>
                        <span class="text">Back to send email page</span>
                    </a>
                </div>
            </div>

        <?php elseif (isset($sendmail_error) && $sendmail_error): ?>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-danger">Emails did not sent correctly! </h6>
                </div>
                <div class="card-body">
                    <p>There was an error during the sending process. Here's the error message: </p>
                    <div class="mb-2">
                        <code><?= (isset($sendmail_error_message) && !empty($sendmail_error_message)) ? $sendmail_error_message : "Unknown error. Please contact the administrator. " ?></code>
                    </div>
                    <p>Please fix any issues or contact the administrator for help. </p>
                    <p>Click the button below to go back to the previous page. </p>
                    <a href="email_send.php" class="btn btn-danger btn-icon-split">
                        <span class="icon text-white-50"><i class="fas fa-arrow-alt-circle-left"></i></span>
                        <span class="text">Back to send email page</span>
                    </a>
                </div>
            </div>

        <?php else: ?>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Emails sent successfully! </h6>
                </div>
                <div class="card-body">
                    <p>Your message has been sent successfully. Click the button below to go back to the previous page. </p>
                    <a href="email_send.php" class="btn btn-primary btn-icon-split">
                        <span class="icon text-white-50"><i class="fas fa-arrow-alt-circle-left"></i></span>
                        <span class="text">Back to send email page</span>
                    </a>
                </div>
            </div>

        <?php endif; ?>
    </div>
    <!-- /.container-fluid -->

<?php require('footer.php'); ?>