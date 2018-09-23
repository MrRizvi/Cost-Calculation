<?php
if (post_password_required()) {
    return;
}
?>

    <div class="comments-thread comment-main">
<?php
if (have_comments()) :
    global $post_type;
    if ($post_type != 'service'):
        ?>
        <div class="heading6">
            <h3><?php esc_html_e('People Reviews', 'unload') ?></h3>
            <?php
            echo '<p>' . get_the_title() . '</p>'
            ?>
        </div>
        <?php
    endif;
    if (get_comment_pages_count() > 1 && get_option('page_comments')) :
        ?>
        <nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
            <h2 class="screen-reader-text"><?php esc_html_e('Comment navigation', 'unload'); ?></h2>
            <div class="nav-links">
                <div class="nav-previous"><?php previous_comments_link(esc_html__('Older Comments', 'unload')); ?></div>
                <div class="nav-next"><?php next_comments_link(esc_html__('Newer Comments', 'unload')); ?></div>

            </div>
        </nav>
    <?php endif; ?>

    <ul itemtype="http://schema.org/UserComments" itemscope="">
        <?php
        wp_list_comments(array(
            'short_ping' => TRUE,
            'callback' => 'unload_CommentsListing',
        ));
        ?>
    </ul>

    <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : // Are there comments to navigate through?     ?>
    <nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
        <h2 class="screen-reader-text"><?php esc_html_e('Comment navigation', 'unload'); ?></h2>
        <div class="nav-links">

            <div class="nav-previous"><?php previous_comments_link(esc_html__('Older Comments', 'unload')); ?></div>
            <div class="nav-next"><?php next_comments_link(esc_html__('Newer Comments', 'unload')); ?></div>

        </div><!-- .nav-links -->
    </nav><!-- #comment-nav-below -->
    <?php
endif; // Check for comment navigation.

