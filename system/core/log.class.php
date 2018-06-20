<?php defined('BASE_PATH') or exit('Access Denied !');
/**
 * 日志处理类
 *
 * @author 		Zorz Dev Team
 * @copyright 	Copyright (c) 2012 - 2017, Zorz, Inc. (http://www.zorz.cn/)
 * @license		http://opensource.org/licenses/MIT	MIT License
 * @link 		http://www.zorz.cn/
 * @since		Version 1.0.0
 */
class log {
    /**
     * 日志级别 从上到下，由低到高
     */
    const EMERG     = 'EMERG';  // 严重错误: 导致系统崩溃无法使用
    const ALERT     = 'ALERT';  // 警戒性错误: 必须被立即修改的错误
    const CRIT      = 'CRIT';  // 临界值错误: 超过临界值的错误，例如一天24小时，而输入的是25小时这样
    const ERR       = 'ERR';  // 一般错误: 一般性错误
    const WARN      = 'WARN';  // 警告性错误: 需要发出警告的错误
    const NOTICE    = 'NOTIC';  // 通知: 程序可以运行但是还不够完美的错误
    const INFO      = 'INFO';  // 信息: 程序输出信息
    const DEBUG     = 'DEBUG';  // 调试: 调试信息
    const SQL       = 'SQL';  // SQL：SQL语句 注意只在调试模式开启时有效

    /**
     * @var array 日志信息
     */
    protected static $log = array();

    /**
     * @var array 日志类型
     */
    protected static $type = array('EMERG, ALERT, CRIT, ERR, WARN, NOTIC, INFO, DEBUG, SQL'); // 允许记录的日志级别

    /**
     * 获取日志信息
     * 
     * @access public
     * @param  string $type 信息类型
     * @return array|string
     */
    public static function get_log($type = '') {
        return $type ? self::$log[$type] : self::$log;
    }

    /**
     * 记录调试信息 并且会过滤未经设置的级别
     * 
     * @access public
     * @param  mixed  $msg  调试信息
     * @param  string $type 信息类型
     * @return void
     */
    public static function record($msg, $type = 'DEBUG') {
        self::$log[$type][] = $msg;
    }

    /**
     * 清空日志信息
     * @access public
     * @return void
     */
    public static function clear() {
        self::$log = array();
    }
}
