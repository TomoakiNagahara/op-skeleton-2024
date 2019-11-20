<?php
/**
 * app-skeleton-2019-nep:/asset/config/20_layout.php
 *
 * @created   2019-02-22
 * @version   1.0
 * @package   app-skeleton-2019-nep
 * @author    Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright Tomoaki Nagahara All right reserved.
 */

/** namespace
 *
 * @created   2019-02-22
 */
namespace OP;

//	...
Env::Set('layout',[
	'directory' => 'asset:/layout/',
	'execute'   =>  true,
	'name'      => 'white',
]);

//	...
/*
if( $layout = Env::Get('layout') ){
	$path   = ConvertPath($layout['directory']) . $layout['name'];
	RootPath('layout', $path);
};
*/
