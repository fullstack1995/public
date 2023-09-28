<style>
    .file-upload-wrapper {
        position: relative;
        max-width: 400px;
        height: 60px;
    }

    .file-upload-wrapper:after {
        content: attr(data-text);
        font-size: 18px;
        position: absolute;
        top: 0;
        left: 0;
        background: #fff;
        padding: 10px 15px;
        display: block;
        width: calc(100% - 30px);
        pointer-events: none;
        z-index: 20;
        height: 40px;
        line-height: 40px;
        color: #999;
        font-weight: 300;
    }

    .file-upload-wrapper:before {
        content: attr(data-button-text);
        position: absolute;
        top: 0;
        left: 0;
        display: inline-block;
        height: 60px;
        background: #4daf7c;
        color: #fff;
        font-weight: 700;
        z-index: 25;
        font-size: 16px;
        line-height: 60px;
        padding: 0 15px;
        text-transform: uppercase;
        pointer-events: none;
    }

    .file-upload-wrapper:hover:before {
        background: #3d8c63;
    }

    .file-upload-wrapper input {
        opacity: 0;
        position: absolute;
        top: 0;
        left: 0;
        bottom: 0;
        left: 0;
        z-index: 99;
        margin: 0;
        padding: 0;
        display: block;
        cursor: pointer;
        width: 100%;
    }

    .sprucecss {
        align-items: flex-start;
        background-color: white;
        border-radius: 0.25rem;
        box-shadow: 0 0 0.5rem rgba(0, 0, 0, 0.05);
        color: #444;
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
        inset: auto auto 1rem 1rem;
        line-height: 1.5;
        max-width: 11rem;
        padding: 1.5rem;
        position: fixed;
        text-decoration: none;
    }

    .sprucecss img {
        height: 1.5rem;
        width: auto;
    }

    .notice.hide {
        display: none;
    }

    .notice-primary {
        border-right-color: #03a9f4;
    }
</style>

<div class="wrap">

    <h1><?php _e( 'Importer', 'infojob' ) ?></h1>

    <br>

    <hr class="wp-header-end">

    <form>

        <div class="file-upload-wrapper" data-text="<?php _e( 'Select your file!', 'infojob' ) ?>"
             data-button-text="<?php _e( 'Upload', 'infojob' ) ?>">

            <input name="file" type="file" class="file-upload-field" value="">

        </div>

        <br>

        <button class="button button-primary" id="start"><?php _e( 'Start', 'infojob' ) ?></button>

        <div class="notice notice-primary hide custom-notice"><p></p></div>

    </form>

</div>

<script type="text/javascript">
    ( function( $ )
    {
        let rows = [];

        let per_request = 10;

        $( 'form' ).on( 'change', '.file-upload-field', function()
        {
            $( this ).parent( ".file-upload-wrapper" ).attr( "data-text", $( this ).val().replace( /.*(\/|\\)/, '' ) );
        } );

        function inprogress( e )
        {
            let rtl = $( 'html[dir="rtl"]' ).length;

            if( e )
            {
                $( '#start' ).prop( 'disabled', true );

                $( '#start' ).html( rtl ? 'در حال پردازش...' : 'In Progress...' );
            }else
            {
                $( '#start' ).prop( 'disabled', false );

                $( '#start' ).html( rtl ? 'شروع' : 'Start' );
            }
        }

        $( document ).on( 'click', '#start', function()
        {
            inprogress( true );

            let file = $( '.file-upload-field' )[0].files[0];

            let formData = new FormData();

            formData.append( 'action', 'infojob_get_excel_data' );

            formData.append( 'file', file );

            $.ajax( {
                url: window.ajaxurl,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function( response )
                {
                    rows = response;

                    $( '.custom-notice' ).removeClass( 'hide' );

                    $( '.custom-notice p' ).html( rows.length + ' آگهی یافت شد' );

                    _import();
                },
                error: function( error )
                {
                    console.log( 'Error uploading file' );
                }
            } );
        } );

        function _import()
        {
            $.ajax( {
                url: window.ajaxurl,
                type: 'POST',
                dataType: 'json',
                data: {
                    action: 'infojob_import',
                    rows: JSON.stringify( rows.slice( 0, per_request ) )
                },
                success: function( response )
                {
                    rows.splice( 0, per_request );

                    if( rows.length > 0 )
                    {
                        $( '.custom-notice p' ).html( rows.length + ' تا باقی مانده' );

                        _import();
                    }else
                    {
                        $( '.custom-notice p' ).html( 'پایان یافت' );

                        inprogress( false );
                    }
                },
                error: function( )
                {
                    inprogress( false );
                }
            } );
        }
    } )( jQuery );
</script>