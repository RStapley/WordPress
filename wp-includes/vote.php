<?php
/**
 * Manages WordPress comments
 *
 * @package WordPress
 * @subpackage Vote
 */

function wp_insert_vote($votedata){
	global $wpdb;
	
	$person = $votedata['author'];
	$vote = $votedata['value'];
	$post = $votedata['bill'];
	
	$compacted = compact( 'person','vote','post' );
	
	if ( ! $wpdb->insert( $wpdb->users_vote, $compacted ) ) {
		return false;
	}
	
	$id = (int) $wpdb->insert_id;
	
	return $id;
}