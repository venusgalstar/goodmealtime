<?php
class foodota_Demo_OCDI
{
    function __construct()
    {
        add_filter('pt-ocdi/import_files', array($this, 'foodota_ocdi_import_files'));
        add_action('pt-ocdi/after_import', array($this, 'foodota_ocdi_after_import'));
        add_filter('pt-ocdi/plugin_intro_text', array($this, 'foodota_ocdi_plugin_intro_text'));
        //add_filter('pt-ocdi/plugin_intro_text', array($this, 'foodota_framework_importer_description_config'));
        add_filter('pt-ocdi/disable_pt_branding', array($this, '__return_true'));
        //add_action('pt-ocdi/enable_wp_customize_save_hooks', '__return_true');
    }

    function foodota_ocdi_before_content_import($a)
    {
        $msg = '';
        $fresh_installation = (array)get_option('_foodota_ocdi_demos');
        if (in_array("$a", $fresh_installation)) {
            $msg = __('Note: This demo data is already imported.', 'redux-framework');
            $msg = "<strong style='color:red;'>" . $msg . "</strong><br />";
        }
        return $msg;
    }

    function foodota_ocdi_options($demo_type = array())
    {
        if (isset($demo_type)) {
            $fresh_installation = (array)get_option('_foodota_ocdi_demos');
            $result = array_merge($fresh_installation, $demo_type);
            $result = array_unique($result);
            update_option('_foodota_ocdi_demos', $result);
        }
        $fresh_installation = (array)get_option('_foodota_ocdi_demos');

    }

    function foodota_ocdi_import_files()
    {


        /* LTR Demo Options */
        $text = " - " . __('Imported', 'redux-framework') . "";
        // $text = "";

        $notice = $this->foodota_ocdi_before_content_import('FoodotaDemo1');
        $notice1 = ($notice != "") ? $text : "";
        $allDemos[] = array(
            'import_file_name' => 'FoodotaDemo1' . $notice1,
            'categories' => array('LTR Demo'),
            'local_import_file' => FOOD_PLUGIN_FRAMEWORK_PATH . 'demo-data/FoodotaDemo1/content.xml',
            'local_import_widget_file' => FOOD_PLUGIN_FRAMEWORK_PATH . 'demo-data/FoodotaDemo1/widgets.json',
            'local_import_customizer_file' => FOOD_PLUGIN_FRAMEWORK_PATH . 'demo-data/FoodotaDemo1/customizer.dat',
            'local_import_redux' => array(
                array('file_path' => FOOD_PLUGIN_FRAMEWORK_PATH . 'demo-data/FoodotaDemo1/theme-options.json', 'option_name' => 'foodota_options',),),
            'import_preview_image_url' => FOOD_PLUGIN_URL . 'demo-data/FoodotaDemo1/demo1.jpg',
            'import_notice' => $notice . '<br />' . __('Please waiting for a few minutes, do not close the window or refresh the page until the data is imported.', 'redux-framework'),
            'preview_url' => 'https://marketplace.foodotawp.com/',
        );
        $notice = $this->foodota_ocdi_before_content_import('Foodotashop');
        $notice1 = ($notice != "") ? $text : "";
        $allDemos[] = array(
            'import_file_name' => 'Foodotashop' . $notice1,
            'categories' => array('LTR Demo'),
            'local_import_file' => FOOD_PLUGIN_FRAMEWORK_PATH . 'demo-data/Foodotashop/content.xml',
            'local_import_widget_file' => FOOD_PLUGIN_FRAMEWORK_PATH . 'demo-data/Foodotashop/widgets.json',
            'local_import_customizer_file' => FOOD_PLUGIN_FRAMEWORK_PATH . 'demo-data/Foodotashop/customizer.dat',
            'local_import_redux' => array(
                array('file_path' => FOOD_PLUGIN_FRAMEWORK_PATH . 'demo-data/Foodotashop/theme-options.json', 'option_name' => 'foodota_options',),),
            'import_preview_image_url' => FOOD_PLUGIN_URL . 'demo-data/Foodotashop/shop.jpg',
            'import_notice' => $notice . '<br />' . __('Please waiting for a few minutes, do not close the window or refresh the page until the data is imported.', 'redux-framework'),
            'preview_url' => 'https://marketplace.foodotawp.com/',
        );

        return $allDemos;


    }


