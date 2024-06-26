<?php render('header', $data ?? []); ?>
    <div class="container">
        <main class="content">
            <br>
            <br>
            <h3 class="text-center">E-Mails</h3>
            <br>
            <button type="button" class="btn btn-outline-primary d-block ml-auto" data-toggle="modal"
                    data-target="#modal">New E-Mail
            </button>


            <?php
            if (isset($emails) && is_array($emails) && (count($emails) > 0)) {
            ?>
            <table class="table mt-4">
                <thead class="bg-secondary">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">To</th>
                    <th scope="col">Subject</th>
                    <th scope="col">Body</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php
                /**
                 * @var $email App\Entities\Email
                 */
                foreach ($emails as $key => $email) {
                    ?>
                    <tr>
                        <th scope="row"><?= $email->getId() ?></th>
                        <td><?= $email->getTo() ?></td>
                        <td><?= $email->getSubject() ?></td>
                        <td><?= $email->getBody() ?></td>
                        <td>
                            <form action="/mail-delete" method="POST">
                                <input name="emailId" type="hidden" value="<?= $email->getId() ?>">
                                <button type="submit"><i data-feather="trash-2"></i></button>
                            </form>
                        </td>
                    </tr>
                    <?php
                }
                } else {
                    echo '<p class="text-center">there is no email to show...</p>';
                }
                ?>
                </tbody>
            </table>

            <!--     MODAL       -->
            <div class="modal" id="modal">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form action="/mail" method="POST">
                            <div class="modal-header">
                                <h5 class="modal-title">Enter your email data</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                           aria-describedby="nameHelp" placeholder="Enter name">
                                    <small id="nameHelp" class="form-text text-muted">We'll never share your email with
                                        anyone else.</small>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                           aria-describedby="emailHelp" placeholder="Enter email">
                                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with
                                        anyone else.</small>
                                </div>
                                <div class="form-group">
                                    <label for="subject">Subject</label>
                                    <input type="text" class="form-control" id="subject" name="subject"
                                           aria-describedby="subjectHelp" placeholder="Subject">
                                    <small id="subjectHelp" class="form-text text-muted">We'll never share your email
                                        with
                                        anyone else.</small>
                                </div>
                                <div class="form-group">
                                    <label for="body">Body</label>
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