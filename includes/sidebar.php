<div class="side-bar mt-4 reveal">
    <div class="secondary-sidebar border-dark border">
        <h5 class="mb-4 mt-3 f-bold">Διαβάστε Περισσότερα</h5>

        <?php
        $current_post_id = isset($_GET['p_id']) ? intval($_GET['p_id']) : 0;
       $query = "SELECT * FROM posts WHERE post_id != $current_post_id ORDER BY RAND() LIMIT 5";
        $select_all_post_query = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($select_all_post_query)) {
            $post_title = $row['post_title'];
            $post_id = $row['post_id'];
            $post_image = $row['post_image'];
            ?>

            <div class="mb-4 secondary-sidebar-content p-0 text-secondary">
                <a class="text-decoration-none " href='post.php?p_id=<?php echo $post_id ?>'>
                    <img class="img-fluid mb-2 rounded" src="images/<?php echo $post_image ?>">
                    <p><?php echo $post_title ?></p>
                </a>
            </div>

        <?php } ?>
    </div>

</div>