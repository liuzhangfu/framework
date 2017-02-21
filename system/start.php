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
basename($_SERVER['PHP_SELF']) == 'start.php' && header('Location: http://'.$_SERVER['HTTP_HOST']);

/* 基本常量定义 */
defined('DS')			or define('DS', 		DIRECTORY_SEPARATOR);	// 目录分隔符
defined('DEBUG') 		or define('DEBUG', 		true);	// 是否调试模式
defined('ROOT_PATH') 	or define('ROOT_PATH', 	realpath('./') . DS); // 项目根目录
defined('BASE_PATH')	or define('BASE_PATH', 	ROOT_PATH . 'system' . DS); // 框架路径
defined('APP_PATH')		or define('APP_PATH', 	ROOT_PATH . 'app' . DS); // 应用路径

/* 加载框架核心文件或编译文件 */
if (DEBUG) {
	require BASE_PATH . 'core/app.class.php';	// 引入框架核心文件
} else {
	
}

/* 运行框架 */
app::run();