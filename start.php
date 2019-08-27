<?php

@set_time_limit(0);
@clearstatcache();
@ini_set('max_execution_time',0);
@ini_set('output_buffering',0);
date_default_timezone_set('UTC');
require __DIR__.'/vendor/autoload.php';


$username = '';//Логин аккаунта
$password = ''; //Пароль аккаунта
$count = '100'; //Количество загржаемых фото


$ig = new \InstagramAPI\Instagram(false, false);

try {
    $ig->login($username, $password);
	echo "Успешно авторизовались.\n";
} catch (Exception $e) {
	echo "Неверное имя пользователя или пароль.\n";
	
}
 for($i = 1; $i< $count; $i++){
$dir = "botImages/"; 
$img_a = array(); 
    if (is_dir($dir)){ 	
        if($od = opendir($dir)){ 		
while(($file = readdir($od)) !== false){ 		
	if(strtolower(strstr($file, "."))===".jpg" || strtolower(strstr($file, "."))===".gif" || strtolower(strstr($file, "."))===".png"){ 				array_push($img_a, $file); 			
        } 		
    } 		
closedir($od); 	
    } 
 } 
$rd = rand(0, count($img_a)-1); 
$photoFilename = $dir.$img_a[$rd];
 
    $photo = new \InstagramAPI\Media\Photo\InstagramPhoto($photoFilename);
    $ig->timeline->uploadPhoto($photo->getFile());
       echo "Загрузили [" .$i."] фото <br>";
}
       $ig->account->changeProfilePicture($photo->getFile());




?>