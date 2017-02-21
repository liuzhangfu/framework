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