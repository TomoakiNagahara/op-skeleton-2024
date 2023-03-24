<?php
/** op-app-skeleton-2020-nep:/img/index.php
 *
 * @created   2018-05-21
 * @version   1.0
 * @package   op-app-skeleton-2020-nep
 * @author    Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright Tomoaki Nagahara All right reserved.
 */

/** namespace
 *
 */
namespace OP;

//	Get "SmartURL" Arguments.
$args = Unit('Router')->Args();

//	Get file name.
$file = $args[0] ?? '404';

//	Support default status image.
if( $file === '403' or $file === '404' ){
	$file .= '.png'; // Add file extension.
}

//	Get Layout name.
$layout = Config::Get('layout')['name'] ?? null;

//	Check layout img directory.
if( file_exists( $path = OP::MetaRoot('asset') . "layout/$layout/img/$file" ) ){
	//	Found
}else if( file_exists( $path = $file ) ){
	//	Found
}else{
	//	Change http status code.
	http_response_code('404');

	//	If not, change file name.
	$path = __DIR__.'/404.png';
}

//	Get extension.
$tmp = explode('.', $file);
$ext = strtolower(array_pop($tmp));

//	Generate MIME.
switch( $ext ){
	case 'jpg':
		$mime = 'jpeg';
	//	break;

	case 'gif':
	case 'png':
	case 'jpeg':
		$mime = "image/$ext";
		break;

	case 'ico':
		$mime = "image/vnd.microsoft.icon";
		break;

	default:
		D("This extension is not supported. ($ext)");
		return;
}

//	Layout to off.
OP::Layout(false);

//	Set MIME.
Env::Mime($mime);

//	Load image file.
passthru(`echo cat {$path}`);
//echo file_get_contents($path);
