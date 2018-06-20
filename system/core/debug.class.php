<?php defined('BASE_PATH') or exit('Access Denied !');
/**
 * debug调试处理类
 *
 * 设置错误处理方法、输出显示调试信息或写入日志
 *
 * @author 		Zorz Dev Team
 * @copyright 	Copyright (c) 2012 - 2017, Zorz, Inc. (http://www.zorz.cn/)
 * @license		http://opensource.org/licenses/MIT	MIT License
 * @link 		http://www.zorz.cn/
 * @since		Version 1.0.0
 */
class debug {
	/**
	 * 初始化 debug 操作
	 */
	public static function init() {
		// 如果是调试模式，打开警告输出
		if ( DEBUG ) {
			error_reporting(-1);
			ini_set("display_errors", "On");
			register_shutdown_function(array('debug', 'fatal_handler'));	// 致命错误中止
		} else {
			error_reporting(E_ALL & ~(E_STRICT|E_NOTICE));
			ini_set("display_errors", "Off");
			ini_set("log_errors", "On");
		}

		set_error_handler(array('debug', 'error_handler'));	// 自定义错误
		set_exception_handler(array('debug', 'exception_handler'));	// 自定义异常
	}

	/**
	 * 异常中止处理
	 */
	public static function fatal_handler() {
		$e = error_get_last();
		//var_dump($e);
		self::exception_handler($e);
	}

    /**
     * 自定义错误处理
     * 
     * @access public
     * @param int $errno 错误类型
     * @param string $errstr 错误信息
     * @param string $errfile 错误文件
     * @param int $errline 错误行数
     * @return void
     */
	public static function error_handler($errno, $errstr, $errfile = '', $errline = 0) {


	}

    /**
     * 自定义异常处理
     * 
     * @access public
     * @param mixed $e 异常对象
     */
	public static function exception_handler($e) {
   		print_r(func_get_arg(0));
   		$exc = func_get_arg(0);
   		var_dump($exc);
        $errno = $exc->getCode();
        $errstr = $exc->getMessage();
        $errfile = $exc->getFile();
        $errline = $exc->getLine();

        $backtrace = $exc->getTrace();

	}
}
