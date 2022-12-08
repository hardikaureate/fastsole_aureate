<?php

		$file_slug = '{
				"files":[
					"https://version2.fastsole.co.uk/wp-json/wl/v1/sneaker-release-dates-test/0-12-0-2000-instock------",
					"https://version2.fastsole.co.uk/sneaker-release-dates/",
					"https://version2.fastsole.co.uk/wp-json/wl/v1/on-focus",
					"https://version2.fastsole.co.uk/wp-json/wl/v1/On-focus-items/105-20-0-500-instock--onfocus---"
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
	
		
