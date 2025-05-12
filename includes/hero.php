
    <div class="hero px-0 reveal">
        <div class="row align-items-center justify-content-around">
            <div class="col-md-12 text-center">
                <?php
                $query = "SELECT * FROM posts ORDER BY post_date DESC, post_id DESC LIMIT 1";
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
                        <div class="hero-post">
                            <div class="hero-inner">
                                <span class="glow-layer"></span>

                                <img class="img-fluid mb-3" src="images/<?php echo $post_image; ?>"
                                    alt="<?php echo $post_title; ?>">


                                <div class="hero-content text-start">
                                    <h1 class="f-bold my-3 text-white text-relative"><?php echo $post_title; ?></h1>
                                    <a class="text-decoration-none btn btn-primary f-bold"
                                        href='post.php?p_id=<?php echo $row['post_id']; ?>'>Διαβάστε το</a>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
