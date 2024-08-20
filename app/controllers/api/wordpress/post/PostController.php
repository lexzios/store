<?php

class PostController extends BaseController {

    public function recent() {

        define('WP_USE_THEMES', false);
        global $wp, $wp_query, $wp_the_query, $wp_rewrite, $wp_did_header;;
        require('blog/wp-blog-header.php');


        $res = array(
			'success' => false,
		);

        query_posts(array(
          'offset' => 0,
          'posts_per_page' => 10,
          'post_type' => 'post',
          'post_status' => 'publish',
        ));

        if (have_posts()) {

            $i = 0;
            $res['post'] = array();

			while (have_posts()) {
                the_post();

                $res['post'][$i]['id'] = get_the_ID();
                $res['post'][$i]['title'] = get_the_title();
                $res['post'][$i]['url'] = apply_filters('the_permalink', get_permalink());
                $res['post'][$i]['content'] = strip_shortcodes(wp_trim_words( get_the_content(), 20 ));
                $res['post'][$i]['date_day'] = get_the_time('d');
                $res['post'][$i]['date_month'] = get_the_time('M');

                $i++;
            };

            $res['success'] = true;
            $statusCd = HTTPConstant::OK;
		}else {
            $statusCd = HTTPConstant::NOT_FOUND;
        }

        return Response::json($res, $statusCd);
    }
}
