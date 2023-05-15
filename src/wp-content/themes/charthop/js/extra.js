(function($) {

    // console.log('connected');
    $(document).ready(function() {

        /*
        * Resource ajax pagination
        * */
        let grid = $('.filter_results'),
            filter_opts = ['', '', ''],
            ajaxSent = false,
            old_filter_data = ['', '', ''],
            extra_data = ['', ''],
            posts_per_page = parseInt($('.resource_pagination').attr('data-count'));

        if ($('.resource_pagination').attr('data-type') != '') {
            extra_data[0] = $('.resource_pagination').attr('data-type');
        }

        if ($('.resource_pagination').attr('data-cat') != '') {
            extra_data[1] = $('.resource_pagination').attr('data-cat');
        }

        let sendAjax = (is_pagination, pagination_has_prev, clear) => {
            $('.filter_results .error_msg').remove();
            ajaxSent = true;
            grid.addClass('loading');
            let cur_page = parseInt($('.resource_pagination').attr('data-page'));
            let next_page = cur_page;

            if (clear)
            {
                next_page = 1;
            }
            else
            {
                if (is_pagination)
                {
                    next_page = (pagination_has_prev && cur_page != 1)? cur_page - 1: cur_page + 1;
                }
            }

            let formObj = {
                action: "forms_callback",
                security: forms_obj.security,
                current_page: next_page,
                filter_search: filter_opts[0],
                filter_type: filter_opts[1],
                filter_cat: filter_opts[2],
                extra_type: extra_data[0]? extra_data[0]: 0,
                extra_cat: extra_data[1]? extra_data[1]: 0
            };
            // console.log(formObj);
            $.post(forms_obj.ajax_url, formObj, function(response) {
                ajaxSent = false;
                if (response) {
                    data = JSON.parse(response);
                    // console.log('Ajax success');
                    // console.log(data);

                    // move to top
                    $('html, body').animate({
                        scrollTop: $('.filter_block').offset().top + 'px'
                    });

                    // remove old data
                    $('.filter_results > .resource-single').each(function() {
                        setTimeout(() => {
                            $('.filter_results > .resource-single.result-old').hide();
                            $(this).addClass('result-old');
                            if ($(this).next().hasClass('resource_pagination')){
                                $(this).hide();
                                $('.filter_results > .resource-single.result-old').remove();
                            }
                        }, 100)
                    });

                    if (data.success) {

                        // render data to result block
                        if (data.posts) {
                            let i = 0;
                            data.posts.reverse().forEach( post => {
                                let code = '',
                                    isVideo = false,
                                    isFeatured = false,
                                    isCS = false;

                                code += '<div class="resource-single col-md-6 col-lg-4 result-new"><div class="blog_box">';

                                code += '<ul class="blog_tags row no-gutters">';

                                // resource types
                                if (post.types.length > 0) {
                                    code += '<li class="col-auto">';
                                    post.types.forEach(type => {
                                        if (type.id == 13) {
                                            isVideo = true;
                                        } else if (type.id == 15) {
                                            isCS = true;
                                        } else if (type.id == 18) {
                                            isFeatured = true;
                                        }
                                        code += `<a href="${type.link}">${type.name}</a>`;
                                    })
                                    code += '</li>';
                                }

                                if (isFeatured) {
                                    code = code.replace('<div class="resource-single col-md-6 col-lg-4 result-new"><div class="blog_box">', '');
                                    code = '<div class="resource-single col-12">\n' +
                                        '<div class="feat_blog_box">\n' +
                                        '<div class="row align-items-center">\n' +
                                        '<div class="col-lg-6 order-lg-1">\n' +
                                        '<div class="blog_box_txt">'
                                        + code;

                                    // resource cats
                                    if (post.cats.length > 0) {
                                        code += '<li class="col-auto">';
                                        post.cats.forEach(cat => {
                                            code += `<a href="${cat.link}" class="people-analytics">${cat.name}</a>`;
                                        })
                                        code += '</li>';
                                    }
                                    code += '</ul>';

                                    code += `<h3><a href="${post.link}">${post.title}</a></h3>
                                                        <a href="${post.link}" class="readmore">Read more</a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 order-lg-2">
                                                    <div class="blog_box_image">
                                                        <a href="${post.link}">
                                                            <img src="${post.src ? post.src : '/wp-content/themes/charthop/img/explore3.png'}" alt="${post.title}" data-no-retina>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>`;


                                } else {

                                    // resource cats
                                    if (post.cats.length > 0) {
                                        code += '<li class="col-auto">';
                                        post.cats.forEach(cat => {
                                            code += `<a href="${cat.link}" class="people-analytics">${cat.name}</a>`;
                                        })
                                        code += '</li>';
                                    }
                                    code += '</ul>';

                                    // resource image
                                    if (isCS) {
                                        let color = post.color ? post.color : '#000000';
                                        code += `<div class="blog_box_image cust" style="background-color:${color};">
                                                <a href="${post.link}">
                                                    <span class="cust_stor_logo">
                                                        <img src="${post.src ? post.src : '/wp-content/themes/charthop/img/explore3.png'}" alt="${post.title}" data-no-retina>
                                                    </span>
                                                </a>
                                            </div>`;
                                    } else if (isVideo) {
                                        code += `<div class="blog_box_image video">
                                                <a href="${post.link}">
                                                    <span class="play">
                                                            <svg class="playicon" xmlns="http://www.w3.org/2000/svg"
                                                                 xmlns:xlink="http://www.w3.org/1999/xlink" width="15.167" height="21"
                                                                 viewBox="0 0 15.167 21">
                                                              <defs>
                                                                <clipPath id="clip-path">
                                                                  <path id="Path_45" data-name="Path 45"
                                                                        d="M23.333-38.5a1.167,1.167,0,0,1,.693.228l.032.025L36.8-28.984l0,0,.018.014a1.167,1.167,0,0,1,.517.968,1.167,1.167,0,0,1-.524.973l-12.783,9.3a1.167,1.167,0,0,1-.693.228,1.167,1.167,0,0,1-1.167-1.167V-37.333A1.167,1.167,0,0,1,23.333-38.5Z"
                                                                        fill="#6e37ff" clip-rule="evenodd"/>
                                                                </clipPath>
                                                                <clipPath id="clip-path-2">
                                                                  <path id="Path_44" data-name="Path 44"
                                                                        d="M-757,1258H683V-5320H-757Z"/>
                                                                </clipPath>
                                                              </defs>
                                                              <g id="Group_144" data-name="Group 144"
                                                                 transform="translate(-22.167 38.5)"
                                                                 clip-path="url(#clip-path)">
                                                                <g id="Group_143" data-name="Group 143" clip-path="url(#clip-path-2)">
                                                                  <path id="Path_43" data-name="Path 43"
                                                                        d="M17.167-12.5H42.333v-31H17.167Z"/>
                                                                </g>
                                                              </g>
                                                            </svg>
                                                    </span>
                                                    <img src="${post.src ? post.src : '/wp-content/themes/charthop/img/explore3.png'}" alt="${post.title}" data-no-retina>
                                                </a>
                                            </div>`;
                                    } else {
                                        code += `<div class="blog_box_image">
                                                <a href="${post.link}">
                                                    <img src="${post.src ? post.src : '/wp-content/themes/charthop/img/explore3.png'}" alt="${post.title}" data-no-retina>
                                                </a>
                                            </div>`;
                                    }


                                    code += `<h3><a href="${post.link}">${post.title}</a></h3><p>${post.excerpt}</p>`
                                    code += '</div></div>';
                                }



                                i++;
                                $('.filter_results').prepend(code);
                                if (i == data.posts.length)
                                {
                                    $('.filter_results > .resource-single.result-new').each(function() {
                                        setTimeout(() => $(this).addClass('loaded'), 150);
                                    });
                                }
                            })
                        }

                        // pagination
                        $('.current_page').html(formObj.current_page);

                        if (data.total_pages)
                        {
                            // $('.total_pages').html(data.total_pages);
                            $('.resource_pagination').attr('data-total', data.total_pages);

                            let paginationCode = '';
                            for (let i = 0; i < data.total_pages; i++)
                            {
                                if (i < formObj.current_page - 4)
                                {
                                    continue;
                                }
                                else if (i > formObj.current_page + 2)
                                {
                                    paginationCode += '<span>...</span>';
                                    break;
                                }
                                else
                                {
                                    if (i + 1 == formObj.current_page)
                                    {
                                        paginationCode += '<li><span class="current_page">' + (i+1) + '</span></li>';
                                    }
                                    else
                                    {
                                        paginationCode += '<li><a href="#" class="pagination_link">' + (i+1) + '</a></li>';
                                    }
                                }
                            }
                            //console.log(paginationCode);
                            $('.resource_pagination .pagination').html(paginationCode);
                        }

                        if (formObj.current_page > 1)
                        {
                            $('.resource_pagination .prev').removeClass('d-none');
                        } else {
                            $('.resource_pagination .prev').addClass('d-none');
                        }

                        if (formObj.current_page == $('.resource_pagination').attr('data-total'))
                        {
                            $('.resource_pagination .next').addClass('d-none');
                        } else {
                            $('.resource_pagination .next').removeClass('d-none');
                        }
                        $('.resource_pagination').attr('data-page', formObj.current_page);

                        if (! data.has_next && $('.resource_pagination').attr('data-page') == 1)
                        {
                            $('.resource_pagination').addClass('hidden');
                        }
                        else
                        {
                            $('.resource_pagination').removeClass('hidden');
                        }

                    } else {
                        // console.log('Ajax error: ' +  data.message);
                        $('.filter_results').prepend('<div class="col-lg-12 error_msg"><div class="blog_box text-center"><p>'
                            + data.message
                            + '</p></div></div>');
                        $('.resource_pagination').addClass('hidden');
                        //$(query_selector).find($('.error_msg')).html('<p>' + data.message + '</p>').fadeIn();
                    }
                } else {
                    console.log('Ajax error');
                }
                grid.removeClass('loading');
            });
        };

        let requestAjax = (_is_pagination = false, _pagination_has_prev = false, _clear = false) => {
            // console.log('_______ REQUESTING AJAX ________');
            setTimeout(() => {
                if (filter_opts[0] == $('.filter_block .search').val() && ! ajaxSent)
                {
                    // console.log('check #1: ', filter_opts[0] == $('.filter_block .search').val());
                    // console.log('check #2: ', filter_opts[1] == $('#content_type + div .jq-selectbox__select-text').html().toLowerCase());
                    // console.log('check #3: ', filter_opts[2] == $('#categories + div .jq-selectbox__select-text').html().toLowerCase());

                    sendAjax(_is_pagination, _pagination_has_prev, _clear);
                    // console.log('_______ SENDING AJAX ________');
                }
                else
                {
                    // console.log('_________ REJECTED _______');
                }
            }, 1000);
        };

        $('#content_type').on('change', function() {
            // console.log('Filter ----- content type');

            if ($(this).val() != 'all')
            {
                filter_opts[1] = $(this).val();
            }
            else
            {
                filter_opts[1] = '';
            }
            requestAjax(false, false, true);
        });

        $('#categories').on('change', function() {
            // console.log('Filter ----- category');
            // console.log($(this).val())

            if ($(this).val() != 'all')
            {
                filter_opts[2] = $(this).val();
            }
            else
            {
                filter_opts[2] = '';
            }

            requestAjax(false, false, true);
        });

        $('.filter_block .search').on('keyup', function(event) {
            var inp = String.fromCharCode(event.keyCode);
            if (/[a-zA-Z0-9-_ +()\']/.test(inp))
            {
                // console.log('Filter ----- search');
                let search_key = $(this).val().trim();
                // console.log(search_key);
                if (search_key.length > 2)
                {
                    filter_opts[0] = search_key;
                }
                else
                {
                    filter_opts[0] = '';
                }
                requestAjax(false, false, true);
            }
            else if($(this).val().trim() == '' && filter_opts[0] != '') {
                filter_opts[0] = '';
                requestAjax(false, false, true);
            }
            else {
                // console.log('keycode not in range');
            }

        });

        $('.filter_block .clear').click(function() {
            filter_opts = ['', '', ''];
            $('.filter_block .search').val('');
            $('#categories').next().find($('.jq-selectbox__select-text')).html('All');
            $('#content_type').next().find($('.jq-selectbox__select-text')).html('All');
            requestAjax(false, false, true);
            return false;
        });


        $('.resource_pagination > a').click(function(e) {
            requestAjax(true, $(this).hasClass('prev'));
            return false;
        });



        $('.resource_pagination .pagination').on('click', function(e) {
            let elem = e.target;
            if (elem.classList.contains('pagination_link'))
            {
                if (elem.innerHTML)
                {
                    $('.resource_pagination').attr('data-page', parseInt(elem.innerHTML) - 1);
                    requestAjax(true);
                }
            }

            return false;
        });



        /*
        * Template part form submit
        * */
        $('.before_foot .wpcf7-form').on('submit', function() {
            $('.before_foot .wpcf7-form button.button').addClass('active');
        }).bind('wpcf7invalid wpcf7submit', function() {
            setTimeout(() => {
                $('.before_foot .wpcf7-form button.button').removeClass('active');
            }, 300);
        });


        /*
        *
        * Job open embed form
        * */
        $('.default_text.singlejob .button').on('click', function(e) {
            // console.log('asdasd');
            $('.singlejob_embed_form').fadeIn();

            setTimeout(() => {
                $('html,body').animate({
                    scrollTop: ($('.singlejob_embed_form').offset().top - $('header').height()) + 'px'
                }, 300);
            }, 300);

            return false;
        });
        
        $(window).bind('load', () => {
            if ($('.has_note header').is(':visible'))
            {
                let height = jQuery('.top_note').innerHeight();
                if (height)
                {
                    $('.has_note header').css({'top': height + 'px'})
                }
            }
            $('.top_note_close').click(function() {
                // $('.has_note').css({'z-index': 99})
                $('.has_note header').animate({
                    top: '0px'
                }, 300);
            });
        });
    });

})(jQuery);