<?php
/** op-app-skeleton-2020-nep:/css/index.php
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
//echo "Could load index.php\n*/\n";

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

//echo "\n/*\nFinish index.php\n";
