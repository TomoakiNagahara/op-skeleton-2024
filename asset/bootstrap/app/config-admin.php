<?php
/** op-module-bootstrap:/app/config-admin.php
 *
 * Generate _admin.php file save to asset:/config dir, copy from admin.php file.
 *
 * @created		2023-11-27
 * @version		1.0
 * @package		op-module-bootstrap
 * @author		Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright	Tomoaki Nagahara All right reserved.
 */

//	...
namespace OP;

//	Check if set admin.
if( Env::_ADMIN_IP_ and Env::_ADMIN_MAIL_ ){
	return;
}

//	Source file.
$path = OP::MetaPath('asset:/config/admin.php');

//	Get and generate config.
$file = file_get_contents($path);
$file = Encode($file);
$file = preg_replace(['|\/\*\* .+|','| \*.+|','| \*|','|\n/\*|','|\n\*/|'], '', $file);
$file = preg_replace(['|//\t|','|\t|','|\n+|','|,\n|','|,\n\n\]|'], ['//  ','    ',"\n",",\n\n",",\n]"], $file);

//	Put config file.
if(!file_put_contents(OP::MetaPath('asset:/config/').'_admin.php',  OP::Decode($file)) ){
	echo 'Could not write to this file. (asset:/config/_admin.php)';
	return false;
}

//	True is success.
return true;
