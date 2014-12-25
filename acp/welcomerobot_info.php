<?php
/**
*
* @package Welcome Robot
* @copyright eMosbat & (c) 2014 Ali Faraji(Ali@php) <alifaraji.mail@gmail.com> phpbbpersian.ir
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace alifaraji\welcomerobot\acp;

class welcomerobot_info
{
	function module()
	{
		return array(
			'filename'	=> '\alifaraji\welcomerobot\acp\welcomerobot_module',
			'title'		=> 'ACP_WELCOMEROBOT_TITLE',
			'version'	=> '1.0.0',
			'modes'		=> array(
				'welcomerobot_settings'	=> array('title' => 'ACP_WELCOMEROBOT_SETTINGS', 'auth' => 'ext_alifaraji/welcomerobot && acl_a_welcomerobot_mod', 'cat' => array('ACP_WELCOMEROBOT_TITLE')),
			),
		);
	}
}