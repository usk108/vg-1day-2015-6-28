<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

	//ライブラリを読み込む
	require_once "./phpFlickr.php";

	//Consumer Key
	$app_key = "9a85478dce3893784c4087db28f703c0";

	//Consumer Secret
	$app_secret = "secret
47a853bedd2bb019";



$app = new My1DayServer\Application();
$app['debug'] = true;

$app->get('/messages', function () use ($app) {
    $messages = $app->getAllMessages();

    return $app->json($messages);
});

$app->get('/messages/{id}', function ($id) use ($app) {
    $message = $app->getMessage($id);

    return $app->json($message);
});

$app->post('/messages', function (Request $request) use ($app) {
    $data = $app->validateRequestAsJson($request);

    $username = isset($data['username']) ? $data['username'] : '';
    $body = isset($data['body']) ? $data['body'] : '';

  if(strcmp($username,'image') == 0){
  		//インスタンスを作成する
	$flickr = new phpFlickr( $app_key , $app_secret );

	//検索ワードの指定
	$keyword = "body";

	//取得件数の指定
	$count = 1;

	//オプションの設定
	$option = array(
		"text" => $keyword,
		"per_page" => $count,
		"extras" => "url_m",
		"safe_search" => 1,
	);

	//検索を実行し、取得したデータを[$result]に代入する
	$result = $flickr->photos_search($option);

	//[$result]をJSONに変換する
	$json = json_encode( $result );

	//JSONをオブジェクト型に変換する
	$obj = json_decode( $json );

	//ループ処理
	foreach($obj->photo as $photo){

		//データの整理
		$body = $photo->url_m;		//画像ファイルのURL
		
		//出力する
		//echo '<img src="' . $src . '" width="' . $width . '" height="' . $height . '"/><br/>';
		 $createdMessage = $app->createMessage($username, $body, base64_encode(file_get_contents($app['icon_image_path'])));

	}
	
	return $app->json($createdMessage);
  }else{
  	

    //bodyの内容がuranaiだったら
    if(strcmp($body,'uranai') == 0){
        //占い結果を擬似乱数で作成
        $randint = rand(1,10);
        if($randint < 3){
            //凶
            $body = '凶';
        }else if($randint < 8){
            //吉
            $body = '吉';
        }else if($randint <= 10){
            //大吉
            $body = '大吉';
        }
        $username = 'bot';
        //username = "bot", body = 占い結果　に書き換える
    }
    $createdMessage = $app->createMessage($username, $body, base64_encode(file_get_contents($app['icon_image_path'])));

    return $app->json($createdMessage);
  }
});

$app->delete('/messages/{id}', function ($id) use ($app) {
    $app->deleteMessage($id);

    return new Response('', Response::HTTP_NO_CONTENT, [
        'Access-Control-Allow-Origin' => '*',
    ]);
});

$app->options('/messages/{id}', function ($id) use ($app) {
    return new Response('', Response::HTTP_NO_CONTENT, [
        'Access-Control-Allow-Origin' => '*',
        'Access-Control-Allow-Methods' => 'GET,DELETE',
    ]);
});

return $app;
