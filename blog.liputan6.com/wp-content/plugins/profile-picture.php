<?php
/*
Plugin Name: Author Profile Picture
Plugin URI: http://geekgrl.net/2007/01/02/profile-pics-plugin-release/
Description: Adds picture to Author profile
Version: 0.1
Author: Hannah Gray
Author URI: http://geekgrl.net
*/

// Get stored options -- substitute defaults if none exist
$profile_picture_options = get_option("profile_picture_options");
$image_dir = (isset($profile_picture_options['image_dir']) && ($profile_picture_options['image_dir'] != '') ? $profile_picture_options['image_dir'] : '/wp-content/uploads/authors/');
$image_extensions = (isset($profile_picture_options['image_extensions']) && ($profile_picture_options['image_extensions'] != '')?  $profile_picture_options['image_extensions'] : 'gif png jpg');
$image_default = (isset($profile_picture_options['image_default']) && ($profile_picture_options['image_default'] != '') ?  $profile_picture_options['image_default'] : 'default.jpg');
$gravatar_width = (isset($profile_picture_options['gravatar_width']) && ($profile_picture_options['gravatar_width'] != '') ?  $profile_picture_options['gravatar_width'] : '80');

// Add actions to appropriete hooks
add_action('show_user_profile', 'add_userpic_fields');
add_action('profile_update','upload_pic',1);
add_action('admin_menu', 'profile_picture_config');

//*** GUI FUNCTION: add menu item for plugin config to Options page
function profile_picture_config() {
	global $wpdb;
	if (function_exists('add_options_page')){
		add_options_page('Profile Picture', 'Profile Picture', 8, __FILE__, 'profile_picture_conf_page');
	}
}

//*** GUI FUNCTION: Show config form
function profile_picture_conf_page() {
	global $image_dir, $image_extensions, $gravatar_width, $image_default;
?>
	<div class="wrap">
	<h2>Profile Picture Options</h2>	
<?php 
	// if submit was pressed, process config data
	if ( isset($_POST['submit']) ) {
		// check user permissions
		if ( !current_user_can('manage_options') ) {
			die(__('Cheatin&#8217; uh?'));
		// if okay, store data
		} else {
			$profile_picture_options = array();
			$profile_picture_options['image_extensions'] = (isset($_POST['image_extensions']) ? strtolower($_POST['image_extensions']) : '');
			$profile_picture_options['image_dir'] = (isset($_POST['image_dir']) ? $_POST['image_dir'] : '');
			$profile_picture_options['image_default'] = (isset($_POST['image_default']) ? $_POST['image_default'] : '');
			$profile_picture_options['gravatar_width'] = (isset($_POST['gravatar_width']) ? $_POST['gravatar_width'] : '');
			update_option('profile_picture_options', $profile_picture_options);
			echo "<b>Settings saved</b>";
		}
	// if submit not pressed, display config options
	} else {
	
?>
		
		<form action="" method="post" id="picture_uploader" style="margin: auto;">
		<p><b><label>Profile Pics Upload Directory: * </label></b><input size="45" name='image_dir' value='<?php _e(($image_dir == "") ? "wp-content/uploads/authors/" : $image_dir); ?>' style="font-family: 'Courier New', Courier, mono;" /><br />
		Recommended: wp-content/uploads/authors/  &nbsp; *must be set to chmod 777 </p>

		<p><b><label>Allowed File Extensions: </label></b><input size="45" name='image_extensions' value='<?php _e(($image_extensions == "") ? 'png gif jpg' : $image_extensions); ?>' style="font-family: 'Courier New', Courier, mono;" /><br />
		Seperate each three digit extension with a space; field is case-insensitive</p>
		
		<p><b><label>Standard Width for Comment Author "Gravatar": </label></b><input size="45" name='gravatar_width' value='<?php _e(($gravatar_width == "") ? '80' : $gravatar_width); ?>' style="font-family: 'Courier New', Courier, mono;" /><br />
		Width in px</p>
		
		<p><b><label>Default Image: </label></b><input size="45" name='image_default' value='<?php _e(($image_default == "") ? 'default.jpg': $image_default); ?>' style="font-family: 'Courier New', Courier, mono;" /><br />
		Must be stored in the profile pics directory specified above</p>
		
		<p class="submit"><input type="submit" name="submit" value="<?php _e('Update Settings&raquo;'); ?>" /></p>
		</form>
		</div>
<?php
	}
}

//*** GUI FUNCTION: displays "add picture" box when editing your profile
function add_userpic_fields() {
	global $user_ID, $image_extensions;

	// build extension check string for the js
	$image_extensions_array = explode(' ', $image_extensions);
	$checkstr = "";
	foreach ($image_extensions_array as $count => $exe) {
		$checkstr .= "(ext != '.$exe') && ";
	}
	$checkstr = rtrim($checkstr, ' && ');

	// HTML GUI, js changes form encoding and adds error check
	?>
		<script type="text/javascript" language="javascript">
		<!--
		
		function uploadPic() {
			document.profile.enctype = "multipart/form-data";
			var upload = document.profile.picture.value;
			upload = upload.toLowerCase();
			var ext = upload.substring((upload.length-4),(upload.length));
				if (<?php _e($checkstr) ?>){
					alert('Please upload an image with one of the following extentions: <?php _e($image_extensions); ?>');
					
				}
		}
		//-->
		</script>
		<fieldset>
		<legend>Profile Picture</legend>
		<p><label>Current: <br />
		<img src="<?php _e(author_image_path($user_ID)); ?>" width="150" /><br /></label></p>
		<p><label>Upload a New Picture:  <input type="file" name="picture" onchange="uploadPic();" /><br />
		</label></p>
		</fieldset>
	<?php
}

