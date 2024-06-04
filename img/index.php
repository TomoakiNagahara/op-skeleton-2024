<?php
/** op-skeleton-2020:/img/index.php
 *
 * @created   2018-05-21
 * @version   1.0
 * @package   op-skeleton-2020
 * @author    Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright Tomoaki Nagahara All right reserved.
 */

/** namespace
 *
 */
namespace OP;

//	Layout is off.
OP::Layout(false);

//	Get "SmartURL" Arguments.
$args = Unit('Router')->Args();

//	Generate file path.
if(!$file = join('/', $args) ){
	$file = '404.png';
}

//	Get Layout name.
$layout = Config::Get('layout')['name'] ?? null;

//	Check layout img directory.
if( file_exists( $path = RootPath('asset') . "layout/{$layout}/img/{$file}" ) ){
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
$ext  = OP::GetExtension($path);
$mime = OP::GetMimeFromExtension($ext);

//	Set MIME.
Env::Mime($mime);

//	Load image file.
echo file_get_contents($path);
