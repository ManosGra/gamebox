<?php include "includes/db.php" ?>
<?php include "includes/header.php" ?>

<!-- Navigation -->
<?php include "includes/navigation.php" ?>

<!-- Page Content -->
<div class="container-lg">
    <div class="row search-content reveal">

        <!-- Blog Entries Column -->
        <div class="col-md-9">

            <?php

            if (isset($_POST['submit'])) {
                $search = trim($_POST['search']); // Remove extra spaces for additional safety
            
                if (!empty($search)) { // Ensure there is something to search for
                    $query = "SELECT * FROM posts WHERE post_title LIKE '%$search%'";
                    $search_query = mysqli_query($connection, $query);

                    if (!$search_query) {
                        die("QUERY FAILED" . mysqli_error($connection));
                    }

                    $count = mysqli_num_rows($search_query);

                    if ($count == 0) {
                        echo "<h1 class='text-center text-white f-bold'>No results found</h1>";
                    } else {
                        while ($row = mysqli_fetch_assoc($search_query)) {
                            $post_id = $row['post_id'];
                            $post_title = $row['post_title'];
                            $post_author = $row['post_user'];
                            $post_date = $row['post_date'];
                            $post_image = $row['post_image'];
                            $post_content = isset($row['post_content']) && !empty($row['post_content'])
                                ? substr(html_entity_decode(stripslashes($row['post_content'])), 0, 350) . '...'
                                : "No content available.";
                            ?>

                            <!-- First Blog Post -->
                            <div class="search-post row">
                                <div class="col-md-12">
                                    <div class="row align-items-end">
                                        <div class="col-md-6">
                                            <a href="post.php?p_id=<?php echo $post_id; ?>" class="text-decoration-none"><img
                                                    class="img-fluid rounded" src="images/<?php echo $post_image ?>">
                                            </a>
                                        </div>

                                        <div class="col-md-6">
                                            <p class="my-2 f-bold"><span class="glyphicon glyphicon-time text-secondary"> <?php echo $post_date ?></span></p>
                                            <a class="text-decoration-none" href="post.php?p_id=<?php echo $post_id; ?>">
                                                <h1 class="f-bold text-white"><?php echo $post_title ?></h1>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="mb-5 mt-4">
                        <?php }
                    }
                } else {
                    echo "<h1 class='text-white text-center'>Please enter a search term</h1>";
                }
            }
            ?>
        </div>

        <div class="col-md-3">
            <?php include "includes/sidebar.php" ?>
        </div>
    </div>
</div>

<?php include "includes/footer.php" ?>