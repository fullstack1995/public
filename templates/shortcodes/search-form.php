<?php
$options = get_option( 'infojob', [] );

$title = !empty( $_GET['title'] ) ? $_GET['title'] : '';

$location = !empty( $_GET['location'] ) ? $_GET['location'] : '';

$job = !empty( $_GET['job'] ) ? $_GET['job'] : '';
?>

<div class="infojob-search-form">

    <form action="<?= get_permalink( iss( $options, 'search_result_page_id' ) ) ?>">

        <div class="infojob-field-container infojob-col-5">

            <input type="text" name="title" placeholder="<?php _e( 'Search in all advertisings', 'infojob' ) ?>" value="<?= $title ?>">

        </div>

        <div class="infojob-field-container infojob-col-3">

            <?php wp_dropdown_categories( [
                'taxonomy' => 'location',
                'name' => 'location',
                'hide_empty' => false,
                'id' => 'location',
                'class' => 'js-example-basic-single',
                'echo' => true,
                'show_count' => false,
                'hierarchical' => true,
                'show_option_none' => __( 'City / district', 'infojob' ),
                'option_none_value' => -1,
                'selected' => $location
            ] ); ?>

        </div>

        <div class="infojob-field-container infojob-col-3">

            <?php wp_dropdown_categories( [
                'taxonomy' => 'job',
                'name' => 'job',
                'hide_empty' => false,
                'id' => 'job',
                'echo' => true,
                'class' => 'js-example-basic-single',
                'show_count' => false,
                'hierarchical' => true,
                'show_option_none' => __( 'Categories', 'infojob' ),
                'option_none_value' => -1,
                'selected' => $job
            ] ); ?>

        </div>

        <div class="infojob-field-container infojob-col-1">

            <button>

                <svg xmlns="http://www.w3.org/2000/svg" style="color: #fff;" width="25" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                </svg>

            </button>

        </div>

    </form>

</div>