<?php
/**
*
* @package Welcome Robot
* @copyright eMosbat & (c) 2014 Ali Faraji(Ali@php) <alifaraji.mail@gmail.com> phpbbpersian.ir
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace alifaraji\welcomerobot\acp;

class welcomerobot_module
{
   var $u_action;
   var $new_config;
   function main($id, $mode)
   {
      global $db, $user, $auth, $template;
      global $config, $phpbb_root_path, $phpbb_admin_path, $phpEx;
		$action	= request_var('action', '');
		$submit = isset($_POST['submit']) ? true : false;
		$forum_id = request_var('forum_id', 0);
		$form_key = 'acp_welcomerobot';
		add_form_key($form_key);

            $this->page_title = $user->lang['ACP_WELCOMEROBOT_MOD_TITLE'];
            $this->tpl_name = 'acp_welcomerobot';
				$display_vars = array(
					'title'	=> $this->page_title,
					'vars'	=> array(
						'legend1'	=> 'ACP_WELCOMEROBOT_LEGEND1',
						'welcomerobot_enable'				=> array(
							'lang' => 'ACP_WELCOMEROBOT_CONFIG_ENABLE',
							'validate' => 'bool',
							'type' => 'radio:enabled_disabled',
							'explain' => true
						),
						'welcomerobot_username'		=> array(
							'lang' => 'ACP_WELCOMEROBOT_CONFIG_USERNAME',
							'type' => 'text:24:100',
							'explain' => true
						),
						'welcomerobot_title'		=> array(
							'lang' => 'ACP_WELCOMEROBOT_CONFIG_TOPICTITLE',
							'type' => 'text:48:255',
							'explain' => true
						),
						'welcomerobot_detail'		=> array(
							'lang' => 'ACP_WELCOMEROBOT_CONFIG_DETAIL',
							'type' => 'textarea:10:2000',
							'explain' => true
						),
					)
				);

		if (isset($display_vars['lang']))
		{
			$user->add_lang($display_vars['lang']);
		}
		$this->new_config = $config;
		$cfg_array = (isset($_REQUEST['config'])) ? utf8_normalize_nfc(request_var('config', array('' => ''), true)) : $this->new_config;
		$error = array();
		// We validate the complete config if whished
		validate_config_vars($display_vars['vars'], $cfg_array, $error);
		if ($submit && !check_form_key($form_key))
		{
			$error[] = $user->lang['FORM_INVALID'];
		}
		
		// Do not write values if there is an error
		if (sizeof($error))
		{
			$submit = false;
		}
		foreach ($display_vars['vars'] as $config_name => $null)
		{
			if (!isset($cfg_array[$config_name]) || strpos($config_name, 'legend') !== false)
			{
				continue;
			}
			$this->new_config[$config_name] = $config_value = $cfg_array[$config_name];
			if ($submit)
			{
				set_config($config_name, $config_value);
			}
		
		}
		
		if ($submit)
		{
			
			$robotname = $cfg_array['welcomerobot_username'];

			if(trim($robotname)=='')
			{
				$error[] = $user->lang['ACP_WELCOMEROBOT_ERROR'];
			}
			
			if(!$this->check_existence('forum',$forum_id))
			{
				$error[] = $user->lang['ACP_WELCOMEROBOT_ERROR2'];
			}
			if(empty($error))
			{
				set_config('welcomerobot_forum', $forum_id);
				trigger_error($user->lang['ACP_WELCOMEROBOT_SUCCESS'] . adm_back_link($this->u_action));
			}
		}
		else
		{
			$forum_id = $cfg_array['welcomerobot_forum'];
		}
		$template->assign_vars(array(
			'S_ERROR'	=> (sizeof($error)) ? true : false,
			'ERROR_MSG'	=> implode('<br />', $error),
			'S_HELP'	=> $user->lang['ACP_WELCOMEROBOT_CONFIG_HELP'],
			'U_ACTION'	=> $this->u_action)
		);
		// Output relevant page
		foreach ($display_vars['vars'] as $config_key => $vars)
		{
			if (!is_array($vars) && strpos($config_key, 'legend') === false)
			{
				continue;
			}
			if (strpos($config_key, 'legend') !== false)
			{
				$template->assign_block_vars('options', array(
					'S_LEGEND'		=> true,
					'LEGEND'		=> (isset($user->lang[$vars])) ? $user->lang[$vars] : $vars)
				);
				continue;
			}
			$type = explode(':', $vars['type']);
			$l_explain = '';
			if ($vars['explain'] && isset($vars['lang_explain']))
			{
				$l_explain = (isset($user->lang[$vars['lang_explain']])) ? $user->lang[$vars['lang_explain']] : $vars['lang_explain'];
			}
			else if ($vars['explain'])
			{
				$l_explain = (isset($user->lang[$vars['lang'] . '_EXPLAIN'])) ? $user->lang[$vars['lang'] . '_EXPLAIN'] : '';
			}
			$content = build_cfg_template($type, $config_key, $this->new_config, $config_key, $vars);
			if (empty($content))
			{
				continue;
			}
			
			$template->assign_block_vars('options', array(
				'KEY'			=> $config_key,
				'TITLE'			=> (isset($user->lang[$vars['lang']])) ? $user->lang[$vars['lang']] : $vars['lang'],
				'S_EXPLAIN'		=> $vars['explain'],
				'TITLE_EXPLAIN'	=> $l_explain,
				'CONTENT'		=> $content,
				)
			);
			$template->assign_vars(array(
				'S_FORUM_OPTIONS' => make_forum_select($forum_id, false, false, true, false)
			));
			unset($display_vars['vars'][$config_key]);
		}
   }
	/**
	* Check if selected items exist. Remove not found ids and if empty return error.
	*/
	function check_existence($mode, $ids)
	{
		global $db, $user;
		switch ($mode)
		{
			case 'forum':
				$table = FORUMS_TABLE;
				$sql_id = 'forum_id';
			break;
		}
			$sql = "SELECT $sql_id
				FROM $table
				WHERE " . intval($ids);
			$result = $db->sql_query($sql);
			$ids = array();
			while ($row = $db->sql_fetchrow($result))
			{
				return true;
			}
			$db->sql_freeresult($result);
	
			trigger_error($user->lang['ACP_WELCOMEROBOT_ERROR2'] . adm_back_link($this->u_action), E_USER_WARNING);
	}
}