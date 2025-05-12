<?php include "includes/db.php" ?>
<?php include "includes/header.php" ?>
<?php include "includes/navigation.php" ?>


<div class="container-lg">
  <div class="row align-items-start">
    
    <?php include "includes/hero.php" ?>
    
    <div class="col-md-9">
      <div class="row align-items-center reveal">
        <h2 class="mb-3 mt-4 text-white f-bold">Τελευταία Nέα</h2>

        <?php include "includes/latest_post.php" ?>

        <h2 class="mb-3 mt-4 f-bold text-white">Αξίζει να διαβάσεις</h2>

        <?php include "includes/posts.php" ?>
      </div>
    </div>

    <div class="col-md-3">
      <?php include "includes/sidebar.php" ?>
    </div>

    <div class="col-md-12">
      meet your guides
    </div>
  </div>
</div>

<?php include "includes/footer.php" ?>