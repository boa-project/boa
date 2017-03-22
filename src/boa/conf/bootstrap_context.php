<?php
// This file is part of BoA - https://github.com/boa-project
//
// BoA is free software: you can redistribute it and/or modify
// it under the terms of the GNU Affero General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// BoA is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU Affero General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with BoA.  If not, see <http://www.gnu.org/licenses/>.
//
// The latest code can be found at <https://github.com/boa-project/>.
 
/**
 * This is a one-line short description of the file/class.
 *
 * You can have a rather longer description of the file/class as well,
 * if you like, and it can span multiple lines.
 *
 * @package    [PACKAGE]
 * @category   [CATEGORY]
 * @copyright  2017 BoA Project
 * @license    https://www.gnu.org/licenses/agpl-3.0.html GNU Affero GPL v3 or later
 * This is the main configuration file for configuring the core of the application.
 * In a standard usage, you should not have to change any variables.
 */
if(function_exists("date_default_timezone_set") and function_exists("date_default_timezone_get")){
	@date_default_timezone_set(@date_default_timezone_get());
}
if(function_exists("xdebug_disable")){
	xdebug_disable();
}
@error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT);
//Windows users may have to uncomment this
//setlocale(LC_ALL, '');

list($vNmber,$vDate) = explode("__",file_get_contents(APP_CONF_PATH."/VERSION"));

define("APP_VERSION", $vNmber);
define("APP_VERSION_DATE", $vDate);
define("APP_EXEC", true);

// APPLICATION PATHES CONFIGURATION
define("APP_DATA_PATH", APP_INSTALL_PATH."/data");
define("APP_CACHE_DIR", APP_DATA_PATH."/cache");
define("APP_SHARED_CACHE_DIR", APP_INSTALL_PATH."/data/cache");
define("APP_PLUGINS_CACHE_FILE", APP_CACHE_DIR."/plugins_cache.ser");
define("APP_PLUGINS_REQUIRES_FILE", APP_CACHE_DIR."/plugins_requires.ser");
define("APP_PLUGINS_QUERIES_CACHE", APP_CACHE_DIR."/plugins_queries.ser");
define("APP_PLUGINS_MESSAGES_FILE", APP_CACHE_DIR."/plugins_messages.ser");
define("APP_SERVER_ACCESS", "index.php");
define("APP_PLUGINS_FOLDER", APP_INSTALL_PATH."/boa/plugins");
define("APP_PLUGINS_FOLDER_REL", "boa/plugins");
define("APP_BIN_FOLDER", APP_INSTALL_PATH."/boa/src");
define("APP_BIN_FOLDER_REL", "boa/src");
define("APP_VENDOR_FOLDER", APP_INSTALL_PATH."/boa/vendor");
define("APP_DOCS_FOLDER", APP_INSTALL_PATH."/boa/docs");
define("APP_COREI18N_FOLDER", APP_PLUGINS_FOLDER."/core.boa/i18n");
define("TESTS_RESULT_FILE", APP_CACHE_DIR."/diag_result.php");
define("APP_TESTS_FOLDER", APP_INSTALL_PATH."/boa/tests");
define("INITIAL_ADMIN_PASSWORD", "admin");
define("SOFTWARE_UPDATE_SITE", "https://github.com/boa-project");
// Startup admin password (used at first creation). Once
// The admin password is created and his password is changed,
// this config has no more impact.
define("ADMIN_PASSWORD", "admin");
// For a specific distribution, you can specify where the
// log files will be stored. This should be detected by log.* plugins
// and used if defined. See bootstrap_plugins.php default configs for
// example in log.serial. Do not forget the trailing slash
// define("APP_FORCE_LOGPATH", "/var/log/application/");
// DEBUG OPTIONS
define("APP_CLIENT_DEBUG"  ,   true);
define("APP_SERVER_DEBUG"  ,   false);
define("APP_SKIP_CACHE"    ,   true);

//require(APP_BIN_FOLDER."/compat.php");
function APP_autoload($className){    
    //Core Classes
    $className = str_replace('\\', '/', $className);
    $lClassName = preg_replace('/^BoA\//', '', $className);
    $fileName = APP_BIN_FOLDER."/".$lClassName.".class.php";
    if(file_exists($fileName)){
        require_once($fileName);
        return;
    }
    //Core interfaces    
    $fileName = APP_BIN_FOLDER."/".$lClassName.".interface.php";
    if(file_exists($fileName)){
        require_once($fileName);
        return;
    }
    
    //Core Plugin Classes
    if (preg_match('/^BoA\/Plugins\/Core/', $className)){
        $value = explode('/', $className);
        $lClassName = end($value);
        //Try class
        $corePlugClass = glob(APP_PLUGINS_FOLDER."/core.*/".$lClassName.".class.php", GLOB_NOSORT);
        if($corePlugClass !== false && count($corePlugClass)){
            require_once($corePlugClass[0]);
            return;
        }
        //Try interface
        $corePlugInterface = glob(APP_PLUGINS_FOLDER."/core.*/".$lClassName.".interface.php", GLOB_NOSORT);
        if($corePlugInterface !== false && count($corePlugInterface)){
            require_once($corePlugInterface[0]);
            return;
        }
    }
}

spl_autoload_register('APP_autoload');

use BoA\Core\Utils\Utils;

Utils::safeIniSet("session.cookie_httponly", 1);

if(is_file(APP_CONF_PATH."/bootstrap_conf.php")){
    include(APP_CONF_PATH."/bootstrap_conf.php");
    if(isSet($APP_INISET)){
        foreach($APP_INISET as $key => $value) Utils::safeIniSet($key, $value);
    }
    if(defined('APP_LOCALE')){
        setlocale(LC_ALL, APP_LOCALE);
    }
}
