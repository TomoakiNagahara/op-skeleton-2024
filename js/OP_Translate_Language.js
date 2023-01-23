
/** op-app-skeleton-2020-nep:/translate-language.js
 *
 * @created   2023-01-22
 * @version   1.0
 * @package   op-app-skeleton-2020-nep
 * @author    Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright Tomoaki Nagahara All right reserved.
 */

//	...
document.addEventListener('DOMContentLoaded', () => {
	//	...
	fetch('https://onepiece-framework.com/api/i18n/language?target=language')
		.then((response) => response.json())
		.then((json) => Display(json));

	//	...
	function Display(json){
		console.log(json);

		//	...
		let name = "<?php echo OP()->Config('translate')['language-area-id'] ?? 'null'; ?>";
		let area = document.querySelector(`#${name}`);
		if(!area ){
			console.error(`Does not found '#${name}'`);
			return;
		}

		//	...
		for(let key in json['result']['language'] ){
			let val  = json['result']['language'][key];
			let dir     = val['dir'];
			let english = val['name'];
			let native  = val['nativeName'];

			//	...
			let span = document.createElement('span');
				span.innerText       = native;
				span.style.direction = dir;
			let a    = document.createElement('a');
				a.appendChild(span);
				a.href  = key;
				a.title = english;
			let li   = document.createElement('li');
				li.appendChild(a);

			//	...
			area.appendChild(li);
		}
	}
});
