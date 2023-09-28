<?php
$options = get_option( 'infojob', [] );

$title = !empty( $_GET['title'] ) ? $_GET['title'] : '';

$tax_query = [ 'relation' => 'AND' ];

if( !empty( $_GET['location'] ) && $_GET['location'] != -1 )
{
    $tax_query[] = [
        'taxonomy' => 'location',
        'field' => 'id',
        'terms' => $_GET['location'],
    ];
}

if( !empty( $_GET['job'] ) && $_GET['job'] != -1 )
{
    $tax_query[] = [
        'taxonomy' => 'job',
        'field' => 'id',
        'terms' => $_GET['job'],
    ];
}

$query = new WP_Query( [
    'post_type' => 'advertising',
    'post_status' => 'publish',
    's' => !empty( $_GET['title'] ) ? $_GET['title'] : '',
    'posts_per_page' => get_option( 'posts_per_page', 20 ),
    'tax_query' => $tax_query,
    'paged' => get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1
] );

?>

<div class="infojob-search-result">

    <ul class="infojob-search-result-list">

        <?php while( $query->have_posts() ) : $query->the_post(); ?>

            <li>

                <div class="wrapper">

                    <div class="image">

                        <a href="<?php the_permalink() ?>" title="<?php the_title() ?>"><?php the_post_thumbnail() ?></a>

                        <div class="advertising-title">

                            <a href="<?php the_permalink() ?>" title="<?php the_title() ?>">

                                <h2><?php the_title() ?></h2>

                            </a>

                        </div>

                    </div>

                    <div class="meta">

                        <figure>

                            <i class="fas fa-calendar"></i>

                            <?= \INFOJOB\Advertising::timeElapsed( get_the_date( 'Y-m-d H:i:s' ) ) ?>

                        </figure>

                        <figure>

                            <i class="fas fa-folder"></i>

                            <?php foreach( get_categories( ['taxonomy' => 'job'] ) as $job ): ?>

                                <a href="<?= $job->slug ?>" rel="tag"><?= $job->name ?></a>

                                <?php break ?>

                            <?php endforeach ?>

                        </figure>

                    </div>

                </div>

            </li>

        <?php endwhile ?>

    </ul>

    <div class="pages-numbers pages-standard">

        <?php
        $big = 999999999; // need an unlikely integer
        echo paginate_links( array(
            'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
            'format' => '?paged=%#%',
            'current' => max( 1, get_query_var( 'paged' ) ),
            'total' => $query->max_num_pages
        ) ); ?>

    </div>

    <?php wp_reset_postdata() ?>

</div>