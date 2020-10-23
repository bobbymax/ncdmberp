<?php


return [

	
	'url' => env('CURLOPT_URL'),


	'return_transfers' => env('CURLOPT_RETURNTRANSFER', true),


	'request' => env('CURLOPT_CUSTOMREQUEST'),


	'encoding' => "",


	'max_redirects' => env('CURLOPT_MAXREDIRS', 10),


	'timeout' => env('CURLOPT_TIMEOUT', 30),


	'client_id' => env('NOGIC_CLIENT_ID'),


];