<?php

// Utility function to geocode an address, return false if more than one result is found
function geocode($address) {

    // url encode the address
  $address = urlencode($address);

    // Google Geocode API
  $url = "http://maps.google.com/maps/api/geocode/json?address={$address}";

    // Get the JSON response
  $resp_json = file_get_contents($url);

    // Decode the JSON
  $resp = json_decode($resp_json, true);

    // Check status field in the response
  if ($resp['status']=='OK'){

    // Create an response array
    $data = array();
    
    // More than one result found
    if (count($resp['results']) > 1) {

      // Start a session
      session_start();

      // Store all addresses in the response array
      for ($x = 0; $x < count($resp['results']); $x++) {
        $data[$x] = $resp['results'][$x]['formatted_address'];;
      }

      // Store the response array in the session
      $_SESSION['data'] = $data;

      // Redirect to choices page
      header('Location: results.php');
    } else {
      // Store all address components in the response array; If given address is missing a component, it will not be created in the response array.
      foreach($resp['results']['0']['address_components'] as $element){
        $data[ implode(' ',$element['types']) ] = $element['long_name'];      
      }

      // Check if any of the components is empty
      if (array_key_exists("street_number", $data) && array_key_exists("route", $data) && array_key_exists("locality political", $data) && array_key_exists("administrative_area_level_1 political", $data) && array_key_exists("postal_code", $data) && array_key_exists("country political", $data) && $resp['results'][0]['geometry']['location']['lat'] && $resp['results'][0]['geometry']['location']['lng']) {
        // Append additional information to the response array
        $data['lat'] = $resp['results'][0]['geometry']['location']['lat'];
        $data['lng'] = $resp['results'][0]['geometry']['location']['lng'];
        $data['formatted_address'] = $resp['results'][0]['formatted_address'];

        // Return the response array
        return $data; 
      } else {
        // One of the address component is empty
        return false;
      }
    }
  } else {
    // JSON response returned status not ok
    return false;
  }
}

?>