<?php if (isset($data['success'])) { ?>
    <div class="alert alert-dismissible alert-success response-feedback">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Success!!</strong> <?= $data['success'] ?>.
    </div>
<?php } elseif(isset($data['danger'])) { ?>
    <div class="alert alert-dismissible alert-danger response-feedback">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Oh snap!!</strong> <?= $data['danger'] ?>
    </div>
<?php } ?>
<script>
    setTimeout(function(){
        const alert = document.querySelector('.alert');
        if (alert) {
            alert.style.opacity = "0";
        }
    }, 5000);
</script>
