<?php
/*
Plugin Name: Username Edit
Author: boonebgorges
Author URL: http://boonebgorges.com
Description: Edit usernames
Version: 0.1
*/

class BBG_Username_Edit {
	function __construct() {
		$this->bbg_username_edit();
	}
	
	function bbg_username_edit() {
		$this->admin_hooks;
	}
	
	function admin_hooks() {
		if ( function_exists('add_submenu_page') )
			add_submenu_page( 'plugins.php', __( 'Username Edit', 'bbg_ue' ), __( 'Username Edit', 'bbg_ue' ), 'edit_users', 'username-edit', array( $this, 'admin_render' ) );
	}
	
	function admin_render() {
		echo 'hnnht';
	}
}

$bbg_username_edit = new BBG_Username_Edit;

?>