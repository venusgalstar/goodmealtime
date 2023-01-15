<?php
/**
 * Adds Foo_Widget widget.
 */
class Food_categories_filter_Widget extends WP_Widget {
    /**
     * Register widget with WordPress.
     */

    public function __construct() {
        $widget_options = array(
            'classname' => 'res-sidebar-box',
            'description' => __( 'A Food Categories Filter', 'foodota-framework' ),
        );
        parent::__construct( 'food_categories_filter_widget', 'Restaurant:Food Categories Filter', $widget_options );
    }
    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ) {
        extract( $args );
        $title = apply_filters( 'widget_title', $instance['title'] );
        echo $before_widget;
        if ( ! empty( $title ) ) {
            echo '<div class="heading-panel-simple">';
            echo $before_title . $title . $after_title;
            echo '<div class="bottom-dots  clearfix">
                    <span class="dot line-dot"></span>
                    <span class="dot"></span>
                    <span class="dot"></span>
                    <span class="dot"></span>
                    </div></div>';
        }
        echo __( '', 'foodota-framework' );
        ?>

        <ul class="element mCustomScrollbar">

            <?php
            $foodota_category='';
            $data = foodota_get_selected_categories();
            foreach ($data as $food_names) {
                ?>
                <li>
                    <div class="res-sb-categories">
                        <div class="pretty p-default p-round p-thick pretty-custom food_cat_filter">
                            <input type="checkbox"  name="sport" value="<?php echo esc_html($food_names['term-id']) ?>"  />
                            <div class="state">
                                <label></label>
                            </div>
                        </div>
                        <span><?php echo esc_html($food_names['term-name']); ?></span> </div>
                    <div class="res-sb-product">
                        <p>(<?php echo esc_html($food_names['term-count']);  ?>)</p>
                    </div>
                </li>

           <?php
            }
            ?>
        </ul>

        <?php
        echo $after_widget;


    }
    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        }
        else {
            $title = __( 'New title', 'foodota-framework' );
        }
        ?>
        <p>
            <label for="<?php echo $this->get_field_name( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <?php
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( !empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        return $instance;
    }
} // class Foo_Widget
if (in_array('wc-multivendor-marketplace/wc-multivendor-marketplace.php', apply_filters('active_plugins', get_option('active_plugins')))) {
    add_action('widgets_init', 'register_categories_filter');
}

if(!function_exists('register_categories_filter')) {
    function register_categories_filter()
    {
        register_widget('Food_categories_filter_Widget');
    }
}