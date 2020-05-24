<?php render('header', $data ?? []); ?>
    <div class="container">
        <main class="content">
            <br>
            <br>
            <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#modal">Mail</button>
            <div class="modal" id="modal">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form action="/mail" method="POST">
                            <div class="modal-header">
                                <h5 class="modal-title">Modal title</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                           aria-describedby="nameHelp" placeholder="Enter email">
                                    <small id="nameHelp" class="form-text text-muted">We'll never share your email with
                                        anyone else.</small>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                           aria-describedby="emailHelp" placeholder="Enter email">
                                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with
                                        anyone else.</small>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Subject</label>
                                    <input type="text" class="form-control" id="subject" name="subject"
                                           aria-describedby="subjectHelp" placeholder="Subject">
                                    <small id="subjectHelp" class="form-text text-muted">We'll never share your email
                                        with
                                        anyone else.</small>
                                </div>
                                <div class="form-group">
                                    <label for="exampleTextarea">Body</label>
                                    <textarea class="form-control" id="body" name="body" rows="3"></textarea>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Enviar</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>
<?php render('footer'); ?>