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

$social_facebook = new Yoast_Social_Facebook( );

$yform->admin_header( true, 'wpseo_social' );
?>

	<h2 class="nav-tab-wrapper" id="wpseo-tabs">
		<a class="nav-tab" id="accounts-tab" href="#top#accounts"><?php esc_html_e( 'Accounts', 'wordpress-seo' ); ?></a>
		<a class="nav-tab" id="facebook-tab" href="#top#facebook"><span class="dashicons dashicons-facebook-alt"></span> <?php esc_html_e( 'Facebook', 'wordpress-seo' ); ?></a>
		<a class="nav-tab" id="twitterbox-tab" href="#top#twitterbox"><span class="dashicons dashicons-twitter"></span> <?php esc_html_e( 'Twitter', 'wordpress-seo' ); ?></a>
		<a class="nav-tab" id="pinterest-tab" href="#top#pinterest"><?php esc_html_e( 'Pinterest', 'wordpress-seo' ); ?></a>
		<a class="nav-tab" id="google-tab" href="#top#google"><span class="dashicons dashicons-googleplus"></span> <?php esc_html_e( 'Google+', 'wordpress-seo' ); ?></a>
	</h2>

	<div id="accounts" class="wpseotab">
		<p>
			<?php esc_html_e( 'To inform Google about your social profiles, we need to know their URLs.', 'wordpress-seo' ); ?>
			<?php esc_html_e( 'For each, pick the main account associated with this site and please enter them below:', 'wordpress-seo' ); ?>
		</p>
		<?php
		$yform->textinput( 'facebook_site', esc_html__( 'Facebook Page URL', 'wordpress-seo' ) );
		$yform->textinput( 'twitter_site', esc_html__( 'Twitter Username', 'wordpress-seo' ) );
		$yform->textinput( 'instagram_url', esc_html__( 'Instagram URL', 'wordpress-seo' ) );
		$yform->textinput( 'linkedin_url', esc_html__( 'LinkedIn URL', 'wordpress-seo' ) );
		$yform->textinput( 'myspace_url', esc_html__( 'MySpace URL', 'wordpress-seo' ) );
		$yform->textinput( 'pinterest_url', esc_html__( 'Pinterest URL', 'wordpress-seo' ) );
		$yform->textinput( 'youtube_url', esc_html__( 'YouTube URL', 'wordpress-seo' ) );
		$yform->textinput( 'google_plus_url', esc_html__( 'Google+ URL', 'wordpress-seo' ) );

		do_action( 'wpseo_admin_other_section' );
		?>
	</div>

	<div id="facebook" class="wpseotab">
		<p>
			<?php
				/* translators: %s expands to <code>&lt;head&gt;</code> */
				printf( esc_html__( 'Add Open Graph meta data to your site\'s %s section, Facebook and other social networks use this data when your pages are shared.', 'wordpress-seo' ), '<code>&lt;head&gt;</code>' );
			?>
		</p>
		<?php $yform->checkbox( 'opengraph', esc_html__( 'Add Open Graph meta data', 'wordpress-seo' ) ); ?>

		<?php
		if ( 'posts' == get_option( 'show_on_front' ) ) {
			echo '<p><strong>' . esc_html__( 'Frontpage settings', 'wordpress-seo' ) . '</strong></p>';
			echo '<p>' . esc_html__( 'These are the title, description and image used in the Open Graph meta tags on the front page of your site.', 'wordpress-seo' ) . '</p>';

			$yform->media_input( 'og_frontpage_image', esc_html__( 'Image URL', 'wordpress-seo' ) );
			$yform->textinput( 'og_frontpage_title', esc_html__( 'Title', 'wordpress-seo' ) );
			$yform->textinput( 'og_frontpage_desc', esc_html__( 'Description', 'wordpress-seo' ) );

			// Offer copying of meta description.
			$meta_options = get_option( 'wpseo_titles' );
			echo '<input type="hidden" id="meta_description" value="', esc_attr( $meta_options['metadesc-home-wpseo'] ), '" />';
			echo '<p class="label desc" style="border:0;"><a href="javascript:;" onclick="wpseoCopyHomeMeta();" class="button">', esc_html__( 'Copy home meta description', 'wordpress-seo' ), '</a></p>';

		} ?>

		<p><strong><?php esc_html_e( 'Default settings', 'wordpress-seo' ); ?></strong></p>
		<?php $yform->media_input( 'og_default_image', esc_html__( 'Image URL', 'wordpress-seo' ) ); ?>
		<p class="desc label">
			<?php esc_html_e( 'This image is used if the post/page being shared does not contain any images.', 'wordpress-seo' ); ?>
		</p>

		<?php $social_facebook->show_form(); ?>

		<?php do_action( 'wpseo_admin_opengraph_section' ); ?>
	</div>

	<div id="twitterbox" class="wpseotab">
		<p>
			<?php
			/* translators: %s expands to <code>&lt;head&gt;</code> */
			printf( esc_html__( 'Add Twitter card meta data to your site\'s %s section.', 'wordpress-seo' ), '<code>&lt;head&gt;</code>' );
			?>
		</p>

		<?php $yform->checkbox( 'twitter', esc_html__( 'Add Twitter card meta data', 'wordpress-seo' ) ); ?>

		<?php
		$yform->select( 'twitter_card_type', esc_html__( 'The default card type to use', 'wordpress-seo' ), WPSEO_Option_Social::$twitter_card_types );
		do_action( 'wpseo_admin_twitter_section' );
		?>
	</div>

	<div id="pinterest" class="wpseotab">
		<p>
			<?php esc_html_e( 'Pinterest uses Open Graph metadata just like Facebook, so be sure to keep the Open Graph checkbox on the Facebook tab checked if you want to optimize your site for Pinterest.', 'wordpress-seo' ); ?>
		</p>
		<p>
			<?php
				/* translators: %1$s / %2$s expands to a link to pinterest.com's help page. */
				printf( esc_html__( 'To %1$sverify your site with Pinterest%2$s, add the meta tag here:', 'wordpress-seo' ), '<a target="_blank" href="https://help.pinterest.com/en/articles/verify-your-website#meta_tag">', '</a>' );
			?>
		</p>

		<?php $yform->textinput( 'pinterestverify', esc_html__( 'Pinterest verification', 'wordpress-seo' ) ); ?>

		<?php
		do_action( 'wpseo_admin_pinterest_section' );
		?>
	</div>

	<div id="google" class="wpseotab">
		<p>
			<?php $yform->checkbox( 'googleplus', esc_html__( 'Add Google+ specific post meta data', 'wordpress-seo' ) ); ?>
		</p>

		<p><?php esc_html_e( 'If you have a Google+ page for your business, add that URL here and link it on your Google+ page\'s about page.', 'wordpress-seo' ); ?></p>

		<?php $yform->textinput( 'plus-publisher', esc_html__( 'Google Publisher Page', 'wordpress-seo' ) ); ?>

		<?php do_action( 'wpseo_admin_googleplus_section' ); ?>
	</div>

<?php
$yform->admin_footer();
