<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * Author xinghuali<xinghuali@126.com>
 * $Id: config.php 6064 2015-08-10 11:05:03  xinghuali
 */

if(!defined('__DEBUG')){
    define('__DEBUG', false);
}
define('__TIME',    time());
define('__CHARSET', 'UTF-8');
define('__CFG_DIR', dirname(__FILE__).DIRECTORY_SEPARATOR);
define('__IMG_DIR', dirname(__CFG_DIR).DIRECTORY_SEPARATOR.'attachs'.DIRECTORY_SEPARATOR);
define('__TPL_DIR', dirname(__CFG_DIR).DIRECTORY_SEPARATOR.'themes'.DIRECTORY_SEPARATOR);
define('__MOBILE', true);
define('__WEIXIN', true);
define('MAGIC_QUOTES_GPC', get_magic_quotes_gpc());
define('__DEBUG_LEVEL', 'system'); // false, data, system
ini_set("display_errors", __DEBUG);
error_reporting(E_ALL ^ E_NOTICE ^ E_STRICT ^ E_WARNING);
date_default_timezone_set('Asia/Shanghai');
//date_default_timezone_set('PRC');
header("Content-type: text/html; charset=UTF-8");
class __CFG
{
    CONST DEBUG     = __DEBUG;
    CONST CHARSET   = __CHARSET;
    CONST DIR       = __CORE_DIR;
    CONST GPC       = MAGIC_QUOTES_GPC;
    CONST TIME      = __TIME;
    CONST TMPL_DIR  = __TPL_DIR;

    CONST RES_URL = '/static';

    CONST MYSQL = 'mysql://';

    CONST SECRET_KEY = '';
    CONST Authorize = '';

    //Cookie
    CONST C_PREFIX  = 'GDH-';
    CONST C_DOMAIN  = '';
    CONST C_PATH    = '/';
    CONST C_EXPIRE  = 2592000;
    CONST C_SECURE  = false; //https
    CONST C_HTTPONLY= true;  //httponly

    //session
    CONST S_TYPE    = 'database';
    CONST S_STAGE   = '';
    CONST S_NAME    = 'KTSSID';
    CONST S_EXPIRE  = 3600;

    //cache
    CONST CACHE_TYPE = 'file'; 
    CONST CACHE_FILE_SIZE = '32M'; //开辟缓存文件大小
}