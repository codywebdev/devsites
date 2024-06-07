<?php

function object2array($object) { 
	//Converts an object (usually a SimpleXML object) into an associative array and returns the array.
	return @json_decode(@json_encode($object),1); 
}
 
function get_aws_item_info($itemId, $responseGroup="Large") {
	/*
	Performs an Amazon Item Lookup on the provided Item ID (ASIN) and returns the item information in an Array.
	Can be used to perform batch lookups, up to 10 items.
	
	$responseGroup is an optional parameter to return certain information about an item and can be any of the following:
	
	Accessories, AlternateVersions, BrowseNodeInfo, BrowseNodes, Cart, CartNewReleases, CartTopSellers, CartSimilarities, Collections, 
	EditorialReview, Images, ItemAttributes, ItemIds, Large, Medium, MostGifted, MostWishedFor, NewReleases, OfferFull, OfferListings, 
	Offers, OfferSummary, PromotionSummary, RelatedItems, Request, Reviews, SalesRank, SearchBins, Seller, SellerListing, Similarities, 
	Small, TopSellers, Tracks, Variations, VariationImages, VariationMatrix, VariationOffers, VariationSummary
	
	See http://docs.amazonwebservices.com/AWSECommerceService/latest/DG/index.html?CHAP_ResponseGroupsList.html for more details on Response Groups.
	
	Parameters:
		$itemId - A string containing the Item ID (ASIN) of an Amazon product.  Can contain up to 10 Item ID's seperated by commas (no spaces).
		$responseGroup - *Optional* - Defines the type of information that is included in the Item Lookup response.
	*/
	$region = "com";
	$service = "AWSECommerceService";
	$timestamp = rawurlencode(gmdate("Y-m-d\TH:i:s\Z"));
	$version = "2011-08-01";//2010-11-01";
	$operation = "ItemLookup";
	$itemId = rawurlencode($itemId);
	
	//Create URL formatted list of variables.  Must be in ascending order, case-sensitive (Capital letters before lowercase).
	$urlVariableString = "AWSAccessKeyId=".PUBLIC_KEY.
						 "&AssociateTag=".rawurlencode(ASSOCIATE_TAG).
						 "&ItemId=".$itemId.
						 "&Operation=".$operation.
						 "&ResponseGroup=".$responseGroup.
						 "&Service=".$service.
						 "&Timestamp=".$timestamp.
						 "&Version=".$version;
						 
	//Generate the string to be used in the calulation of the signature
	$rawString = "GET"."\n"."ecs.amazonaws.".$region."\n"."/onca/xml"."\n".$urlVariableString;	
	
	//Generate the signature to sign the Item Lookup request
	$signature = rawurlencode(base64_encode(hash_hmac("sha256", $rawString, PRIVATE_KEY, true)));
	
	//Generate the full URL of the Item Lookup request
	$urlRequest = "http://ecs.amazonaws.".$region."/onca/xml?".
				  $urlVariableString.
				  "&Signature=".$signature;
	
	//Send the request to Amazon using CURL and record the response into $response
	$ch = curl_init();
		curl_setopt ( $ch, CURLOPT_URL, $urlRequest );
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt ( $ch, CURLOPT_INTERFACE, waitInQueue() );
	$response = curl_exec ($ch);
	
	if ($response === false) {
		return false;
	}
	else {
		$pageXml = simplexml_load_string($response);
		$pageArray = object2array($pageXml);
		return $pageArray;
	}
}

function waitInQueue($maxWaitTime = 30, $waitTime = AWS_QUERY_QUEUE_WAIT_TIME) {
	/*
	AWS only allows 1 AWS query per ip per second. This function pauses execution of a function while waiting 
	in a queue.  Once an IP address is returned, then the application can continue and us the IP address in a 
	CURL request.  If the queue is full and times out after $maxWaitTime seconds, then this function returns false.
	
	Return values - Returns an ip address to use in a curl request when a request can be made.  
					Returns false if the queue is full and times out after $maxWaitTime seconds.
	*/
	$result = false;
	$i=0;
	
	while (!$result && $i < ($maxWaitTime/$waitTime)) {
		$curTime = microtime(true);
		$query = "SELECT * FROM `".DB_NAME."`.`queryQueue` ORDER BY `time` ASC LIMIT 1";
		$result = mysql_query($query);
		$row =  mysql_fetch_assoc($result);
		$queryTime = $row['time'];
		$queryId = $row['id'];
		$queryIpAddress = $row['ip'];
		
		if ($curTime <= ($queryTime+$waitTime)) {
			usleep((($queryTime+$waitTime)-$curTime)*1000000);
		}
		
		usleep(rand(10,50)*1000); //wait .001 - .005 seconds
		$newTime = microtime(true);
		$query = "UPDATE `".DB_NAME."`.`queryQueue` SET `time` = '".$newTime."' WHERE `queryQueue`.`time` = '".$queryTime."' AND `id` ='".$queryId."' LIMIT 1";
		$result = mysql_query($query);
		$query = "SELECT * FROM `".DB_NAME."`.`queryQueue` WHERE `time` = '".$newTime."' AND `id` ='".$queryId."' LIMIT 1";
		$result = mysql_query($query);
		$result =  mysql_num_rows($result);
		$i++;
		//echo $newTime.'<br />';
	}
	if ($i < ($maxWaitTime/$waitTime)) return $queryIpAddress;
	else return false;
}