//*** INTERNAL FUNCTION: stores pic submitted via profile editing page
function upload_pic() {
	global $image_dir, $user_ID, $image_extensions;
	
	$raw_name = (isset($_FILES['picture']['name'])) ? $_FILES['picture']['name'] : "";	
	// if file was sumbitted, continue
	if ($raw_name != "") {
		// delete previous image if it's there
		$image_extensions_array = explode(' ', $image_extensions);
		foreach ($image_extensions_array as $image_extension) {
			$old_pic_path = clean_path(ABSPATH . '/' . $image_dir . '/' . $user_ID . '.' . $image_extension);
			if ( file_exists($old_pic_path) ) { 
				unlink($old_pic_path);
			}
		}
		// build the path and filename 		
		$clean_name = ereg_replace("[^a-z0-9._]", "", ereg_replace(" ", "_", ereg_replace("%20", "_", strtolower($raw_name))));
		$file_ext = substr(strrchr($clean_name, "."), 1);
		$file_path = clean_path(ABSPATH . '/' . $image_dir . '/' . $user_ID . '.' . $file_ext);
	// store file
		move_uploaded_file($_FILES['picture']['tmp_name'], $file_path);
	} else {
		return false;
	}
}

//*** TEMPLATE FUNCTION: returns requested dimension from specific image
//    USAGE: 
//		path: absolute path to image from server root', 
//		dimension: the dimension you want, can be either 'height' or width'
//		display: display results (ie. echo)? true or false
function author_image_dimensions($path, $dimension, $display = false) {
	$size = getimagesize($path);
	$width = $size[0];
	$height = $size[1];
	
	switch ($dimension) {
		case 'width':
			if ($display) { echo $width; } else { return $width; }
			break;
		case 'height':
			if ($display) { echo $height; } else { return $height; }
			break;
	}
}



//*** TEMPLATE FUNCTION: returns image for comment author
//    USAGE: 
//		authorID: id number of author
//		tags: attributes to include in img tag (optional, defaults to no tags)
function author_gravatar_tag($authorID, $tags = '') {
	global $gravatar_width;
	if ($authorID != 0) {
		$path = author_image_path($authorID, false, 'absolute');
		$width = $gravatar_width;
		$height = author_image_dimensions($path, 'height') * ($gravatar_width / author_image_dimensions($path, 'width'));
		$tag = '<img src="' . author_image_path($authorID, false, 'url') . '" width=' . $width . ' height=' . $height . ' '. $tags . ' />';
		return $tag;
	} else {
		return false;
	}
}


//*** TEMPLATE FUNCTION: returns image for author wrapped in image tag
//    USAGE: 
//		authorID: id number of author
//		tags: attributes to include in img tag (optional, defaults to no tags)
//		display: display results (ie. echo)? true or false (optional, defaults to true)
function author_image_tag($authorID, $tags = '', $display = true) {
	$path = author_image_path($authorID, false, 'absolute');
	$width = author_image_dimensions($path, 'width');
	$height = author_image_dimensions($path, 'height');
	$tag = '<img src="' . author_image_path($authorID, false, 'url') . '" width=' . $width . ' height=' . $height . ' '. $tags . ' ' . ' id="authorpic" />';
	if ($display) { echo $tag; } else { return $tag; }
}

//*** TEMPLATE FUNCTION: returns url or absolute path to author's picture
//    USAGE: 
//		authorID: id number of author
//		display: display results (ie. echo)? true or false (optional, defaults to true)
//		type: specify what kind of path requested: 'url' or 'absolute' (optional, defaults to url)
function author_image_path($authorID, $display = true, $type = 'url') {
	switch($type) {
		case 'url' :
			$ref =  clean_path(get_settings('siteurl') . pick_image($authorID));
			if ($display) { echo $ref; } else { return $ref; }
			break;
		case 'absolute':
			$ref =  clean_path(ABSPATH . pick_image($authorID));
			if ($display) { echo $ref; } else { return $ref; }
			break;
	}
} 


//*** INTERNAL FUNCTION: strips extra slashes from paths; means user-end 
//    configuration is not picky about leading and trailing slashes
function clean_path($dirty_path) {
	$nasties = array(1 => "///", 2 => "//", 3 => "http:/");
	$cleanies = array(1 => "/", 2 => "/", 3 => "http://");
	$clean_path = str_replace($nasties, $cleanies, $dirty_path);
	return $clean_path;
}

//*** INTERNAL FUNCTION: finds the appropriete path to the author's picture
function pick_image($authorID) {
	global $image_dir, $image_extensions, $image_default;
	$image_extensions_array = explode(' ', $image_extensions);
	// look for image file based on user id
	$path = "";
	foreach ($image_extensions_array as $image_extension) {
		$path_fragment = '/' . $image_dir . '/' . $authorID . '.' . $image_extension;
		$path_to_check = clean_path(ABSPATH . $path_fragment);
		if ( file_exists($path_to_check) ) { 
			$path = $path_fragment;
			break;
		}
	}
	// if not found, use default
	if ($path == "") {
		$path = '/' . $image_dir . '/' . $image_default;
	}
	return $path;
}
?>