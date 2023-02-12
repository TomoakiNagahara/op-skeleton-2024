<?php
/** op-module-bootstrap:/php/module.php
 *
 * @created   2022-12-17
 * @version   1.0
 * @package   op-module-bootstrap
 * @author    Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright Tomoaki Nagahara All right reserved.
 */

/** namespace
 *
 */
namespace OP;

//	...
$php     = ($_SERVER['_'] ?? null) ? basename($_SERVER['_']): 'php';
$version = ($php !== 'php') ? '': PHP_MAJOR_VERSION . PHP_MINOR_VERSION;
$module  = _OP_APP_BOOTSTRAP_;

//	...
foreach(['port','pkg','yum','apt'] as $pkg){
	if( `command -v $pkg` ){
		break;
	}
}

//	...
if( Env::isCI() ){
	echo "0\n";
	echo "{$pkg} install {$php}{$version}-{$module}\n";
	return;
}

//	...
if( Env::isShell() ){
	echo "Note: php-{$module} is not install. Please enter the following command.\n";
	echo "\n"."sudo {$pkg} install {$php}{$version}-{$module}"."\n\n";
	return;
}

//	...
define('_INSTALL_COMMAND_', "sudo {$pkg} install {$php}{$version}-{$module}");

//	...
require('module.phtml');
