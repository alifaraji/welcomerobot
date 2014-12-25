<?php
/**
*
* @package Welcome Robot
* @copyright eMosbat & (c) 2014 Ali Faraji(Ali@php) <alifaraji.mail@gmail.com> phpbbpersian.ir
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace alifaraji\welcomerobot\migrations;

class add_data extends \phpbb\db\migration\migration
{
	public function effectively_installed()
	{
		return isset($this->config['ajaxlike_version']) && version_compare($this->config['ajaxlike_version'], '2.0.0', '>=');
	}
	static public function depends_on()
	{
		return array();
	}
	public function update_data()
	{
		return array(
			array('config.add', array('welcomerobot_version', '1.0.0')),
			array('config.add', array('welcomerobot_enable', true)),
			array('config.add', array('welcomerobot_forum', 0)),
			array('config.add', array('welcomerobot_username', '')),
			array('config.add', array('welcomerobot_title', 'Welcome %user!')),
			array('config.add', array('welcomerobot_detail', '%user,
[b]Welcome to our forum![/b]
Hope you enjoy!
%robot,
%board')),

			array('permission.add', array('a_welcomerobot_mod', true)),


			array('permission.permission_set', array('ROLE_ADMIN_FULL', 'a_welcomerobot_mod')),
			

			array('module.add', array(
				'acp',
				'ACP_CAT_DOT_MODS',
				'ACP_WELCOMEROBOT_TITLE'
			)),
			array('module.add', array(
				'acp',
				'ACP_WELCOMEROBOT_TITLE',
				array(
					'module_basename'	=> '\alifaraji\welcomerobot\acp\welcomerobot_module',
					'modes'				=> array('welcomerobot_settings'),
				),
			)),
		);
	}

}