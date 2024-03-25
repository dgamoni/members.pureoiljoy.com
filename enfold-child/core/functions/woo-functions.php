<?php

// remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
// add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail_new', 10);

//add_action('woocommerce_before_main_content', 'include_ajaxseach', 15);
function include_ajaxseach()
{
    echo '<div class="aja_search_wrapper">';
    echo '<h2>Search here:</h2>';
    echo do_shortcode("[wd_asp elements='search' ratio='100%' id=1]");
    echo '</div>';
}


// function mb_blacklist_custom_post_type( array $blacklist ) {
//     $blacklist[] = 'product';
//
//     return $blacklist;
// }
//
// add_filter( 'algolia_post_types_blacklist', 'mb_blacklist_custom_post_type' );



add_action('wp_enqueue_scripts', function () {
    if (is_shop() || is_product_category()):
        wp_enqueue_style('algolia-instantsearch');
        wp_enqueue_script('algolia-instantsearch');
    endif;
});

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 6 );

add_action( 'woocommerce_after_shop_loop_item_title',  'avia_add_description', 7);

function avia_add_description() {
    $excerpt = get_the_excerpt();
    $excerpt = preg_replace(" ([.*?])",'',$excerpt);
    $excerpt = strip_shortcodes($excerpt);
    $excerpt = strip_tags($excerpt);
    $excerpt = substr($excerpt, 0, 80);
    $excerpt = substr($excerpt, 0, strripos($excerpt, " "));
    //$excerpt = trim(preg_replace( '/s+/', ' ', $excerpt));
    $excerpt = $excerpt.'...';
    ?>
    <div itemprop="description" style="line-height: 1.1;font-size: 0.9em">
        <?php echo $excerpt; ?>
    </div>
    <?php
}

//add_action('woocommerce_before_main_content', 'include_instaseach_pre', 14);
function include_instaseach_pre() {
    echo '
    <div class="instaseach_pre">
        <p class="instaseach_pre_header">INTERACTIVE SEARCH ENGINE</p>
        <div class="instaseach_pre_text">
            <span class="instaseach_pre_header">Fill in an interest, health issue, or body system.</span><br>
            <span>Hit Enter, and watch your website find the categories of oils to fit your needs.</span>
        </div>
    </div>
    ';
}

