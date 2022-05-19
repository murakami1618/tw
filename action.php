<?php
	$usere_name= array();
	$bearer_token = '' ;	// ベアラートークン
	$request_url = 'https://api.twitter.com/2/users/by' ;		// エンドポイント

	$params = array("usernames" => $_GET["user_id"],) ;
	if( $params ) {
		$request_url .= '?' . http_build_query( $params ) ;
	}

	$context = array(
		'http' => array(
			'method' => 'GET' , // リクエストメソッド
			'header' => array('Authorization: Bearer ' . $bearer_token ,) ,
		) ,
	) ;

	$curl = curl_init() ;
	curl_setopt( $curl , CURLOPT_URL , $request_url ) ;
	curl_setopt( $curl , CURLOPT_HEADER, 1 ) ; 
	curl_setopt( $curl , CURLOPT_RETURNTRANSFER , true ) ;
	curl_setopt( $curl , CURLOPT_HTTPHEADER , $context['http']['header'] ) ;
	$res1 = curl_exec( $curl ) ;
	$res2 = curl_getinfo( $curl ) ;
	curl_close( $curl ) ;

	$json = substr( $res1, $res2['header_size'] ) ;	
	$array = json_decode($json,true);
	$id = $array['data'][0]["id"]; //使用者のユーザーid

	$request_url = 'https://api.twitter.com/2/users/'.$id.'/following';	

	do{
		if(isset($array['meta']['next_token'])){
			$params = array(
				"pagination_token" => $next_token,
				"max_results" => '1000',
			) ;

			if( $params ) {
				$request_next_url =$request_url.'?'.http_build_query( $params ) ;
			}

			$context = array(
				'http' => array(
					'method' => 'GET' ,
					'header' => array(
						'Authorization: Bearer ' . $bearer_token ,
					) ,
				) ,
			) ;
		}else{
			$params = array("max_results" => '100',) ;
			if( $params ) {
				$request_next_url =$request_url.'?'.http_build_query( $params ) ;
			}

			$context = array(
				'http' => array(
					'method' => 'GET' ,
					'header' => array(
						'Authorization: Bearer ' . $bearer_token ,
					) ,
				) ,
			) ;
		}

		$curl = curl_init() ;
		curl_setopt( $curl , CURLOPT_URL , $request_next_url ) ;
		curl_setopt( $curl , CURLOPT_HEADER, 1 ) ; 
		curl_setopt( $curl , CURLOPT_RETURNTRANSFER , true ) ;
		curl_setopt( $curl , CURLOPT_HTTPHEADER , $context['http']['header'] ) ;
		$res1 = curl_exec( $curl ) ;
		$res2 = curl_getinfo( $curl ) ;
		curl_close( $curl ) ;

		$json = substr( $res1, $res2['header_size'] ) ;
		$array = json_decode($json,true);
		foreach($array['data'] as $user){
			if(isset($user['username'])){
				//echo "<a href ='https://twitter.com/".$user['username']."'>".$user['name']."</a><br>";
				echo $user['username'].',';
				$usere_name[] = $user['username'];
			}
		}

		if(isset($array['meta']['next_token'])){
			$next_token = $array['meta']['next_token'];
		}
	}while(isset($array['meta']['next_token']));