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
		add_action( 'edit_user_profile', array( $this, 'user_edit_render' ) );
		add_action( 'profile_update', array( $this, 'process_edit' ), 10, 2 );
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
	
	function process_edit( $user_id ) {
		if ( empty( $_POST['username-edit'] ) )
			return $errors;
		
		if ( $this->change_username( $user_id, $_POST['username-edit'] ) )
			return true;
		
		return false;		
	}
	
	function change_username( $user_id, $new_username ) {
		global $wpdb;
		
		if ( empty( $user_id ) || empty( $new_username ) )
			return false;
		
		$new_username = sanitize_user( $new_username, true );
		
		if ( username_exists( $new_username ) )
			return new WP_Error('existing_user_login', __('This username is already registered.') );
		
		$sql = $wpdb->prepare( "UPDATE {$wpdb->users} SET user_login = %s, user_nicename = %s WHERE ID = %s;", $new_username, $new_username, $user_id );
		$result = $wpdb->query( $sql );
		
		//die();
	
		if ( $result )
			return true;

		return false;	
	}
}

$bbg_username_edit = new BBG_Username_Edit;

?>