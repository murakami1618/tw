<?php

	$bearer_token = 'AAAAAAAAAAAAAAAAAAAAACWhcgEAAAAAruXZ6Oyq7ty1Rugb7MCg0KWxmz4%3DsIhRUvr9cplAWJGmTitDQirdakJ6bN7VXIeO42G99AnIGjCXD9' ;	// ベアラートークン
	$request_url = 'https://api.twitter.com/2/users/by' ;		// エンドポイント

	// パラメータ (オプション)
	$params = array("usernames" => $_GET["user_id"],) ;

	// パラメータがある場合
	if( $params ) {
		$request_url .= '?' . http_build_query( $params ) ;
	}

	// リクエスト用のコンテキスト
	$context = array(
		'http' => array(
			'method' => 'GET' , // リクエストメソッド
			'header' => array(			  // ヘッダー
				'Authorization: Bearer ' . $bearer_token ,
			) ,
		) ,
	) ;

	// cURLを使ってリクエスト
	$curl = curl_init() ;
	curl_setopt( $curl , CURLOPT_URL , $request_url ) ;
	curl_setopt( $curl , CURLOPT_HEADER, 1 ) ; 
	curl_setopt( $curl , CURLOPT_RETURNTRANSFER , true ) ;								// curl_execの結果を文字列で返す
	curl_setopt( $curl , CURLOPT_HTTPHEADER , $context['http']['header'] ) ;			// ヘッダー
	$res1 = curl_exec( $curl ) ;
	$res2 = curl_getinfo( $curl ) ;
	curl_close( $curl ) ;

	// 取得したデータ
	$json = substr( $res1, $res2['header_size'] ) ;				// 取得したデータ(JSONなど)
	$header = substr( $res1, 0, $res2['header_size'] ) ;		// レスポンスヘッダー (検証に利用したい場合にどうぞ)
	$array = json_decode($json,true);
	$id = $array['data'][0]["id"]; //使用者のユーザーid

	
	$request_url = 'https://api.twitter.com/2/users/'.$id.'/following';	

	// パラメータ (オプション)
	$params = array(
		//"usernames" => $_GET["user_id"],
		"max_results" => '20',
	) ;

	// パラメータがある場合
	if( $params ) {
		$request_url .= '?' . http_build_query( $params ) ;
	}

	// リクエスト用のコンテキスト
	$context = array(
		'http' => array(
			'method' => 'GET' , // リクエストメソッド
			'header' => array(			  // ヘッダー
				'Authorization: Bearer ' . $bearer_token ,
			) ,
		) ,
	) ;

	// cURLを使ってリクエスト
	$curl = curl_init() ;
	curl_setopt( $curl , CURLOPT_URL , $request_url ) ;
	curl_setopt( $curl , CURLOPT_HEADER, 1 ) ; 
	curl_setopt( $curl , CURLOPT_RETURNTRANSFER , true ) ;								// curl_execの結果を文字列で返す
	curl_setopt( $curl , CURLOPT_HTTPHEADER , $context['http']['header'] ) ;			// ヘッダー
	$res1 = curl_exec( $curl ) ;
	$res2 = curl_getinfo( $curl ) ;
	curl_close( $curl ) ;

	// 取得したデータ
	$json = substr( $res1, $res2['header_size'] ) ;				// 取得したデータ(JSONなど)
	$header = substr( $res1, 0, $res2['header_size'] ) ;		// レスポンスヘッダー (検証に利用したい場合にどうぞ)
	$array = json_decode($json,true);
	foreach($array['data'] as $user){
		if(isset($user['username'])){
		echo "<a href ='https://twitter.com/".$user['username']."'>".$user['name']."</a><br>";
	}
}
	

	$next_token = $array['meta']['next_token'];
	//////////////////////////////////////////////////////////////////////////////Next_token取得後
			if(isset($next_token)){

				while(isset($array['meta']['next_token'])){
					// パラメータ (オプション)
					$params = array(
						"pagination_token" => $next_token,
					) ;

					// パラメータがある場合
					if( $params ) {
						$request_next_url =$request_url.'&'.http_build_query( $params ) ;
					}

					// リクエスト用のコンテキスト
					$context = array(
						'http' => array(
							'method' => 'GET' , // リクエストメソッド
							'header' => array(			  // ヘッダー
								'Authorization: Bearer ' . $bearer_token ,
							) ,
						) ,
					) ;

					// cURLを使ってリクエスト
					$curl = curl_init() ;
					curl_setopt( $curl , CURLOPT_URL , $request_next_url ) ;
					curl_setopt( $curl , CURLOPT_HEADER, 1 ) ; 
					curl_setopt( $curl , CURLOPT_RETURNTRANSFER , true ) ;								// curl_execの結果を文字列で返す
					curl_setopt( $curl , CURLOPT_HTTPHEADER , $context['http']['header'] ) ;			// ヘッダー
					$res1 = curl_exec( $curl ) ;
					$res2 = curl_getinfo( $curl ) ;
					curl_close( $curl ) ;

					// 取得したデータ
					$json = substr( $res1, $res2['header_size'] ) ;				// 取得したデータ(JSONなど)
					$header = substr( $res1, 0, $res2['header_size'] ) ;		// レスポンスヘッダー (検証に利用したい場合にどうぞ)
					$array = json_decode($json,true);
					foreach($array['data'] as $user){
							if(isset($user['username'])){
							echo "<a href ='https://twitter.com/".$user['username']."'>".$user['name']."</a><br>";
						}
					}

					if(isset($array['meta']['next_token'])){
						$next_token = $array['meta']['next_token'];
					}
				}
			}


