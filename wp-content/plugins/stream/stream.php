<?php   
    /* 
    Plugin Name: Stream Plugin
    Plugin URI: http://www.devdesks.com 
    Description: Plugin for adding live and recorded channels 
    Author:Adnan Hashmi
    Version: 1.0 
    Author URI: http://www.devdesks.com 
    */  
class Wp_stream_plugin{
	
	  		public $user_id;
		function __construct() {
			
			   add_action('save_post',array($this, 'myplugin_save_postdata'),$post->ID);
			   add_action('init',array($this, 'recorded_channel_register'));
		      // $this->user_id = $current_user->ID;
				add_action( 'add_meta_boxes', array($this, 'myplugin_add_custom_box'));
				add_action( 'init', array($this, 'Add_javascript_style'));
				add_action('post_edit_form_tag', array($this, 'post_edit_form_tag'));
				 add_shortcode( 'stream_addpost', array($this, 'shortcode') );
				 
				  //add_action('save_post',array($this, 'myplugin_save_postdata'),$post->ID);
		}
		
function inser_post($post)
{
	global $current_user;
	
	echo $current_user->ID;
	exit;
	//add_post_meta($post_id, $meta_key, $meta_value, $unique);
	
	
}
function shortcode($atts)
{
	//print_r($atts);
	//exit;
	 extract( shortcode_atts( array('post_type' => 'post'), $atts ) );

        ob_start();
		  if ( is_user_logged_in() ) {
            $this->submit_post();
		  }
		$content = ob_get_contents();
        ob_end_clean();

        return $content;
	
	
}

