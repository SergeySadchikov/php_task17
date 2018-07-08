<?php
session_start();  
require __DIR__.'/vendor/autoload.php';
if (!empty($_POST['address'])) {
		$address = $_POST['address'];
		$api = new \Yandex\Geo\Api();
		$api->setQuery($address);
		$api
		    ->setLimit(5)
		    ->setLang(\Yandex\Geo\Api::LANG_RU) 
		    ->load();

		$response = $api->getResponse();
		$response->getQuery(); 
		$count = $response->getFoundCount();
		$collection = $response->getList();
}

if (isset($collection) && $count > 0) { 
		foreach ($collection as $item) { 
			$data[] = [
				'found' => $item->getAddress(),
				'lat' => $item->getLatitude(),
				'long' => $item->getLongitude(),
			];
			$_SESSION['data'] = $data;
		} 
	} elseif (isset($collection) && $count == 0) {
		unset($_SESSION['data']);
		$error = 'Данный адрес не существует';
} 

function getCenter() {
	if(!empty($_GET['lat'] && $_GET['long'])) {
		return
			$center = ($_GET['lat'].', '.$_GET['long']);
	}
}
?>