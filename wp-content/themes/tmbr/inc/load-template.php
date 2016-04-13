<?php
/**
 * Allows the passing of variables to a template file when loaded.  Should help
 * to remove the need for unnecessarily putting data into the $_GLOBAL scope.
 *
 * Usage:
 * // This example will expose two variables to the loaded template:
 * // $type = 'Foo', and $url = '//example.com/test.jpg'
 * tmbr_load_template( 'partials/map.php', array(
 *   'type' => 'Foo',
 *   'url'  => '//example.com/test.jpg'
 * ) );
 *
 * @param string $filename Name of the file that you would typically pass to `get_template_part()` **WITH THE EXTENSION**
 * @param array $data array of information to be utilized in the template
 * @return null  This echos out the template, does not return it
 */
function tmbr_load_template( $filename, $data = array() ) {
  $file = locate_template( $filename );
  if( $file ){
    extract( $data );
    include( $file );
  }
}