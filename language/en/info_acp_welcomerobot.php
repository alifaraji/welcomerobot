<?php
/**
*
* @package Welcome Robot
* @copyright eMosbat & (c) 2014 Ali Faraji(Ali@php) <alifaraji.mail@gmail.com> phpbbpersian.ir
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

if (!defined('IN_PHPBB'))
{
	exit;
}
if (empty($lang) || !is_array($lang))
{
	$lang = array();
}
$lang = array_merge($lang, array(
	'ACP_WELCOMEROBOT_MOD_TITLE'					=> 'phpBB Welcome Topic Robot',
	'ACP_WELCOMEROBOT_CONFIG_TITLE'					=> 'Welcome Topic Robot',
	'ACP_WELCOMEROBOT_TITLE'						=> 'Welcome Topic Robot',
	'ACP_WELCOMEROBOT_LEGEND1'						=> 'Settings',
	'ACP_WELCOMEROBOT_CONFIG_ENABLE'				=> 'Enable',
	'ACP_WELCOMEROBOT_CONFIG_FORUM'					=> 'Forum',
	'ACP_WELCOMEROBOT_CONFIG_FORUM_EXPLAIN'			=> 'post topics in this forum.',
	'ACP_WELCOMEROBOT_CONFIG_USERNAME'				=> 'Robot',
	'ACP_WELCOMEROBOT_CONFIG_USERNAME_EXPLAIN'		=> 'username of poster.',
	'ACP_WELCOMEROBOT_CONFIG_TOPICTITLE'			=> 'Title of topics',
	'ACP_WELCOMEROBOT_CONFIG_TOPICTITLE_EXPLAIN'	=> '',
	'ACP_WELCOMEROBOT_CONFIG_DETAIL'				=> 'Content of topics',
	'ACP_WELCOMEROBOT_CONFIG_DETAIL_EXPLAIN'		=> '',
	'ACP_WELCOMEROBOT_CONFIG_HELP'					=> 'Note:<br />you can use `%user`, `%robot` and `%board` to display registered username, robot username and board title in title and content.',
	'ACP_WELCOMEROBOT_SETTINGS'						=> 'Settings',
	'ACP_WELCOMEROBOT_SUCCESS'						=> 'Settings saved successfully.',
	'ACP_WELCOMEROBOT_ERROR'						=> 'Username for robot is invalid.',
	'ACP_WELCOMEROBOT_ERROR2'						=> 'Select a forum.',
));