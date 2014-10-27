<?php 

/*

ALLOWS YOU TO LOAD CONTENT BASED ON FAMILY, if (is_page(#)){} or if ( $post->post_parent == '#' ) {}
http://css-tricks.com/snippets/wordpress/if-page-is-parent-or-child/

Usage: 
	if (is_tree(2)) {}

*/

function is_tree($pid)
{
  global $post;

  $ancestors = get_post_ancestors($post->$pid);
  $root = count($ancestors) - 1;
  $parent = $ancestors[$root];

  if(is_page() && (is_page($pid) || $post->post_parent == $pid || in_array($pid, $ancestors)))
  {
    return true;
  }
  else
  {
    return false;
  }
};
?>