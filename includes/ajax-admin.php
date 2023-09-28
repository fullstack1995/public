<?php defined( 'ABSPATH' ) or die;

add_action( 'wp_ajax_infojob_get_excel_data', function()
{
    $filename = $_FILES['file']['tmp_name'];

    $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load( $filename );

    $data = $spreadsheet->getActiveSheet()->toArray( null, true, true, true );

    unset( $data[1] );

    $data = array_values( array_filter( $data ) );

    wp_send_json( $data );
} );

add_action( 'wp_ajax_infojob_import', function()
{
    $rows = json_decode( html_entity_decode( stripslashes( $_POST['rows'] ) ) );

    foreach( $rows as $row )
    {
        $exists = \INFOJOB\Advertising::exists( $row->G, $row->M, $row->Q, $row->K );

        if( $exists )
        {
            continue;
        }

        \INFOJOB\Advertising::create( [
            'post_title' => $row->G,
            'post_content' => $row->H,
            'thumbnail' => $row->U,
            'category' => $row->I,
            'sub_category' => $row->J,
            'location' => $row->A,
            'sub_location' => $row->B,
            'meta' => [
                'tie_post_layout' => 8,
                'municipality_regional' => $row->C,
                'district' => $row->D,
                'street' => $row->E,
                'building' => $row->F,
                'address' => $row->K,
                'website' => $row->L,
                'phone1' => $row->M,
                'phone2' => $row->N,
                'phone3' => $row->O,
                'fax' => $row->P,
                'cellphone1' => $row->Q,
                'cellphone2' => $row->R,
                'email' => $row->S,
                'google_map' => $row->T,
                'video' => $row->V,
            ]
        ] );
    }

    wp_send_json_success();
} );