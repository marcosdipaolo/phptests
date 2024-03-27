<?php use App\Entities\Profile; ?>
<?php render('header'); ?>
<?php /** @var Profile $profile */ ?>
<main class="container content profile">
    <h1 class="mt-4">Profile <?= $profile?->getUser()?->getId() ?></h1>
    <form action="/profile" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-12 col-md-6">
                <label for="address">Address:</label>
                <input type="text" class="form-control" id="address" name="address" value="<?= $profile?->getAddress() ?? "" ?>">
            </div>
            <div class="col-12 col-md-6">
                <label for="image">Image:</label>
                <input class="form-control" type="file" name="image" id="image" value="<?= $profile?->getImagePath() ?? "" ?>">
            </div>
        </div>
        <div class="img mt-4" style="background-image: url('<?= storage($profile?->getImagePath() ?? "") ?>'"></div>
        <div class="row">
            <button class="btn btn-info mt-4 ml-auto">Send</button>
        </div>
    </form>
</main>
<?php render('footer'); ?>
