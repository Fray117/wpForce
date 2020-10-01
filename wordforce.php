<?php
/**
 * wpForce
 *
 * @author Fray117
 * @package WordForce
 * @version 0.4.1
 */

//                 _____                  
// __      ___ __ |  ___|__  _ __ ___ ___ 
// \ \ /\ / / '_ \| |_ / _ \| '__/ __/ _ \
//  \ V  V /| |_) |  _| (_) | | | (_|  __/
//   \_/\_/ | .__/|_|  \___/|_|  \___\___|
//          |_|                           

class wordforce {
	
	function save(string $url, string $username, string $password, string $filename = 'cookie.txt') {
		// Open Connection
		$ch = curl_init();
		
		// Setting up Connection
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
		// Setting up Cookie Jar
		curl_setopt($ch, CURLOPT_COOKIEJAR, dirname(__FILE__) . '/' . $filename);
				
		// Make Request
		$result = curl_exec($ch);
		
		// Close Connection
		curl_close($ch);

		// Return Data
		if (file_exists(dirname(__FILE__) . '/' . $filename)) {
			return true;
		} else {
			return false;
		}
	}

	function validate(string $url, string $username, string $password, string $agent = '') {
		if (empty($agent)) $agent = 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13';

		// Open Connection
		$ch = curl_init();
		
		// Setting up Connection
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, 'log=' . $username . '&pwd=' . $password);
		curl_setopt($ch, CURLOPT_USERAGENT, $agent);
		curl_setopt($ch, CURLOPT_COOKIEFILE, dirname(__FILE__) . '/' . $filename);

		// Make Request
		$result = curl_exec($ch);
		
		// Close Connection
		curl_close($ch);

		// Return Data
		if (empty($result)) {
			return true;
		} else {
			return false;
		}
	}
}