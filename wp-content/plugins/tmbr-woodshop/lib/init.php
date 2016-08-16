<?php
/*    Shopify User API Integration to approve pro users
 *    @param : User types : pro, friendsandfam
 *
 *
*/


$gformID = 1;
require_once('shopifyAPI.php');



/*
 * UPDATE Customer in Shopify when form is submitted with valid pro code
   -------------------------
 *
*/

add_action( 'gform_after_submission_3', 'after_submission', 10, 2 );

function after_submission( $entry, $form ) {

    $procode =  strtoupper( rgar( $entry, '12') );

    // Figure out what level of a discount we are dealing with
    $prolevelchar = substr($procode, 0, 1);
    $approved = rgar( $entry, '11');

    switch ($prolevelchar) {
         case "R":
            $approved = 'Approved Shop';
            break;
        case "S":
            $approved = 'Approved Shop';
            break;
        case "P":
            $approved = 'Approved Pro';
            break;
        case "N":
            $approved = 'Approved Industry';
            break;
        case "V":
            $approved = 'Approved Investor';
            break;
        case "F":
            $approved = 'Approved Friends';
            break;
        case "Y":
            $approved = 'Approved Rep';
            break;
        default:
            $approved = 'Pending';
    }

    // Update status field with procode
    GFAPI::update_entry_field($entry["id"], 11, $approved );

    // Create customer in shopify with the correct discount level based on the approved code
    update_shopify_customer($form, $entry, $approved);

}



/*
 * Check Database of Pro Codes to see if value code has been used
   -------------------------
   form validation will fail if code status = 1
 *
*/
add_filter( 'gform_validation_3', 'validate_code' );

function validate_code( $validation_result ) {

    // 2 - Get the form object from the validation result
    $form = $validation_result['form'];

    // 3 - Get the current page being validated
    $current_page = rgpost( 'gform_source_page_number_' . $form['id'] ) ? rgpost( 'gform_source_page_number_' . $form['id'] ) : 1;

    // 4 - Loop through the form fields
    foreach( $form['fields'] as &$field ) {

        // 5 - If the field does not have our designated CSS class, skip it
        if ( strpos( $field->cssClass, 'validate-code' ) === false ) {
            continue;
        }
        // 6 - Get the field's page number
        $field_page = $field->pageNumber;

        // 7 - Check if the field is hidden by GF conditional logic
        $is_hidden = RGFormsModel::is_field_hidden( $form, $field, array() );

        // 8 - If the field is not on the current page OR if the field is hidden, skip it
        if ( $field_page != $current_page || $is_hidden ) {
            continue;
        }

        // 9 - Get the submitted value from the $_POST
        $field_value = rgpost( "input_{$field['id']}" );

        // 10 - Make a call to your validation function to validate the value
        $is_valid = is_code_valid( $field_value );

        // 11 - If the field is valid we don't need to do anything, skip it
        if ( $is_valid ) {
            continue;
        }

        // 12 - The field field validation, so first we'll need to fail the validation for the entire form
        $validation_result['is_valid'] = false;

        // 13 - Next we'll mark the specific field that failed and add a custom validation message
        $field->failed_validation = true;
        $field->validation_message = 'The Pro Code You Enered is not valid.';

    }

    // 14 - Assign our modified $form object back to the validation result
    $validation_result['form'] = $form;

    // 15 - Return the validation result
    return $validation_result;
}

// Check DB to see if the procode that was entered is valid or has been used
function is_code_valid( $code ) {
  // Search the procode table for a code that matches what was entered in the form
  global $wpdb;
  $sql = "SELECT code, status FROM procode WHERE code = %s";
  $query = $wpdb->prepare($sql, $code);
  $results = $wpdb->get_results($query);

  if (!$results) {
    die("Invalid query.");
  }

  foreach( $results as &$result ) {
    if($result->status == 1 ){
      // if code has been used invalidate submission
      return false;
    } else {
      // if code has not been used validate submission
      $wpdb->update( 'procode', array( 'status' => 1, 'updated_at' => current_time( 'mysql' )),array('code'=>$code));
      return true;
    }
  }

}




/*
 * UPDATE Customer in Shopify when submitted form is manually approved
 ------------------------
 *
*/

add_action( 'gform_after_update_entry_' . $gformID, 'send_to_shopify',10,2);

function send_to_shopify( $form, $entry_id  ) {

  // Get Entry Value
  $entry = GFAPI::get_entry( $entry_id );

  // Check if approved - based on ID of Field in the form
  $approved = rgar( $entry, '11');
  // echo 'approved status : ' . $approved;

  if( $approved != "Denied" || $approved != "Pending"){
    update_shopify_customer($form, $entry, $approved);
  }

  // Send email if set to denied
  if($approved == "Denied"){
    $to = rgar( $entry, '2' );
    $subject = 'Flylow Pro Application Status';
    $message = rgar( $entry, '1.3' ) .', we regret to inform you that your application for the Flylow Pro program has been denied.';
    wp_mail( $to, $subject, $message, $headers );
  }

}



