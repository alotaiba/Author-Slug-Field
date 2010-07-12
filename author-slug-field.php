<?php
/*
Plugin Name: Author Slug Field
Plugin URI: http://www.almashroo.com/projects/wordpress/plugins/author-slug-field/en/
Description: This plugin will add a new field in the profile page to enable you to edit the user_nicename field which controls the URL of authors home page
Version: 1.0
Author: Almashroo Development Team
Author URI: http://www.almashroo.com
Text Domain: asf

Copyright 2009  Almashroo  (email : contact@almashroo.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
define( 'ASF_VERSION', '1.0' );
define( 'ASF_FOLDER', plugin_basename( dirname( __FILE__ )) );
load_plugin_textdomain( 'asf', false, ASF_FOLDER . '/lang' );

function author_slug_field() {
	global $user_id;
	global $profileuser;
?>

    <!-- Author Slug profile field HTML -->
    <table class="form-table">
    <h3><?php _e('Author Slug', 'asf'); ?></h3>
    <tr>
        <th><label for="nicename"><?php _e('Author Slug', 'asf'); ?></label></th>
        <td><input type="text" name="nicename" id="nicename" value="<?php echo esc_attr($profileuser->user_nicename); ?>" class="regular-text" />
        <span class="description"><?php _e('This slug will be used in the URL of the author\'s page', 'asf'); ?></span>
        </td>
    </tr>
    </table>

<?php
} // End author_slug_field

function save_author_slug_field() {
	global $user_id;
	$author_slug = sanitize_title( $_POST['nicename'] );
	$update_data = array(
		'ID' => $user_id,
		'user_nicename' => $author_slug
	);
	wp_update_user($update_data);
}

// Add it to the profile page
add_filter('show_user_profile','author_slug_field');
add_action('edit_user_profile', 'author_slug_field');
add_action('personal_options_update', 'save_author_slug_field');
add_action('edit_user_profile_update', 'save_author_slug_field');

