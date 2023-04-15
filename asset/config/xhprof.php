<?php
/** op-app-skeleton-2020:/asset/config/xhprof.php
 *
 * @created   2023-04-15
 * @version   1.0
 * @package   op-app-skeleton-2020
 * @author    Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright Tomoaki Nagahara All right reserved.
 */

//  ...
$root_path   = sys_get_temp_dir() . '/xhprof/';

/** Return config array.
 *
 * @return    array        $config
 */
$config = [
    'root_path'  => $root_path,
    'file_path'  => [
        'date'   => true,
    ],
    'file_name'  => [
        'whoami' => false,
        'host'   => true,
        'version'=> true,
        'date'   => false,
        'time'   => true,
    ],
    'link_path'  => [
        'host'   => true,
        'url'    => true,
        'args'   => true,
    ],
];

//  ...
return $config;
