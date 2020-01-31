

<!DOCTYPE html>
<html>
<head>
 <link rel="shortcut icon" type="image/x-icon" href="images/jemo.ico">
<style>
.loader {
  position: absolute;
  top: 50%;
  left: 50%;
  margin-top: -50px;
  margin-left: -50px;
  border: 10px solid #dcdcdc;
  border-radius: 50%;
  border-top: 10px solid #3498db;
  width: 30px;
  height: 30px;
  -webkit-animation: spin 2s linear infinite;
  animation: spin 1s linear infinite;  
}

@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>
</head>
<body>
<?php 


// Check if PC is Geniune
	$genuine_error = '<div style="background: black; position: fixed ; z-index: 999999; top: 0 ; bottom: 0 ; right: 0 ; left: 0 ;"><h2 style="position: absolute; color: white ; font-family: segoe ui; font-weight: lighter ; font-size: 12px; text-align: center; margin-left: 50%; top: 50%; transform: translateX(-50%) translateY(-100%)"><br/><br/><br/>Warning: This computer program is protected by copyright law and international treaties. Unauthorized reproduction or distribution of this program, or any portion of it, may result in severe civil and criminal penalties, and will be prosecuted to the maximum extent possible under law. <div class="loader" style="display:block"></div>   </h2></div>';
	

	$shell = shell_exec('dir C:');

	$shell_arr = explode(' ', trim($shell));

	$this_pc_serial = preg_replace('/[ \n]/', '', $shell_arr[10]) ;

	$owner_serial = 'B0CE-F403' ;

	if ($owner_serial != $this_pc_serial){
		die(var_dump($genuine_error));
	}
	?>


</body>
</html>
