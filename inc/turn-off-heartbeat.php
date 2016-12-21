<?php
/**
 * https://hiddedevries.nl/en/blog/2016-02-08-turning-off-heartbeat-in-wordpress-made-my-day
 * Heartbeat API is a thing built into WordPress that sends a POST request every 15 seconds.
 * It allows for interesting functionalities like revision tracking, but can also dramatically
 * slow things down and even block editors from editing content (if your connection is quite slow).
 */

function remove_heartbeat() {
	wp_deregister_script('heartbeat');
}

add_action( 'init', 'remove_heartbeat');
