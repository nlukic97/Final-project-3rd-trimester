<?php require_once "views/partials/header.php"; ?>

<div class="container viewArea">
    <div class="row pt-4 pb-5">
            <div class="col-12"> <!-- how to align to center when it becomes mobile ?? -->
                <div class="card m-auto cardContainer"> <!-- for each here -->
                    <div class="itemImg">
                        <img src="../public/item-images/<?= $item->img?>" alt="">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><?= $item->title ?> </h5>
                        <p>Price: <?= number_format($item->price,2) ?>&#163;</p>
                        <p class="card-text">Extras: <?= $item->extras ?></p>
                        <a href="/items/edit?id=<?= $item->id?>" class="btn btn-warning">Edit</a>
                        <a href="/items/destroy?id=<?= $item->id?>" class="btn btn-danger">Delete</a>
                    </div>
                </div>
            </div>
    </div>
</div>

<?php require_once "views/partials/footer.php"; ?>
