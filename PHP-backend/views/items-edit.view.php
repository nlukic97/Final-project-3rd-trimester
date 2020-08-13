<?php require_once "views/partials/header.php"; ?>

<div class="container">
    <form action="/items/edit" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $item->id ?>">

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" id="title" name="title" class="form-control" value="<?= $item->title ?>">
        </div>
        <div class="d-flex flex-lg-row flex-sm-column flex-column justify-content-around align-items-center text-center">
            <div class=" mb-4">
                <h3>Keep current Image</h3>
                <img src="../public/item-images/<?= $item->img ?>" alt="" width="300px; margin:0 auto;">
                <input type="text" value="<?= $item->img ?>" name="oldImageName" hidden>
            </div>
            <h3 class=" mb-4">or</h3>
            <div class="form-group text-center mb-4">
                <h3>Upload new image</h3>
                <label for="img" style="font-size: 40px"><i class="fas fa-upload"></i></label>
                <div>
                    <input type="file" name="img" id="img">
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="price">Price</label>
            <input type="text" id="price" name="price" class="form-control" value="<?= $item->price ?>">
        </div>

        <div class="form-group">
            <label for="extras">Extras</label>
            <input type="text" id="extras" name="extras" class="form-control" value="<?= $item->extras ?>">
        </div>

        <button type="submit" class="btn btn-primary">Edit</button>
    </form>
</div>

<?php require_once "views/partials/footer.php"; ?>
