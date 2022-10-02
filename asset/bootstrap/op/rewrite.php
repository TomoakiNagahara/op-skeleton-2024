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
<?php include(__DIR__.'/../html_head.phtml') ?>
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
<?php include(__DIR__.'/../html_foot.phtml') ?>
