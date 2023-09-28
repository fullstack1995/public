<style>
    .information,
    .information input,
    .information textarea {
        width: 100%;
    }

    .information th {
        max-width: 30px;
        text-align: right;
    }
</style>

<table class="information">

    <tbody>

    <tr>

        <th><?php _e( 'Municipality regional', 'infojob' ) ?></th>

        <td>

            <input type="text" autocomplete="off" name="municipality_regional"
                   value="<?= get_post_meta( $post->ID, 'municipality_regional', true ) ?>">

        </td>

    </tr>

    <tr>

        <th><?php _e( 'District', 'infojob' ) ?></th>

        <td>

            <input type="text" autocomplete="off" name="district"
                   value="<?= get_post_meta( $post->ID, 'district', true ) ?>">

        </td>

    </tr>

    <tr>

        <th><?php _e( 'Street', 'infojob' ) ?></th>

        <td>

            <input type="text" autocomplete="off" name="street"
                   value="<?= get_post_meta( $post->ID, 'street', true ) ?>">

        </td>

    </tr>

    <tr>

        <th><?php _e( 'Building', 'infojob' ) ?></th>

        <td>

            <input type="text" autocomplete="off" name="building"
                   value="<?= get_post_meta( $post->ID, 'building', true ) ?>">

        </td>

    </tr>

    <tr>

        <th><?php _e( 'Address', 'infojob' ) ?></th>

        <td>

            <textarea name="address" rows="5"><?= get_post_meta( $post->ID, 'address', true ) ?></textarea>

        </td>

    </tr>

    <tr>

        <th><?php _e( 'Website', 'infojob' ) ?></th>

        <td>

            <input type="text" autocomplete="off" dir="ltr" name="website"
                   value="<?= get_post_meta( $post->ID, 'website', true ) ?>">

        </td>

    </tr>

    <tr>

        <th><?php _e( 'Phone', 'infojob' ) ?> 1</th>

        <td>

            <input type="text" autocomplete="off" dir="ltr" name="phone1"
                   value="<?= get_post_meta( $post->ID, 'phone1', true ) ?>">

        </td>

    </tr>

    <tr>

        <th><?php _e( 'Phone', 'infojob' ) ?> 2</th>

        <td>

            <input type="text" autocomplete="off" dir="ltr" name="phone2"
                   value="<?= get_post_meta( $post->ID, 'phone2', true ) ?>">

        </td>

    </tr>

    <tr>

        <th><?php _e( 'Phone', 'infojob' ) ?> 3</th>

        <td>

            <input type="text" autocomplete="off" dir="ltr" name="phone3"
                   value="<?= get_post_meta( $post->ID, 'phone3', true ) ?>">

        </td>

    </tr>

    <tr>

        <th><?php _e( 'Fax', 'infojob' ) ?></th>

        <td>

            <input type="text" autocomplete="off" dir="ltr" name="fax"
                   value="<?= get_post_meta( $post->ID, 'fax', true ) ?>">

        </td>

    </tr>

    <tr>

        <th><?php _e( 'Cellphone', 'infojob' ) ?> 1</th>

        <td>

            <input type="text" autocomplete="off" dir="ltr" name="cellphone1"
                   value="<?= get_post_meta( $post->ID, 'cellphone1', true ) ?>">

        </td>

    </tr>

    <tr>

        <th><?php _e( 'Cellphone', 'infojob' ) ?> 2</th>

        <td>

            <input type="text" autocomplete="off" dir="ltr" name="cellphone2"
                   value="<?= get_post_meta( $post->ID, 'cellphone2', true ) ?>">

        </td>

    </tr>

    <tr>

        <th><?php _e( 'Email', 'infojob' ) ?></th>

        <td>

            <input type="text" autocomplete="off" dir="ltr" name="email"
                   value="<?= get_post_meta( $post->ID, 'email', true ) ?>">

        </td>

    </tr>

    <tr>

        <th><?php _e( 'Google map', 'infojob' ) ?></th>

        <td>

            <input type="text" autocomplete="off" dir="ltr" name="google_map"
                   value="<?= get_post_meta( $post->ID, 'google_map', true ) ?>">

        </td>

    </tr>

    <tr>

        <th><?php _e( 'Video', 'infojob' ) ?></th>

        <td>

            <textarea name="video" dir="ltr" rows="3"><?= get_post_meta( $post->ID, 'video', true ) ?></textarea>

        </td>

    </tr>

    </tbody>

</table>