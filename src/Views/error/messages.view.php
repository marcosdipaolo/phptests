<?php
$types = ['danger', 'success'];
foreach ($types as $type) {
    if (session()->has($type)) {
?>
        <div class="alert alert-dismissible alert-<?= $type ?> response-feedback">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?= session()->get($type) ?>.
        </div>
<?php }
}
clearFlashMessages();
?>
<script>
    setTimeout(function(){
        const alert = document.querySelector('.alert');
        if (alert) {
            alert.style.opacity = "0";
        }
    }, 5000);
</script>
