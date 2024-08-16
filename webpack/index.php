<?php
/** op-skeleton-2024:/webpack/index.php
 *
 * @created   2024-08-16
 * @version   1.0
 * @package   op-skeleton-2024
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

//	Layout is turn off.
OP()->Layout(false);

//	Init MIME
OP()->Env()->MIME('text/plain');

//	Get extension by directory name.
if(!$ext = OP()->Router()->Args()[0] ?? null ){
	echo "/* Empty extension directory name. */";
	return;
}

//	Match extension.
switch( $ext ){
	case 'js':
	case 'css':
		break;
	default:
		echo "/* Does not match extension directory name. `$ext` */";
	return;
}

//	Re:Set MIME by extension.
OP()->Env()->MIME($ext);

//	Get Layout name by URL Query. If not set URL Query, Use default Layout.
$layout = OP()->Request('layout') ?? OP()->Layout()->Name();

//	Set Layout default config.
if( $path   = OP()->MetaPath("asset:/layout/{$layout}/config.php") ){
	$config = include( $path );
	OP()->Config($layout, $config);
}

//	Set source directories.
OP()->WebPack()->Auto("asset:/layout/{$layout}/{$ext}/");
OP()->WebPack()->Auto(__DIR__."/{$ext}/");

//	Output codes.
OP()->WebPack()->Auto();
