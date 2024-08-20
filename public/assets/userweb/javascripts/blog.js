'use strict';

(function() {

    var host = 'http://www.tokocentralpc.com/';

    var Blog = {

        api: host + 'api/blog/',

        initialize: function() {
            this.recent();
        },

        recent: function() {
            var blog = document.getElementById('recent-blog');

            if (blog) {

                var xhr = new XMLHttpRequest();
                var res = '';

                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 4 ) {

                        try {
                            res = JSON.parse(xhr.responseText);
                        }catch(error) {
                            
                            blog.innerHTML = '';

                            var msg = document.createElement('p');
                            msg.innerHTML = 'No Blog Post Found ...'
                            blog.appendChild(msg);
                            blog.className = '';
                        }

                        if(xhr.status == 200) {

                            if (res) {

                                blog.innerHTML = '';

                                for(i = 0; i < res.post.length ; i++) {
                                    if (i%2 == 0) {
                                        var sets = document.createElement('div');
                                        sets.setAttribute('class', 'blog-set');
                                        blog.appendChild(sets);
                                    }
                                }

                                var setIndex = 0;

                                res.post.forEach(function(d, i) {

                                    var set = document.getElementsByClassName('blog-set');

                                    var col = document.createElement('div');
                                    col.setAttribute('class', 'col-md-6');

                                    if(i%2 == 0 && i > 0) {
                                        setIndex++;
                                    }
                                    set[setIndex].appendChild(col);

                                    var article = document.createElement('article');
                                    col.appendChild(article);

                                    var date = document.createElement('div');
                                    date.setAttribute('class', 'date');
                                    article.appendChild(date);

                                    var day = document.createElement('span');
                                    day.setAttribute('class', 'day');
                                    day.innerHTML = d.date_day;
                                    date.appendChild(day);

                                    var month = document.createElement('span');
                                    month.setAttribute('class', 'month');
                                    month.innerHTML = d.date_month;
                                    date.appendChild(month);

                                    var header = document.createElement('h4');
                                    article.appendChild(header);

                                    var url = document.createElement('a');
                                    url.setAttribute('target', '_blank');
                                    url.setAttribute('href', d.url);
                                    url.innerHTML = d.title;
                                    header.appendChild(url);

                                    var content = document.createElement('p');
                                    content.innerHTML = d.content;

                                    var readMore = document.createElement('a');
                                    readMore.setAttribute('target', '_blank');
                                    readMore.setAttribute('href', d.url);
                                    readMore.innerHTML = d.title;
                                    readMore.innerHTML = 'read more';
                                    readMore.setAttribute('class', 'read-more');
                                    content.appendChild(readMore);

                                    article.appendChild(content);
                                });

                                $("#recent-blog").owlCarousel({
                                    items : 1,
                                    itemsCustom : false,
                                    itemsDesktop : [1199,4],
                                    itemsDesktopSmall : [980,3],
                                    itemsTablet: [768,2],
                                    itemsTabletSmall: false,
                                    itemsMobile : [479,1],
                                    singleItem : false,
                                    itemsScaleUp : false,

                                });

                            } else {

                                blog.innerHTML = '';

                                var msg = document.createElement('p');
                                msg.innerHTML = 'No Blog Post Found ...'
                                blog.appendChild(msg);
                                blog.className = '';
                            }

                        }else {

                            blog.innerHTML = '';

                            var msg = document.createElement('p');
                            msg.innerHTML = 'No Blog Post Found ...'
                            blog.appendChild(msg);
                            blog.className = '';
                        }

                    }
                }

                xhr.open('GET',this.api + 'recent',true);
                xhr.send();
            }
        }
    };

    window.onload = function()  {
        var waypoint = new Waypoint({
            element: document.getElementById('company-logo'),
            handler: function() {
                Blog.initialize();
                this.disable();
            },
        });
    };

})();
