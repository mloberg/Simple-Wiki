<?php error_reporting(E_ERROR | E_WARNING | E_PARSE);
	
	// define some settings
	$copyright = 'Matthew Loberg';
	$title = 'Tea-Fueled Does Docs';
	
	$users = array('mloberg' => 'smartness', 'guest' => 'guest');
	
	if($_SERVER['HTTP_HOST'] === 'localhost'){
		define('BASE_URL', 'http://localhost/wiki/');
	}else{
		define('BASE_URL', 'http://'.$_SERVER['HTTP_HOST'].'/docs/');
	}
	
	// include our markdown file
	include_once('markdown.php');
	
	// our wiki functions
	
	function auth(){
		$realm = 'Restricted area';
		global $users;
		
		if(empty($_SERVER['PHP_AUTH_DIGEST'])){
			header('HTTP/1.1 401 Unauthorized');
			header('WWW-Authenticate: Digest realm="'.$realm.'",qop="auth",nonce="'.uniqid().'",opaque="'.md5($realm).'"');
			die('You do not have access to edit this wiki.');
		}
		
		// analyze the PHP_AUTH_DIGEST variable
		if(!($data = http_digest_parse($_SERVER['PHP_AUTH_DIGEST'])) || !isset($users[$data['username']])) die('Wrong Username/Password Combination!');
		
		// generate the valid response
		$A1 = md5($data['username'] . ':' . $realm . ':' . $users[$data['username']]);
		$A2 = md5($_SERVER['REQUEST_METHOD'].':'.$data['uri']);
		$valid_response = md5($A1.':'.$data['nonce'].':'.$data['nc'].':'.$data['cnonce'].':'.$data['qop'].':'.$A2);
		
		if($data['response'] != $valid_response) die('Wrong Username/Password Combination!');
	}
	
	function http_digest_parse($txt){
		// protect against missing data
		$needed_parts = array('nonce' => 1, 'nc' => 1, 'cnonce' => 1, 'qop' => 1, 'username' => 1, 'uri' => 1, 'response' => 1);
		$data = array();
		$keys = implode('|', array_keys($needed_parts));
		preg_match_all('@(' . $keys . ')=(?:([\'"])([^\2]+?)\2|([^\s,]+))@', $txt, $matches, PREG_SET_ORDER);
		foreach ($matches as $m) {
			$data[$m[1]] = $m[3] ? $m[3] : $m[4];
			unset($needed_parts[$m[1]]);
		}
		return $needed_parts ? false : $data;
	}
	
	function sidebar(){
		return Markdown(file_get_contents('sidebar.md'));
	}
	
	function content(){
		if($_GET['page'] == ''){
			return Markdown(stripslashes(file_get_contents('docs/home.md')));
		}elseif(file_exists('docs/'.$_GET['page'].'.md')){
			return Markdown(stripslashes(file_get_contents('docs/'.$_GET['page'].'.md')));
		}else{
			return 'Page not found!';
		}
	}
	
	function edit_page($page = null){
		if(is_null($page)){
			if($_GET['page'] == ''){
				return stripslashes(file_get_contents('docs/home.md'));
			}elseif(file_exists('docs/'.$_GET['page'].'.md')){
				return stripslashes(file_get_contents('docs/'.$_GET['page'].'.md'));
			}else{
				return '';
			}
		}else{
			if($_GET['page'] == ''){
				$fp = fopen('docs/home.md', 'w');
			}else{
				$fp = fopen('docs/'.$_GET['page'].'.md', 'w');
			}
			if(!fwrite($fp, $page)){
				die('Could not save page.');
			}
			fclose($fp);
			header('Location: '.BASE_URL.$_GET['page']);
			exit;
		}
	}
	
	function edit_sidebar($content = null){
		if(is_null($content)){
			return file_get_contents('sidebar.md');
		}else{
			$fp = fopen('sidebar.md', 'w');
			if(!fwrite($fp, $content)){
				die('Could not save sidebar.');
			}
			fclose($fp);
			header('Location: '.BASE_URL);
			exit;
		}
	}
	
	function title($page, $force = false){
		if($_GET['sidebar'] === 'edit' && $force !== true) return 'Sidebar';
		if($page == '') return 'Home';
		// replace - and _ with spaces
		$page = str_replace('_', ' ', str_replace('-', ' ', $page));
		return ucwords($page);
	}
	
	function pages(){
		$content = <<<PAGE
	<h4>Pages</h4>
PAGE;
			foreach(glob('docs/*.md') as $filename){
				$page = preg_replace('/^docs\//', '', preg_replace('/\.md$/', '', $filename));
				$title = title($page, true);
				$content .= <<<PAGE
		<div><a href="{$page}">{$title}</a></div>
PAGE;
			}
			return $content;
	}