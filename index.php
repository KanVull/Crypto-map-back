<?php
include("config.php");
//$dbcnx = @mysql_connect($dblocation,$dbuser,$dbpasswd);
/*
if ($mysql->ping()) {
	printf ("Соединение в порядке!\n");
} else {
	printf ("Ошибка: %s\n", $mysql->error);
}
*/
if ($mysql->connect_error) {
	/* Используйте предпочитаемый вами метод регистрации ошибок */
	error_log('Ошибка при подключении: ' . $mysql->connect_error);
}

if (isset($_GET['request']) && $_GET['request']=="list") {
	
} else {
	$sql="SELECT 
		changers.id as id,
		changers.name as name,
		changers.adress as adress,
		changers.phone as phone,
		changers.site as site,
		changers.tg as tg,
		changers.comission as comission,
		changers.link as link,
		cites.name as city,
		types.name as type,
		changers.work_hours as work_hours
		FROM 
			`changers`,cites,types 
		where 
			changers.type_id=types.id and changers.city_id=cites.id";
	$res=$mysql->query($sql);
	$changers=[];
	while($item=$res->fetch_assoc()) {
		$sql="SELECT currency.name as name FROM currency,changer_currency where changer_currency.changer_id=".$item['id']." and changer_currency.currency_id=currency.id";
		$res2=$mysql->query($sql);
		$currency_ar=[];
		while ($currency=$res2->fetch_assoc()) {
			$currency_ar[]=$currency['name'];
		}
	
	
		$changers[]=array(
			"name"=> $item['name'],
			"address"=> $item['adress'],
			"contacts"=>"" ,
			"commission"=> $item['comission'],
			"currencies" => $currency_ar,
			"map_links" => $item['link'] ,
			"opening_hours" => $item['work_hours'] ,
			"type"=>$item['type'] ,
			"city"=>$item['city'] 
		);
	};
	
	echo json_encode($changers,JSON_UNESCAPED_UNICODE);
}
?>