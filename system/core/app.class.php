<?php defined('BASE_PATH') or exit('Access Denied !');
/**
 * 框架核心文件
 *
 * 定义基本常量及引入框架并执行
 *
 * @author 		Zorz Dev Team
 * @copyright 	Copyright (c) 2012 - 2017, Zorz, Inc. (http://www.zorz.cn/)
 * @license		http://opensource.org/licenses/MIT	MIT License
 * @link 		http://www.zorz.cn/
 * @since		Version 1.0.0
 */
class app {

    /**
     * 系统配置参数
     */ 
	protected static $_config = array();

    /**
     * 自动加载文件参数
     */ 
	protected static $_imports = array();

    /**
     * 应用程序初始化
     */
    static public function init() {
		header('Content-Type:text/html; charset=utf-8'); // 页头编码
		date_default_timezone_set("Asia/Shanghai"); // 设置系统时区

		if ( version_compare(PHP_VERSION, '5.4.0', '<') ) {
			// 对外部引入文件禁止加转义符
			ini_set('magic_quotes_runtime', 0);
			// GPC 安全过滤,删除系统自动加的转义符号
			if ( get_magic_quotes_gpc() ) {
				_stripslashes($_POST);
				_stripslashes($_GET);
				_stripslashes($_REQUEST);
				_stripslashes($_COOKIE);
			}
		}

        // 定义当前请求的系统常量
        define('NOW_TIME',     		$_SERVER['REQUEST_TIME']);
        define('REQUEST_METHOD',	$_SERVER['REQUEST_METHOD']);
        define('IS_GET',        	REQUEST_METHOD =='GET' 		? true : false);
        define('IS_POST',       	REQUEST_METHOD =='POST' 	? true : false);
        define('IS_PUT',        	REQUEST_METHOD =='PUT' 		? true : false);
        define('IS_DELETE',     	REQUEST_METHOD =='DELETE' 	? true : false);
        define('IS_AJAX',       	(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')  ? true : false);

		// 初始化全局变量
		$_ENV['_sqls'] 				= array();	// debug 时使用
		$_ENV['_include'] 			= array();	// autoload 时使用
		$_ENV['_time'] 				= isset($_SERVER['REQUEST_TIME']) ? $_SERVER['REQUEST_TIME'] : time();
		$_ENV['_ip'] 				= '127.0.0.1';
		$_ENV['_sqlnum'] 			= 0;
    }

    /**
     * 运行应用实例 入口文件使用的快捷方法
     */
	public static function run() {
		app::load_file();
		debug::init();
		//app::ob_gzip();
		app::init();
	}

	/**
	 * GZIP压缩处理
	 */
	protected static function ob_gzip() {
	    if( extension_loaded('zlib') ) {
			// 页面没有输出且浏览器可以接受GZIP的页面
	        if ( ! headers_sent() && isset($_SERVER['HTTP_ACCEPT_ENCODING']) && strpos($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip') !== FALSE) {
	        	ob_start('ob_gzhandler');
	        }
	    }
	}

	/**
	 * 载入核心文件
	 */
	public static function load_file() {
		//app::init_config();
	}

	/**
	 * 初始化配置
	 */
	public static function init_config() {
		$config = BASE_PATH . 'configs.php';
		if ( is_file($config) ) {
			//echo 1;
			//self::$_config = include($config);
		}
	}
}