function modify_cart($itemString,$action="modify") {
	/*
	Takes an item string and modifies the quantity of that item in the customers shopping cart. Setting at item quantity to 0 deletes the item.
	
	Parameters:
		$itemString - An item string containing the ASIN of the product and the quantity of that product that the customer 
					  wishes to have in their cart. Values are separated by comma's and can contain multiple item strings. 
					  (Format:"asin,quantity,asin,quantity")
		$action - A string containing the type of operation to be conducted.
				  modify - *default* Modify the total quantity of a product. If the product isn't in the cart, it adds it.  If 
						   the quantity is set to 0 then it deletes the item from the cart.
				  empty - Deletes all items from the customers cart.  Does not delete the cart id.  The cart id remains available.
		
	Requirements:
		This function must be called before anything is output to the browser in order for the cookie to be set.
	*/
	$region = "com";
	$service = "AWSECommerceService";
	$timestamp = rawurlencode(gmdate("Y-m-d\TH:i:s\Z"));
	$version = "2010-11-01";
	$cartId = rawurlencode($_COOKIE['cart_id']);
	$hmac = rawurlencode($_COOKIE['hmac']);
	$itemArray = array();
	
	
	//Find out the contents of the cart if the user has already created a cart
	if ($cartId != '') {
		//Begin cartArray
			$region = "com";
			$service = "AWSECommerceService";
			$timestamp = rawurlencode(gmdate("Y-m-d\TH:i:s\Z"));
			$version = "2010-11-01";
			$cartArrayVariableString = "AWSAccessKeyId=".PUBLIC_KEY.
								 "&AssociateTag=".rawurlencode(ASSOCIATE_TAG).
								 "&CartId=".$cartId.
								 "&HMAC=".$hmac.
								 "&Operation=CartGet".
								 "&Service=".$service.
								 "&Timestamp=".$timestamp.
								 "&Version=".$version;
			//Generate the string to be used in the calulation of the signature
			$rawString = "GET"."\n"."ecs.amazonaws.".$region."\n"."/onca/xml"."\n".$cartArrayVariableString;	
			//Generate the signature to sign the request
			$signature = rawurlencode(base64_encode(hash_hmac("sha256", $rawString, PRIVATE_KEY, true)));
			//Generate the full URL of the request
			$urlRequest = "http://ecs.amazonaws.".$region."/onca/xml?".
						  $cartArrayVariableString.
						  "&Signature=".$signature;
			//Send the request to Amazon using CURL and record the response into $response
			$ch = curl_init();
				curl_setopt ( $ch, CURLOPT_URL, $urlRequest );
				curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
				curl_setopt ( $ch, CURLOPT_INTERFACE, waitInQueue() );
			$response = curl_exec ($ch);
			$pageXml = simplexml_load_string($response);
			$cartArray = object2array($pageXml);
			$cartArray = $cartArray['Cart'];
		//End cartArray
	}
	
	//Break up the $itemString into an array
	$itemArrayExplode = explode(',',$itemString);
	$numItems = sizeof($itemArrayExplode)/2;
	$numCartItems = sizeof($cartArray['CartItems']['CartItem']);
	for ($i=0,$j=0;$j<$numItems;$i++,$j++) {
		$itemArray[$j]['asin'] = $itemArrayExplode[$i];
		$i++;
		$itemArray[$j]['quantity'] = $itemArrayExplode[$i];
		for ($k=0;$k<$numCartItems;$k++) {
			if ($cartArray['CartItems']['CartItem'][$k]['ASIN'] == $itemArray[$j]['asin']) {
				$itemArray[$j]['cartItemId'] = $cartArray['CartItems']['CartItem'][$k]['CartItemId'];
			}
		}
		if ($cartArray['CartItems']['CartItem']['ASIN'] == $itemArray[$j]['asin']) {
			$itemArray[$j]['cartItemId'] = $cartArray['CartItems']['CartItem']['CartItemId'];
		}
		if ($itemArray[$j]['cartItemId'] == '') {
		//Only look up the offerListingID if the item is not in the cart
			//Begin offerListingID
				$region = "com";
				$service = "AWSECommerceService";
				$timestamp = rawurlencode(gmdate("Y-m-d\TH:i:s\Z"));
				$version = "2011-08-01";//2010-11-01";
				$offerListingIdVariableString = "AWSAccessKeyId=".PUBLIC_KEY.
									 "&AssociateTag=".rawurlencode(ASSOCIATE_TAG).
									 "&Condition=All".
									 "&ItemId=".$itemArray[$j]['asin'].
									 "&Operation=ItemLookup".
									 "&ResponseGroup=Offers".
									 "&Service=".$service.
									 "&Timestamp=".$timestamp.
									 "&Version=".$version;
				//Generate the string to be used in the calulation of the signature
				$rawString = "GET"."\n"."ecs.amazonaws.".$region."\n"."/onca/xml"."\n".$offerListingIdVariableString;	
				//Generate the signature to sign the request
				$signature = rawurlencode(base64_encode(hash_hmac("sha256", $rawString, PRIVATE_KEY, true)));
				//Generate the full URL of the request
				$urlRequest = "http://ecs.amazonaws.".$region."/onca/xml?".
							  $offerListingIdVariableString.
							  "&Signature=".$signature;
				//Send the request to Amazon using CURL and record the response into $response
				$ch = curl_init();
					curl_setopt ( $ch, CURLOPT_URL, $urlRequest );
					curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
					curl_setopt ( $ch, CURLOPT_INTERFACE, waitInQueue() );
				$response = curl_exec ($ch);
				$pageXml = simplexml_load_string($response);
				$pageArray = object2array($pageXml);
				if ($pageArray['Items']['Item']['Offers']['TotalOffers'] > 1) {
					for ($k=0;$k<$pageArray['Items']['Item']['Offers']['TotalOffers'];$k++) {
						if ($pageArray['Items']['Item']['Offers']['Offer'][$k]['OfferAttributes']['Condition'] == 'New') {
							$itemArray[$j]['offerListingId'] = $pageArray['Items']['Item']['Offers']['Offer'][$k]['OfferListing']['OfferListingId'];
						}
					}
				}
				else if ($pageArray['Items']['Item']['Offers']['TotalOffers'] > 0) {
						if ($pageArray['Items']['Item']['Offers']['Offer']['OfferAttributes']['Condition'] == 'New') {
							$itemArray[$j]['offerListingId'] = $pageArray['Items']['Item']['Offers']['Offer']['OfferListing']['OfferListingId'];
					}
				}
			//End offerListingID
		}
	}
			
	//Create a cart if the customer doesn't have a cart id in their cookie history.
	if ($cartId == '') {
		$operation = "CartCreate";
		//Create URL formatted list of variables.  Must be in ascending order, case-sensitive (Capital letters before lowercase).
		$urlVariableString = "AWSAccessKeyId=".PUBLIC_KEY.
							 "&AssociateTag=".rawurlencode(ASSOCIATE_TAG);
						for ($i=0;$i<$numItems;$i++) {
		$urlVariableString .= "&Item.".($i+1).".OfferListingId=".$itemArray[$i]['offerListingId'].
							  "&Item.".($i+1).".Quantity=".$itemArray[$i]['quantity'];
						}
		$urlVariableString .= "&Operation=".$operation.
							  "&Service=".$service.
							  "&Timestamp=".$timestamp.
							  "&Version=".$version;
	}
	//Change the quantity of an item in the customers cart.
	else if ($action == "modify") {
		$modifyArray = array();
		$addArray = array();
		for ($i=0;$i<$numItems;$i++) {
			if (isset($itemArray[$i]['cartItemId'])) {
				array_push($modifyArray, $itemArray[$i]);
			}
			else {
				array_push($addArray, $itemArray[$i]);
			}
		}
		if (sizeof($modifyArray)>0 && sizeof($addArray)>0) {
			//Process the CartAdd operation
				$operation = "CartAdd";
				//Create URL formatted list of variables.  Must be in ascending order, case-sensitive (Capital letters before lowercase).
				$urlVariableString = "AWSAccessKeyId=".PUBLIC_KEY.
									 "&AssociateTag=".rawurlencode(ASSOCIATE_TAG).
									 "&CartId=".$cartId.
									 "&HMAC=".$hmac;
								for ($i=0;$i<sizeof($addArray);$i++) {
				$urlVariableString .= "&Item.".($i+1).".OfferListingId=".$addArray[$i]['offerListingId'].
									  "&Item.".($i+1).".Quantity=".$addArray[$i]['quantity'];
								}
				$urlVariableString .= "&Operation=".$operation.
									  "&Service=".$service.
									  "&Timestamp=".$timestamp.
									  "&Version=".$version;
				//Generate the string to be used in the calulation of the signature
				$rawString = "GET"."\n"."ecs.amazonaws.".$region."\n"."/onca/xml"."\n".$urlVariableString;	
				//Generate the signature to sign the request
				$signature = rawurlencode(base64_encode(hash_hmac("sha256", $rawString, PRIVATE_KEY, true)));
				//Generate the full URL of the request
				$urlRequest = "http://ecs.amazonaws.".$region."/onca/xml?".
							  $urlVariableString.
							  "&Signature=".$signature;
				//Send the request to Amazon using CURL and record the response into $response
				$ch = curl_init();
					curl_setopt ( $ch, CURLOPT_URL, $urlRequest );
					curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
					curl_setopt ( $ch, CURLOPT_INTERFACE, waitInQueue() );
				$response = curl_exec ($ch);
			//Create the CartModify string
				$operation = "CartModify";
				//Create URL formatted list of variables.  Must be in ascending order, case-sensitive (Capital letters before lowercase).
				$urlVariableString = "AWSAccessKeyId=".PUBLIC_KEY.
									 "&AssociateTag=".rawurlencode(ASSOCIATE_TAG).
									 "&CartId=".$cartId.
									 "&HMAC=".$hmac;
								for ($i=0;$i<sizeof($modifyArray);$i++) {
				$urlVariableString .= "&Item.".($i+1).".CartItemId=".$modifyArray[$i]['cartItemId'].
									  "&Item.".($i+1).".Quantity=".$modifyArray[$i]['quantity'];
								}
				$urlVariableString .= "&Operation=".$operation.
									  "&Service=".$service.
									  "&Timestamp=".$timestamp.
									  "&Version=".$version;
		}
		else {
			//Create the CartAdd or CartModify string
			if (sizeof($addArray)>0) {
				$operation = "CartAdd";
				//Create URL formatted list of variables.  Must be in ascending order, case-sensitive (Capital letters before lowercase).
				$urlVariableString = "AWSAccessKeyId=".PUBLIC_KEY.
									 "&AssociateTag=".rawurlencode(ASSOCIATE_TAG).
									 "&CartId=".$cartId.
									 "&HMAC=".$hmac;
								for ($i=0;$i<sizeof($addArray);$i++) {
				$urlVariableString .= "&Item.".($i+1).".OfferListingId=".$addArray[$i]['offerListingId'].
									  "&Item.".($i+1).".Quantity=".$addArray[$i]['quantity'];
								}
				$urlVariableString .= "&Operation=".$operation.
									  "&Service=".$service.
									  "&Timestamp=".$timestamp.
									  "&Version=".$version;
			}
			else if (sizeof($modifyArray)>0) {
				$operation = "CartModify";
				//Create URL formatted list of variables.  Must be in ascending order, case-sensitive (Capital letters before lowercase).
				$urlVariableString = "AWSAccessKeyId=".PUBLIC_KEY.
									 "&AssociateTag=".rawurlencode(ASSOCIATE_TAG).
									 "&CartId=".$cartId.
									 "&HMAC=".$hmac;
								for ($i=0;$i<sizeof($modifyArray);$i++) {
				$urlVariableString .= "&Item.".($i+1).".CartItemId=".$modifyArray[$i]['cartItemId'].
									  "&Item.".($i+1).".Quantity=".$modifyArray[$i]['quantity'];
								}
				$urlVariableString .= "&Operation=".$operation.
									  "&Service=".$service.
									  "&Timestamp=".$timestamp.
									  "&Version=".$version;
			}
			else {
				$urlVariableString = '';
			}
		}
	}
	//Empty the customers cart.
	else if ($action == "empty") {
		$operation = "CartClear";
		//Create URL formatted list of variables.  Must be in ascending order, case-sensitive (Capital letters before lowercase).
		$urlVariableString = "AWSAccessKeyId=".PUBLIC_KEY.
							 "&AssociateTag=".rawurlencode(ASSOCIATE_TAG).
							 "&CartId=".$cartId.
							 "&HMAC=".$hmac;
		$urlVariableString .= "&Operation=".$operation.
							  "&Service=".$service.
							  "&Timestamp=".$timestamp.
							  "&Version=".$version;
	}
	else {
		$_SESSION['numberOfItemsInCart'] = '0';
		return false;
	}

	//Generate the string to be used in the calulation of the signature
	$rawString = "GET"."\n"."ecs.amazonaws.".$region."\n"."/onca/xml"."\n".$urlVariableString;	
	
	//Generate the signature to sign the request
	$signature = rawurlencode(base64_encode(hash_hmac("sha256", $rawString, PRIVATE_KEY, true)));
	
	//Generate the full URL of the request
	$urlRequest = "http://ecs.amazonaws.".$region."/onca/xml?".
				  $urlVariableString.
				  "&Signature=".$signature;
	
	//Send the request to Amazon using CURL and record the response into $response
	$ch = curl_init();
		curl_setopt ( $ch, CURLOPT_URL, $urlRequest );
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt ( $ch, CURLOPT_INTERFACE, waitInQueue() );
	$response = curl_exec ($ch);
	
	if ($response === false) {
		$_SESSION['numberOfItemsInCart'] = '0';
		return false;
	}
	else {
		$pageXml = simplexml_load_string($response);
		$pageArray = object2array($pageXml);
		if ($pageArray['Cart']['CartId']) {
			setcookie('cart_id', $pageArray['Cart']['CartId'], time()+60*60*24*7, '/', 'noroth.com');
			setcookie('hmac', $pageArray['Cart']['HMAC'], time()+60*60*24*7, '/', 'noroth.com');
			
			
		//Check to see if there is 1 item in the cart
		if ($pageArray['Cart']['CartItems']['CartItem']['CartItemId']) {
			$_SESSION['numberOfItemsInCart'] = '1';
		}
		//Multiple items in the cart
		elseif ($pageArray['Cart']['CartItems']['CartItem'][0]['CartItemId']) {
			$_SESSION['numberOfItemsInCart'] = sizeof($pageArray['Cart']['CartItems']);
		}
		else {
			$_SESSION['numberOfItemsInCart'] = '0';
		}
			
			
			return true;
		}
		else {
			$_SESSION['numberOfItemsInCart'] = '0';
			return false;
		}
	}
}

