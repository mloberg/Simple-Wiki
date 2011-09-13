<?php error_reporting(E_ERROR|E_WARNING|E_PARSE);
	
	class Wiki{
	
		private $template;
		static private $content;
		
		function __construct(){
			// config
			$this->config();
			// mustache for template rendering
			include_once('lib/mustache.php');
			$this->template = new Mustache();
			// Markdown for page formatting
			include_once('lib/markdown.php');
			// 
			$this->bootstrap();
		}
		
		function config(){
			// include our config
			$config = include_once('config/config.php');
			// define some stuff
			define('BASE_URL', $config['site_url']);
		}
		
		function bootstrap(){
			// what are we doing with the page?
			switch($_GET['page']){
				case 'sidebar':
					
					break;
				case 'add':
					
					break;
				case '':
					$this->page('home');
					break;
				default:
					$this->page($_GET['page']);
					break;
			}
		}
		
		function page($page){
			if(!file_exists('docs/'.$page.'.md')){
			
			}
			self::$content = Markdown(file_get_contents('docs/'.$page.'.md'));
		}
		
		function render(){
			$info = array(
				'title' => 'Wiki',
				'base_url' => 'http://localhost/wiki/',
				'copyright' => ''
			);
			$content = array(
				'sidebar' => Markdown(file_get_contents('includes/sidebar.md')),
				'content' => self::$content,
				'toc' => $this->toc()
			);
			return $this->template->render(file_get_contents('includes/page.stache'), $info, $content);
		}
		
		function toc(){
			return '';
		}
	
	}