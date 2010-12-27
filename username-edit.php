<?php
/*
Plugin Name: Username Edit
Author: boonebgorges
Author URL: http://boonebgorges.com
Description: Edit usernames
Version: 0.1
*/

class BBG_Username_Edit {

	/**
	 * PHP5 constructor
	 *
	 * @package Username Edit
	 * @since 0.1
	 */
	function __construct() {
		$this->bbg_username_edit();
	}
	
	/**
	 * PHP4 constructor
	 *
	 * @package Username Edit
	 * @since 0.1
	 */
	function bbg_username_edit() {
		$this->hooks();
	}
	
	/**
	 * Hooks UE actions to WP hooks
	 *
	 * @package Username Edit
	 * @since 0.1
	 */
	function hooks() {
		add_action( 'show_user_profile', array( $this, 'user_edit_render' ) );
	}
	
	/**
	 * Renders the HTML on the Edit User page
	 *
	 * @package Username Edit
	 * @since 0.1
	 *
	 * @global $profileuser The user whose profile edit screen is currently being viewed
	 */
	function user_edit_render() {
		global $profileuser;
		
		?>
		
		<h3><?php _e( 'Username Edit' ) ?></h3>
		
		<table class="form-table">
			<tr>
				<th><label for="username-edit"><?php _e( 'Username' ) ?></label></th>
				<td><input type="text" name="username-edit" id="username-edit" value="<?php echo esc_attr($profileuser->user_login); ?>" class="regular-text" /></td>
			</tr>
		</table>
		
		<?php
	}
}

$bbg_username_edit = new BBG_Username_Edit;

?>