<?php include "includes/db.php" ?>
<?php include "includes/header.php" ?>

<!-- Navigation -->
<?php include "includes/navigation.php" ?>

<?php
// Ορισμός του τίτλου της κατηγορίας πριν το layout
$post_category_id = isset($_GET['category']) ? $_GET['category'] : 0;

// Fetch the category title based on the category ID
$query = "SELECT cat_title, cat_image FROM categories WHERE cat_id = $post_category_id";
$category_query = mysqli_query($connection, $query);

if ($row = mysqli_fetch_assoc($category_query)) {
    $cat_title_raw = $row['cat_title'];
    $cat_image = $row['cat_image']; // Ανάκτηση της εικόνας

    // Αφαίρεση τόνων
    $cat_title_no_tones = strtr($cat_title_raw, [
        'ά' => 'α',
        'έ' => 'ε',
        'ή' => 'η',
        'ί' => 'ι',
        'ό' => 'ο',
        'ύ' => 'υ',
        'ώ' => 'ω',
        'Ά' => 'Α',
        'Έ' => 'Ε',
        'Ή' => 'Η',
        'Ί' => 'Ι',
        'Ό' => 'Ο',
        'Ύ' => 'Υ',
        'Ώ' => 'Ω',
        'ϊ' => 'ι',
        'ΐ' => 'ι',
        'ϋ' => 'υ',
        'ΰ' => 'υ',
        'Ϊ' => 'Ι',
        'Ϋ' => 'Υ'
    ]);

    // Μετατροπή σε κεφαλαία
    $cat_title = mb_strtoupper($cat_title_no_tones, 'UTF-8');
} else {
    $cat_title = "NO CATEGORY FOUND";
    $cat_image = "path/to/default-image.jpg"; // Εικόνα εναλλακτικής αν δεν υπάρχει
}
?>

<div class="main-content reveal">
    <div class="category-hero">
        <img src="admin/images/categories/<?php echo $cat_image; ?>" style="width:100%; height:100vh;"
            alt="<?php echo $cat_title; ?>">
        <span class="glow-layer"></span>
        <h1 class="text-center content-title text-white scroll-fade"><?php echo $cat_title; ?></h1>
    </div>
</div>

<!-- Page Content -->
<div class="container-lg">
    <div class="row justify-content-center align-items-start mt-5 reveal">
        <!-- Blog Entries Column -->
        <div class="col-md-9">
            <div class="row align-items-center">
                <?php
                $query = "SELECT * FROM posts WHERE post_category_id = $post_category_id";
                $select_all_posts_query = mysqli_query($connection, $query);

                while ($row = mysqli_fetch_assoc($select_all_posts_query)) {
                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];
                    $post_author = $row['post_user'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_tag_string = $row['post_tags']; // Παίρνουμε όλο το string από τη βάση
                    $tag_parts = explode(',', $post_tag_string); // Το κόβουμε με βάση το κόμμα
                    $post_tag = trim($tag_parts[0]); // Παίρνουμε μόνο το πρώτο tag
                    $post_content = isset($row['post_content']) && !empty($row['post_content'])
                        ? substr(html_entity_decode(stripslashes($row['post_content'])), 0, 350) . '...'
                        : "No content available.";
                    ?>

                    <div class="col-md-6">
                        <div
                            class="border-none blog-post category-container relative rounded post-container mb-5 border border-dark rounded shadow">
                            <a href="post.php?p_id=<?php echo $post_id; ?>" class="text-decoration-none"><img
                                    class="img-fluid rounded" src="images/<?php echo $post_image ?>">
                                <div>
                                    <span
                                        class="mx-2 review f-bold text-decoration-none category-<?php echo $post_category_id; ?>">
                                        <?php echo $post_tag; ?>
                                    </span>

                                    <p
                                        class="me-4 mb-2 text-secondary d-flex align-items-center justify-content-end f-bold">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                            class="bi bi-calendar me-2" viewBox="0 0 16 16">
                                            <path
                                                d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z" />
                                        </svg>
                                        <?php echo $post_date ?>
                                    </p>
                                </div>
                                <h5 class="px-2 mt-3 f-bold"><?php echo $post_title ?> </h5>
                            </a>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>

        <div class="col-md-3">
            <?php include "includes/sidebar.php" ?>
        </div>
    </div>
</div>

<?php include "includes/footer.php" ?>