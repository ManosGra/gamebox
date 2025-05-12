<div class="nav-bar py-2">
    <div class="container-lg">
        <div class="row align-items-center justify-content-between">
            <div class="col-md-2">
                <div class="logo">
                    <a class="text-decoration-none" href="index">
                        <img class="img-fluid rounded-circle" style="width:80px;" src="images/gamebox.png">
                    </a>
                </div>
            </div>

            <div class="col-md-8">
                <ul class="d-flex flex-row align-items-center justify-content-between mb-0 f-bold nav-links">
                    <?php
                    $query = "SELECT * FROM categories LIMIT 4";
                    $select_all_categories_query = mysqli_query($connection, $query);

                    // Παίρνουμε την τρέχουσα κατηγορία από το URL
                    $current_category_id = isset($_GET['category']) ? $_GET['category'] : '';

                    while ($row = mysqli_fetch_assoc($select_all_categories_query)) {
                        $cat_title = $row['cat_title'];
                        $cat_id = $row['cat_id'];

                        // Αν η τρέχουσα κατηγορία είναι αυτή που επιλέχτηκε, προσθέτουμε την κλάση active
                        $active_class = ($cat_id == $current_category_id) ? 'active' : '';
                        echo "<li class='p-0 mb-0 list-unstyled'><a class='text-decoration-none $active_class' href='category.php?category={$cat_id}'>{$cat_title}</a></li>";
                    }
                    ?>
                </ul>
            </div>

            <div class="col-md-2">
                <div class="search text-end text-white">
                    <?php include 'svg/search.php'?>
                </div>

                <div class="search-popup" id="searchPopup">
                    <div class="popup-inner">
                        <form action="search.php" method="post">
                            <div class="input-group text-secondary">
                                <input name="search" type="text" class="form-control border-secondary w-100"
                                    placeholder="Αναζήτηση...">
                                <button name="submit" class="btn border-dark d-none"
                                    type="submit"><?php include 'svg/search.svg'; ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/responsive_nav.php'?>
