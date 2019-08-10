<?php

$page = $this->getCurrent();

?>

  <div class="admin-page" style="padding: 40px 0;">
    <h1><?php echo $page->title; ?></h1>

    <div class="admin-page__posts">
        <?php echo $page->category; ?>
    </div>
    <div class="admin-page__zero-state">
        <?php echo $page->zero_state; ?>
    </div>
  </div>