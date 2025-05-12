<header class="responsive-nav">
    <div class=" d-flex align-items-center flex-row justify-content-between">
        <div class="hamburger" id="hamburger">
            <span></span>
            <span></span>
            <span></span>
        </div>

        <div class="logo">
            <a class="text-decoration-none" href="index">
                <img class="img-fluid rounded-circle" style="width:80px;" src="images/gamebox.png">
            </a>
        </div>
        
        <div></div>
    </div>

    <nav id="menu" class="d-flex flex-column">
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
            echo "<a class='text-decoration-none f-bold text-dark $active_class' href='category.php?category={$cat_id}'>{$cat_title}</a>";
        }
        ?>
         <a class="text-decoration-none f-bold text-dark" href="contact.php">Επικοινωνία</a>
    </nav>
</header>