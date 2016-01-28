<?php
/**
 * @package WPSEO\Admin|Google_Search_Console
 */

/**
 * Class WPSEO_GSC_Platform_Tabs
 */
class WPSEO_GSC_Platform_Tabs {

	/**
	 * @var string
	 */
	private $current_tab;

	/**
	 * Return the tabs as a string
	 *
	 * @return string
	 */
	public function __toString() {
		return $this->platform_tabs();
	}

	/**
	 * Getting the current_tab
	 *
	 * @return string
	 */
	public function current_tab() {
		return $this->current_tab;
	}

	/**
	 * Loops through the array with all the platforms and convert it into an array
	 *
	 * @return string
	 */
	private function platform_tabs() {
		$tabs = array( 'settings' => esc_html__( 'Settings', 'wordpress-seo' ) );

		$platforms = array(
			'web'             => esc_html__( 'Desktop', 'wordpress-seo' ),
			'smartphone_only' => esc_html__( 'Smartphone', 'wordpress-seo' ),
			'mobile'          => esc_html__( 'Feature phone', 'wordpress-seo' ),
		);

		if ( WPSEO_GSC_Settings::get_profile() !== '' ) {
			$tabs = array_merge( $platforms, $tabs );
		}

		$admin_link = admin_url( 'admin.php?page=wpseo_search_console&tab=' );

		$this->set_current_tab( $tabs );

		$return = '';

		foreach ( $tabs as $platform_target => $platform_value ) {
			$return .= $this->platform_tab( $platform_target, $platform_value, $admin_link );
		}

		return $return;
	}

	/**
	 * Setting the current tab
	 *
	 * @param array $platforms Set of platforms (desktop, mobile, feature phone).
	 */
	private function set_current_tab( array $platforms ) {
		$this->current_tab = key( $platforms );
		if ( $current_platform = filter_input( INPUT_GET, 'tab' ) ) {
			$this->current_tab = $current_platform;
		}
	}

	/**
	 * Parses the tab
	 *
	 * @param string $platform_target Platform (desktop, mobile, feature phone).
	 * @param string $platform_value  Link anchor.
	 * @param string $admin_link      Link URL admin base.
	 *
	 * @return string
	 */
	private function platform_tab( $platform_target, $platform_value, $admin_link ) {
		$active = '';
		if ( $this->current_tab === $platform_target ) {
			$active = ' nav-tab-active';
		}

		return '<a class="nav-tab ' . $active . '" id="' . $platform_target . '-tab" href="' . $admin_link . $platform_target . '">' . $platform_value . '</a>';
	}
}
