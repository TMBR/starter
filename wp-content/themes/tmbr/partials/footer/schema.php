<?php

$name = get_field('schema_name','option');
$description = get_field('schema_description','option');
$logo = get_field('schema_logo','option');
$url = get_field('schema_url','option');

$streetAddress = get_field('schema_street_address','option');
$poBox = get_field('schema_po_box','option');
$city = get_field('schema_city','option');
$state = get_field('schema_state','option');
$country = get_field('schema_country','option');
$zip = get_field('schema_zip','option');

$phone = get_field('schema_phone','option');
$fax = get_field('schema_fax','option');
$email = get_field('schema_email','option');

?>


<div itemscope itemtype="http://schema.org/LocalBusiness">

  <?php 
  // BUSINESS INFORMATION
  if ( $name ) { ?> 
  <h4><span itemprop="name"><?php echo $name; ?></span></h4>
  <?php } 

  if ( $description ) { ?> 
  <div itemprop="description"><?php echo $description; ?></div>
  <?php } 

  if ( $logo ) { ?> 
  <img itemprop="logo" src="<?php echo $logo['sizes']['thumbnail']; ?>" alt="<?php echo $logo['alt']; ?>" class="img-responsive" />
  <?php } 

  if ( $url ) { ?> 
  <a itemprop="url" href="grandtarghee.com"><?php echo $url; ?></a>

  <?php } ?>

  <div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
    <?php 
    // STREET ADDRESS
    if ( $streetAddress ) { ?> 
    <span itemprop="streetAddress"><?php echo $streetAddress; ?></span><br/>
    <?php } 

    if ( $poBox ) { ?> 
    <span itemprop="postOfficeBoxNumber">PO Box <?php echo $poBox; ?></span><br/>
    <?php } 

    if ( $city ) { ?> 
    <span itemprop="addressLocality"><?php echo $city; ?></span>,
    <?php } 

    if ( $state) { ?> 
    <span itemprop="addressRegion"><?php echo $state; ?></span><br/>
    <?php } 

    if ( $country ) { ?> 
    <span itemprop="addressCountry"><?php echo $country; ?></span></br/>
    <?php } 

    if ( $zip ) { ?> 
    <span itemprop="postalCode"><?php echo $zip; ?></span>
    
    <?php } ?>
  </div><!-- /address -->

  <?php 
  // STREET ADDRESS
  if ( $phone ) { ?> 
  <span itemprop="telephone"><?php echo $phone; ?></span> <br />
  <?php } 

  if ( $fax ) { ?> 
  <span itemprop="faxNumber"><?php echo $fax; ?></span> <br />
  <?php } 

  if ( $email ) { ?> 
  <a href="mailto:<?php echo $email; ?>" itemprop="email"><?php echo $email; ?></a>
  <?php } ?>

  </div><!-- /schema.org -->


                      