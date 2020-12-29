<?php
/** op-module-bootstrap:/op/rewrite.php
 *
 * @created   2016-11-25
 * @version   1.0
 * @package   op-module-bootstrap
 * @author    Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright Tomoaki Nagahara All right reserved.
 */
?>
<!doctype html>
<html>
	<head>
		<title>Boot to the onepiece-framework</title>
		<style>

		h1 {
			font-size: 1.5vw;
		}

		li {
			margin-bottom: 1em;
		}

		div[role="code"] {
			border: 1px solid #9f9f9f;
			margin:  1em 0;
			padding: 0.7em 1em;
			font-family: monospace;
		}

		pre {
			border: 1px solid #9f9f9f;
			border-radius: 0.25em;
			padding: 0.5em 0.5em;
		}

		code {

		}

		pre, code {
			font-size:   14px;
			line-height:  1.2;
			font-family: Consolas, 'Courier New', Courier, Monaco, monospace;
		}
		</style>
	</head>
	<body>
		<header>
			Boot to the onepiece-framework
		</header>
		<hr/>
		<div data-i18n="true" data-lang="en">
		<?php
		//	...
		$name = strtolower(explode('/', $_SERVER['SERVER_SOFTWARE'])[0]);
		$path = __DIR__."/rewrite-{$name}.phtml";

		//	...
		if( file_exists($path) ){
			include($path);
		}else{
			echo "<p>Unknown web server. ($name)</p>";
		}
		?>
		</div>
		<hr/>
		<footer>
			Copyright 2006 onepiece-framework all right reserved
		</footer>
	</body>
</html>
<?php
exit();
