<?php
$alertTypes = ['danger', 'success'];
foreach ($alertTypes as $alertType) {
    if (session()->has($alertType)) {
        ?>
        <div class="alert alert-dismissible alert-<?= $alertType ?> response-feedback">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?= session()->get($alertType) ?>.
        </div>
<?php
    }
}
clearFlashMessages();
?>
<script>
    const alert = document.querySelector('.alert');
    setTimeout(function(){
        if (alert) {
            alert.style.opacity = "0";
        }
    }, 2000);
    setTimeout(function(){
        alert.parentNode.removeChild(alert);
    }, 3000);
</script>
