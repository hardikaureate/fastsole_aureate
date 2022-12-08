<?php
		$authKey = "26f5b0688b57b00a619f3bb09030c02f5348b";
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
			'content' => json_encode($data),
		]];
		$context = stream_context_create($opts);
		$resultt = file_get_contents($url, false, $context);
		echo $resultt;

		/*$ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.cloudflare.com/client/v4/zones/26f5b0688b57b00a619f3bb09030c02f5348b/purge_cache");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $headers = [
            'X-Auth-Email: fastsoleuk@gmail.com',
            'X-Auth-Key: 26f5b0688b57b00a619f3bb09030c02f5348b',
            'Content-Type: application/json'
        ];

        $data = json_encode(array("files" => array("https://dev.fastsole.co.uk/wp-json/wl/v1/coming-soon")));
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        echo $result = curl_exec($ch);*/

	
	?>