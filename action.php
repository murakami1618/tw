<?php

	$bearer_token = 'AAAAAAAAAAAAAAAAAAAAACWhcgEAAAAAruXZ6Oyq7ty1Rugb7MCg0KWxmz4%3DsIhRUvr9cplAWJGmTitDQirdakJ6bN7VXIeO42G99AnIGjCXD9' ;	// ベアラートークン
	$request_url = 'https://api.twitter.com/2/users/by' ;		// エンドポイント

	// パラメータ (オプション)
	$params = array(

		"usernames" => $_GET["user_id"],

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
$id = $array['data'][0]["id"];

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
	var_dump($request_url);
	curl_setopt( $curl , CURLOPT_RETURNTRANSFER , true ) ;								// curl_execの結果を文字列で返す
	curl_setopt( $curl , CURLOPT_HTTPHEADER , $context['http']['header'] ) ;			// ヘッダー
	$res1 = curl_exec( $curl ) ;
	$res2 = curl_getinfo( $curl ) ;
	curl_close( $curl ) ;

	// 取得したデータ
	$json = substr( $res1, $res2['header_size'] ) ;				// 取得したデータ(JSONなど)
	$header = substr( $res1, 0, $res2['header_size'] ) ;		// レスポンスヘッダー (検証に利用したい場合にどうぞ)
 $array = json_decode($json,true);

 for($i=0;$i<100;$i++){

	if(isset($array['data'][$i]['username'])){
		echo "<a href ='https://twitter.com/".$array['data'][$i]['username']."'>".$array['data'][$i]['name']."</a><br>";
	}
}
//var_dump($json);











// パラメータ (オプション)
$params = array(

	//"usernames" => $_GET["user_id"],
	//"max_results" => '10',
	"pagination_token" => "7R04EU6M5K5HGZZZ",
	//"next_token"  => 'U08O4JJEM3G1EZZZ',

) ;

// パラメータがある場合
if( $params ) {
	$request_url .= '&'.http_build_query( $params ) ;
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
	var_dump($request_url);
	curl_setopt( $curl , CURLOPT_RETURNTRANSFER , true ) ;								// curl_execの結果を文字列で返す
	curl_setopt( $curl , CURLOPT_HTTPHEADER , $context['http']['header'] ) ;			// ヘッダー
	$res1 = curl_exec( $curl ) ;
	$res2 = curl_getinfo( $curl ) ;
	curl_close( $curl ) ;

	// 取得したデータ
	$json = substr( $res1, $res2['header_size'] ) ;				// 取得したデータ(JSONなど)
	$header = substr( $res1, 0, $res2['header_size'] ) ;		// レスポンスヘッダー (検証に利用したい場合にどうぞ)
 $array = json_decode($json,true);

 for($i=0;$i<10;$i++){

	if(isset($array['data'][$i]['username'])){
		echo "<a href ='https://twitter.com/".$array['data'][$i]['username']."'>21~".$array['data'][$i]['name']."</a><br>";
	}
}

var_dump($json);