function get_cart_contents() {
	$region = "com";
	$service = "AWSECommerceService";
	$timestamp = rawurlencode(gmdate("Y-m-d\TH:i:s\Z"));
	$version = "2010-11-01";
	$cartId = rawurlencode($_COOKIE['cart_id']);
	$hmac = rawurlencode($_COOKIE['hmac']);
	$itemArray = array();
	
	if ($cartId != '') {
	//Begin cartArray
		$region = "com";
		$service = "AWSECommerceService";
		$timestamp = rawurlencode(gmdate("Y-m-d\TH:i:s\Z"));
		$version = "2010-11-01";
		$cartArrayVariableString = "AWSAccessKeyId=".PUBLIC_KEY.
							 "&AssociateTag=".rawurlencode(ASSOCIATE_TAG).
							 "&CartId=".$cartId.
							 "&HMAC=".$hmac.
							 "&Operation=CartGet".
							 "&Service=".$service.
							 "&Timestamp=".$timestamp.
							 "&Version=".$version;
		//Generate the string to be used in the calulation of the signature
		$rawString = "GET"."\n"."ecs.amazonaws.".$region."\n"."/onca/xml"."\n".$cartArrayVariableString;	
		//Generate the signature to sign the request
		$signature = rawurlencode(base64_encode(hash_hmac("sha256", $rawString, PRIVATE_KEY, true)));
		//Generate the full URL of the request
		$urlRequest = "http://ecs.amazonaws.".$region."/onca/xml?".
					  $cartArrayVariableString.
					  "&Signature=".$signature;
		//Send the request to Amazon using CURL and record the response into $response
		$ch = curl_init();
			curl_setopt ( $ch, CURLOPT_URL, $urlRequest );
			curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
			curl_setopt ( $ch, CURLOPT_INTERFACE, waitInQueue() );
		$response = curl_exec ($ch);
		$pageXml = simplexml_load_string($response);
		$cartArray = object2array($pageXml);
		$cartArray = $cartArray['Cart'];
		
		
		//Check to see if there is 1 item in the cart
		if ($cartArray['CartItems']['CartItem']['CartItemId']) {
			$_SESSION['numberOfItemsInCart'] = '1';
		}
		//Multiple items in the cart
		elseif ($cartArray['CartItems']['CartItem'][0]['CartItemId']) {
			$_SESSION['numberOfItemsInCart'] = sizeof($cartArray['CartItems']);
		}
		else {
			$_SESSION['numberOfItemsInCart'] = '0';
		}
		
		
		if (sizeof($cartArray)>0) {
			return $cartArray;
		}
		else {
			return false;
		}
	//End cartArray
	}
	else {
		$_SESSION['numberOfItemsInCart'] = '0';
		return false;
	}
}