endif; // Check for have_comments().
// If comments are closed and there are comments, let's leave a little note, shall we?
if (!comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments')) :
    ?>

    <p class="no-comments"><?php esc_html_e('Comments are closed.', 'unload'); ?></p>
    </div>
    <?php
endif;
if (comments_open()) {
    unload_comment_form();
}
?>

    </div><!-- #comments -->

<?php

function unload_comment_form($args = array(), $post_id = NULL)
{
    if (NULL === $post_id) {
        $post_id = get_the_ID();
    } else {
        $id = $post_id;
    }

    $commenter = wp_get_current_commenter();
    $user = wp_get_current_user();
    $user_identity = $user->exists() ? ucwords($user->display_name) : '';
    $args = wp_parse_args($args);
    if (!isset($args['format'])) {
        $args['format'] = current_theme_supports('html5', 'comment-form') ? 'html5' : 'xhtml';
    }
    $req = get_option('require_name_email');
    $aria_req = ($req ? " aria-required='true'" : '');
    $html5 = 'html5' === $args['format'];
    $fields = array(
        'author' => '<div class="col-md-6"><input class="text-field" id="author" placeholder="' . esc_html__('Full Name *', 'unload') . '" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" ' . $aria_req . ' /></div>',
        'email' => '<div class="col-md-6"><input class="text-field" id="email" name="email" ' . ($html5 ? 'type="email"' : 'type="text"') . ' value="' . esc_attr($commenter['comment_author_email']) . '" size="30"' . $aria_req . ' placeholder="' . esc_html__('Email Address *', 'unload') . '" /></div>',
        'url' => '<div class="col-md-12"><input class="text-field" id="url" placeholder="' . esc_html__('Website *', 'unload') . '" name="url" ' . ($html5 ? 'type="url"' : 'type="text"') . ' value="' . esc_attr($commenter['comment_author_url']) . '"  /></div>',
    );

    $required_text = sprintf(' ' . esc_html__('Required fields are marked %s', 'unload'), '<span class="required">*</span>');
    $defaults = array(
        'fields' => apply_filters('comment_form_default_fields', $fields),
        'comment_field' => '<div class="col-md-12"><textarea class="text-field" id="comment" name="comment" aria-required="true" placeholder="' . esc_html__('Comment *', 'unload') . '" ></textarea></div>',
        'must_log_in' => '<p class="must-log-in">' . esc_html__('You must be ', 'unload') . sprintf('<a href="%s">' . esc_html__('logged in ', 'unload') . '</a>' . esc_html__('to post a comment', 'unload'), wp_login_url(apply_filters('the_permalink', get_permalink($post_id)))) . ' </p > ',
        'logged_in_as' => ' <div class="col-md-12" ><p class="logged-in-as" > ' . esc_html__('Logged in as ', 'unload') . sprintf('<a href="%1$s">%2$s</a>. <a href="%3$s" title="' . esc_html__('Log out of this account', 'unload') . '"> ' . esc_html__('Log out', 'unload') . '?</a > ', get_edit_user_link(), $user_identity, wp_logout_url(apply_filters('the_permalink', get_permalink($post_id)))) . ' </p ></div > ',
        'comment_notes_before' => esc_html__('Your email address will not be published . ', 'unload'),
        'comment_notes_after' => ' <p class="form-allowed-tags"> ' . esc_html__('You may use these ', 'unload') . sprintf('<abbr title="' . esc_html__('HyperText Markup Language HTML', 'unload') . '" ></abbr>' . esc_html__('tags and attributes', 'unload') . ': %s', '<code>' . allowed_tags() . ' </code> ') . '</p > ',
        'id_form' => 'commentform',
        'id_submit' => 'submit',
        'title_reply' => esc_html__('Leave A Reply', 'unload'),
        'title_reply_to' => esc_html__('Leave a Reply to %s', 'unload'),
        'cancel_reply_link' => esc_html__('Cancel reply', 'unload'),
        'label_submit' => esc_html__('POST COMMENT', 'unload'),
        'format' => 'xhtml',
    );
    $args = wp_parse_args($args, apply_filters('comment_form_defaults', $defaults));

    if (comments_open($post_id)) :
        do_action('comment_form_before');
        if (get_option('comment_registration') && !is_user_logged_in()) :
            echo wst_set($args, 'must_log_in');
            do_action('comment_form_must_log_in_after');
        else :
            ?>
            <div id="respond" class="leave-reply">
                <div class="heading6">
                    <?php echo ' <h3>' . $args['title_reply'] . ' </h3 ><p> ' . $args['comment_notes_before'] . $required_text . ' </p > '; ?>
                </div>
                <small><?php cancel_comment_reply_link($args['cancel_reply_link']); ?></small>
                <div class="reply-form">
                    <form class="contact-form" action="<?php echo site_url('/wp-comments-post.php'); ?>"
                          method="post"
                          id="<?php echo esc_attr($args['id_form']); ?>" <?php echo esc_attr($html5) ? ' novalidate' : ''; ?>>
                        <div class="row">
                            <?php
                            do_action('comment_form_top');
                            if (is_user_logged_in()) :
                                echo apply_filters('comment_form_logged_in', $args['logged_in_as'], $commenter, $user_identity);
                                do_action('comment_form_logged_in_after', $commenter, $user_identity);
                            else :
                                do_action('comment_form_before_fields');
                                foreach ((array)$args['fields'] as $name => $field) {
                                    echo apply_filters("comment_form_field_{$name}", $field) . "\n";
                                }
                                do_action('comment_form_after_fields');
                            endif;
                            echo apply_filters('comment_form_field_comment', $args['comment_field']);
                            ?>
                            <div class="col-md-12">
                                <button class="theme-btn" type="submit" name="submit"
                                        id="<?php echo esc_attr($args['id_submit']); ?>"><i
                                        class="fa fa-paper-plane"></i><?php echo esc_attr($args['label_submit']); ?>
                                </button>
                            </div>
                            <?php comment_id_fields($post_id); ?>
                        </div>
                        <?php do_action('comment_form', $post_id); ?>
                    </form>
                </div>
            </div>
        <?php endif; ?>
        <?php do_action('comment_form_after'); ?>
    <?php else : ?>
        <?php do_action('comment_form_comments_closed'); ?>
    <?php endif; ?>
    <?php
}

function unload_CommentsListing($comment, $args, $depth)
{
    $GLOBALS['comment'] = $comment;
    ?>
    <li>
    <div id="comment-<?php echo comment_ID(); ?>" itemprop="name" class="comment">
        <?php echo get_avatar($comment, 186); ?>
        <div class="comment-detail">
            <div class="comment-info">
                <h6 itemtype="http://schema.org/Person" itemscope="" itemprop="creator">
                    <?php echo ucfirst(get_comment_author_link()); ?>
                    <span><?php esc_html_e('says', 'unload') ?>:</span>
                </h6>
                <i itemprop="commentTime">
                    <?php
                    comment_date(get_option('post_format'));
                    esc_html_e(' at ', 'unload');
                    comment_time('h:i a');
                    ?>
                </i>
                <?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
            </div>
            <?php comment_text(); ?>
        </div>
    </div>
    <?php
}
	