    function foodota_ocdi_after_import($selected_import)
    {
        if ('FoodotaDemo1' === $selected_import['import_file_name']) {
            $primary_menu = get_term_by('name', 'Main Menu', 'nav_menu');
            if (isset($primary_menu->term_id)) {
                set_theme_mod('nav_menu_locations', array('main_theme_menu' => $primary_menu->term_id));
            }
            /* Assign front page and posts page (blog page). */
            $front_page_id = get_page_by_title('Main Home');
            $blog_page_id = get_page_by_title('Blog');
            update_option('show_on_front', 'Page');
            update_option('page_on_front', $front_page_id->ID);
            update_option('page_for_posts', $blog_page_id->ID);
            $this->foodota_ocdi_options(array('FoodotaDemo1'));

            $url = FOOD_PLUGIN_FRAMEWORK_PATH . '/demo-data/FoodotaDemo1/userexport.csv';
            $file = fopen($url, "r");
            $user_data = fgetcsv($file);
            $user_array = array(3,4);
            while (($data = fgetcsv($file)) !== FALSE) {
                $user_login = isset($data[0]) ? $data[0] : '';
                $user_email = isset($data[1]) ? $data[1] : '';
                $user_pass = isset($data[3]) ? $data[3] : '';
                $user_nice = isset($data[4]) ? $data[4] : '';
                $user_display = isset($data[7]) ? $data[7] : '';
                $user_role = isset($data[8]) ? $data[8] : '';
                $user_nickname = isset($data[9]) ? $data[9] : '';
                $user_id = wp_insert_user(array(
                    'user_login' => $user_login,
                    'user_email' => $user_email,
                    'user_pass' => $user_pass,
                    'user_nicename' => $user_nice,
                    'display_name' => $user_display,
                    'role' => $user_role,
                    'nickname' => $user_nickname,
                ));
                $wcfm_user_meta = unserialize($data[48]); /*need to unserialize the meta data first*/
                $wcfm_hours_meta = unserialize($data[57]); /*need to unserialize the meta data first*/
                if (!is_wp_error($user_id)) {
                    update_user_meta($user_id, 'wcfmmp_profile_settings', $wcfm_user_meta);
                    update_user_meta($user_id, '_store_description', $data[49]);
                    update_user_meta($user_id, 'wcfm_vendor_store_hours', $wcfm_hours_meta);
                    array_push($user_array, $user_id);
                }
            }
            fclose($file);
            if (!empty($user_array)) {
                $productargs = array(
                    'post_type'      => 'product',
                    'posts_per_page' => -1,
                );
                $product_ids = new WP_Query( $productargs );
                $count_product = 1;
                $i = 0;
                echo "out form while loop";
                while ( $product_ids->have_posts() ) : $product_ids->the_post();
                    global $product;
                    $pid=get_the_ID();
                    echo "in while loop";
                    $arg = array(
                        'ID' => $pid,
                        'post_author' => isset($user_array[$i]) ? $user_array[$i] : 1,
                    );
                    wp_update_post($arg);
                    if ($count_product % 18 == 0) {
                        $i++;
                    }
                    $count_product++;
                endwhile;
                wp_reset_query();
            }
        }

        if ('Foodotashop' === $selected_import['import_file_name']) {
            $primary_menu = get_term_by('name', 'Main Menu', 'nav_menu');
            if (isset($primary_menu->term_id)) {
                set_theme_mod('nav_menu_locations', array('main_theme_menu' => $primary_menu->term_id));
            }
            /* Assign front page and posts page (blog page). */
            $front_page_id = get_page_by_title('Product Main');
            $blog_page_id = get_page_by_title('Blog');
            update_option('show_on_front', 'Page');
            update_option('page_on_front', $front_page_id->ID);
            update_option('page_for_posts', $blog_page_id->ID);
            $this->foodota_ocdi_options(array('FoodotaDemo1'));

            if (in_array('wc-multivendor-marketplace/wc-multivendor-marketplace.php', apply_filters('active_plugins', get_option('active_plugins'))) || in_array('wc-frontend-manager/wc_frontend_manager.php', apply_filters('active_plugins', get_option('active_plugins'))) || in_array('wc-multivendor-membership/wc-multivendor-membership.php', apply_filters('active_plugins', get_option('active_plugins'))) ) {
                deactivate_plugins('/wc-frontend-manager/wc_frontend_manager.php');
                deactivate_plugins('/wc-multivendor-marketplace/wc-multivendor-marketplace.php');
                deactivate_plugins('/wc-multivendor-membership/wc-multivendor-membership.php');
            }

        }




        global $wp_rewrite;
        $wp_rewrite->set_permalink_structure('/%postname%/');
    }

