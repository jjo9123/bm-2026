<?php
/*
 * The Index Post (or excerpt)
 * ===========================
 * Used by index.php, category.php and author.php
 */

// CATEGORY HANDLING (SAFE)
$categories = get_the_category();
$category_slug = '';
$category_name = '';

if (!empty($categories)) {
    $category_slug = esc_html($categories[0]->slug);
    $category_name = esc_html($categories[0]->name);
}

// AUTHOR HANDLING (SAFE)
$post_object = get_field('author');
$author = '';

if ($post_object) {
    $post = $post_object;
    setup_postdata($post);

    $details = get_field('contact_details', $post->ID);
    if (!empty($details['name'])) {
        $author = $details['name'];
    }

    wp_reset_postdata();
}

$post_id = get_the_ID();
?>

<div class="col-12 search-results">
    <ul>
        <li>
            <a href="<?php the_permalink(); ?>">
                <h2><?php the_title(); ?></h2>
            </a>

            <?php
            // SAFE EXCERPT HANDLING

            // Default post content
            $excerpt = get_post_field('post_content', $post_id);

            // New blog layout fallback
            if (empty($excerpt) && get_field('new_blog_layout', $post_id) === 'yes') {
                $excerpt = get_field('blog_intro', $post_id);
            }

            // Events / training override
            if ($category_slug === 'events' || $category_slug === 'training') {
                $intro = get_field('intro_title', $post_id);
                if (!empty($intro)) {
                    $excerpt = $intro;
                }
            }

            // Ensure $excerpt is always a string
            if (!is_string($excerpt)) {
                $excerpt = '';
            }

            echo wp_trim_words($excerpt, 30, '...');
            ?>
        </li>
    </ul>
</div>
