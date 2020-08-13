<?php require_once "views/partials/header.php"; ?>

<div class="container">
    <div class="row">
            <div class="col-12"> <!-- how to align to center when it becomes mobile ?? -->
                <div class="card m-auto" style="width: 23rem"> <!-- for each here -->
                    <div style="height:192px; overflow: hidden; display: flex; align-items: center;">
                        <img src="../public/item-images/<?= $item->img?>" alt="" style="width: 18rem">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><?= $item->size ?> <?= $item->title ?> </h5>
                        <p>Price: <?= $item->price ?>&#163;</p>
                        <p class="card-text">Extras: <?= $item->extras ?></p>
                        <a href="/items/edit?id=<?= $item->id?>" class="btn btn-warning">Edit</a>
                        <a href="/items/destroy?id=<?= $item->id?>" class="btn btn-danger">Delete</a>
                    </div>
                </div>
            </div>
    </div>
</div>

<?php require_once "views/partials/footer.php"; ?>
