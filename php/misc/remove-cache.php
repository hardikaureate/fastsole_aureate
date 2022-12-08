<?php

		$file_slug = '{
				"files":[
					"https://aws.fastsole.co.uk/wp-json/wl/v1/on-focus"	,
					 "https://aws.fastsole.co.uk/wp-json/wl/v1/posts/air-jordan-4-sail-cement-grey-womens-dq4909-100/",
					 "https://aws.fastsole.co.uk/wp-json/wl/v1/sneaker-release-dates-test/54-32-0-500-instock----0"		
					]
				}';
		
		$curl = curl_init();
		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'https://api.cloudflare.com/client/v4/zones/877eb0772f14d15e4aa402004e92738c/purge_cache',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  CURLOPT_POSTFIELDS =>$file_slug,
		  CURLOPT_HTTPHEADER => array(
			'X-Auth-Email: fastsoleuk@gmail.com',
			'X-Auth-Key: 26f5b0688b57b00a619f3bb09030c02f5348b',
			'Content-Type: application/json',
			'Cookie: __cflb=0H28vgHxwvgAQtjUGU4vq74ZFe3sNVUZa2FcJYX1jQh; __cfruid=da055736efdb090c4f26f7d66ea5e2e5e046a230-1644575410'
		  ),
		));

		$response = curl_exec($curl);

		curl_close($curl);
		echo $response;
		/*$authKey = "26f5b0688b57b00a619f3bb09030c02f5348b";
		$authEmail = "fastsoleuk@gmail.com";

		$zoneId = "877eb0772f14d15e4aa402004e92738c";
		$endpoint = "purge_cache";

		$data = [
			"purge_everything" => true
		];

		$url = "https://api.cloudflare.com/client/v4/zones/{$zoneId}/{$endpoint}";
		$opts = ['http' => [
			'method' => 'DELETE',
			'header' => [
				"Content-Type: application/json",
				"X-Auth-Key: {$authKey}",
				"X-Auth-Email: {$authEmail}",
			],
			'content' => $file_slug,
		]];
		$context = stream_context_create($opts);
		$resultt = file_get_contents($url, false, $context);
		echo $resultt;*/
	
		
