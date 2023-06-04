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
    if (alert) {
        setTimeout(function(){
            alert.style.opacity = "0";
        }, 20000);
        setTimeout(function(){
            alert.parentNode.removeChild(alert);
        }, 22000);
    }
</script>
