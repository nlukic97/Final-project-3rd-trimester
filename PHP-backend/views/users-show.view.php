<?php require_once "views/partials/header.php"; ?>

<div class="container viewArea">
    <div class="row">
        <div class="col text-center">
            <h1>User: <?= $user->name ?></h1>
            <h4>Email: <?= $user->email ?></h4>
        </div>
    </div>

</div>


<?php require_once "views/partials/footer.php"; ?>