function update_shopify_customer($form, $entry, $approved) {

      $tags = array();

      $c = new ShopifyAPI;
      $email = rgar( $entry, '2' );
      $d = $c->findCustomer('',$email);

      // Check to see if customer already exists in Shopify Database
      if(empty($d->data["customers"]))
      {
        // echo 'new customer';

            // Add pro or elite pro tags on status change to approved
            switch ($approved) {
                case "Approved Shop":
                    array_push($tags,'60off');
                    array_push($tags,'Discount-Shop');
                    break;
                case "Approved Pro":
                    array_push($tags,'50off');
                    array_push($tags,'Discount-Pro');
                    break;
                case "Approved Industry":
                    array_push($tags,'50off');
                    array_push($tags,'Discount-Industry');
                    break;
                case "Approved Investor":
                    array_push($tags,'50off');
                    array_push($tags,'Discount-Investor');
                    break;
                case "Approved Friends":
                    array_push($tags,'50off');
                    array_push($tags,'Discount-Friends');
                    break;
                case "Approved Rep":
                    array_push($tags,'70off');
                    array_push($tags,'Discount-Rep');
                    break;
                default:
                    break;
            }

            //if Customer doesn't exist then add them.
            $customerData = array
            (
                "customer" => array(
                "first_name"    =>  rgar( $entry, '1.3' ),
                "last_name"     =>  rgar( $entry, '1.6' ),
                "email"         =>  rgar( $entry, '2' ),
                "verified_email" =>  true,
                "send_email_invite" => true,
                "tags" => implode(",",$tags),
                "note" => "Pro Application Notes : " . rgar( $entry, '7' ),
                "addresses"     =>  array(
                        array(
                          "address1"  =>  rgar( $entry, '10.1' ),
                          "address2"  =>  rgar( $entry, '10.2' ),
                          "city"      =>  rgar( $entry, '10.3' ),
                          "country"   =>  "US",
                          "first_name"=>  rgar( $entry, '1.3' ),
                          "last_name" =>  rgar( $entry, '1.6' ),
                          "phone"     =>  rgar( $entry, '4' ),
                          "province"  =>  rgar( $entry, '10.4' ),
                          "zip"       =>  rgar( $entry, '10.5' )
                          )
                    )
                  )
              );

            // print_r($customerData);

            $c->createNewCustomer($customerData);
      } else {
              $waspro = false;

              // Get existing tags
              $c_tags = $d->data["customers"][0]["tags"];

              // Add existing tags to tag list
              if($c_tags){
                $tags = array_merge($tags,explode(",",$c_tags));
              }

              foreach($tags as $key => $v)
              {
                  // Find pro or elite-pro tags
                  if( strpos($v, 'off') || strpos( $v, 'Discount') )
                  {
                    // set to true to stop remove points notice
                    $waspro = true;
                    //Remove tags
                    unset($tags[$key]);
                  }
              }

              // Add tags on status change to approved
              switch ($approved) {
                  case "Approved Shop":
                      array_push($tags,'60off');
                      array_push($tags,'Discount-Shop');
                      break;
                  case "Approved Pro":
                      array_push($tags,'50off');
                      array_push($tags,'Discount-Pro');
                      break;
                  case "Approved Industry":
                      array_push($tags,'50off');
                      array_push($tags,'Discount-Industry');
                      break;
                  case "Approved Investor":
                      array_push($tags,'40off');
                      array_push($tags,'Discount-Investor');
                      break;
                  case "Approved Friends":
                      array_push($tags,'50off');
                      array_push($tags,'Discount-Friends');
                      break;
                  case "Approved Rep":
                      array_push($tags,'70off');
                      array_push($tags,'Discount-Rep');
                      break;
                  default:
              }


            // Customer exists so update tag for customer
            $c->updateCustomerTag($d->data["customers"][0]["id"],implode(",",$tags));

            if(false == $waspro) { ?>
              <?php
              // Send email to user that they are now approved as a pro account
              add_filter( 'wp_mail_content_type', function( $content_type ) {
                return 'text/html';
              });

              $to = rgar( $entry, '2' );
              $subject = 'Flylow Pro Application Approved';
              $message = '<p>'. rgar( $entry, '1.3' ) .', Welcome! You have been accepted to the Flylow pro program.</p>

              <p>Please go here to set a new password - https://shop.flylowgear.com/pages/enable-account if you are unable to login at https://shop.flylowgear.com/account/login</p>

              <p>Once you have logged in correctly, you should see pro pricing next to all products eligible for the program. If you do not see this pricing, you may not have logged in correctly. <p>

              <p>So again welcome! – we’re here to help so let us know what else we can do for you. </p>


              <p>
              Flylow Pro Sales
              Berkeley, CA  USA
              info@flylowgear.com</p>
              ';

              wp_mail( $to, $subject, $message);
            }
      }
}