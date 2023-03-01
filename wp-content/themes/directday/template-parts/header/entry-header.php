<?php
/**
 * Displays the post header
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */
$title = get_the_title();
if(str_contains($title, 'DIRECTDAY')) {
    $title = explode(' ', $title);
    echo '<h1 class="directday-page-title"><span class="directday-blue">' . $title[0] . '</span><span>&nbsp;</span><span>' . $title[1] . '</span></h1>';
}
else
    the_title( '<h1 class="directday-page-title">', '</h1>' );