    function foodota_ocdi_plugin_intro_text($default_text)
    {
        $default_text .= '<div class="ocdi__intro-text"><h4 id="before">Before Importing Demo</h4>
            	<p><strong>Before importing one of the demos available it is advisable to check the following list</strong>. <br />All these queues are important and will ensure that the import of a demo ends successfully. In the event that something should go wrong with your import, open a ticket and <a href="https://scriptsbundle.ticksy.com/" target="_blank">contact our Technical Support</a>.</p>
            	<ul>
            	<li><strong>Theme Activation</strong> – Please make sure to activate the theme to be able to access the demo import section</li>
            	<li><strong>Required Plugins</strong> – Install and activate all required plugins</li>
            	<li><strong>Other Plugins</strong> – Is recommended to <strong>disable all other plugins that are not required</strong>. Such as plugins to create coming soon pages, plugins to manage the cache, plugin to manage SEO, etc &#8230; You will reactivate your personal plugins later as soon as the import process is finished</li>
            	</ul>
            	<h4>Requirements for demo importing</h4>
            	<p>To correctly import a demo please make sure that your hosting is running the following features:</p>
            	<p><strong>WordPress Requirements</strong></p>
            	<ul>
            	<li>WordPress 4.6+</li>
            	<li>PHP 5.6+</li>
            	<li>MySQL 5.6+</li>
            	</ul>
            	<p><strong>Recommended PHP configuration limits</strong></p>
            	<p>*If the import stalls and fails to respond after a few minutes it because your hosting is suffering from PHP configuration limits. You should contact your hosting provider and ask them to increase those limits to a minimum as follows:</p>
            	<ul>
            	<li>max_execution_time 3000</li>
            	<li>memory_limit 512M</li>
            	<li>post_max_size 100M</li>
            	<li>upload_max_filesize 81M</li>
            	</ul></div>
            	<p><strong>*Please note that you can import 1 demo data select it carefully.</strong></p>
            	<hr />';

        return $default_text;
    }

    /* if ( !function_exists( 'foodota_framework_importer_description_config' ) ) { */

