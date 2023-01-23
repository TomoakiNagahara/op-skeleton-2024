<span id="sha256"></span>
<span>fdb481ea956fdb654afcc327cff9b626966b2abdabc3f3e6dbcb1667a888ed9a</span><br/>
<span><?= hash('sha256', 'あいうえお'); ?></span>
<script>
async function sha256(text){
	const uint8  = new TextEncoder().encode(text)
	const digest = await crypto.subtle.digest('SHA-256', uint8)
	return Array.from(new Uint8Array(digest)).map(v => v.toString(16).padStart(2,'0')).join('')
}
sha256('あいうえお').then(hash => document.querySelector('#sha256').innerText = hash);
</script>
https://reigle.info/entry/2022/08/03/100000
https://zenn.dev/batton/articles/c84a99913b5430
https://qiita.com/economist/items/768d2f6a10d54d4fa39f
https://www.datacurrent.co.jp/column/jssha256-20211222/
