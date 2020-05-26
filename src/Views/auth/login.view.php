<?php render('header') ?>
<main class="content">
    <div class="container pt-5">
        <div class="row">
            <div class="col-md-4 m-auto">
                <h4>Login</h4><br>
                <form action="/login" method="POST">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" id="email" name="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" class="form-control">
                    </div>
                    <input type="submit" class="btn bg-secondary">
                </form>
            </div>
        </div>
    </div>
</main>
<?php render('footer') ?>
