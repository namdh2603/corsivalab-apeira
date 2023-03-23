<?php get_header();
?>
<div class="archive-blog">
    <div class="content-blog">
        <div class="container">
            <div class="group-action">
                <div class="row justify-content-center filter-section">
                    <div class="filter-tabs d-flex align-items-center justify-content-center" id="tabs-gallery">
                        <?php $terms = get_terms('locations_gallery');
                        if (!empty($terms)) :
                            foreach ($terms as $term) {
                                echo '<div class="tab-item">
                                <label>
                                <input id="filter_categories-' . $term->term_id . '" class="filter-item" name="cat" type="checkbox" data="categories" value="' . $term->term_id . '" />
                                <span>' . $term->name . '</span>
                                </label>
                                </div>';
                            }
                        endif;
                        ?>
                    </div>
                    <div class=" filter d-lg-flex d-block justify-content-between align-items-center">
                        <div class="number mb-lg-0 mb-4">
                            <?php echo  'Showing <span id="qty-post">' . $wp_query->post_count . '</span> out of ' . $wp_query->found_posts . ' results'; ?>
                        </div>
                        <div class="sort-blog d-flex flex-wrap align-items-center">
                            <div class="sort-item mb-lg-0 mb-3">
                                <span>Media type</span>
                                <div class="select-outside">
                                    <select class="filter-item" name="gen_name" id="filter_type" data="type">
                                        <option value="all">All</option>
                                        <option value="video">Video</option>
                                        <option value="image">Image</option>
                                    </select>
                                </div>
                            </div>
                            <div class="sort-item">
                                <span>Sort by</span>
                                <div class="select-outside">
                                    <select class="filter-item" id="filter_orderbydate" data="orderbydate">
                                        <option value="desc">Most recent</option>
                                        <option value="asc">Oldest</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class=" list-post">
                <div class="row list-post-inner" id="gallerys">
                    <?php if (have_posts()) : while (have_posts()) : the_post();
                            get_template_part('template-parts/content');
                        endwhile;
                        corsivalab_posts_nav();
                        wp_reset_postdata();
                    endif;
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    jQuery(document).ready(function($) {
        var or_link = '<?php echo get_post_type_archive_link('gallerys'); ?>';
        var arr = [];
        var body = $('body');
        $.fn.getType = function() {
            return this[0].tagName == "input" ? this[0].type.toLowerCase() : this[0].tagName.toLowerCase();
        }
        var getUrlParameter = function getUrlParameter(sParam) {
            var sPageURL = window.location.search.substring(1),
                sURLVariables = sPageURL.split('&'),
                sParameterName,
                i;
            for (i = 0; i < sURLVariables.length; i++) {
                sParameterName = sURLVariables[i].split('=');
                if (sParameterName[0] === sParam) {
                    return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
                }
            }
        };
        var getValue = function(index, element) {
            var type = $(this).getType();
            var key_filter = $(this).attr('data');
            if (type == 'select') {
                var value_filter = $(this).find(":selected").val();
                body.pushToUrl('add', {
                    url: or_link,
                    key: key_filter,
                    value: value_filter
                });
            } else {
                var value_filter = $(this).val();
                if ($(this).is(':checked')) { //checked
                    if ($.inArray(value_filter, arr) == -1) arr.push(value_filter);
                } else { //not check
                }
                if (arr.length != 0) {
                    value_filter_str = arr.join(',');
                    body.pushToUrl('removeSelected', {
                        url: or_link,
                        key: key_filter
                    });
                    body.pushToUrl('add', {
                        url: or_link,
                        key: key_filter,
                        value: value_filter_str
                    });
                } else {
                    body.pushToUrl('removeSelected', {
                        url: or_link,
                        key: key_filter
                    });
                }
            }
        };
        var setValue = function() {
            var type = $(this).getType();
            var key_filter = $(this).attr('data');
            var parameter_value = getUrlParameter(key_filter);
            if (parameter_value === undefined) {
                parameter_value = 0;
            } else {
                parameter_value = parameter_value;
                if (type == 'select') {
                    $('#filter_' + key_filter).val(parameter_value);
                } else {
                    $.each(parameter_value.split(","), function(index, item) {
                        $('#filter_' + key_filter + '-' + item).prop("checked", true);
                        // alert(item);
                    });
                }
            }
        };
        $(".filter-item").change(function() {
            $('.filter-section .filter-item').each(getValue);
            location.reload();
        });
        $('.filter-section .filter-item').each(setValue);
        $('#yith-infs-button').click(function() {
            setTimeout(function() {
                $('#qty-post').text($('#gallerys .post-item-outside').length);
            }, 1000);
        });
    });
</script>
<?php get_footer();
