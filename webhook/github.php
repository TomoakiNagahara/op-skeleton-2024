<?php
/** op-app-skeleton-2020-nep:/webhook/github.com
 *
 * @created    2022-11-21
 * @version    2.0
 * @package    op-app-skeleton-2020-nep
 * @author     Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright  Tomoaki Nagahara All right reserved.
 */

/** Declare strict
 *
 */
declare(strict_types=1);

/** namespace
 *
 */
namespace OP;

//	MIME
Env::MIME('text/plain');

//	GitHub -> repository -> Settings -> Webhooks
if( true ){
	//	...
	$action    = OP::Request('action');
	$signature = OP::Request('X-Hub-Signature');
	$account   = OP::Request('repository')['owner']['login'] ?? null;

	//	...
	if( $secret = OP::Config('cd')['github']['secret'] ?? null ){
		$hash   = 'sha1='.hash_hmac('sha1', file_get_contents("php://input"), $secret);
	}else{
		$hash   = null;
	}

	//	...
	if( Env::isAdmin() ){
		//	OK
		echo "isAdmin\n";
	}else
	if( $signature !== $hash ){
		$message = "Signature is unmatch.";
		echo $message;
		return;
	}

	//	...
	if( $comands = OP::Config('webhook')['github'][$action] ?? null ){
		//	...
		chdir( OP::MetaPath('git:/') );

		//	...
		if(!is_array($comands)){
			$comands = [$comands];
		}

		//	...
		foreach( $comands as $comand ){
			D($comand);
			echo `{$comand}`;
		}
	}else{
		echo "Empty: asset > config > webhook.php > github > {$action}\n";
	}

	/*
	//	...
	switch( $action ){
		//	GitHub action
		case 'completed':
			break;

		//	op-cd
		case 'update':
			break;

		default:
	}
	*/
}

//	...
echo $account;
