<?php
/** op-app-skeleton-2020-nep:/js/index.php
 *
 * @created   2023-01-22
 * @version   1.0
 * @package   op-app-skeleton-2020-nep
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
foreach( glob('*.js') as $file ){
	//	...
	if( $file === 'index.js' ){
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
	if( OP()->Env()->isAdmin() ){
		OP()->WebPack()->Auto("asset:/webpack/{$extension}/");
	}

	//	Output codes.
	OP()->WebPack()->Auto();
}
