<?php
namespace ElementorFoodota\Widgets;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly
class Foodnewsletters extends Widget_Base
{
    public function get_name()
    {
        return 'foodota-newsletter';
    }

    public function get_title()
    {
        return __('foodota-newsletter', 'foodota-framework');
    }

    public function get_icon()
    {
        return 'eicon-lock';
    }

    public function get_categories()
    {
        return ['foodota'];
    }

    public function get_script_depends()
    {
        return [''];
    }

    /**
     * Register the widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function register_controls()
    {
        /* for About Us tab */
        $this->start_controls_section(
            'food-newsletter',
            [
                'label' => __('Foodota Newsletters', 'foodota-framework'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'food-heading-Scheme',
            [
                'label' => __('Foodota Color Heading Scheme', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'white-section',
                'options' => [
                    'white-section' => __('White Section Heading Scheme', 'foodota-framework'),
                    'dark-section' => __('Dark Section Heading Scheme', 'foodota-framework'),
                ],
            ]
        );


        $this->add_control(
            'address-icon',
            [
                'label' => __('Address Icone', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('fa fa-home', 'foodota-framework'),
                'placeholder' => __('fa fa-home', 'foodota-framework'),
                'description' => __('Use only Font-Awesome Classes', 'foodota-framework')
            ]
        );

        $this->add_control(
            'location-address-title',
            [
                'label' => __('Location Address Title', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Location Adress', 'foodota-framework'),
                'placeholder' => __('Type your Location Address Title Here!', 'foodota-framework'),
            ]
        );

        $this->add_control(
            'location-address',
            [
                'label' => __('Location Address', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 4,
                'default' => __('Jones Street 126, Edgbaston', 'foodota-framework'),
                'placeholder' => __('Type your Location Address Here', 'foodota-framework'),
            ]
        );

        $this->add_control(
            'phone-number-icon',
            [
                'label' => __('Address Icone', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('fa fa-phone', 'foodota-framework'),
                'placeholder' => __('fa fa-phone', 'foodota-framework'),
                'description' => __('Use only Font-Awesome Classes', 'foodota-framework'),
            ]
        );

        $this->add_control(
            'phone-number-title',
            [
                'label' => __('Phone Number Heading Title', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Phone Number', 'foodota-framework'),
                'placeholder' => __('Type your Phone Number Heading', 'foodota-framework'),
            ]
        );

        $this->add_control(
            'phone-number-detail',
            [
                'label' => __('Phone Number Detail', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 4,
                'default' => __('00-22-55-77-88', 'foodota-framework'),
                'placeholder' => __('Type your Phone Number Here', 'foodota-framework'),
            ]
        );


        $this->add_control(
            'newsletter-heading',
            [
                'label' => __('Newletter Heading', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Signup For Newsletter', 'foodota-framework'),
                'placeholder' => __('Type your Newsletter Heading', 'foodota-framework'),
            ]
        );

        $this->add_control(
            'newsletter-input-placeholder',
            [
                'label' => __('Newsletter input Placeholder Field', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => __('Enter Your Email Address', 'foodota-framework'),
            ]
        );
        $this->add_control(
            'newsletter-submit-button',
            [
                'label' => __('Newsletter input Placeholder Field', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Subscribe', 'foodota-framework'),
                'placeholder' => __('Enter Text For Newsletter button', 'foodota-framework'),
            ]
        );


        $this->end_controls_section();
    }

    protected function render()
    {
        // get our input from the widget settings.
        $settings = $this->get_settings_for_display();
        $params['food-heading-Scheme'] = $settings['food-heading-Scheme'] ? $settings['food-heading-Scheme'] : '';
        $params['address-icon'] = $settings['address-icon'] ? $settings['address-icon'] : '';
        $params['location-address-title'] = $settings['location-address-title'] ? $settings['location-address-title'] : '';
        $params['location-address'] = $settings['location-address'] ? $settings['location-address'] : '';
        $params['phone-number-icon'] = $settings['phone-number-icon'] ? $settings['phone-number-icon'] : '';
        $params['phone-number-title'] = $settings['phone-number-title'] ? $settings['phone-number-title'] : '';
        $params['phone-number-detail'] = $settings['phone-number-detail'] ? $settings['phone-number-detail'] : '';
        $params['newsletter-heading'] = $settings['newsletter-heading'] ? $settings['newsletter-heading'] : '';
        $params['newsletter-input-placeholder'] = $settings['newsletter-input-placeholder'] ? $settings['newsletter-input-placeholder'] : '';
        $params['newsletter-submit-button'] = $settings['newsletter-submit-button'] ? $settings['newsletter-submit-button'] : '';
        echo $this->foodota_newsletters($params);
    }

    /**
     * Render the widget output in the editor.
     *
     * Written as a Backbone JavaScript template and used to generate the live preview.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function content_template()
    {

    }


    public function foodota_newsletters($params)
    {
        $foodota_text_color = $params['food-heading-Scheme'];
        $address_icon = $params['address-icon'];
        $address_title = $params['location-address-title'];
        $address_detail = $params['location-address'];
        $phone_icon = $params['phone-number-icon'];
        $phone_title = $params['phone-number-title'];
        $phone_detail = $params['phone-number-detail'];
        $newsletter_heading = $params['newsletter-heading'];
        $newsletter_placeholder = $params['newsletter-input-placeholder'];
        $newsletter_button_text = $params['newsletter-submit-button'];
        return '<section class="res-sign ' . $foodota_text_color . '">
          <div class="container">
            <div class="row">
              <div class="col-xxl-6 col-xl-6 col-md-6 col-lg-6 align-self-center">
                <div class="res-sign-content">
                  <div class="res-sign-box">
                    <div class="res-sign-icon"> <i class="' . $address_icon . '"></i> </div>
                    <div class="res-sign-details">
                      <h4>' . $address_title . '</h4>
                      <p>' . $address_detail . '</p>
                    </div>
                  </div>
                  <div class="res-sign-box">
                    <div class="res-sign-icon"> <i class="' . $phone_icon . '"></i> </div>
                    <div class="res-sign-details">
                      <h4>' . $phone_title . '</h4>
                      <p>' . $phone_detail . '</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xxl-6 col-xl-6 col-md-6 col-lg-6">
                <div class="res-sign-form">
                  <h2>' . $newsletter_heading . '</h2>
                  <form>
                    <div class="form-group">
                      <input type="text" placeholder="' . $newsletter_placeholder . '" class="form-control">
                    </div>
                    <button type="submit" class="news-btn btn btn-theme">' . $newsletter_button_text . '</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
       </section>';
    }
}