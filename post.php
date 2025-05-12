<?php include "includes/db.php" ?>
<?php include "includes/header.php" ?>

<!-- Navigation -->
<?php include "includes/navigation.php" ?>
<?php ob_start(); ?>
<!-- Page Content -->
<?php
function removeGreekAccents($string)
{
    $unwanted = [
        'ά' => 'α',
        'έ' => 'ε',
        'ί' => 'ι',
        'ό' => 'ο',
        'ύ' => 'υ',
        'ή' => 'η',
        'ώ' => 'ω',
        'Ά' => 'Α',
        'Έ' => 'Ε',
        'Ί' => 'Ι',
        'Ό' => 'Ο',
        'Ύ' => 'Υ',
        'Ή' => 'Η',
        'Ώ' => 'Ω',
        'ϊ' => 'ι',
        'ΐ' => 'ι',
        'Ϊ' => 'Ι',
        'ϋ' => 'υ',
        'ΰ' => 'υ',
        'Ϋ' => 'Υ'
    ];
    return strtr($string, $unwanted);
} ?>

<div class="row w-100 g-0">
    <!-- Blog Entries Column -->
    <div class="col-md-12">
        <?php
        if (isset($_GET['p_id'])) {

            $the_post_id = $_GET['p_id'];

            $view_query = "UPDATE posts SET post_view_counts = post_view_counts + 1 WHERE post_id = $the_post_id";
            $send_query = mysqli_query($connection, $view_query);
            if (!$send_query) {
                die("QUERY FAILED" . mysqli_error($connection));
            }

            $query = "SELECT * FROM posts WHERE post_id = $the_post_id";
            $select_all_posts_query = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_assoc($select_all_posts_query)) {
                $post_title = $row['post_title'];
                $post_user = $row['post_user'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $post_content = $row['post_content'];

                $title_clean = removeGreekAccents($post_title);
                $title_upper = mb_strtoupper($title_clean, 'UTF-8');
                ?>

                <!-- First Blog Post -->
                <div class="container-lg">
                    <div class="main-content">
                        <img class="img-fluid hero-image rounded" style="width:100%; height:100vh;" src="images/<?php echo $post_image; ?>"
                            alt="">
                        <span class="backdrop"></span>
                        <h1 class="mb-4 f-bold text-center text-white post-title px-4 position-absolute w-100"><?php echo $title_upper ?></h1>
                    </div>
                    <div class="row align-items-start mt-5">
                        <div class="col-md-9">
                            <div class="pe-5 secondary-sidebar border border-dark">
                                <h6 class="content-text">
                                    <?php echo $post_content ?>
                                </h6>
                                <div class="share-buttons ms-4">
                                    <h3 class="ms-2 mb-3 text-white">SHARE THIS:</h3>
                                    <!-- Facebook -->
                                    <a class="text-decoration-none text-white f-bold rounded-circle p-2" href="#"
                                        target="_blank">
                                        <?php include 'svg/facebook.php' ?></php>
                                    </a>

                                    <!-- Twitter -->
                                    <a class="text-decoration-none text-white rounded-circle p-3 bg-black" href="#"
                                        target="_blank">
                                        <?php include 'svg/x.php' ?>
                                    </a>
                                </div>
                            </div>

                            <div class="comments-section mt-4">
                                <?php
                                if (isset($_POST['create_comment'])) {
                                    $the_post_id = $_GET['p_id'];

                                    $comment_author = $_POST['comment_author'];
                                    $comment_email = $_POST['comment_email'];
                                    $comment_content = $_POST['comment_content'];

                                    if (!empty($comment_author) && !empty($comment_email) && !empty($comment_content)) {
                                        $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date)";
                                        $query .= "VALUES ($the_post_id, '{$comment_author}', '{$comment_email}', '{$comment_content}', 'unapproved', now())";

                                        $create_comment_query = mysqli_query($connection, $query);

                                        if (!$create_comment_query) {
                                            die('QUERY FAILED' . mysqli_error($connection));
                                        }

                                        header("Location:/post.php?p_id=$the_post_id");
                                    } else {
                                        echo "<script>alert('Fields cannot be empty');</script>";
                                    }
                                }
                                ?>

                                <!-- Comments Form -->
                                <div class="secondary-sidebar  border border-dark p-3">
                                    <h4 class="mb-4 bg-black p-3 text-center rounded ms-auto" style="max-width:300px;">Κάνε το
                                        πρώτο σχόλιο!</h4>
                                    <form role="form" action="" method="post">
                                        <div class="form-group  mb-2">
                                            <input type="text" class="form-control border-dark" name="comment_author"
                                                placeholder="Όνομα">
                                        </div>

                                        <div class="form-group mb-2">
                                            <input type="email" class="form-control border-dark" name="comment_email"
                                                placeholder="Email">
                                        </div>

                                        <div class="form-group">
                                            <textarea class="form-control border-dark" name="comment_content" rows="3"
                                                placeholder="Σχόλιο"></textarea>
                                        </div>
                                        <button type="submit" name="create_comment"
                                            class="btn btn-danger f-bold mt-3 w-100">Submit</button>
                                    </form>
                                </div>

                                <!-- Posted Comments -->
                                <div class="secondary-sidebar mt-4 border border-dark p-3">
                                <h5 class="mb-3 ">Σχόλια:</h5>
                                    <?php
                                    $query = "SELECT * FROM comments WHERE comment_post_id = {$the_post_id} ";
                                    $query .= "AND comment_status = 'approved' ";
                                    $query .= "ORDER BY comment_id DESC ";
                                    $select_comment_query = mysqli_query($connection, $query);
                                    if (!$select_comment_query) {
                                        die('Query Failed' . mysqli_error($connection));
                                    }
                                    while ($row = mysqli_fetch_array($select_comment_query)) {
                                        $comment_date = $row['comment_date'];
                                        $comment_content = $row['comment_content'];
                                        $comment_author = $row['comment_author'];
                                        ?>

                                        <div class="media">
                                            
                                            <div class="media-body">
                                                <div class="d-flex flex-row align-items-center mb-2">
                                                    <h5 class="media-heading mb-0 me-1 text-danger f-bold">
                                                        <?php echo $comment_author; ?>
                                                    </h5> /
                                                    <small class="mb-0 text-white ms-1">
                                                        <?php echo $comment_date; ?>
                                                    </small>
                                                </div>
                                                <p class="text-white"><?php echo $comment_content; ?></p>
                                                <hr>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <hr class="text-white">
                            <div class="row align-items-center">
                                <h5 class="mb-2 f-bold text-white">Αξίζει να διαβάσεις</h5>
                                
                                <?php include "includes/posts.php" ?>
                            </div>

                        </div>

                        <div class="col-md-3">
                            <?php include "includes/sidebar.php" ?>
                        </div>
                    </div>
                </div>
            <?php }
        } else {
            header("Location: index.php");
        }
        ?>
    </div> <!-- .col-md-12 -->
</div> <!-- .row.main-content -->

<?php include "includes/footer.php" ?>