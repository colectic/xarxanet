<?php
// $Id: comment.tpl.php,v 1.1.2.3 2009/05/11 20:28:33 jmburnz Exp $

/**
 * @file comment.tpl.php
 * Default theme implementation for comments.
 *
 * Available variables:
 * - $author: Comment author. Can be link or plain text.
 * - $content: Body of the post.
 * - $date: Date and time of posting.
 * - $links: Various operational links.
 * - $new: New comment marker.
 * - $picture: Authors picture.
 * - $signature: Authors signature.
 * - $status: Comment status. Possible values are:
 *   comment-unpublished, comment-published or comment-preview.
 * - $submitted: By line with date and time.
 * - $title: Linked title.
 *
 * Helper variables:
 * - $classes: Outputs dynamic classes for advanced themeing.
 *
 * These two variables are provided for context.
 * - $comment: Full comment object.
 * - $node: Node object the comments are attached to.
 *
 * @see template_preprocess_comment()
 * @see genesis_preprocess_comment()
 * @see theme_comment()
 */
?>
<div class="<?php print $classes; ?>">
    <div class="comment-inner">
        <div class="comment-content">
            <?php print $content; ?>
            <?php if ($signature): ?>
                <div class="user-signature clear-block"><?php print $signature; ?></div>
            <?php endif; ?>
        </div>
        <?php if ($submitted): ?>
            <div class="comment-submitted"><?php print $submitted; ?></div>
        <?php endif; ?>
        <?php if ($links): ?>
            <div class="comment-links"><?php print $links; ?></div>
        <?php endif; ?>
    </div>
    <div class="comment-clear-float">&nbsp;</div>
</div> <!-- /comment -->