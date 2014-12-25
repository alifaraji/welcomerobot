<?php
/**
*
* @package Welcome Robot
* @copyright eMosbat & (c) 2014 Ali Faraji(Ali@php) <alifaraji.mail@gmail.com> phpbbpersian.ir
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/
namespace alifaraji\welcomerobot\event;
/**
* @ignore
*/
if (!defined('IN_PHPBB'))
{
	exit;
}
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
/**
* Event listener
*/
class listener implements EventSubscriberInterface
{
	static public function getSubscribedEvents()
	{
		return array(
			'core.user_setup'		=> 'send_topic',
		);
	}

	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/** @var \phpbb\user */
	protected $user;

	/** @var string phpBB root path */
	protected $root_path;

	/** @var string PHP extension */
	protected $phpEx;

	public function __construct(\phpbb\config\config $config, \phpbb\db\driver\driver_interface $db, \phpbb\user $user, $root_path, $phpEx)
	{
		$this->config = $config;
		$this->db = $db;
		$this->user = $user;
		$this->root_path = $root_path;
		$this->phpEx = $phpEx;
	}

	public function send_topic()
	{
		if($this->user->data['is_registered'] && $this->user->data['user_lastvisit'] == 0)
		{
			$this->create_welcome_topic($this->user->data['user_id']);

			$sql_ary = array(
				'user_lastvisit'    => $this->user->data['session_last_visit'],
			);

			$sql = 'UPDATE ' . USERS_TABLE . '
				SET ' . $this->db->sql_build_array('UPDATE', $sql_ary) . '
				WHERE user_id = ' . $this->user->data['user_id'];
			$result = $this->db->sql_query($sql);
			$this->db->sql_freeresult($result);
		}
	}

	public function create_welcome_topic($user_id)
	{	
		if(!$this->config['welcomerobot_enable'])
			return false;
		if(!function_exists('get_username_string'))
		{
			include($this->root_path . 'includes/functions_content.' . $this->phpEx);
		}
		if(!function_exists('submit_post'))
		{
			include($this->root_path . 'includes/functions_posting.' . $this->phpEx);
		}
		
		$sql = 'SELECT *
			FROM ' . USERS_TABLE . "
			WHERE user_id = " . intval($user_id) . "";
		$dbresult = $this->db->sql_query($sql);
		$row = $this->db->sql_fetchrow($dbresult);
		$this->db->sql_freeresult($dbresult);
		if (empty($row))
		{
			return false;
		}
		
		
		$username = get_username_string('full', $row['user_id'], $row['username'], $row['user_colour']);
		$clean_username = utf8_clean_string($row['username']);
		
		$topic_title = str_replace(
								array('%user','%robot','%board'),
								array($clean_username, $this->config['welcomerobot_username'], $this->config['sitename']),
								$this->config['welcomerobot_title']
		);
		$topic_content =   str_replace(
								array('%user','%robot','%board'),
								array($clean_username, $this->config['welcomerobot_username'], $this->config['sitename']),
								$this->config['welcomerobot_detail']
		);
		
		$poll = $uid = $bitfield = $options = '';
		// will be modified by generate_text_for_storage
		$allow_bbcode = $allow_urls = $allow_smilies = true;
		generate_text_for_storage($topic_content, $uid, $bitfield, $options, $allow_bbcode, $allow_urls, $allow_smilies);
		
		$data = array(
		// General Posting Settings
		'forum_id'            => $this->config['welcomerobot_forum'], // The forum ID in which the post will be placed. (int)
		'topic_id'            => 0, // Post a new topic or in an existing one? Set to 0 to create a new one, if not, specify your topic ID here instead.
		'icon_id'            => false,    // The Icon ID in which the post will be displayed with on the viewforum, set to false for icon_id. (int)
		
		// Defining Post Options
		'enable_bbcode'    => true,    // Enable BBcode in this post. (bool)
		'enable_smilies'    => true,    // Enabe smilies in this post. (bool)
		'enable_urls'        => true,    // Enable self-parsing URL links in this post. (bool)
		'enable_sig'        => true,    // Enable the signature of the poster to be displayed in the post. (bool)
		
		// Message Body
		'message'            => $topic_content,        // Your text you wish to have submitted. It should pass through generate_text_for_storage() before this. (string)
		'message_md5'    => md5($topic_content),// The md5 hash of your message
		
		// Values from generate_text_for_storage()
		'bbcode_bitfield'    => $bitfield,    // Value created from the generate_text_for_storage() function.    
		'bbcode_uid'        => $uid,        // Value created from the generate_text_for_storage() function.    // Other Options    
		'post_edit_locked'    => 0,        // Disallow post editing? 1 = Yes, 0 = No    
		'topic_title'        => $topic_title,    // Subject/Title of the topic. (string)    // Email Notification Settings    
		'notify_set'        => false,        // (bool)    
		'notify'            => false,        // (bool)    
		'post_time'         => 0,        // Set a specific time, use 0 to let submit_post() take care of getting the proper time (int)    
		'forum_name'        => '',        // For identifying the name of the forum in a notification email. (string)    // Indexing    
		'enable_indexing'    => true,        // Allow indexing the post? (bool)    // 3.0.6    
		'force_approved_state'    => true, // Allow the post to be submitted without going into unapproved queue
		);
		
		submit_post('post', $topic_title, $this->config['welcomerobot_username'], POST_NORMAL, $poll, $data);
		
		return true;
	}

}