		function submit_post()
		{
			

       // ob_start();
			if ( isset($_POST['new_submit']) ) {
					 
						// do_action( 'myplugin_save_postdata', $post_id );
						// $this->myplugin_save_postdata( $post->ID);
					 $this->inser_post($_POST);
					}
        if ( is_user_logged_in() ) {
			
          // $this->myplugin_save_postdata( $post->ID);
      
			
			?>
			<form id="wpuf_new_post_form" name="wpuf_new_post_form" action="" enctype="multipart/form-data" method="POST">
                    <?php //wp_nonce_field( 'wpuf-add-post' ) ?>

                   
                            <label for="new-post-title">
                              Title <span class="required">*</span>
                            </label>
                            <input class="requiredField" type="text" value="<?php echo $title; ?>" name="wpuf_post_title" id="new-post-title" minlength="2">
                            <div class="clear"></div>
                           
                       
                        <?php //if ( wpuf_get_option( 'allow_cats' ) == 'on' ) { ?>
                           
                                <label for="new-post-cat" style="float:left">
                                   Select Category <span class="required">*</span>
                                </label>

                                <div class="category-wrap" style="float:left;">
                                    <div id="lvl0">
                                        <?php
                                      //  $exclude = wpuf_get_option( 'exclude_cats' );
                                       // $cat_type = wpuf_get_option( 'cat_type' );
									    $cat_type = 'normal';

                                        if ( $cat_type == 'normal' ) {
                                            wp_dropdown_categories( 'show_option_none=' . __( '-- Select --') . '&hierarchical=1&hide_empty=0&orderby=name&name=category[]&id=cat&show_count=0&title_li=&use_desc_for_title=1&class=cat requiredField' );
                                        } else if ( $cat_type == 'ajax' ) {
                                            wp_dropdown_categories( 'show_option_none=' . __( '-- Select --') . '&hierarchical=1&hide_empty=0&orderby=name&name=category[]&id=cat-ajax&show_count=0&title_li=&use_desc_for_title=1&class=cat requiredField&depth=1');
                                        } else {
                                           // wpuf_category_checklist(0, false, 'category', $exclude);
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="loading"></div>
                                <div class="clear"></div>
                                <p class="description"><?php //echo stripslashes( wpuf_get_option( 'cat_help' ) ); ?></p>
                          
                        <?php //} ?>

                        <?php //do_action( 'wpuf_add_post_form_description', $post_type ); ?>
                        <?php //wpuf_build_custom_field_form( 'description' ); ?>
             <label for="new-post-desc" style="float:left;">
                                Description &nbsp;
                            </label>

                            <?php
                            $editor = '';//wpuf_get_option( 'editor_type' );
                            if ( $editor == 'full' ) {
                                ?>
                                <div style="float:left;">
                                    <?php wp_editor( $description, 'new-post-desc', array('textarea_name' => 'wpuf_post_content', 'editor_class' => 'requiredField', 'teeny' => false, 'textarea_rows' => 8) ); ?>
                                </div>
                            <?php } else if ( $editor == 'rich' ) { ?>
                                <div style="float:left;">
                                    <?php wp_editor( $description, 'new-post-desc', array('textarea_name' => 'wpuf_post_content', 'editor_class' => 'requiredField', 'teeny' => true, 'textarea_rows' => 8) ); ?>
                                </div>

                            <?php } else { ?>
                                <textarea name="wpuf_post_content" class="requiredField" id="new-post-desc" cols="60" rows="8"><?php echo esc_textarea( $description ); ?></textarea>
                            <?php } ?>

                            <div class="clear"></div>
                           
                            <label>&nbsp;</label>
                            <input class="wpuf_submit" type="submit" name="wpuf_new_post_submit" value="<?php //echo esc_attr( wpuf_get_option( 'submit_label' ) ); ?>">
                            <input type="hidden" name="post_type" value="<?php echo $post_type; ?>" />
                            <input type="hidden" name="new_submit" value="yes" />
                       

                        <?php //do_action( 'wpuf_add_post_form_bottom', $post_type ); ?>

                </form>
			
			
		<?php 	
		 } else {
            printf( __( "This page is restricted. Please %s to view this page." ), wp_loginout( get_permalink(), false ) );
        }
		
		}
		function  Add_javascript_style()
		{
			define( 'STREAM_PLUGIN_URL', trailingslashit( str_replace( DIRECTORY_SEPARATOR, '/', str_replace( str_replace( '/', DIRECTORY_SEPARATOR, WP_CONTENT_DIR ), WP_CONTENT_URL, dirname(__FILE__) ) ) ) );
		
				wp_register_script( 'jquery_ui_core', STREAM_PLUGIN_URL . 'date_picker/development-bundle/ui/jquery.ui.core.js' );
				wp_register_script( 'jquery_datepicker', STREAM_PLUGIN_URL . 'date_picker/development-bundle/ui/jquery.ui.datepicker.js' );
				wp_register_script( 'all_js', STREAM_PLUGIN_URL . 'js/all.js' );
				wp_register_script( 'timepicker_js', STREAM_PLUGIN_URL . 'time_picker/jquery.timepicker.js' );
				
		  
				wp_enqueue_script( 'jquery_ui_core' );
				wp_enqueue_script( 'jquery_datepicker' );
				wp_enqueue_script( 'all_js' );
				wp_enqueue_script( 'timepicker_js' );
				
				wp_register_style( 'timepicker_style', STREAM_PLUGIN_URL . 'time_picker/jquery.timepicker.css"');
				wp_register_style( 'datepicker_style', STREAM_PLUGIN_URL . 'date_picker/development-bundle/themes/base/jquery.ui.all.css"');
				wp_enqueue_style( 'datepicker_style' );
				wp_enqueue_style( 'timepicker_style' );
		  
		}
	
  
  
function recorded_channel_register() {
	$labels = array(
		'name' => _x('Recorded Channels', 'post type general name'),
		'singular_name' => _x('Recorded Channel', 'post type singular name'),
		'add_new' => _x('Add New', 'Recorded Channel'),
		'add_new_item' => __('Add New Recorded Channel'),
		'edit_item' => __('Edit Recorded Channel'),
		'new_item' => __('New Recorded Channel'),
		'view_item' => __('View Recorded Channel'),
		'search_items' => __('Search Recorded Channel'),
		'not_found' =>  __('Nothing found'),
		'not_found_in_trash' => __('Nothing found in Trash'),
		'parent_item_colon' => ''
	);
 
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'taxonomies' => array('category'),
		'menu_icon' => plugins_url( 'images/icon_video.gif', __FILE__ ),
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' =>5,
		'supports' => array('title','editor','thumbnail'),
		'rewrite' => array("slug" => "r_channel"), // Permalinks format
       // 'register_meta_box_cb' => 'add_events_metaboxes'

	  ); 
 
	register_post_type( 'recorded' , $args );
	
}


// backwards compatible (before WP 3.0)
// add_action( 'admin_init', 'myplugin_add_custom_box', 1 );

/* Do something with the data entered */
//add_action( 'save_post', 'myplugin_save_postdata' );

/* Adds a box to the main column on the Post and Page edit screens */
function myplugin_add_custom_box() {
    $screens = array('recorded' );
    foreach ($screens as $screen) {
        add_meta_box(
            'myplugin_sectionid',
            __( 'Additional Info For Recorded Channel', 'myplugin_textdomain' ),
             array($this, 'myplugin_inner_custom_box'),
            $screen
        );
    }
}
/*********************************** for adding Multipart/form_data for file upload***********************/

function post_edit_form_tag() {
    echo ' enctype="multipart/form-data"';
}
/*********************************** for adding Multipart/form_data for file upload***********************/

