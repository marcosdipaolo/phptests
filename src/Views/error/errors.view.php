<?php render('header'); ?>
<main class="d-flex errors">
    <div class="content text-center">
        <h1><?= $code ?? '' ?></h1>
        <p>...<?= strtolower($message ?? '') ?>.</p>
    </div>
</main>
<?php render('footer'); ?>