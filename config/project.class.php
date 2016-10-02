<?php

/*
*   System variables definition.
*/
define('PATH', str_replace(DIRECTORY_SEPARATOR, '/', realpath(dirname(__FILE__).'/..')));
define('ROOT', str_replace(' ', '%20', preg_replace('/'.preg_quote(str_replace(DIRECTORY_SEPARATOR, '/', $_SERVER['DOCUMENT_ROOT']), '/').'\/?/', '', str_replace(DIRECTORY_SEPARATOR, '/', realpath(dirname(__FILE__) . '/..')))));
define('URL', (empty($_SERVER['HTTPS']) ? 'http://' : 'https://') . $_SERVER['HTTP_HOST'] . (strlen(ROOT) ? ("/" . ROOT) : ''));
error_reporting(E_ALL ^ E_NOTICE);

/*
*   Database variables definition.
*/
define('HOST', 'localhost');
define('DBNAME', 'articulatelogic_main');
define('DBUSER', 'articulatelogic');
define('DBPASS', 'pass#100');

/*
*   Project class definition;
*   establishes database connection, creates tempate object and load library classes.
*/
class Project
{
    var $db;
    var $tp;

	function Project()
	{
        $this->loadlib();
        
        $this->db = ($_SERVER['HTTP_HOST'] == "localhost") ? new Dblib("localhost", "alogicdbnew", "root", "") : new Dblib(HOST, DBNAME, DBUSER, DBPASS);

        if($this->db->err != "")
        {
            Errors::report($this->db->err);
        }
        
        $this->tp = new Template();
        
        session_start();
	}
	
	function loadlib()
	{
        require_once(PATH . '/libs/functions.php');
        
        require_once(PATH . '/libs/template.class.php');
        require_once(PATH . '/libs/dblib.class.php');
        require_once(PATH . '/libs/users.class.php');
        require_once(PATH . '/libs/errors.class.php');
        
        require_once(PATH . '/data/dbdata.php');
        
        require_once(PATH . '/scripts/fckeditor/fckeditor_php5.php');
        require_once(PATH . '/scripts/mailer/swift_required.php');
	}
}

?>