	/* Prints the box content */
	function myplugin_inner_custom_box( $post ) 
	{
		
		
		 global $post;

		
		  // Use nonce for verification
		  wp_nonce_field( plugin_basename( __FILE__ ), 'myplugin_noncename' );
		echo '<input type="hidden" name="wp_meta_box_nonce" value="', wp_create_nonce( basename(__FILE__) ), '" />';
		  // The actual fields for data entry
		  // Use get_post_meta to retrieve an existing value from the database and use the value for the form
		 /* $value = get_post_meta( $post->ID, '_my_meta_value_key', true );
		  echo '<label for="myplugin_new_field">';
			   _e("Description for this field", 'myplugin_textdomain' );
		  echo '</label> ';
		  echo '<input type="text" id="myplugin_new_field" name="myplugin_new_field" value="'.esc_attr($value).'" size="25" />';*/
		 
		 
		 echo '<table>
		 <tbody>
		 <tr>
		 ';
		 
		  $date_val =  get_post_meta( $post->ID, 'date_', true );
		  echo '
		  <td>
		  <label for="datepicker">';
			   _e("Select Date", 'myplugin_textdomain' );
		  echo '</label> </td> ';
		  echo '
		   <td> <input class="cmb_text_small" type="text" name="date_" id="datepicker" value="'.esc_attr($date_val).'" />
		  
		</td> </tr> ';
		    $time_val =  get_post_meta( $post->ID, 'time_', true );
		   echo '<tr>
		   <td><label for="time_picker">';
			   _e("Select Time", 'myplugin_textdomain' );
		  echo '</label></td> ';
		  echo '<td><input class="cmb_text_small" type="text" name="time_" id="time_picker" value="'.esc_attr($time_val).'" /></td></tr>';
		  
		  $file_ = get_post_meta($post->ID, 'avatar_', true); 
		 // print_r( $file_);
		  //exit;
		  @$file_url =  @$file_['url'];
		   echo '<tr><td><label for="avatar">';
			   _e("Select Avatar", 'myplugin_textdomain' );
		  echo '</label> </td>';
		  echo '<td><input  type="file" name="avatar_" id="avatar" />
		  <img src="'.@$file_url.'" width="100" height="80"/>
		  </td>
		  </tr>
		  ';
		  
		  echo '</tbody>
		  </table>';
	}


/* When the post is saved, saves our custom data */
function myplugin_save_postdata( $post_id ) 
{
	
	  // First we need to check if the current user is authorised to do this action. 
	  if ( 'page' == $_POST['post_type'] ) {
		if ( ! current_user_can( 'edit_page', $post_id ))
			return;
	  } else {
		if ( ! current_user_can( 'edit_post', $post_id ))
			return;
	  }
	
	  // Secondly we need to check if the user intended to change this value.
	  if ( ! isset( $_POST['myplugin_noncename'] ) || ! wp_verify_nonce( $_POST['myplugin_noncename'], plugin_basename( __FILE__ ) ) )
		  return;
	  $post_ID = $_POST['post_ID'];
	  //sanitize user input
	 // $mydata['_my_meta_value_key'] = sanitize_text_field( $_POST['myplugin_new_field'] );
	 
	 /********************************************* file upload code **********************************************/
		//print_r($_FILES);
		//exit; 
		if(!empty($_FILES['avatar_']['name'])) { 
         
        $supported_types = array('image/png',
								 'image/jpeg',
								 'image/gif',
								 'image/bmp');  
          
        // Get the file type of the upload  
        $arr_file_type = wp_check_filetype(basename($_FILES['avatar_']['name']));  
        $uploaded_type = $arr_file_type['type'];  
   
        // Check if the type is supported. If not, throw an error.  
        if(in_array($uploaded_type, $supported_types)) {  
  
            // Use the WordPress API to upload the file  
            $upload = wp_upload_bits($_FILES['avatar_']['name'], null, file_get_contents($_FILES['avatar_']['tmp_name']));  
      
            if(isset($upload['error']) && $upload['error'] != 0) {  
		
                wp_die('There was an error uploading your file. The error is: ' . $upload['error']);  
            } else { 
			
                add_post_meta($post_ID, 'avatar_', $upload);  
                update_post_meta($post_ID, 'avatar_', $upload);       
            } // end if/else  

        } else {  
            wp_die("The file type that you've uploaded is not a PDF.");  
        } // end if/else  
          
    } // end if  
		/***************************************************** end file upload code *********************************/
	   $mydata['date_'] = sanitize_text_field( $_POST['date_'] );
	   $mydata['time_'] = sanitize_text_field( $_POST['time_'] );
	  // Do something with $mydata 
	  // either using 
	   foreach ($mydata as $key => $value) { // Cycle through the $events_meta array!
		if(get_post_meta( $post_ID, $key, FALSE)) { // If the custom field already has a value
	
			  update_post_meta( $post_ID, $key, $value);
	
			} else { // If the custom field doesn't have a value
	
				 add_post_meta( $post_ID, $key, $value);
	
			}
	
			 if(!$value) delete_post_meta($post_ID, $key); // Delete if blank
	
		}
		
		
	
	
	 // add_post_meta($post_ID, '_my_meta_value_key', $mydata, true) ;
	  // or a custom table (see Further Reading section below)
	}


	}
	
	$Stream_obj = new Wp_stream_plugin();
?> 