function update_product($awsObject) {
	/*
	Inserts a product into the MySQL product database if it is not in the database already.  If it is in the database, 
	then it updates the products information.
	
	Parameters:
		$awsObject - An array containing the product information created by get_aws_item_info.  Can contain one or 
		more products.
		
	Requirements:
		$awsObject - Must be a 'Large' AWS query to contain all of the data needed for the database.
	*/
	//Check to see if the $awsObject is a valid request
	if ($awsObject['Items']['Request']['IsValid'] == 'True') {
		//Create an array that will store success and errors for each item as it is processed
		$returnArray = array();
	}
	elseif ($awsObject['Items']['Request']['IsValid'] == 'False') {
		//$awsObject is a valid response, but it wasn't constructed correctly
		$returnArray = array();
		if ($awsObject['Items']['Request']['Errors']['Error']['Message'] != '') {
			if (is_array($awsObject['Items']['Request']['ItemLookupRequest']['ItemId'])) {
				//Multiple items were searched, but all of them failed.
				foreach($awsObject['Items']['Request']['ItemLookupRequest']['ItemId'] as $itemAsin) {
					if (!is_array($returnArray[$itemAsin])) $returnArray[$itemAsin] = array();
					array_push($returnArray[$itemAsin], $awsObject['Items']['Request']['Errors']['Error']['Message']);
					//Atttempt to disable the item (as a precaution)
					$query = "UPDATE `".DB_NAME."`.`products` SET `disabled` = '1' WHERE `products`.`asin` = '".mysql_real_escape_string($itemAsin)."';";
					$result = mysql_query($query);
						if (mysql_affected_rows() > 0 ) {
							array_push($returnArray[$itemAsin], 'Item was successfully disabled.');
						}
				}
				return $returnArray;
			}
			elseif ($awsObject['Items']['Request']['ItemLookupRequest']['ItemId'] != '') {
				//One item was searched, and returned an error (invalid syntax)	
				if (!is_array($returnArray[$awsObject['Items']['Request']['ItemLookupRequest']['ItemId']])) $returnArray[$awsObject['Items']['Request']['ItemLookupRequest']['ItemId']] = array();	
				array_push($returnArray[$awsObject['Items']['Request']['ItemLookupRequest']['ItemId']], $awsObject['Items']['Request']['Errors']['Error']['Message']);
				return $returnArray;
					//Atttempt to disable the item (as a precaution)
					$query = "UPDATE `".DB_NAME."`.`products` SET `disabled` = '1' WHERE `products`.`asin` = '".mysql_real_escape_string($awsObject['Items']['Request']['ItemLookupRequest']['ItemId'])."';";
					$result = mysql_query($query);
						if (mysql_affected_rows() > 0 ) {
							array_push($returnArray[$awsObject['Items']['Request']['ItemLookupRequest']['ItemId']], 'Item was successfully disabled.');
						}
			}
			else {
				//Unknown items
				return $awsObject['Items']['Request']['Errors']['Error']['Message'];
			}
		}
		else {
			return 'AWS returned an unknown error.  No items were processed.';
		}
	}
	else {
		return 'AWS returned an unrecognized response: '.print_r($awsObject,true);
	}
	
	//Check to make sure that all items were processed (no error message when there's at least 1 item processed)
	if (is_array($awsObject['Items']['Request']['ItemLookupRequest']['ItemId'])) {
		//Multiple items were searched.
		if (is_array($awsObject['Items']['Item'][0])) {
			//Multiple items were returned
			foreach($awsObject['Items']['Request']['ItemLookupRequest']['ItemId'] as $itemAsin) {
				$itemFound = false;
				foreach($awsObject['Items']['Item'] as $awsItem) {
					if ($itemAsin == $awsItem['ASIN']) {
						$itemFound = true;
					}
				}
				if (!$itemFound) {
					//If item was not found, then add the item to $returnArray and give an error message.
					if (!is_array($returnArray[$itemAsin])) $returnArray[$itemAsin] = array();	
					array_push($returnArray[$itemAsin], 'Item was not returned from AWS. Item may no longer be available.');
					$query1 = "UPDATE `goofol5_amazonian`.`products` SET `updated` = '".time()."', `disabled` = '1' WHERE `products`.`asin` = '".mysql_real_escape_string($itemAsin)."';";
					$result1 = mysql_query($query1);
						echo $query1;
				}
			}
		}
		else {
			//One item was returned
			foreach($awsObject['Items']['Request']['ItemLookupRequest']['ItemId'] as $itemAsin) {
				$itemFound = false;
				if ($itemAsin == $awsObject['Items']['Item']['ASIN']) {
					$itemFound = true;
				}
				if (!$itemFound) {
					//If item was not found, then add the item to $returnArray and give an error message.
					if ($awsObject['Items']['Request']['Errors']['Error']['Message'] != '') {
						if (!is_array($returnArray[$itemAsin])) $returnArray[$itemAsin] = array();	
						array_push($returnArray[$itemAsin], $awsObject['Items']['Request']['Errors']['Error']['Message']);
					}
					else {
						if (!is_array($returnArray[$itemAsin])) $returnArray[$itemAsin] = array();	
						array_push($returnArray[$itemAsin], 'Item was not returned from AWS. Item may no longer be available.');
						$query1 = "UPDATE `goofol5_amazonian`.`products` SET `updated` = '".time()."', `disabled` = '1' WHERE `products`.`asin` = '".mysql_real_escape_string($itemAsin)."';";
						$result1 = mysql_query($query1);
						echo $query1;
					}
				}
			}
		}
	}
	else {
		//One item was searched.
		if ($awsObject['Items']['Request']['Errors']['Error']['Message'] != '') {
			//One item searched and error message returned (correct syntax)
			if (!is_array($returnArray[$awsObject['Items']['Request']['ItemLookupRequest']['ItemId']])) $returnArray[$awsObject['Items']['Request']['ItemLookupRequest']['ItemId']] = array();
			array_push($returnArray[$awsObject['Items']['Request']['ItemLookupRequest']['ItemId']], $awsObject['Items']['Request']['Errors']['Error']['Message']);
		}
		elseif ($awsObject['Items']['Request']['ItemLookupRequest']['ItemId'] != $awsObject['Items']['Item']['ASIN']) {
			//One item searched, but AWS returned something unrecognized
			if (!is_array($returnArray[$awsObject['Items']['Request']['ItemLookupRequest']['ItemId']])) $returnArray[$awsObject['Items']['Request']['ItemLookupRequest']['ItemId']] = array();
			array_push($returnArray[$awsObject['Items']['Request']['ItemLookupRequest']['ItemId']], 'AWS returned an unrecognized response: '.print_r($awsObject,true));
		}
	}
	
	//Return the error array if there are no valid items
	if ($awsObject['Items']['Request']['Errors']['Error']['Message'] != '') {
		return $returnArray;
	}
	
	//Create $itemArray
	$itemArray = $awsObject['Items']['Item'];
	//Turn $itemArray into a multi-item array if there's only 1 item
	if (!is_array($itemArray[0])) {
		$tempItemArray = $itemArray;
		$itemArray = array();
		$itemArray[0] = $tempItemArray;
	}
	
	
	foreach($itemArray as $item) {
		//Gather up all the database variables
		//Get asin
			$asin = '';
			if ($item['ASIN'] != '') {
				$asin = $item['ASIN'];
			}
		//Get title
			$title = '';
			if ($item['ItemAttributes']['Title'] != '') {
				$title = $item['ItemAttributes']['Title'];
			}
		//Get manufacturer
			$manufacturer = '';
			if ($item['ItemAttributes']['Manufacturer'] != '') {
				$manufacturer = $item['ItemAttributes']['Manufacturer'];
			}
		//Get Browse Nodes
			$browseNodeArray = array();
			if (is_array($item['BrowseNodes']['BrowseNode'][0])) $browseNodeObject = $item['BrowseNodes']['BrowseNode'][0];
			else $browseNodeObject = $item['BrowseNodes']['BrowseNode'];
			$j=0;
			while($browseNodeObject['Name'] != '' && $j<10) {
				if ($browseNodeObject['Name'] != 'Categories') {
					$browseNodeArray[$j] = $browseNodeObject['Name'];
					$j++;
				}
				$browseNodeObject = $browseNodeObject['Ancestors']['BrowseNode'];
			}
			$browseNodeArray = array_reverse($browseNodeArray);
			$browseNode0 = ''.$browseNodeArray[0];
			$browseNode1 = ''.$browseNodeArray[1];
			$browseNode2 = ''.$browseNodeArray[2];
			$browseNode3 = ''.$browseNodeArray[3];
			$browseNode4 = ''.$browseNodeArray[4];
			$browseNode5 = ''.$browseNodeArray[5];
			$browseNode6 = ''.$browseNodeArray[6];
			$browseNode7 = ''.$browseNodeArray[7];
			$browseNode8 = ''.$browseNodeArray[8];
			$browseNode9 = ''.$browseNodeArray[9];
		//Get Parent Asin
			$parentAsin = '';
			if ($item['ParentASIN'] != '') {
				$parentAsin = $item['ParentASIN'];
			}
		//Get Variations
			$variations = '';
			//Determine if the product is a parent ASIN (container) or a child ASIN (actual purchasable product).
			//Find out if the product has an OfferListingID.
			if ($item['Offers']['Offer']['OfferListing']['OfferListingId'] != '') {
				$variations = '';
			}
			else {
				$region = "com";
				$service = "AWSECommerceService";
				$timestamp = rawurlencode(gmdate("Y-m-d\TH:i:s\Z"));
				$version = "2010-11-01";
				$urlVariableString = "AWSAccessKeyId=".PUBLIC_KEY.
									 "&AssociateTag=".rawurlencode(ASSOCIATE_TAG).
									 "&Condition=All".
									 "&ItemId=".$item['ASIN'].
									 "&Operation=ItemLookup".
									 "&ResponseGroup=VariationMatrix".
									 "&Service=".$service.
									 "&Timestamp=".$timestamp.
									 "&Version=".$version;
				//Generate the string to be used in the calulation of the signature
				$rawString = "GET"."\n"."ecs.amazonaws.".$region."\n"."/onca/xml"."\n".$urlVariableString;	
				//Generate the signature to sign the request
				$signature = rawurlencode(base64_encode(hash_hmac("sha256", $rawString, PRIVATE_KEY, true)));
				//Generate the full URL of the request
				$urlRequest = "http://ecs.amazonaws.".$region."/onca/xml?".
							  $urlVariableString.
							  "&Signature=".$signature;
				//Send the request to Amazon using CURL and record the response into $response
				$ch = curl_init();
					curl_setopt ( $ch, CURLOPT_URL, $urlRequest );
					curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
					curl_setopt ( $ch, CURLOPT_INTERFACE, waitInQueue() );
				$response = curl_exec ($ch);
				$pageXml = simplexml_load_string($response);
				$pageArray = object2array($pageXml);
				if ($pageArray['Items']['Item']['Variations']['TotalVariations'] > 0) {
					$variationsArray = array();
					$variationsArray[0] = $pageArray['Items']['Item']['Variations']['VariationDimensions']['VariationDimension'];
					$variationsArrayItems = array();
					if (is_array($pageArray['Items']['Item']['Variations']['Item'][0])) {
						$variationsArrayItems = $pageArray['Items']['Item']['Variations']['Item'];
					}
					else {
						$variationsArrayItems[0] = $pageArray['Items']['Item']['Variations']['Item'];
					}
					$variationsArray[1] = array();
					$k=0;
					foreach ($variationsArrayItems as $variationItem) {
						$variationsArray[1][$k]['asin'] = $variationItem['ASIN'];
						if(is_array($variationItem['ItemAttributes'])) {
							$variationsArray[1][$k] += $variationItem['ItemAttributes'];
						}
						elseif(is_array($variationItem['VariationAttributes']['VariationAttribute'])) {
							$variationsArray[1][$k] += $variationItem['VariationAttributes']['VariationAttribute'];
						}
						$k++;
					}
				}
				else {
					$variations = '';
				}
				if (is_array($variationsArray)) $variations = serialize($variationsArray);
				else $variations = '';
			}
		//Get Parent Node
			if ($variations == '') {
				$parentNode = '0';
			}
			else {
				$parentNode = '1';
			}
		//Get MSRP
			$msrp = '';
			$msrp = $item['ItemAttributes']['ListPrice']['Amount'];
		//Get Price
			$price = '';
			$price = $item['OfferSummary']['LowestNewPrice']['Amount'];
			if (!is_numeric($price)) {
				if ($item['Offers']['Offer']['OfferAttributes']['Condition'] == 'New') {
					$price = $item['Offers']['Offer']['OfferListing']['Price']['Amount'];
				}
				elseif ($item['Offers']['Offer'][1]['OfferAttributes']['Condition'] == 'New') {
					$price = $item['Offers']['Offer'][1]['OfferListing']['Price']['Amount'];
				}
			}
		//Get PriceUpdated
			if ($price > 0) {
				$priceupdated = time();
			}
			else {
				$priceupdated = '';
			}
		//Get Sales Rank
			$salesRank = '10000';
			if ($item['SalesRank'] > 0) $salesRank = $item['SalesRank'];
		//Get Description
			$description = '';
			$description = $item['EditorialReviews']['EditorialReview']['Content'];
		//Get Features
			$features = '';
			if (is_array($item['ItemAttributes']['Feature'])) {
				$features = serialize($item['ItemAttributes']['Feature']);
			}
		//Get Amazon Link
			$amazonLink = '';
			$amazonLink = $item['DetailPageURL'];
		//Get Image
			$image = '';
			if (is_array($item['LargeImage'])) {
				$image = serialize($item['LargeImage']);
			}
		//Get Alt Image (get an image from image sets in case there isn't a main image)
			$altImage = '';
			if (is_array($item['ImageSets']['ImageSet'][0]['LargeImage'])) {
				$altImage = serialize($item['ImageSets']['ImageSet'][0]['LargeImage']);
			}		
		//Get More Images
			$moreImages = '';
			if (is_array($item['ImageSets']['ImageSet']) && $item['ImageSets']['ImageSet']['LargeImage'] == '') {
				$moreImages = array();
				foreach($item['ImageSets']['ImageSet'] as $swatchImage) {
					array_push($moreImages, $swatchImage['LargeImage']);
				}
				$moreImages = serialize($moreImages);
			}
		//Get Reviews Link
			$reviewsLink = '';
			$reviewsLink = $item['CustomerReviews']['IFrameURL'];
		//Get Created
			$created = time();
		//Get Updated
			$updated = time();
		//Get Disabled
			$disabled = '0';
			if ($price == '') {
				$disabled = '1';
			}
			
		//New product or update to existing product?
		//Search the database for the product
		$query = "SELECT * FROM `".DB_NAME."`.`products` WHERE `asin` LIKE '".mysql_real_escape_string($asin)."' LIMIT 1";
		$result = mysql_query($query);
		$numOfRows = mysql_num_rows($result);
		if ($numOfRows == 1) {
			//Product found, update information
			$resultItem = mysql_fetch_assoc($result);
			$sqlQuery = "UPDATE `".DB_NAME."`.`products` SET ";
			if ($title != '') {
				$sqlQuery .= "`title` = '".mysql_real_escape_string($title)."'";
			}
			if ($manufacturer != '') {
				$sqlQuery .= ", `manufacturer` = '".mysql_real_escape_string($manufacturer)."'";
			}
			if ($parentNode != '') {
				$sqlQuery .= ", `parentNode` = '".mysql_real_escape_string($parentNode)."'";
			}
			if ($variations != '') {
				$sqlQuery .= ", `variations` = '".mysql_real_escape_string($variations)."'";
			}
			if ($msrp != '') {
				$sqlQuery .= ", `msrp` = '".mysql_real_escape_string($msrp)."'";
			}
			if ($price != '') {
				$sqlQuery .= ", `price` = '".mysql_real_escape_string($price)."'";
			}
			if ($salesRank != '') {
				$sqlQuery .= ", `salesrank` = '".mysql_real_escape_string($salesRank)."'";
			}
			if ($description != '') {
				$sqlQuery .= ", `description` = '".mysql_real_escape_string($description)."'";
			}
			if ($features != '') {
				$sqlQuery .= ", `features` = '".mysql_real_escape_string($features)."'";
			}
			if ($amazonLink != '') {
				$sqlQuery .= ", `amazonlink` = '".mysql_real_escape_string($amazonLink)."'";
			}
			if ($image != '') {
				$sqlQuery .= ", `image` = '".mysql_real_escape_string($image)."'";
			}
				//Insert the alternate image if there isn't a normal image
				if ($image == '' && $resultItem['image'] == '') {
					$sqlQuery .= ", `image` = '".mysql_real_escape_string($altImage)."'";
				}
			if ($moreImages != '') {
				$sqlQuery .= ", `moreimages` = '".mysql_real_escape_string($moreImages)."'";
			}
			if ($reviewsLink != '') {
				$sqlQuery .= ", `reviewslink` = '".mysql_real_escape_string($reviewsLink)."'";
			}
			if ($updated != '') {
				$sqlQuery .= ", `updated` = '".mysql_real_escape_string($updated)."'";
			}
			if ($priceupdated != '') {
				$sqlQuery .= ", `priceupdated` = '".mysql_real_escape_string($priceupdated)."'";
			}
			if ($disabled != '') {
				$sqlQuery .= ", `disabled` = '".mysql_real_escape_string($disabled)."'";
			}
			$sqlQuery .= ", `deleted` = '0'";
			$sqlQuery .= " WHERE `products`.`asin` = '".mysql_real_escape_string($asin)."'";
			$result = mysql_query($sqlQuery);
			//Record in the return array that the product was updated
			if (!is_array($returnArray[$asin])) $returnArray[$asin] = array();
			if (mysql_affected_rows() > 0 ) {
				//Update was successful
				if ($disabled == '0') {
					array_push($returnArray[$asin], 'Item was successfully updated.');
				}
				else {
					array_push($returnArray[$asin], 'Item was successfully updated, but was disabled because new product price was unavailable.');
				}
			}
			else {
				//Update was not successful
					array_push($returnArray[$asin], 'Item update was not successful: '.$sqlQuery);
			}
		}
		else {
			//Product not found, insert a new product
			$sqlQuery = "INSERT INTO `".DB_NAME."`.`products` (`id`, `asin`, `title`, `manufacturer`, `parentNode`, `parentAsin`, `variations`, `msrp`, `price`, `salesrank`, `description`, `features`, `amazonlink`, `image`, `moreimages`, `reviewslink`, `created`, `updated`, `priceupdated`, `special`, `disabled`, `deleted`) VALUES (NULL";
			$sqlQuery .= ", '".mysql_real_escape_string($asin)."'";
			$sqlQuery .= ", '".mysql_real_escape_string($title)."'";
			$sqlQuery .= ", '".mysql_real_escape_string($manufacturer)."'";
			$sqlQuery .= ", '".mysql_real_escape_string($parentNode)."'";
			$sqlQuery .= ", '".mysql_real_escape_string($parentAsin)."'";
			$sqlQuery .= ", '".mysql_real_escape_string($variations)."'";
			$sqlQuery .= ", '".mysql_real_escape_string($msrp)."'";
			$sqlQuery .= ", '".mysql_real_escape_string($price)."'";
			$sqlQuery .= ", '".mysql_real_escape_string($salesRank)."'";
			$sqlQuery .= ", '".mysql_real_escape_string($description)."'";
			$sqlQuery .= ", '".mysql_real_escape_string($features)."'";
			$sqlQuery .= ", '".mysql_real_escape_string($amazonLink)."'";
			if ($image != '') {
				$sqlQuery .= ", '".mysql_real_escape_string($image)."'";
			}
			else {
				$sqlQuery .= ", '".mysql_real_escape_string($altImage)."'";
			}
			$sqlQuery .= ", '".mysql_real_escape_string($moreImages)."'";
			$sqlQuery .= ", '".mysql_real_escape_string($reviewsLink)."'";
			$sqlQuery .= ", '".mysql_real_escape_string($created)."'";
			$sqlQuery .= ", '".mysql_real_escape_string($updated)."'";
			$sqlQuery .= ", '".mysql_real_escape_string(time())."'";
			$sqlQuery .= ", '0'";
			$sqlQuery .= ", '".mysql_real_escape_string($disabled)."'";
			$sqlQuery .= ", '0'";
			$sqlQuery .=");";
			$result = mysql_query($sqlQuery);
			//Record in the return array that the product was entered into the databse
			if (!is_array($returnArray[$asin])) $returnArray[$asin] = array();
			if (mysql_affected_rows() > 0 ) {
				//Update was successful
				if ($disabled == '0') {
					array_push($returnArray[$asin], 'Item was successfully entered into the database.');
				}
				elseif ($parentNode == '1') {
					array_push($returnArray[$asin], 'Item was successfully entered into the database, but was disabled because it is a parent container of products.');
				}
				else {
					array_push($returnArray[$asin], 'Item was successfully entered into the database, but was disabled because new product price was unavailable.');
				}
			}
			else {
				//Update was not successful
					array_push($returnArray[$asin], 'Item was not entered into the database: '.mysql_error());
			}
		}
	}
	
	return $returnArray;
}

