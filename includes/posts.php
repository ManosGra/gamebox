<?php
$current_post_id = isset($_GET['p_id']) ? intval($_GET['p_id']) : 0;

$query = "SELECT * FROM posts ORDER BY post_date DESC, post_id DESC LIMIT 10 OFFSET 5";
$result = mysqli_query($connection, $query);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        // Παράλειψη του post αν είναι το τρέχον
        if ($row['post_id'] == $current_post_id) {
            continue;
        }

        $post_title = $row['post_title'];
        $post_date = $row['post_date'];
        $post_content = substr($row['post_content'], 0, 100);
        $post_image = $row['post_image'];
        $post_tag = $row['post_tags'];
        $post_category_id = $row['post_category_id'];
        ?>

        <div class="col-md-4">
            <div class='blog-post relative category-container mt-3 border rounded border-dark pb-2 reveal'>
                <a class="text-decoration-none" href='post.php?p_id=<?php echo $row['post_id']; ?>'>
                    <img class="img-fluid mb-3 rounded" src="images/<?php echo $post_image; ?>"
                        alt="<?php echo $post_title; ?>">

                    <span class="mx-2 f-bold text-decoration-none category-<?php echo $post_category_id; ?>">
                        <?php echo $post_tag; ?>
                    </span>

                    <div class="d-flex align-items-center">
                        <h4 class="mt-3 m-2 f-bold text-white text-relative"><?php echo $post_title; ?></h4>
                    </div>
                </a>
            </div>
        </div>
        <?php
    }
}
?>