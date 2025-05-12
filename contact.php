<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>

<?php

if (isset($_POST['submit'])) {
    $to = "manosgrammos9@gmail.com";
    $subject = wordwrap($_POST['subject'], 70);
    $body = $_POST['body'];
    $header = "From:" . $_POST['email'];

    mail($to, $subject, $body, $header);
}

?>

<?php include "includes/navigation.php"; ?>

<!-- Page Content -->
<div class="container-lg">
    <div class="row contact-form">
    <h1 class="text-center mb-4 text-white f-bold mt-4">Eπικοινωνία</h1>
        <div class="col-md-12">
            <div class="form-wrap border rounded border-dark shadow p-3">
              
                <form role="form" action="" method="post" id="login-form" autocomplete="off">
                    <div class="form-group mb-3">
                        <label for="email" class="sr-only mb-2 f-bold text-white">Email</label>
                        <input type="email" name="email" id="email" class="form-control border-dark">
                    </div>

                    <div class="form-group mb-3">
                        <label for="subject" class="sr-only mb-2 f-bold text-white">Θέμα</label>
                        <input type="text" name="subject" id="subject" class="form-control border-dark"
                           >
                    </div>

                    <div class="form-group mb-3">
                    <label for="" class="sr-only mb-2 f-bold text-white">Μήνυμα</label>
                        <textarea name="body" id="body" class="form-control border-dark" style="height:225px" cols="50" rows="10"></textarea>
                    </div>

                    <input type="submit" name="submit" id="btn-login" class="btn btn-danger w-100 btn-lg f-bold btn-block"
                        value="Submit">
                </form>
            </div>
        </div>
    </div>
</div>
<?php include "includes/footer.php"; ?>