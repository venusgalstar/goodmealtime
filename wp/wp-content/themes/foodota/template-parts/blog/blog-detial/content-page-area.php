<div class="blog-detial-main-area">
    <div class="post-excerpt post-desc">
        <?php the_content(); ?>
        <div class="clearfix"></div>
        <?php
        wp_link_pages(array(
            'before' => '<div class="page_with_pagination"><div class="page-links">', 'after' => '</div></div>', 'next_or_number' => 'number', 'link_before' => '<span class="no">', 'link_after' => '</span>'));
        ?>
        <?php comments_template('', true); ?>
    </div>
</div>