<?php
/** op-app-skeleton-2020-nep:/dev.php
 *
 * @created   2023-04-13
 * @version   1.0
 * @package   op-app-skeleton-2020-nep
 * @author    Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright Tomoaki Nagahara All right reserved.
 */

//  Check
if(!extension_loaded('tideways_xhprof') ){
    echo "A tideways_xhprof is not install\n";
    return;
}

//  Start
tideways_xhprof_enable(/* TIDEWAYS_XHPROF_FLAGS_CPU | TIDEWAYS_XHPROF_FLAGS_MEMORY */);

//  App
include('app.php');

//  Finish
$data = tideways_xhprof_disable();

//  Save
$version = PHP_MAJOR_VERSION.PHP_MINOR_VERSION;
$time    = date('H-i-s').'-'.explode('.', $_SERVER["REQUEST_TIME_FLOAT"])[1];
$ext     = true ? 'xhprof': 'json'; // extension
$file    = "php{$version}_{$time}.{$ext}";
if( false ){
    $path    = sys_get_temp_dir() . "/" . uniqid() . ".yourapp.xhprof";
    $dir     = '/www/_caches/php/xhprof/test/';
    $time    = date('H-i-s').'-'.explode('.', $_SERVER["REQUEST_TIME_FLOAT"])[1];
}else{
    $whoami  = trim(`whoami`);
    $year    = date('Y');
    $month   = date('m');
    $day     = date('d');
    $root    = "/www/_caches/php/xhprof/";
    $dir     = "{$root}/{$whoami}/{$year}/{$month}/{$day}/";
    $path    = "{$dir}/{$file}";

    //  ...
    if( \OP\Env::isHttp() ){
        $host    = $_SERVER['SERVER_NAME'];
        $path    = "{$dir}/{$host}_{$file}";
        $endpoint= dirname( OP()->Router()->EndPoint() );
        if( strpos($endpoint, $_SERVER['DOCUMENT_ROOT']) !== 0 ){
            Notice("Unmatch end-point: {$endpoint}, {$_SERVER['DOCUMENT_ROOT']}");
        }else{
            $doc = rtrim($_SERVER['DOCUMENT_ROOT'], '/');
            $len = strlen($doc);
            $url = substr($endpoint, $len);
            $link= "{$root}/{$whoami}/{$host}/{$url}/";
        }
    }else{
    }
}

//  Create save directory.
if(!file_exists($dir) ){
    if(!mkdir($dir, 0777, true) ){
        Notice("Could not create directory. ({$dir})");
        return;
    }
}

//  Create xhprof.
file_put_contents( $path, json_encode($data) );

//  Create link file at URL.
if( $link ?? null ){
    //  ...
    if(!$io = file_exists($link) ){
        if(!$io = mkdir($link, 0777, true) ){
            Notice("Could not create directory. ({$link})");
        }
    }

    //  ...
    if( $io ){
        symlink($path, $link.$file);
    }
}

/** Profiling tools
 *
 * Tideways toolkit
 * <pre>
 * cd ~/
 * sudo port install go
 * export GOPATH=$HOME/go
 * export PATH=$GOPATH/bin:$PATH
 * go install github.com/tideways/toolkit
 * toolkit analyze-xhprof /www/_caches/php/xhprof/date/*.json
 * toolkit generate-xhprof-graphviz /www/_caches/php/xhprof/date/*.json
 * dot -Tpng callgraph.dot > callgraph.png
 * </pre>
 * @see https://github.com/tideways/toolkit
 *
 * <pre>
 * git clone https://github.com/sters/xhprof-html
 * cd xhprof-html
 * php -S localhost:8001
 * http://localhost:8001/?dir={Your xhprof profiling result dir}
 * </pre>
 * @see https://github.com/sters/xhprof-html
 *
 * Xhprof for PHP7
 * @see https://github.com/yaoguais/phpng-xhprof
 *
 * Production
 * @see https://tideways.com/
 *
 * Others
 * @see https://github.com/topics/xhprof?o=desc&s=stars
 */