function print_return_array($returnArray) {
	foreach($returnArray as $itemAsin => $itemErrorArray) {
		echo $itemAsin;
		foreach($itemErrorArray as $errorValue) {
			echo ' -> '.$errorValue;
		}
		echo "<br />\n";
	}
}

function get_aws_category_items($browseNodeId, $searchIndex = "Electronics", $numOfReturnItems = 100, $sortMethod = 'salesrank', $printResults = 'on') {
	/*
	Performs an Amazon Item Search on the provided Browse Node and enters the items into the database. Returns 10
	items per search, and will perform enough searches to reach the requested number of items (default 100).
	
	See http://docs.amazonwebservices.com/AWSECommerceService/latest/DG/USSortValuesArticle.html for additional sort methods.
	
	Parameters:
		$browseNodeId - A string containing the numeric browse node to be searched.
		$printResults - *Optional* - Defines whether the results should be printed on the screen.
		$numOfReturnItems - *Optional* - Defines the number of items to be searched for. Max is 100
		$sortMethod - *Optional* - Defines the sort method of the search to get the top $numOfReturnItems out of millions of results.
		$searchIndex - *Optional* - Defines the category that is to be searched. Can be set to "Blended" to search all categories.
	*/
	if ($numOfReturnItems > 100 || $numOfReturnItems < 1) {
		$numOfReturnItems = 100;
	}
	
	for ($i=1;$i<=ceil($numOfReturnItems/10);$i++) {
		$region = "com";
		$service = "AWSECommerceService";
		$timestamp = rawurlencode(gmdate("Y-m-d\TH:i:s\Z"));
		$version = "2011-08-01";//2010-11-01";
		$operation = "ItemSearch";
		$itemId = rawurlencode($itemId);
		$itemPage = $i;
		
		//Create URL formatted list of variables.  Must be in ascending order, case-sensitive (Capital letters before lowercase).
		$urlVariableString = "AWSAccessKeyId=".PUBLIC_KEY.
							 "&AssociateTag=".rawurlencode(ASSOCIATE_TAG).
							 "&BrowseNode=".$browseNodeId.
							 "&ItemPage=".$itemPage.
							 "&Operation=".$operation.
							 "&ResponseGroup=Large".
							 "&SearchIndex=".$searchIndex.
							 "&Service=".$service.
							 "&Timestamp=".$timestamp.
							 "&Version=".$version;
							 
		//Generate the string to be used in the calulation of the signature
		$rawString = "GET"."\n"."ecs.amazonaws.".$region."\n"."/onca/xml"."\n".$urlVariableString;	
		
		//Generate the signature to sign the Item Lookup request
		$signature = rawurlencode(base64_encode(hash_hmac("sha256", $rawString, PRIVATE_KEY, true)));
		
		//Generate the full URL of the Item Lookup request
		$urlRequest = "http://ecs.amazonaws.".$region."/onca/xml?".
					  $urlVariableString.
					  "&Signature=".$signature;
		
		//Send the request to Amazon using CURL and record the response into $response
		$ch = curl_init();
			curl_setopt ( $ch, CURLOPT_URL, $urlRequest );
			curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
			curl_setopt ( $ch, CURLOPT_INTERFACE, waitInQueue() );
		$response = curl_exec ($ch);
		
		if ($response === false) {
			$pageArray = '';
		}
		else {
			$pageXml = simplexml_load_string($response);
			$pageArray = object2array($pageXml);
		}
		
		if ($printResults == 'on') {
			print_return_array(update_product($pageArray));
		}
		else {
			update_product($pageArray);
		}
	}
}


?>