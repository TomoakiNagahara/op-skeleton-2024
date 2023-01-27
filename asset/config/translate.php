<?php
/**
 * app-skeleton-2020-nep:/asset/config/translate.php
 *
 * @created   2022-12-30
 * @version   1.0
 * @package   app-skeleton-2020-nep
 * @author    Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright Tomoaki Nagahara All right reserved.
 */

 /** namespace
 *
 */
namespace OP;

/** Return config array.
 *
 * @return    array        $config
 */
return [
	'language-area-id'       => 'op-translate-language-area',
	'tranlate_language_list' => Hasha1('tranlate_language_list'),
	'tranlate_language_code' => Hasha1('tranlate_language_code'),
	'item_language_code'     => Hasha1('item_language_code'),
];
