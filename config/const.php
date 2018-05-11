<?php

return [

	/*
	|--------------------------------------------------------------------------
	| users file path
	|--------------------------------------------------------------------------
	|
	| users file path
	| Supported: "local"
	|
	*/

	'user_path' => 'users',
	'project_path' => 'projects',
	'sex' => [
		'0' => '男性',
		'1' => '女性',
		'2' => '該当なし',
	],
	'skill' => [
		'1' => '企画',
		'2' => 'コピーライター',
		'3' => 'ナレーション原稿',
		'4' => 'プロデュース',
		'5' => '絵コンテ',
		'6' => '制作進行',
		'7' => '演出',
		'8' => 'カメラ（スチール）',
		'9' => 'カメラ（ムービー）',
		'10' => '照明',
		'11' => '音声・録音',
		'12' => '美術',
		'13' => 'メイク',
		'14' => '衣装',
		'15' => '作曲',
		'16' => '選曲・SE',
		'17' => 'ナレーション',
		'18' => '編集',
		'19' => 'イラスト',
		'20' => 'アニメーション',
		'21' => '3DCG',
	],
	'softwear' => [
		'1' => 'Photoshop',
		'2' => 'Illustrator',
		'3' => 'Final Cut Pro',
		'4' => 'Adobe Premiere',
		'5' => 'Avid Media Composer',
		'6' => 'Avid Xpress Pro',
		'7' => 'EDIUS',
		'8' => 'After Effects',
		'9' => 'Flash',
		'10' => 'Motion',
		'11' => 'Fusion',
		'12' => 'Smoke',
		'13' => 'NUKE',
		'14' => 'Houdini',
		'15' => 'ZBrush',
		'16' => 'Shade',
		'17' => 'CINEMA 4D',
		'18' => 'MAYA',
		'19' => '3ds Max',
		'20' => 'Softimage',
		'21' => 'Blender',
		'22' => 'Light Wave',
		'23' => 'Apple Compressor',
		'24' => 'Adobe Media Encoder',
	],
	'kind' => [
		'1' => 'クリエイター',
		'2' => 'クライアント',
		'3' => '管理者',
	],
	'publish' => [
		'1' => 'コンペ主催者',
		'2' => '全クライアント',
		'3' => '全ユーザ',
		'4' => '閲覧制限なし',
	],
	'enabled' => [
		'0' => '無効',
		'1' => '有効',
	],

	'category1' => [
		'各プロモーション分類' => [
			10 => '認知・ブランディング・イメージ',
			11 => '施設・商品・サービス紹介',
			12 => '施設・商品・サービス利用訴求',
			13 => '営業ツール',
			20 => 'マニュアル',
			21 => '社内用',
			22 => 'リクルート',
			30 => 'コンテンツマーケ',
			31 => 'オウンドメディア・ランディング',
			40 => '企画もの',
		],
		'コンテンツ分類' => [
			50 => 'エンターテイメント全般コンテンツ（YouTube等含む）',
			51 => 'ニュースコンテンツ',
			52 => '教育コンテンツ',
			53 => 'アート系コンテンツ',
			54 => '自主製作コンテンツ',
			55 => 'セルフプロデュースコンテンツ',
			56 => '結婚式等の冠婚葬祭',
		],
	],
	'category2' => [
		'実写' => [
			10 => 'イメージ広告 ブランド広告表現',
			11 => 'ドキュメンタリー',
			12 => 'インフォマーシャル',
			13 => 'テスティモニアル（お客様の声など）',
			14 => 'ハウツー マニュアルもの',
			15 => 'インタビュー',
			20 => '演技もの ドラマ仕立',
			21 => 'お笑い仕立',
			22 => '食レポ・料理もの',
			23 => '旅行もの',
			30 => 'イベント収録・中継など（ライブのＤＶＤなど）',
			31 => 'メイキングもの',
			32 => '特殊表現（シズルなど）',
			33 => 'バズを意図したもの',
		],
		'アニメーション・CG' => [
			40 => '3DCG',
			41 => '2DCG',
			42 => 'モーショングラフィック',
			50 => 'キャラクターアニメーション',
			51 => 'ホワイトボードアニメーション',
			52 => 'インフォグラフィック',
			53 => 'セルアニメーション',
			54 => '3Dアニメーション',
			55 => 'ストップモーション',
			56 => 'マンガ風アニメーション',
			57 => '切り絵アニメーション',
			58 => '絵本風アニメーション',
			60 => 'その他のアニメーション手法',
		],
		'編集もの' => [
			70 => '素材編集全般',
		],
	],
	'category3' => [
		'WEB系' => [
			10 => '自社サービス・商品HP',
			11 => 'Web上媒体 SNS系以外',
			12 => 'SNS系各種',
		],
		'デジタルデバイス系' => [
			20 => '展示会や各種イベント',
			21 => '店頭・施設モニター',
			22 => 'PC・各種スマートデバイス内',
			23 => 'デジタルサイネージ（公共交通機関）',
			24 => 'デジタルサイネージ（公共交通機関以外）',
		],
		'メディア系' => [
			30 => 'テレビ地上波',
			31 => 'テレビ地上波以外（BS/CS/CATV）',
			32 => '映画',
			33 => 'DVD作品全般',
		],
		'その他' => [
			40 => 'オリジナル作品（ゲーム・アプリなど）',
		],
	],
	//TODO:not used
	'category4' => [
		'IT/情報通信' => [
			'スマホアプリ', 'ゲーム', 'Web ・ITサービス', '情報機器', '通信', 'テレビ・ラジオ・新聞'
		],
		'メーカー' => [
			6 => '医薬品・健康食品', '化粧品・美容', '食品・飲料', 'ファッション',
			'自動車・輸送機器', '電機', '石油化学・鉄鋼業', 'その他製造業'
		],
		'サービス/流通' => [
			14 => '銀行・金融', '医療・福祉', '建設・不動産', '小売り・卸売', '運輸・交通',
			'飲食', '旅行・宿泊', '教育・研修', '娯楽・エンターテイメント',
			'スポーツ', 'ブライダル', 'コンサルティング・士業', 'その他サービス業',
		],
		'公共/一次産業' => [
			27 => '農林・水産・鉱業', '電力・ガス・インフラ', '官公庁・政府広報', 'NPO・NGO',
		],
	],
	'base' => [
		'全国','北海道地方', '東北地方', '関東地方', '中部地方', '近畿地方', '中国地方',
		'四国地方', '九州地方'
	],
	'group' => [
		'1' => 'フリーランス個人',
		'2' => 'フリーランス チーム ～5名',
		'3' => 'フリーランス チーム 6～10名',
		'4' => 'フリーランス チーム 11名～',
		'5' => '制作作会社 ～5名',
		'6' => '制作作会社6～10名',
		'7' => '制作作会社 11名～',
		'8' => '学生',
		'9' => '学生チーム',
	],
	'generation' => [
		'1' => '18～20才未満',
		'2' => '20代前半',
		'3' => '20代後半',
		'4' => '30代前半',
		'5' => '30代後半',
		'6' => '40代',
		'7' => '50代',
		'8' => '60代',
		'0' => '該当なし',
	],
	'project_status' => [
		//0   => '下書き',
		//0   => '登録済み',
		10  => '登録済み',
		20  => 'クルオ確認中',
		30  => '公開',
		40  => '案件スタート',
		50  => 'クルオ検収中',
		60  => 'クライアント検収中',
		70  => '終了',
		999 => 'キャンセル',
	],
	'project_movie_style' => [
		1 => '実写',
		2 => 'アニメーション・CG',
		//2 => 'アニメーション',
		//3 => 'アニメーション・CG',
	],
	'project_movie_type' => [
		0  => '広告', //'WEB広告(サイネージ・SNS含む)',
		//1  => 'エンゲージコンテンツ',
		//2  => 'ブランディング',
		//3  => '店舗・施設紹介',
		//4  => 'プロダクト・サービス紹介',
		//5  => 'インフォマーシャル',
		//6  => 'HOWTO',
		7  =>  '作品',//'メディア/オウンドもの',
		//8  => '事例紹介・お客様の声',
		//9  => 'リクルート',
		//10 => 'APP',
		//11 => 'ゲーム',
		//12 => 'イベント',
		//13 => 'クラウドファンディング',
		//14 => 'VR・360°コンテンツ',
		//15 => 'ミュージックビデオ',
		//16 => 'TVCM',
		//17 => '番組',
		//18 => 'インタビュー',
		19 => 'インナー', //'教育・ラーニング・セミナー',
		//20 => 'スクリーンキャスト',
		//21 => 'ドローン',
		//22 => 'ARコンテンツ',
		//23 => 'CGコンテンツ',
		24 => '記録',//'その他',
	],
	'project_movie_type_update_text' => [
		0 => '広告',
		7 => '作品',
		19 => 'インナー',
		24 => '記録'
	],
	'project_purpose' => [
		'1' => ['ブランドの認知度アップ', 'gray-blue-back'],
		'2' => ['リーチ', 'gray-light-back'],
		'3' => ['トラフィック', 'gray-light-back'],
		'4' => ['エンゲージメント', 'gray-light-back'],
		'5' => ['アプリのインストール', 'gray-light-back'],
		'6' => ['動画の再生数アップ', 'gray-light-back'],
		'7' => ['リード獲得', 'gray-light-back'],
		'8' => ['コンバージョン', 'gray-green-back'],
		'9' => ['製品カタログでの販売', 'gray-green-back'],
		'10' => ['来店数の増加', 'gray-green-back'],
	],
	'project_client_range' => [
		'1' => '会社・商品素材(ロゴ、資料、写真など)',
		'2' => 'ディレクション プロデュース',
		'3' => '演者・モデル',
		'4' => 'ロケーション(撮影場所)',
		'5' => 'ヘアメイク',
		'6' => 'スタイリスト'
	],
	'project_aspect' => [
		'1' => '16:9',
		'2' => 'スクエア',
		'3' => '縦型',
		'4' => 'その他',
	],
	'payment_status' => [
		'1' => '支払い済み',
		'100' => '返金済み',
	],
	'business_type' => [
		'1' => '農林水産・鉱業',
		'2' => '建設',
		'3' => '自動車、輸送機器',
		'4' => '電気、電子機器',
		'5' => '機械、重電',
		'6' => '素材',
		'7' => '食品、医薬、化粧品',
		'8' => 'その他製造',
		'9' => 'エネルギー',
		'10' => '卸売・小売業・商業（商社含む）',
		'11' => '金融・証券・保険',
		'12' => '不動産',
		'13' => '通信サービス',
		'14' => '情報処理、SI,ソフトウェア',
		'15' => '運輸',
		'16' => 'コンサル・会計・法律関連',
		'17' => '放送・広告・出版・マスコミ',
		'18' => '公務員（教員を除く）',
		'19' => '教育・教育学習支援関係',
		'20' => '医療',
		'21' => '介護・福祉',
		'22' => '飲食店・宿泊',
		'23' => '人材サービス',
		'24' => '旅行',
		'25' => 'その他',
	],
	'project_fees' => [
		'certcreator' => 100000,
		'normal' => 50000,
		'prime'  => 30000
	],
	
	'project_requests' => [
		1  => '企画<br/>（ストーリーボード）',
		2  => '撮影',
		3  => '編集',
		4  => 'アニメーション',
		5  => 'モーショングラフィック<br>（高度なアニメーション）',
		6  => '会社・商品素材<br/>（ロゴ、資料、写真など）',
		7  => 'ディレクション<br/>プロデュース',
		8  => '演者・モデル',
		9  => 'ロケーション<br/>（撮影場所）',
		10 => 'ヘアメイク',
		11 => 'スタイリスト'
	],
	'creative_room_thumbnails' => [
		0 => 'images/room_thumbnails/thumb01.jpg',
		1 => 'images/room_thumbnails/thumb02.jpg',
		2 => 'images/room_thumbnails/thumb03.jpg',
		3 => 'images/room_thumbnails/thumb04.jpg',
		4 => 'images/room_thumbnails/thumb05.jpg',
		5 => 'images/room_thumbnails/thumb06.jpg',
		6 => 'images/room_thumbnails/thumb07.jpg',
		7 => 'images/room_thumbnails/thumb08.jpg',
		8 => 'images/room_thumbnails/thumb09.jpg',
		9 => 'images/room_thumbnails/thumb10.jpg',
	],
	'c_base_user_limit' => 10
//TODO: const for reword
//               $kind = [0 => 'コンペ', '経費', '追加報酬'];
//               $enabled = [0 => '無効', '有効'];
//               $status = [0 => '無効', '承認待ち', '支払い予定', '支払い完了'];

];