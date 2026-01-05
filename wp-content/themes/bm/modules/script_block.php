<?php
$custom_script = get_sub_field('script'); // Retrieve the script field, if it exists
$current_page_id = get_queried_object_id(); // Get current page ID

// Define allowed tags and attributes
$allowed_tags = array(
    'script' => array(
        'src' => array(),
        'type' => array(),
    ),
    'div' => array(
        'id' => array(),
        'style' => array(),
    ),
    'iframe' => array(
        'src' => array(),
        'width' => array(),
        'height' => array(),
        'scrolling' => array(),
        'frameborder' => array(),
        'allowtransparency' => array(),
        'allowfullscreen' => array(),
        'loading' => array(), // optional: for lazy loading
        'style' => array(),   // optional: inline style if needed
    ),
);

// Sanitize the embed code
$sanitized_embed_code = wp_kses($custom_script, $allowed_tags);
?>

<section class="txt script-block" style="padding-top: 0;">
    <div class="container">
        <div class="row">
            <?php if ($current_page_id == 34711): // fix for https://www.blakemorgan.co.uk/employment-rights-bill/ iframe?>
                <div class="col-lg-12 mx-auto text-center" style="padding: 0;">
            <?php else: ?>
                <div class="col-12 col-lg-10 mx-auto text-center">
            <?php endif; ?>

                <?php if (get_sub_field('title')): ?>
                    <h2 class="purple">
                        <?php the_sub_field('title'); ?>
                    </h2>
                <?php endif; ?>

                <?php if ($sanitized_embed_code): ?>
                    <?php echo $sanitized_embed_code; ?>
                <?php endif; ?>

                </div> <!-- close col -->
        </div>
    </div>
</section>