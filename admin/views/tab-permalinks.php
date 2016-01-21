<?php
/**
 * @package WPSEO\Admin
 */

if ( ! defined( 'WPSEO_VERSION' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit();
}

$yform = Yoast_Form::get_instance();
$yform->currentoption = 'wpseo_permalinks';

echo '<h3>', esc_html__( 'Change URLs', 'wordpress-seo' ), '</h3>';

/* translators: %s expands to <code>/category/</code> */
$yform->checkbox( 'stripcategorybase', sprintf( esc_html__( 'Strip the category base (usually %s) from the category URL.', 'wordpress-seo' ), '<code>/category/</code>' ) );

echo '<p>' . esc_html__( 'Attachments to posts are stored in the database as posts, this means they\'re accessible under their own URL\'s if you do not redirect them, enabling this will redirect them to the post they were attached to.', 'wordpress-seo' ) . '</p>';
$yform->checkbox( 'redirectattachment', esc_html__( 'Redirect attachment URL\'s to parent post URL.', 'wordpress-seo' ) );

echo '<h3>', esc_html__( 'Clean up permalinks', 'wordpress-seo' ), '</h3>';
echo '<p>' . esc_html__( 'This helps you to create cleaner URLs by automatically removing the stopwords from them.', 'wordpress-seo' ) . '</p>';
$yform->checkbox( 'cleanslugs', esc_html__( 'Remove stop words from slugs.', 'wordpress-seo' ) );

echo '<p>' . esc_html__( 'This prevents threaded replies from working when the user has JavaScript disabled, but on a large site can mean a <em>huge</em> improvement in crawl efficiency for search engines when you have a lot of comments.', 'wordpress-seo' ) . '</p>';

/* translators: %s expands to <code>?replytocom</code> */
$yform->checkbox( 'cleanreplytocom', sprintf( esc_html__( 'Remove the %s variables.', 'wordpress-seo' ), '<code>?replytocom</code>' ) );

/* translators: %s expands to <code>.html</code> */
echo '<p>' . sprintf( esc_html__( 'If you choose a permalink for your posts with %1$s, or anything else but a %2$s at the end, this will force WordPress to add a trailing slash to non-post pages nonetheless.', 'wordpress-seo' ), '<code>.html</code>', '<code>/</code>' ) . '</p>';
$yform->checkbox( 'trailingslash', esc_html__( 'Enforce a trailing slash on all category and tag URL\'s', 'wordpress-seo' ) );

echo '<p>' . esc_html__( 'People make mistakes in their links towards you sometimes, or unwanted parameters are added to the end of your URLs, this allows you to redirect them all away. Please note that while this is a feature that is actively maintained, it is known to break several plugins, and should for that reason be the first feature you disable when you encounter issues after installing this plugin.', 'wordpress-seo' ) . '</p>';
$yform->checkbox( 'cleanpermalinks', esc_html__( 'Redirect ugly URL\'s to clean permalinks. (Not recommended in many cases!)', 'wordpress-seo' ) );

echo '<div id="cleanpermalinksdiv">';
echo '<p>' . esc_html__( 'Google Site Search URL\'s look weird, and ugly, but if you\'re using Google Site Search, you probably do not want them cleaned out.', 'wordpress-seo' ) . '</p>';
$yform->checkbox( 'cleanpermalink-googlesitesearch', esc_html__( 'Prevent cleaning out Google Site Search URL\'s.', 'wordpress-seo' ) );

/* translators: %s expands to <code>?utm_</code> */
echo '<p>' . sprintf( esc_html__( 'If you use Google Analytics campaign parameters starting with %s, check this box. However, you\'re advised not to use these. Instead, use the version with a hash.', 'wordpress-seo' ), '<code>?utm_</code>' ) . '</p>';
$yform->checkbox( 'cleanpermalink-googlecampaign', esc_html__( 'Prevent cleaning out Google Analytics Campaign & Google AdWords Parameters.', 'wordpress-seo' ) );

echo '<p>' . esc_html__( 'You might have extra variables you want to prevent from cleaning out, add them here, comma separated.', 'wordpress-seo' ) . '</p>';
$yform->textinput( 'cleanpermalink-extravars', esc_html__( 'Other variables not to clean', 'wordpress-seo' ) );
echo '</div>';

/* translators: %s expands to <code>&lt;head&gt;</code> */
echo '<h3>', sprintf( esc_html__( 'Clean up the %s', 'wordpress-seo' ), '<code>&lt;head&gt;</code>' ), '</h3>';
$yform->checkbox( 'hide-rsdlink', esc_html__( 'Hide RSD Links', 'wordpress-seo' ) );
$yform->checkbox( 'hide-wlwmanifest', esc_html__( 'Hide WLW Manifest Links', 'wordpress-seo' ) );
$yform->checkbox( 'hide-shortlink', esc_html__( 'Hide Shortlink for posts', 'wordpress-seo' ) );
$yform->checkbox( 'hide-feedlinks', esc_html__( 'Hide RSS Links', 'wordpress-seo' ) );
