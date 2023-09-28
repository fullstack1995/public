<?php global $post ?>

<div class="advertising-information-widget">

    <table class="information">

        <tbody>

        <tr>

            <th><?php _e( 'Municipality regional', 'infojob' ) ?></th>

            <td style="text-align:right"><?= get_post_meta( $post->ID, 'municipality_regional', true ) ?></td>

        </tr>

        <tr>

            <th><?php _e( 'District', 'infojob' ) ?></th>

            <td style="text-align:right"><?= get_post_meta( $post->ID, 'district', true ) ?></td>

        </tr>

        <tr>

            <th><?php _e( 'Street', 'infojob' ) ?></th>

            <td style="text-align:right"><?= get_post_meta( $post->ID, 'street', true ) ?></td>

        </tr>

        <tr>

            <th><?php _e( 'Building', 'infojob' ) ?></th>

            <td style="text-align:right"><?= get_post_meta( $post->ID, 'building', true ) ?></td>

        </tr>

        <tr>

            <th><?php _e( 'Address', 'infojob' ) ?></th>

            <td style="text-align:right"><?= get_post_meta( $post->ID, 'address', true ) ?></td>

        </tr>

        <tr>

            <th><?php _e( 'Website', 'infojob' ) ?></th>

            <td><?= get_post_meta( $post->ID, 'website', true ) ?></td>

        </tr>

        <tr>

            <th><?php _e( 'Phone', 'infojob' ) ?> 1</th>

            <td><?= get_post_meta( $post->ID, 'phone1', true ) ?></td>

        </tr>

        <tr>

            <th><?php _e( 'Phone', 'infojob' ) ?> 2</th>

            <td><?= get_post_meta( $post->ID, 'phone2', true ) ?></td>

        </tr>

        <tr>

            <th><?php _e( 'Phone', 'infojob' ) ?> 3</th>

            <td><?= get_post_meta( $post->ID, 'phone3', true ) ?></td>

        </tr>

        <tr>

            <th><?php _e( 'Fax', 'infojob' ) ?></th>

            <td><?= get_post_meta( $post->ID, 'fax', true ) ?></td>

        </tr>

        <tr>

            <th><?php _e( 'Cellphone', 'infojob' ) ?> 1</th>

            <td><?= get_post_meta( $post->ID, 'cellphone1', true ) ?></td>

        </tr>

        <tr>

            <th><?php _e( 'Cellphone', 'infojob' ) ?> 2</th>

            <td><?= get_post_meta( $post->ID, 'cellphone2', true ) ?></td>

        </tr>

        <tr>

            <th><?php _e( 'Email', 'infojob' ) ?></th>

            <td><?= get_post_meta( $post->ID, 'email', true ) ?></td>

        </tr>

        <tr>

            <th><?php _e( 'Google map', 'infojob' ) ?></th>

            <td>

                <iframe width='600' height='450' style='border:0;' allowfullscreen='' loading='lazy' src='<?= get_post_meta( $post->ID, 'google_map', true ) ?>'></iframe>

            </td>

        </tr>

        <tr>

            <th><?php _e( 'Video', 'infojob' ) ?></th>

            <td><?= get_post_meta( $post->ID, 'video', true ) ?></td>

        </tr>

        </tbody>

    </table>

</div>