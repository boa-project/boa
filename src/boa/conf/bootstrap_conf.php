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
 
/*
 * If you have a charset warning, or problems displaying filenames with accented characters,
 * check your system locale and set it in the form lang_country.charset
 * Example : fr_FR.UTF-8, fr_FR.ISO-8859-1, fr_FR.CP1252 (windows), en_EN.UTF-8, etc.
 *
 * Windows users may define an empty string
 * define("BOA_LOCALE", "");
 */
//define("BOA_LOCALE", "en_EN.UTF-8");
//define("BOA_LOCALE", "");


/*
 * If you encounter problems writing to the standard php tmp directory, you can
 * define your own tmp dir here. Suggested value is boa_path/data/tmp/
 * BOA_DATA_PATH, BOA_INSTALL_PATH are replaced automatically.
 *
 * See php.ini settings below for the session.save_path value as well.
 */
//define("BOA_TMP_DIR", BOA_DATA_PATH."/tmp");


/*
 * Additionnal php.ini settings
 * > Problems with tmp dir : set your own session tmp dir (create it and make it writeable!)
 * > Concurrent versions of AjaXplorer : use session.cookie_path to differentiate them.
 */
$BOA_INISET = array();
//$BOA_INISET["session.save_path"] = BOA_DATA_PATH."/tmp/sessions";
//$BOA_INISET["session.cookie_path"] = "/ajaxplorer";

/*
 * If you want to force the https, uncomment the line below. This will automatically
 * redirect all calls to ajaxplorer via http to the same URL with https
 */
//define("BOA_FORCE_SSL_REDIRECT", true);
