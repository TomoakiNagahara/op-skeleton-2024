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

/** Start
 *
 * <pre>
 * XHPROF_FLAGS_NO_BUILTINS (int)
 *     Used to skip all built-in (internal) functions.
 *
 * XHPROF_FLAGS_CPU (int)
 *     Used to add CPU profiling information to the output.
 *
 * XHPROF_FLAGS_MEMORY (int)
 *     Used to add memory profiling information to the output.
 * </pre>
 *
 * @see https://www.php.net/manual/en/xhprof.constants.php
 */
tideways_xhprof_enable( TIDEWAYS_XHPROF_FLAGS_CPU | TIDEWAYS_XHPROF_FLAGS_MEMORY );

//  App
include('app.php');

//  Finish
$prof = tideways_xhprof_disable();

//  Config
$config      = OP()->Config('xhprof');

//  ...
$whoami  = trim(`whoami`);
$version = PHP_MAJOR_VERSION.PHP_MINOR_VERSION;
$host    = $_SERVER['SERVER_NAME'] ?? 'cli';
$host    = str_replace('.', '-', $host);
$date    = date('Y-m-d');
$time    = date('H-i-s');
$mtime   = $_SERVER["REQUEST_TIME_FLOAT"] ?? '.'.uniqid();
$mtime   = explode('.', $mtime)[1];
$url     = OP()->Router()->EndPoint();
$url     = dirname( $url );
$url     = str_replace($_SERVER['DOCUMENT_ROOT'], '', $url);
$url     = str_replace('/', '-', trim($url,'/'));
$args    = OP()->Router()->Args();
$args    = join('-', $args);
$temp    = $whoami.$version.$date.$time;

//  Get root path
$root_path = $config['root_path'];

//  Generate file path
$temp = [];
foreach( $config['file_path'] as $key => $value ){
    if( $value ){
        $temp[] = ${$key};
    }
}
$file_path = join('_', $temp);

//  Generate file name
$temp = [];
foreach( $config['file_name'] as $key => $value ){
    if( $value ){
        $temp[] = ${$key};
    }
}
$file_name = join('_', $temp) . "_{$mtime}.xhprof";

//  Generate full path
$full_path = '/' . $root_path .'/'. $file_path .'/'. $file_name;
$full_path = preg_replace('|/+|', '/', $full_path);

//  Generate end-point path
$temp = [];
foreach( $config['link_path'] as $key => $value ){
    if( $value ){
        $temp[] = ${$key};
    }
}
if( $temp ){
    $link_path = $root_path . join('/', $temp) . "_{$mtime}.xhprof";
    $link_path = preg_replace('|/+|', '/', $link_path);
}

//  Create save directory.
if(!file_exists($dir = dirname($full_path)) ){
    if(!mkdir($dir, 0777, true) ){
        OP()->Notice("Could not create file. ({$full_path})");
        return;
    }
}

//  Create xhprof.
if(!file_put_contents( $full_path, json_encode($prof) )){
    OP()->Notice("Could not create file. ({$full_path})");
    return;
}

//  Show path to console
if( OP()->MIME() === 'text/html' ){
    echo "<script>console.log('{$full_path}')</script>";
}

//  Create link file of URL.
if( $link_path ?? null ){
    //  ...
    $dir = dirname($link_path);

    //  Create directory.
    if( $io = file_exists($dir) ){
        if(!$io = is_dir( $dir) ){
            OP()->Notice("This path is not a directory. ({$dir})");
        }
    }else{
        if(!$io = mkdir($dir, 0777, true) ){
            OP()->Notice("Could not make directory. ({$dir})");
        }
    }

    //  Create symbolic link.
    if( $io ){
        if( symlink($full_path, $link_path) ){
            if( OP()->MIME() === 'text/html' ){
                echo "<script>console.log('{$link_path}')</script>";
            }
        }
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
