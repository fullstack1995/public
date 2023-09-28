<div class="wrap">

    <form method="post">

        <table class="form-table">

            <tbody>

            <tr>

                <th><?php _e( 'API key', 'infojob' ) ?></th>

                <td>

                    <input type="text" name="api[key]" disabled dir="ltr" style="width: 100%;" value="<?= iss( $options, 'api.key' ) ?>">

                </td>

            </tr>

            <tr>

                <th>

                    <h1><?php _e( 'Shortcodes', 'infojob' ) ?></h1>

                </th>

                <td>

                    <hr>

                </td>

            </tr>

            <tr>

                <th><?php _e( 'Search form', 'infojob' ) ?></th>

                <td>

                    <pre>[infojob-search-form]</pre>

                </td>

            </tr>

            <tr>

                <th><?php _e( 'Show search result', 'infojob' ) ?></th>

                <td>

                    <pre>[infojob-search-result]</pre>

                </td>

            </tr>

            <tr>

                <th>

                    <h1><?php _e( 'Importer', 'infojob' ) ?></h1>

                </th>

                <td>

                    <hr>

                </td>

            </tr>

            <tr>

                <th><?php _e( 'Default image id', 'infojob' ) ?></th>

                <td>

                    <input type="number" name="importer[default_image_id]" dir="ltr" value="<?= iss( $options, 'importer.default_image_id' ) ?>">

                </td>

            </tr>

            <tr>

                <th><?php _e( 'Default map', 'infojob' ) ?></th>

                <td>

                    <input type="text" name="importer[map]" style="width: 100%" dir="ltr" value="<?= iss( $options, 'importer.map' ) ?>">

                </td>

            </tr>

            <tr>

                <th><?php _e( 'Default video', 'infojob' ) ?></th>

                <td>

                    <input type="text" name="importer[video]" style="width: 100%" dir="ltr" value="<?= iss( $options, 'importer.video' ) ?>">

                </td>

            </tr>

            <tr>

                <th><?php _e( 'Search result page id', 'infojob' ) ?></th>

                <td>

                    <input type="text" name="search_result_page_id" dir="ltr" value="<?= iss( $options, 'search_result_page_id' ) ?>">

                </td>

            </tr>

            <tr>

                <th></th>

                <td><?php submit_button() ?></td>

            </tr>

            </tbody>

        </table>

    </form>

</div>