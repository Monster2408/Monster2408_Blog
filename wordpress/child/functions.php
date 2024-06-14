<?php //子テーマ用関数
if ( !defined( 'ABSPATH' ) ) exit;

//子テーマ用のビジュアルエディタースタイルを適用
add_editor_style();

//以下に子テーマ用の関数を書く
function custom_rss_feed_action() {
	add_feed('custom', 'custom_rss_feed');
}
add_action('init', 'custom_rss_feed_action');

function custom_rss_feed() {
	get_template_part('rss', 'customized');
}