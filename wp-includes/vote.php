<?php
/**
 * Manages WordPress comments
 *
 * @package WordPress
 * @subpackage Vote
 */

function wp_insert_vote($votedata){
	global $wpdb;
	
	$user = $votedata['author'];
	$vote = $votedata['value'];
	$post = $votedata['bill'];
	
	$compacted = compact( 'user','vote','post' );
	
	if ( ! $wpdb->insert( $wpdb->user_post_vote, $compacted ) ) {
		return false;
	}
	
	$id = (int) $wpdb->insert_id;
	
	return $id;
}