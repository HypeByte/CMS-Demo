<?php require_once('../private/initialize.php'); ?>

<?php

if (isset($_GET['subject_id'])) {
  $subject_id = $_GET['subject_id'];
  $page_set = find_pages_by_subject_id($subject_id, ['visible' => true]);
  $page = mysqli_fetch_assoc($page_set);
  $page_id = $page['id'];
  mysqli_free_result($page_set);
  if(!$page) {
    redirect_to(url_for('/index.php'));
  }
}

elseif (isset($_GET['id'])) {
  $page_id = $_GET['id'];
  $page = find_page_by_id($page_id);
  if(!$page) {
    redirect_to(url_for('/index.php'));
  }
  $subject_id = $page['subject_id'];
}

?>

<?php include(SHARED_PATH . '/public_header.php'); ?>

<div id="main">
  <?php include(SHARED_PATH . '/public_navigation.php'); ?>
  <div id="page">

      <?php
        if(isset($page)) {
            echo $page['content'];
        } else {
            include(SHARED_PATH . '/static_homepage.php');
        }
      ?>

  </div>

</div>

<?php include(SHARED_PATH . '/public_footer.php'); ?>
