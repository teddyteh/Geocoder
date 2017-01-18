<script type="text/javascript">
    function showSelection(number){
        for (i = 0; i <= number; i++) { 
        	var objDiv = document.getElementById("radioDiv");
         
	        var radioItem1 = document.createElement("input");
	        radioItem1.type = "radio";
	        radioItem1.name = "radioGrp";
	        radioItem1.id = "rad1";
	        radioItem1.value = "myradio1";
	 
	        var objTextNode1 = document.createTextNode("Radio1");
	        
	        var objLabel = document.createElement("label");
	        objLabel.htmlFor = radioItem1.id;
	        objLabel.appendChild(radioItem1);
	        objLabel.appendChild(objTextNode1);

	        objDiv.appendChild(objLabel);
		}

    }

    function test() {
    	alert("");
    }
</script>

<div id="radioDiv"></div>

<?php 

// information received from the client
$address = $_GET['foo'];

// do something with this information
$info = geocode($address);

// Show detailed information if address is valid
if (!empty($info)) {
	echo 'Street number: ' . $info['street_number'] . "<br/>";
	echo 'Street name: ' . $info['route'] . "<br/>";
	echo 'City: ' . $info['locality political'] . "<br/>";
	echo 'State: ' . $info['administrative_area_level_1 political'] . "<br/>";
	echo 'Post Code: ' . $info['postal_code'] . "<br/>";
	echo 'Country: ' . $info['country political'] . "<br/>";
	echo 'Latitude: ' . $info['lat'] . "<br/>";	
	echo 'Longitude: ' . $info['lng'] . "<br/>";		
}

// function to geocode address, it will return false if unable to geocode address
function geocode($address){
 
    // url encode the address
    $address = urlencode($address);
     
    // google map geocode api url
    $url = "http://maps.google.com/maps/api/geocode/json?address={$address}";
 
    // get the json response
    $resp_json = file_get_contents($url);
     
    // decode the json
    $resp = json_decode($resp_json, true);
 
    // response status will be 'OK', if able to geocode given address 
    if ($resp['status']=='OK'){
 
 		$data = array();
		// more than one result found
 		if (count($resp['results']) > 1) {
 			
 			session_start();

 			for ($x = 0; $x < count($resp['results']); $x++) {
			    $data[$x] = $resp['results'][$x]['formatted_address'];;
			}

			$_SESSION['data'] = $data;
 			header('Location: choice.php');
		}

        // get the important data
        $data = array();
		
		foreach($resp['results']['0']['address_components'] as $element){
			// Element can have multiple types
			$data[ implode(' ',$element['types']) ] = $element['long_name'];			
		}
		
		if (array_key_exists("street_number", $data) && array_key_exists("route", $data) && array_key_exists("locality political", $data) && array_key_exists("administrative_area_level_1 political", $data) && array_key_exists("postal_code", $data) && array_key_exists("country political", $data) && $resp['results'][0]['geometry']['location']['lat'] && $resp['results'][0]['geometry']['location']['lng']) {
			$data['lat'] = $resp['results'][0]['geometry']['location']['lat'];
			$data['lng'] = $resp['results'][0]['geometry']['location']['lng'];

			return $data;	
		} else {
			return false;
		}


    } else {
        return false;
    }
}

?>