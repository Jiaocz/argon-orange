<?php
// 说说添加到feed
function add_shuoshuo_to_feed ($query) {
    if (is_feed() || (is_search() && is_main_query() && !is_admin())) {
        $query->set('post_type', array('post', 'shuoshuo'));
    }
    return $query;
}
add_filter('pre_get_posts', 'add_shuoshuo_to_feed');

//使用 CDN 加速 gravatar
function o_gravatar_cdn($url){
	$cdn = "gravatar.loli.net/avatar/";
	$default_avatar = 'https://static.orangii.cn/avatar/default.jpg';
	$url = preg_replace("/\/\/(.*?).gravatar.com\/avatar\//", "//" . $cdn, $url);
	$url = preg_replace('/(\?|&)(d=[a-zA-Z]+)(&?)/', '\\1', $url);
	$url .= "&d=" . urlencode($default_avatar);
	return $url;
}
add_filter('get_avatar_url', 'o_gravatar_cdn');

function child_css() {
	$url = get_stylesheet_directory_uri();
	echo "<link rel=stylesheet id=\"orangii-style\" href=\"$url/style.css\" type=\"text/css\" media=\"all\">";
}
add_action('wp_head', 'child_css');

function comment_placeholder() {
	return "友好地评论一句，请尽量不要在评论区发送文章无关内容，如需发送时请到留言板。";
}
add_filter('argon_comment_textarea_placeholder', 'comment_placeholder');
?>