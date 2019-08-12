
<?php 
/** 
 * Template file for displaying the individual page the user is on
 *
*/
?>

<div class="admin-page">
  <h1><?php echo $currentPage->title; ?></h1>

  <?php if ($query->have_posts()) : ?>
    <table class="wp-list-table widefat fixed striped posts">
      <thead>
        <tr>
          <th scope="col" id="title" class="manage-column column-title column-primary sortable desc"><a href="http://localhost:8888/dfm/wp-admin/edit.php?orderby=title&amp;order=asc"><span>Title</span><span class="sorting-indicator"></span></a></th>
          <th scope="col" id="author" class="manage-column column-author">Author</th>
          <th scope="col" id="categories" class="manage-column column-categories">Categories</th>
          <th scope="col" id="tags" class="manage-column column-tags"></th>
        </tr>
      </thead>
      <tbody id="the-list">
        <?php while ($query->have_posts()) : $query->the_post(); ?>
          <?php $id = get_the_ID(); ?>
          <?php $categories = get_the_category($id); ?>
          <?php $i = 0; ?>
          <div class="admin-page__post">
          <tr class="iedit author-self level-0 post-5 type-post status-publish format-standard hentry category-world-and-news entry">
            <td class="title column-title has-row-actions column-primary page-title">
              <strong>
                <a href="<?php bloginfo('url'); ?>/wp-admin/post.php?post=<?php echo $id; ?>&action=edit"><?php the_title(); ?></a>
              </strong>
            </td>
            <td class="author column-author">
              <a href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' )); ?>"><?php the_author(); ?></a>
            </td>
            <td class="categories column-categories">
              <?php foreach ($categories as $c) : ?>
                <?php $i++; ?>
                <a href="<?php echo get_category_link($c->cat_ID); ?>">
                  <?php echo $c->name; ?><?php if (count($categories) > 1 && $i !== count($categories)) echo ','; ?>
                </a>
              <?php endforeach; ?>
            </td>
            <td></td>
          </tr>
        <?php endwhile;?> 
      </tbody>
    </table>
  <?php else : ?>
    <div class="admin-page__zero-state">
        <?php echo $currentPage->zero_state; ?>
    </div>
  <?php endif; ?>
</div>