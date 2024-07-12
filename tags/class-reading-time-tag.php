<?php
use Elementor\Controls_Manager;
use Elementor\Core\DynamicTags\Tag;
use Elementor\Modules\DynamicTags\Module as TagsModule;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Reading_Time_Tag extends Tag {

    public function get_name() {
        return 'reading-time-tag';
    }

    public function get_title() {
        return __( 'Reading Time', 'ele-reading-time' );
    }

    public function get_group() {
        return 'post';
    }

    public function get_categories() {
        return [ TagsModule::TEXT_CATEGORY ];
    }

    protected function register_controls() {
        $this->add_control(
            'words_per_minute',
            [
                'label' => __( 'Words Per Minute', 'ele-reading-time' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 200,
            ]
        );
    }

    public function render() {
        $words_per_minute = $this->get_settings( 'words_per_minute' );
        $post_content = get_post_field( 'post_content', get_the_ID() );
        $word_count = str_word_count( wp_strip_all_tags( $post_content ) );
        $reading_time = ceil( $word_count / $words_per_minute );

        echo esc_html( $reading_time ) . ' ' . __( 'min', 'ele-reading-time' );
    }

}