    function foodota_framework_importer_description_config($default_text)
    {
        //get ser detials
        $server_memory_limit = $server_max_execution_time = $server_upload_max_size = '';
        $server_memory_limit = ini_get('memory_limit');
        $server_max_execution_time = ini_get('max_execution_time');
        $server_upload_max_size = ini_get('upload_max_filesize');
        //minimum req
        $php_version = 7.1;
        $min_memory_end = 512;
        $min_execution_time = 3000; // 300 seconds = 5 minutes
        $min_filesize = 81;
        //get php version
        if (phpversion() >= $php_version) {
            $active_clr = 'ok-req';
            $icon = 'yes';
            $msg = '';
        }
        if (phpversion() < $php_version) {
            $active_clr = 'bad-req';
            $icon = 'no';
            $msg = 'You have outdated PHP version installed on your server. PHP version 7.1 or higher is required to make sure Propertya Theme and all required plugins work correctly. <a href="https://www.php.net/supported-versions.php"> Click here to read more details </a>';
        }
        if ($server_max_execution_time >= $min_execution_time) {
            $ok_clr = 'ok-req';
            $e_icon = 'yes';
            $e_msg = '';
        }
        if ($server_max_execution_time < $min_execution_time) {
            $ok_clr = 'bad-req';
            $e_icon = 'no';
            $e_msg = 'Your server has limited max_execution_time. We recommend you to increase it to 360 (seconds) or more to make sure demo import will have enough time to load all demo content & images';
        }
        if ($server_upload_max_size >= $min_filesize) {
            $f_ok_clr = 'ok-req';
            $f_icon = 'yes';
            $f_msg = '';
        }
        if ($server_upload_max_size < $min_filesize) {
            $f_ok_clr = 'bad-req';
            $f_icon = 'no';
            $f_msg = 'Your server has limited upload_max_filesize. We recommend to increase it to 32M or more to make sure demo import will have enough time to load all demo content & images';
        }
        if ($server_memory_limit >= $min_memory_end) {
            $ok_mem = 'ok-req';
            $mem_icon = 'yes';
            $mem_msg = '';
        }
        if ($server_memory_limit < $min_memory_end && $server_memory_limit != 0) {
            $ok_mem = 'bad-req';
            $mem_icon = 'no';
            $mem_msg = 'Your server has very limited memory_limit. Please increase it to 256M or more to make sure DWT Listing Theme and all required plugins work correctly.';
        }

        $message = '<p>' . esc_html__('Best if used on new WordPress install & this theme requires PHP version 7.1+', 'propertya-framework') . '</p>';
        $message .= '<p>' . esc_html__('Images are for demo purpose only.', 'propertya-framework') . '</p>';
        $message .= '
        <h3>Server Requirements</h3>
        <div class="theme-server-detials">            
        <div class="requirnment-row ' . $active_clr . '">
            <div class="req-title"><strong>PHP version</strong> ' . $msg . ' | ' . esc_html(phpversion()) . ' | <span class="dashicons dashicons-' . $icon . '"></span></div>
        </div>
        <div class="requirnment-row ' . $ok_mem . '">
            <div class="req-title"><strong>Memory Limit</strong> ' . $mem_msg . ' | ' . esc_html($server_memory_limit) . ' | <span class="dashicons dashicons-' . $mem_icon . '"></span></div>
        </div>
        <div class="requirnment-row ' . $ok_clr . '">
            
            <div class="req-title"><strong>Max Execution Time</strong> ' . $e_msg . ' | ' . esc_html($server_max_execution_time) . ' | <span class="dashicons dashicons-' . $e_icon . '"></span></div>
        </div>
        <div class="requirnment-row ' . $f_ok_clr . '">
            
            <div class="req-title"><strong>Upload max filesize</strong> ' . $f_msg . ' | ' . esc_html($server_upload_max_size) . ' | <span class="dashicons dashicons-' . $f_icon . '"></span></div>

        </div>
    </div>< hr />';

        $message = $default_text . $message;
        return $message;
    }

    /* add_filter( 'wbc_importer_description', 'foodota_framework_importer_description_config', 10 ); */
    //}
    //
    function foodota_importing_data($demo_type)
    {
        global $wpdb;
        $sql_file_OR_content;
        if ($demo_type == 'FoodotaDemo1') {
            $sql_file_OR_content = SB_PLUGIN_PATH . 'sql/data.sql';
        }
        $SQL_CONTENT = (strlen($sql_file_OR_content) > 300 ? $sql_file_OR_content : file_get_contents($sql_file_OR_content));
        $allLines = explode("\n", $SQL_CONTENT);
        $zzzzzz = $wpdb->query('SET foreign_key_checks = 0');
        preg_match_all("/\nCREATE TABLE(.*?)\`(.*?)\`/si", "\n" . $SQL_CONTENT, $target_tables);
        foreach ($target_tables[2] as $table) {
            $wpdb->query('DROP TABLE IF EXISTS ' . $table);
        }
        $zzzzzz = $wpdb->query('SET foreign_key_checks = 1');
        //$wpdb->query("SET NAMES 'utf8'");
        $templine = ''; // Temporary variable, used to store current query
        foreach ($allLines as $line) {           // Loop through each line
            if (substr($line, 0, 2) != '--' && $line != '') {
                $templine .= $line;  // (if it is not a comment..) Add this line to the current segment
                if (substr(trim($line), -1, 1) == ';') {  // If it has a semicolon at the end, it's the end of the query
                    if ($wpdb->prefix != 'wp_') {
                        $templine = str_replace("`wp_", "`$wpdb->prefix", $templine);
                    }
                    if (!$wpdb->query($templine)) {
                    //print('Error performing query \'<strong>' . $templine . '\': ' . $wpdb->error . '<br /><br />');
                    }
                    $templine = ''; // set variable to empty, to start picking up the lines after ";"
                }
            }
        }
        //return 'Importing finished. Now, Delete the import file.';
    }
}

$foodota_demo_ocdi = new foodota_Demo_OCDI();




