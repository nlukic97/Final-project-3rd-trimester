<?php require_once "views/partials/header.php"; ?>
<div class="container">
    <div class="mb-3 text-center mt-4 mb-4">
        <a href="/users/create" class="btn btn-info">Add new user</a>
    </div>
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Options</th>
        </tr>
        </thead>
        <?php foreach ($users as $user): ?>
            <tr>
                <td class="border-bottom border-secondary"><?= $user->id ?></td>
                <td class="border-bottom border-secondary"><?= $user->name ?></td>
                <td class="border-bottom border-secondary"><?= $user->email ?></td>
                <td class="border-bottom border-secondary">
                    <a href="/users/show?id=<?= $user->id ?>" class="btn btn-info">Show</a>
                    <a href="/users/edit?id=<?= $user->id ?>" class="btn btn-warning">Edit</a>
                    <a href="/users/destroy?id=<?= $user->id ?>" class="btn btn-danger">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>


<?php require_once "views/partials/footer.php"; ?>
