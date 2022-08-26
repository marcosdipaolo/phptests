<?php render('header'); ?>
<main class="d-flex content">
    <div class="error text-center">
        <h1><?= $code ?? '' ?></h1>
        <p><?= $message ?? '' ?>.</p>
    </div>
</main>
<?php render('footer'); ?>