add_action('woocommerce_before_main_content', 'include_instaseach', 15);
function include_instaseach()
{
    if ( is_product() ){
        return;
    }
    ?>

    <div id="ais-wrapper">
        <main id="ais-main">

            <div id="search-box-left">
                <p class="instaseach_pre_header">INTERACTIVE SEARCH ENGINE</p>
            </div>
            <div id="search-box-right">
                <div class="instaseach_pre_text">
                    <span class="instaseach_pre_header2">Fill in an interest, health issue, or body system.</span><br>
                    <span class="instaseach_pre_header3">Hit Enter, and watch your website find the categories of oils to fit your needs.</span>
                </div>
                <div id="algolia-search-box">
                    <div id="algolia-stats"></div>
                    <svg class="search-icon" width="25" height="25" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
                        <path d="M24.828 31.657a16.76 16.76 0 0 1-7.992 2.015C7.538 33.672 0 26.134 0 16.836 0 7.538 7.538 0 16.836 0c9.298 0 16.836 7.538 16.836 16.836 0 3.22-.905 6.23-2.475 8.79.288.18.56.395.81.645l5.985 5.986A4.54 4.54 0 0 1 38 38.673a4.535 4.535 0 0 1-6.417-.007l-5.986-5.986a4.545 4.545 0 0 1-.77-1.023zm-7.992-4.046c5.95 0 10.775-4.823 10.775-10.774 0-5.95-4.823-10.775-10.774-10.775-5.95 0-10.775 4.825-10.775 10.776 0 5.95 4.825 10.775 10.776 10.775z"
                              fill-rule="evenodd"></path>
                    </svg>
                </div>

            </div>
            <div class="ais-clearfix"></div>
	        <?php //do_action( 'woocommerce_archive_description' ); ?>
            <div id="algolia-hits"></div>
            <div id="algolia-pagination"></div>
        </main>
        <div class="instaseach_descript">
            The following products help promote and maintain better health. These statements have not been evaluated by the Food and Drug Administration. These products are not intended to diagnose, treat, cure, or prevent any disease.
        </div>
        <aside id="ais-facets">
            <section class="ais-facets" id="facet-post-types"></section>
            <section class="ais-facets" id="facet-categories"></section>
            <section class="ais-facets" id="facet-tags"></section>
            <section class="ais-facets" id="facet-users"></section>
        </aside>
    </div>

    <script type="text/html" id="tmpl-instantsearch-hit">
        <article itemtype="http://schema.org/Article">
            <# if ( data.images.thumbnail ) { #>
                <div class="ais-hits--thumbnail">
                    <a href="{{ data.permalink }}" title="{{ data.post_title }}">
                        <img src="{{ data.images.thumbnail.url }}" alt="{{ data.post_title }}"
                             title="{{ data.post_title }}" itemprop="image"/>
                    </a>
                </div>
                <# } #>

                    <div class="ais-hits--content">
                        <h2 itemprop="name headline"><a href="{{ data.permalink }}" title="{{ data.post_title }}"
                                                        itemprop="url">{{{ data._highlightResult.post_title.value
                                }}}</a></h2>
                        <div class="excerpt">
                            <p>
                                <# if ( data._snippetResult['content'] ) { #>
                                    <span class="suggestion-post-content">{{{ data._snippetResult['content'].value }}}</span>
                                    <# } #>
                            </p>
                        </div>
                    </div>
                    <div class="ais-clearfix"></div>
        </article>
    </script>


    <script type="text/javascript">
        jQuery(function () {
            if (jQuery('#algolia-search-box').length > 0) {

                if (algolia.indices.searchable_posts === undefined && jQuery('.admin-bar').length > 0) {
                    alert('It looks like you haven\'t indexed the searchable posts index. Please head to the Indexing page of the Algolia Search plugin and index it.');
                }

                /* Instantiate instantsearch.js */
                var search = instantsearch({
                    appId: algolia.application_id,
                    apiKey: algolia.search_api_key,
                    indexName: algolia.indices.searchable_posts.name,
                    urlSync: {
                        mapping: {'q': 's'},
                        trackedParameters: ['query']
                    },
                    searchParameters: {
                        facetingAfterDistinct: true,
                        highlightPreTag: '__ais-highlight__',
                        highlightPostTag: '__/ais-highlight__'
                    },
                    searchFunction: function (helper) {
                        if(helper.state.query) {
                            helper.search()
                        }
                    }
                });

                /* Search box widget */
                search.addWidget(
                    instantsearch.widgets.searchBox({
                        container: '#algolia-search-box',
                        placeholder: 'Search for...',
                        wrapInput: false,
                        poweredBy: algolia.powered_by_enabled,
                        autofocus: true
                    })
                );

                /* Stats widget */
                search.addWidget(
                    instantsearch.widgets.stats({
                        container: '#algolia-stats'
                    })
                );

                /* Hits widget */
                search.addWidget(
                    instantsearch.widgets.hits({
                        container: '#algolia-hits',
                        hitsPerPage: 5,
                        templates: {
                            empty: 'No results were found for "<strong>{{query}}</strong>".',
                            item: wp.template('instantsearch-hit')
                        },
                        transformData: {
                            item: function (hit) {
                                for (var key in hit._highlightResult) {
                                    // We do not deal with arrays.
                                    if (typeof hit._highlightResult[key].value !== 'string') {
                                        continue;
                                    }
                                    hit._highlightResult[key].value = _.escape(hit._highlightResult[key].value);
                                    hit._highlightResult[key].value = hit._highlightResult[key].value.replace(/__ais-highlight__/g, '<em>').replace(/__\/ais-highlight__/g, '</em>');
                                }

                                for (var key in hit._snippetResult) {
                                    // We do not deal with arrays.
                                    if (typeof hit._snippetResult[key].value !== 'string') {
                                        continue;
                                    }

                                    hit._snippetResult[key].value = _.escape(hit._snippetResult[key].value);
                                    hit._snippetResult[key].value = hit._snippetResult[key].value.replace(/__ais-highlight__/g, '<em>').replace(/__\/ais-highlight__/g, '</em>');
                                }

                                return hit;
                            }
                        }
                    })
                );

                /* Pagination widget */
                search.addWidget(
                    instantsearch.widgets.pagination({
                        container: '#algolia-pagination'
                    })
                );

                /* Post types refinement widget */
                search.addWidget(
                    instantsearch.widgets.menu({
                        container: '#facet-post-types',
                        attributeName: 'post_type_label',
                        sortBy: ['isRefined:desc', 'count:desc', 'name:asc'],
                        limit: 10,
                        templates: {
                            header: '<h3 class="widgettitle">Post Type</h3>'
                        },
                    })
                );

                /* Categories refinement widget */
                search.addWidget(
                    instantsearch.widgets.hierarchicalMenu({
                        container: '#facet-categories',
                        separator: ' > ',
                        sortBy: ['count'],
                        attributes: ['taxonomies_hierarchical.category.lvl0', 'taxonomies_hierarchical.category.lvl1', 'taxonomies_hierarchical.category.lvl2'],
                        templates: {
                            header: '<h3 class="widgettitle">Categories</h3>'
                        }
                    })
                );

                /* Tags refinement widget */
                search.addWidget(
                    instantsearch.widgets.refinementList({
                        container: '#facet-tags',
                        attributeName: 'taxonomies.post_tag',
                        operator: 'and',
                        limit: 15,
                        sortBy: ['isRefined:desc', 'count:desc', 'name:asc'],
                        templates: {
                            header: '<h3 class="widgettitle">Tags</h3>'
                        }
                    })
                );

                /* Users refinement widget */
                search.addWidget(
                    instantsearch.widgets.menu({
                        container: '#facet-users',
                        attributeName: 'post_author.display_name',
                        sortBy: ['isRefined:desc', 'count:desc', 'name:asc'],
                        limit: 10,
                        templates: {
                            header: '<h3 class="widgettitle">Authors</h3>'
                        }
                    })
                );

                /* Start */
                search.start();

//                jQuery('#algolia-search-box input').attr('type', 'search').select();
            }
        });
    </script>
    <?php
}


if (!function_exists('woocommerce_template_loop_product_thumbnail_new')) {
    function woocommerce_template_loop_product_thumbnail_new()
    {
        echo woocommerce_get_product_thumbnail_new();
    }
}
if (!function_exists('woocommerce_get_product_thumbnail_new')) {
    function woocommerce_get_product_thumbnail_new($size = 'shop_catalog', $placeholder_width = 0, $placeholder_height = 0)
    {
        global $post, $woocommerce;

        $post_thumbnail_id = get_post_thumbnail_id($post->ID);
        $image_src = wp_get_attachment_image_src($post_thumbnail_id, 'full');
        $params = array('width' => 300, 'height' => 300, 'crop' => true);
        //var_dump($fimage_src[0]);

        $output = '<div class="imagewrapper">';

        if (has_post_thumbnail()) {
            //$output .= get_the_post_thumbnail( $post->ID, $size ); 
            //var_dump(bfi_thumb( $image_src, $params ));
            $output .= "<img src='" . bfi_thumb($image_src, $params)[0] . "'/>";
        }
        $output .= '</div>';
        return $output;
    }
}