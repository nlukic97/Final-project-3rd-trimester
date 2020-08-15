<?php require_once "views/partials/header.php"; ?>

<form action="/users/edit" method="post">
    <input type="hidden" name="id" value="<?= $user->id ?>">

    <div class="form-group">
        <label for="name">User name</label>
        <input type="text" id="name" name="name" class="form-control" value="<?= $user->name ?>">
    </div>

    <div class="form-group">
        <label for="email">User email</label>
        <input type="text" id="email" name="email" class="form-control" value="<?= $user->email ?>">
    </div>

    <div class="form-group">
        <label for="password">Enter user password:</label>
        <input type="password" id="password" name="password" class="form-control" value="">
    </div>

    <button type="submit" class="btn btn-primary">Edit</button>
</form>

<?php require_once "views/partials/header.php"; ?>
