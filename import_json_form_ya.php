<?php
	$dblocation = "192.168.1.235";
	//$dbname = "cabinet_test";
	$dbname = "crypto_map";
	$dbuser = "crypto_map";
	$dbpasswd = "1@Fpqed5aJ";
	$mysql=new mysqli($dblocation,$dbuser,$dbpasswd,$dbname);
	$mysql->set_charset("utf8");
	
	$ourData = file_get_contents("sample_crypto.json");
	$ar=json_decode($ourData,True);
	//var_dump($ar);
	$find_result=json_decode($ar,True);
	foreach($find_result['features'] as $find_item) {
		//print_r($find_item);
		$company=$find_item['properties']['CompanyMetaData'];
		//print_r ($company);
		
		
		$phones=[];
		
		if (isset($company['phones'])) {
			foreach($company['phones'] as $phone) {
				$phones[]=$phone['formatted'];
			}
		}
		
		$url='';
		if (isset($company['url'])) {
			$url=$company['url'];
		}
		
		$hours='';
		if (isset($company['Hours']['text'])) {
			$hours=$company['Hours']['text'];
		}
		
		$sql="insert into changers(
		name,
		adress,
		phone,
		mail,
		site,
		tg,
		comission,
		link,
		type_id,
		city_id,
		work_hours) values(
			'".$company['name']."',
			'".$company['address']."',
			'".implode(",",$phones)."',
			'',
			'".$url."',
			'',
			'0',
			'https://yandex.ru/maps/?text=".$company['name']."',
			'1',
			'1',
			'".$hours."')
		";
		if ($mysql->query($sql)){
			echo "New record created successfully";	
		} else {
			echo "Error: " . $sql . "<br>" . $mysql->error;
		}
	}
?>