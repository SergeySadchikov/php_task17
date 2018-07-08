<?php
	require_once 'controller.php';
	if (isset($_SESSION['data'])) {
		$data = $_SESSION['data'];
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Поиск координат </title>
	<meta charset="utf-8">
	<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
</head>
<h1>Поиск координат по адресу</h1>
<body>
	<form action="" method="post">
		<input type="text" name="address" required placeholder="введите адрес" value="<?php if (isset($address)) {echo $address; } ?>">
		<input type="submit" value="Поиск">
	</form>
		<?php
			if(isset($data)) { ?>
				<?php foreach ($data as $key => $value) : ?>
					<div>
						<a href="?lat=<?php echo ($value['lat']); ?>&long=<?php echo ($value['long']); ?>"><?php echo ($value['found']) ?>, <?php echo ($value['lat']); ?>, <?php echo ($value['long']); ?></a>
					</div>	
				<?php endforeach; ?>
				
				<div id="map" style="width: 600px; height: 400px"></div>
				
				<script type="text/javascript">
				    ymaps.ready(init);
				    function init(){   
				        var myMap = new ymaps.Map("map", {
				            center: [<?php echo (getCenter()); ?>],
				            zoom: 7
				        });
				        var myPlacemark = new ymaps.Placemark([<?php echo (getCenter()); ?>], {
				            });
				            
				            myMap.geoObjects.add(myPlacemark);
				    }
				</script>
			
			<?php } else { ?>
				<p><?php if (isset($error)) {echo $error;} ?></p>
			<?php } ?>

</body>
</html>


