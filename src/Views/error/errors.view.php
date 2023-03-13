<?php require __DIR__ . '/../header.view.php'; ?>
<main class="d-flex content">
    <div class="error text-center">
        <h1><?= $code ?? '' ?></h1>
        <h3><?= $message ?? '' ?>.</h3>
        <?php
            array_map(function($item){
                echo "<p>{$item['file']}({$item['line']})</p>";
            }, $trace ?? []);
        ?>
    </div>
</main>
<?php require __DIR__ . '/../footer.view.php'; ?>