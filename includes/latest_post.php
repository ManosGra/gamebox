<?php
$query = "SELECT * FROM posts ORDER BY post_date DESC, post_id DESC LIMIT 4 OFFSET 1";
$result = mysqli_query($connection, $query);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $post_title = $row['post_title'];
        $post_date = $row['post_date'];
        $post_content = substr($row['post_content'], 0, 100);
        $post_image = $row['post_image'];
        $post_tag = $row['post_tags'];
        $post_category_id = $row['post_category_id'];
        ?>

        <div class='col-md-6 mb-4'>
            <div class='blog-post relative category-container border border-dark rounded shadow reveal'>

                <a class="text-decoration-none" href='post.php?p_id=<?php echo $row['post_id']; ?>'>
                    <img class="img-fluid rounded mb-3" src="images/<?php echo $post_image; ?>"
                        alt="<?php echo $post_title; ?>">
                    <h4 class="pb-3 mt-3 m-2 f-bold text-white text-relative"><?php echo $post_title; ?></h4>
                </a>

                <a class="review f-bold mx-2 text-decoration-none category-<?php echo $post_category_id; ?>"
                    href='post.php?p_id=<?php echo $row['post_id']; ?>'><?php echo $post_tag; ?></a>
            </div>
        </div>
        <?php
    }
}
?>