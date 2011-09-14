<?php error_reporting(E_ERROR|E_WARNING|E_PARSE);
	
	class Wiki{
	
		const template = 'includes/page.stache';
		const sidebar = 'includes/sidebar.md';
		
		protected $template;
		protected static $content;
		protected static $config = array();
		
		function __construct(){
			session_start();
			// config
			$this->config();
			// mustache for template rendering
			include_once('lib/mustache.php');
			$this->template = new Mustache();
			// Markdown for page formatting
			include_once('lib/markdown.php');
			// our functions
			include_once('lib/functions.php');
			// get this party started
			$this->bootstrap();
		}
		
		static function redirect($url = ''){
			header('Location: '.self::$config['site_url'].$url);
			exit;
		}
		
		function config(){
			// include our config
			self::$config = include_once('config/config.php');
			// define some stuff
			define('BASE_URL', self::$config['site_url']);
		}
		
		function bootstrap(){
			// what are we doing with the page?
			$p = $_GET['page'];
			if($p == self::$config['logout_path']){
				Admin::logout();
			}elseif($p == self::$config['login_path']){
				Admin::login();
			}elseif($_GET['edit'] === 'page'){
				if(Admin::validate()){
					$this->edit($p);
				}else{
					self::redirect($p);
				}
			}elseif($_GET['edit'] === 'sidebar'){
				if(Admin::validate()){
					$this->sidebar();
				}else{
					self::redirect();
				}
			}elseif(empty($p)){
				$this->page('home');
			}else{
				$this->page($p);
			}
		}
		
		function edit($page){
			if(empty($page)) $page = 'home';
			if(isset($_POST['submit'])){
				$fp = fopen('docs/'.$page.'.md', 'w');
				if(!fwrite($fp, stripslashes($_POST['content']))) die('Could not save page!');
				fclose($fp);
				self::redirect($page);
			}elseif(file_exists('docs/'.$page.'.md')){
				self::$content = $this->template->render(file_get_contents('includes/edit.stache'), array('content' => stripslashes(file_get_contents('docs/'.$page.'.md')), 'type' => 'Page'));
			}else{
				self::$content = $this->template->render(file_get_contents('includes/edit.stache'), array('content' => '', 'type' => 'Page'));
			}
		}
		
		function sidebar(){
			if(isset($_POST['submit'])){
				$fp = fopen('includes/sidebar.md', 'w');
				if(!fwrite($fp, stripslashes($_POST['content']))) die('Could not save sidebar!');
				fclose($fp);
				self::redirect();
			}else{
				self::$content = $this->template->render(file_get_contents('includes/edit.stache'), array('content' => stripslashes(file_get_contents('includes/sidebar.md')), 'type' => 'Sidebar'));
			}
		}
		
		function page($page){
			if(!file_exists('docs/'.$page.'.md')){
				// send a 404
				header('HTTP/1.1 404 Not Found');
				self::$content = '<p>That page does not exist.</p>';
				if(Admin::validate()){
					self::$content .= '<p><a href="'.$page.'?edit=page">Add this page?</a></p>';
				}
			}else{
				self::$content = Markdown(file_get_contents('docs/'.$page.'.md'));
			}
		}
		
		function render(){
			$info = array(
				'title' => self::$config['site_title'].' - '.page_title($_GET['page']),
				'base_url' => self::$config['site_url'],
				'page' => $_GET['page'],
				'loggedin' => Admin::validate(),
				'logout' => self::$config['site_url'].self::$config['logout_path'],
				'login' => self::$config['site_url'].self::$config['login_path']
			);
			$content = array(
				'sidebar' => Markdown(file_get_contents(self::sidebar)),
				'content' => self::$content,
				'toc' => $this->toc(),
				'copyright' => $this->copyright()
			);
			return $this->template->render(file_get_contents(self::template), $info, $content);
		}
		
		function toc(){
			$content = "<h4>Pages</h4>\n";
			$scan = new DirScan('docs');
			foreach($scan->files() as $file){
				$page = preg_replace('/(^docs\/|\.md)/', '', $file);
				$title = page_title($page);
				$content .= "<div><a href=\"{$page}\">{$title}</a></div>\n";
			}
			return $content;
		}
		
		function copyright(){
			if(!empty(self::$config['copyright'])){
				return 'Copyright &copy; '.date('Y', time()).' '.self::$config['copyright'];
			}
		}
	
	}
	
	class Admin extends Wiki{
	
		function validate(){
			return (md5($_SESSION['username'] . parent::$config['auth_key'] . $_SERVER['HTTP_USER_AGENT']) === $_SESSION['fingerprint']);
		}
		
		function login(){
			if(isset($_POST['submit'])){
				$valid_users = implode('|', array_keys(parent::$config['users']));
				if(preg_match('/^'.preg_quote($valid_users).'$/', $_POST['username']) && parent::$config['users'][$_POST['username']] === $_POST['password']){
					$_SESSION['username'] = $_POST['username'];
					$_SESSION['fingerprint'] = md5($_POST['username'] . parent::$config['auth_key'] . $_SERVER['HTTP_USER_AGENT']);
					self::redirect();
				}else{
					self::redirect(parent::$config['login_path']);
				}
			}else{
				parent::$content = $this->template->render(file_get_contents('includes/login.stache'));
			}
		}
		
		function logout(){
			session_destroy();
			self::redirect();
		}
	
	}