<?php require_once "views/partials/header.php"; ?>
<form action="/users/editPassword" method="post">
    <input type="hidden" name="id" value="<?= $user->id ?>">

    <p><strong>User: </strong> <?= $user->name ?></p>
    <p><strong>Email: </strong> <?= $user->email ?></p>

    <div class="form-group">
        <label for="currentPassword">Current password:</label>
        <input type="text" id="currentPassword" name="currentPassword" class="form-control" value="">
    </div>

    <div class="form-group">
        <label for="password">New password:</label>
        <input type="password" id="password" name="password" class="form-control" value="">
    </div>

    <button type="submit" class="btn btn-primary">Edit</button>
</form>

<?php require_once "views/partials/header.php"; ?>
