<?php
/** op-skeleton-2020:/css/index.php
 *
 * @created   2023-01-22
 * @version   1.0
 * @package   op-skeleton-2020
 * @author    Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright Tomoaki Nagahara All right reserved.
 */

/** Declare strict
 *
 */
declare(strict_types=1);

/** namespace
 *
 */
namespace OP;

//	...
if( _OP_APP_BRANCH_ < 2024 ){
//	...
foreach( glob('*.css') as $file ){
	//	...
	if( $file === 'index.css' ){
		//	Why?
		continue;
	}

	//	...
	if( $file[0] === '.' or $file[0] === '_' ){
		continue;
	}

	//	...
	echo OP::Template($file);
}
}else{
	//	Get extension.
	$extension = basename(__DIR__);

	//	Set MIME from extension.
	OP()->Env()->MIME($extension);

	//	Get Layout name.
	$layout = OP()->Request('layout') ?? OP()->Layout()->Name();

	//	Set each layout default config.
	if( $path   = OP()->MetaPath("asset:/layout/{$layout}/config.php") ){
		$config = include( $path );
		OP()->Config($layout, $config);
	}

	//	Set directories.
	OP()->WebPack()->Auto("asset:/layout/{$layout}/{$extension}/");
	OP()->WebPack()->Auto('./');

	//	Output codes.
	OP()->WebPack()->Auto();
}
