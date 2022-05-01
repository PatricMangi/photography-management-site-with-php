
<?php
$PAGE_ID = "photo";
$PAGE_HEADER = "Photos";

require('headerPHP.php');

/** @var PDO $dbh Database connection */
?>



<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800 pb-2">
        <span>Products</span>
        <a href="#" class="btn btn-danger btn-icon-split float-right" id="delete-selected-products">
                    <span class="icon text-white-50">
                      <i class="fas fa-trash"></i>
                    </span>
        </a>
    </h1>

    <p class="mb-4">You can manage all Photoshoots events within the system here.</p>
    <div class="table-responsive">

        <?php $photo_stmt = $pdo->prepare("SELECT * FROM `photo_shoot`");
        if ($photo_stmt->execute() && $photo_stmt->rowCount() > 0): ?>
            <form method="post" action="client_delete.php" id="delete-products">
                <table class="table table-bordered" width="100%" cellspacing="0">

                    <div>
                        <p class="yes" >
                            <a href="client_insert.php" type="button" class="btn btn-success" name="insert">CREATE NEW PHOTOSHOOT EVENT </a>
                        </p>
                    </div>

                    <div style="text-align: left">
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" ><i
                                    class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                    </div>

                    <thead>
                    <tr>

                        <th scope="col" >ID</th>
                        <th scope="col">Client ID</th>
                        <th scope="col" >Photoshoot-Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Quote</th>
                        <th scope="col">Date</th>
                        <th scope="col">Other info</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php while ($photos = $photo_stmt->fetchObject()): ?>
                        <tr>


                            <td><?= $photos->id?></td>
                            <td><?= $photos->client_id?></td>
                            <td><?= $photos->photo_shoot_name ?></td>
                            <td><?= $photos->photo_shoot_desc ?></td>
                            <td><?= $photos->photo_shoot_quote ?></td>
                            <td><?= $photos->photo_shoot_dateTime ?></td>
                            <td><?= $photos->photo_shoot_other_information ?></td>
                            <td class="table-cell-center">
                                <button type="submit" class="btn btn-danger btn-circle btn-sm button-delete-product"  value="<?= $photos->id ?>" >DELETE</i></button>
                                <button type="submit" class="btn btn-success btn-circle btn-sm button-delete-product"  value="<?= $photos->id ?>" >EDIT</i></button>
                                <button type="submit" class="btn btn-info btn-circle btn-sm button-delete-product"  value="<?= $photos->id ?>" >VIEW</i></button>
                            </td>

                        </tr>

                    <?php endwhile; ?>
                    </tbody>
                </table>
            </form>
        <?php else: ?>
            <p class="mb-4">There's no product in the database. </p>
        <?php endif; ?>
    </div>

</div>
<!-- /.container-fluid -->
<?php require('footer.php'); ?>