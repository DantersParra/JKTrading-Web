<?php
$isLive 		= false;

if ($isLive) {
	// production
	//define("DB_SERVER", "internal-db.s7428.gridserver.com");	//database setup
	//define("DB_USER", "db7428_jktrading");
	//define("DB_PASS", "-95m[O{iSut");
	//define("DB_NAME", "db7428_jktrading");

	define("DB_SERVER", "sql201.epizy.com");	//database setup
	define("DB_USER", "epiz_23919426");
	define("DB_PASS", "WuIblQDH");
	define("DB_NAME", "epiz_23919426_jktrading");

} else {
	// development
	define("DB_SERVER", "localhost");	//database setup
	define("DB_USER", "root");
	define("DB_PASS", "");
	define("DB_NAME", "jktrading");
}
