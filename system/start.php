<?php
/**
 * 框架单一入口文件
 *
 * 定义基本常量及引入框架并执行
 *
 * @author 		Zorz Dev Team
 * @copyright 	Copyright (c) 2012 - 2017, Zorz, Inc. (http://www.zorz.cn/)
 * @license		http://opensource.org/licenses/MIT	MIT License
 * @link 		http://www.zorz.cn/
 * @since		Version 1.0.0
 */
basename($_SERVER['PHP_SELF']) == 'start.php' && header('Location: http://' . $_SERVER['HTTP_HOST']);

define('START_TIME', 	microtime(true)); // 记录开始运行时间
define('START_MEM', 	memory_get_usage()); // 记录内存初始使用

/* 基本常量定义 */
defined('DS')			or define('DS', 		DIRECTORY_SEPARATOR); // 目录分隔符
defined('DEBUG') 		or define('DEBUG', 		false); // 是否调试模式
defined('APP_PATH') 	or define('APP_PATH', 	realpath('./') . DS);  // 项目根目录
defined('BASE_PATH') 	or define('BASE_PATH', 	dirname(__FILE__) . DS); // 框架路径

/* 加载框架核心文件或编译文件 */
if ( DEBUG ) {
	require BASE_PATH . 'core/app.class.php'; // 引入框架核心文件
	require BASE_PATH . 'core/debug.class.php'; // 引入框架核心文件
	require BASE_PATH . 'core/log.class.php'; // 引入框架核心文件
} else {
	$runtime = APP_PATH . '_runtime.php';
	if ( ! is_file($runtime)) {
		$s = trim(php_strip_whitespace(BASE_PATH . 'core/app.class.php'), "<?php>\r\n");
		$s .= trim(php_strip_whitespace(BASE_PATH . 'core/debug.class.php'), "<?php>\r\n");
		$s .= trim(php_strip_whitespace(BASE_PATH . 'core/log.class.php'), "<?php>\r\n");
		$s = str_replace('defined(\'APP_PATH\') or exit(\'Access Denied !\');', '', $s);
		file_put_contents($runtime, '<?php ' . $s);
		unset($s);
	}
	// 部署模式直接载入运行缓存
	require $runtime;
}

/* 运行框架 */
app::run();

if (DEBUG && !IS_AJAX) {
	debug::show_trace();
}
