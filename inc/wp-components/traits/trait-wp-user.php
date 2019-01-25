<?php
/**
 * WP_User trait.
 *
 * @package WP_Components
 */

namespace WP_Components;

/**
 * WP_User trait.
 */
trait WP_User {

	/**
	 * User object.
	 *
	 * @var null|\WP_User
	 */
	public $user = null;

	/**
	 * Get the user ID.
	 *
	 * @return int
	 */
	public function get_user_id() {
		return absint( $this->user->ID ?? 0 );
	}

	/**
	 * Set the user object.
	 *
	 * @param mixed $user User object, user ID, or null to use global $user
	 *                    object.
	 */
	public function set_user( $user = null ) {

		// Post was passed.
		if ( $user instanceof \WP_User ) {
			$this->user = $user;
			$this->user_has_set();
			return $this;
		}

		// Use global $user.
		if ( is_null( $user ) ) {
			global $user;
			$this->user = $user;
			$this->user_has_set();
			return $this;
		}

		// user ID was passed.
		if ( 0 !== absint( $user ) ) {
			$this->set_user( get_user( $user ) );
			$this->user_has_set();
			return $this;
		}

		// Something else went wrong.
		// @todo deuserine how to handle error messages.
		return $this;
	}

	/**
	 * Callback function for classes to override.
	 */
	public function user_has_set() {
		// Silence is golden.
	}
}
