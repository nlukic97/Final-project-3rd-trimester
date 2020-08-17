<?php require_once "views/partials/header.php"; ?>
<div class="container viewArea">
    <div class="row">
        <div class="cols m-auto">
            <form action="/users/editPassword" method="post">
                <input type="hidden" name="id" value="<?= $user->id ?>">

                <p><strong>User: </strong></p>
                <p> <?= $user->name ?></p>
                <p><strong>Email: </strong></p>
                <p><?= $user->email ?></p>

                <div class="form-group">
                    <label for="currentPassword">Current password:</label>
                    <input type="password" id="currentPassword" name="currentPassword" class="form-control" value="">
                </div>

                <div class="form-group">
                    <label for="password">New password:</label>
                    <input type="password" id="password" name="password" class="form-control" value="">
                </div>

                <button type="submit" class="btn btn-primary">Edit</button>
            </form>
        </div>
    </div>
</div>

<?php require_once "views/partials/header.php"; ?>
