<?php
class Redirect{
	public static function to($location = null){
		if ($location){
			if (is_numeric($location)){
				switch ($location){
					case '404':
						header('HTTP/1.0 404 Not Found');
						exit();
					break;
					default:
						exit();
					break;
				}
			}
				echo "<script>window.location='{$location}'</script>";
				exit();
		}
	}
}
?>