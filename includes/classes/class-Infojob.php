<?php namespace INFOJOB;

class Advertising
{
    public static function timeElapsed( $timestamp ): string
    {
        $now = time();
        $diff = $now - strtotime( $timestamp );

        $seconds = $diff;
        $minutes = round( $diff / 60 );
        $hours = round( $diff / 3600 );
        $days = round( $diff / 86400 );
        $weeks = round( $diff / 604800 );
        $months = round( $diff / 2592000 );
        $years = round( $diff / 31536000 );

        if( $seconds < 60 )
        {
            return $seconds . ' ثانیه پیش';
        }
        elseif( $minutes < 60 )
        {
            return $minutes . ' دقیقه پیش';
        }
        elseif( $hours < 24 )
        {
            return $hours . ' ساعت پیش';
        }
        elseif( $days < 7 )
        {
            return $days . ' روز پیش';
        }
        elseif( $weeks < 4 )
        {
            return $weeks . ' هفته پیش ';
        }
        elseif( $months < 12 )
        {
            return $months . ' ماه پیش';
        }
        else
        {
            return $years . ' سال پیش';
        }
    }

    public static function uploadMediaByURL( $url, $post_parent = 0 ): void
    {
        // This file need to be included as dependencies when on the front end.
        require_once ABSPATH . 'wp-admin/includes/image.php';

        $file_content = file_get_contents( $url );

        $upload_dir = wp_upload_dir();

        $name = pathinfo( $url, PATHINFO_BASENAME ) . '.jpg';

        $type = wp_check_filetype( $name );

        if( wp_mkdir_p( $upload_dir['path'] ) )
        {
            $file = $upload_dir['path'] . '/' . $name;
        }
        else
        {
            $file = $upload_dir['basedir'] . '/' . $name;
        }

        file_put_contents( $file, $file_content );

        $attachment = [
            'post_mime_type' => $type['type'],
            'post_title' => sanitize_file_name( $name ),
            'post_content' => '',
            'post_status' => 'inherit',
            'post_parent' => $post_parent
        ];

        $thumbnail_id = wp_insert_attachment( $attachment, $file );

        $attach_data = wp_generate_attachment_metadata( $thumbnail_id, $file );

        wp_update_attachment_metadata( $thumbnail_id, $attach_data );

        update_post_meta( $post_parent, '_thumbnail_id', $thumbnail_id );
    }

    public static function exists( ...$data ): bool
    {
        $query = new \WP_Query( [
            'post_type' => 'advertising',
            's' => $data[0],
            'meta_query' => [
                'relation' => 'AND',
                [
                    'key' => 'phone1',
                    'value' => $data[1],
                ],
                [
                    'key' => 'cellphone1',
                    'value' => $data[2],
                ],
                [
                    'key' => 'address',
                    'value' => $data[3],
                ]
            ]
        ] );

        return $query->found_posts > 0;
    }

    public static function create( $data ): void
    {
        $options = get_option( 'infojob' );

        $data['post_status'] = 'publish';

        $data['post_type'] = 'advertising';

        $post_id = wp_insert_post( $data );

        foreach( $data['meta'] as $field => $value )
        {
            if( $field == 'google_map' && empty( $value ) )
            {
                $value = iss( $options, 'importer.map' );
            }

            if( $field == 'video' && empty( $value ) )
            {
                $value = iss( $options, 'importer.video' );
            }

            update_post_meta( $post_id, $field, $value );
        }

        $category = wp_insert_term( $data['category'], 'job' );
        $category_id = is_wp_error( $category ) ? $category->error_data['term_exists'] : $category['term_id'];

        wp_insert_term( $data['sub_category'], 'job', [ 'parent' => $category_id ] );
        wp_set_object_terms( $post_id, [ $data['category'], $data['sub_category'] ], 'job', false );

        $location = wp_insert_term( $data['location'], 'location' );
        $location = is_wp_error( $location ) ? $location->error_data['term_exists'] : $location['term_id'];

        wp_insert_term( $data['sub_location'], 'location', [ 'parent' => $location ] );
        wp_set_object_terms( $post_id, [ $data['location'], $data['sub_location'] ], 'location', false );

        if( empty( $data['thumbnail'] ) )
        {
            update_post_meta( $post_id, '_thumbnail_id', iss( $options, 'importer.default_image_id' ) );
        }
        else
        {
            self::uploadMediaByURL( $data['thumbnail'], $post_id );
        }
    }
}