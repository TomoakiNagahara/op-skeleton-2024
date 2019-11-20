<?php
/**
 * app-skeleton-2019-nep:/asset/config.php
 *
 * @creation  2018-03-27
 * @version   1.0
 * @package   app-skeleton-2019-nep
 * @author    Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright Tomoaki Nagahara All right reserved.
 */
//	...
call_user_func(function(){
	//	...
	foreach( glob(__DIR__.'/config/*\.php') as $file ){
		//	...
		call_user_func(function($file){

			//	...
			include($file);

		}, $file);
	};
});
