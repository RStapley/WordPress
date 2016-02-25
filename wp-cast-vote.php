<?php
/**
 * Handles Casting a Vote to WordPress.
 *
 * @package WordPress
 */

if ( 'POST' != $_SERVER['REQUEST_METHOD'] ) {
	header('Allow: POST');
	header('HTTP/1.1 405 Method Not Allowed');
	header('Content-Type: text/plain');
	exit;
}

/** Sets up the WordPress Environment. */
require( dirname(__FILE__) . '/wp-load.php' );

// If the user is logged in
$user = wp_get_current_user();
if ( ! $user->exists() ) {
	wp_die( __( '<strong>ERROR</strong>: must be signed in to cast a vote.' ), 200 );
}

$value = $_POST['value'];
$author = $user->ID;
$bill = $_POST['postId'];

$votedata = compact('value','author','bill');

$voteId = wp_insert_vote($votedata);
if(! $voteId)
{
	wp_die( __( "<strong>ERROR</strong>: The vote could not be saved. Please try again later." ) );
}

$location = 'http://localhost/wp/';

wp_safe_redirect( $location );
exit;