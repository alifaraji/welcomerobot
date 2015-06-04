<?php
/**
*
* @package Welcome Robot
* @copyright eMosbat & (c) 2014 Ali Faraji(Ali@php) <alifaraji.mail@gmail.com> phpbbpersian.ir
* @license GNU General Public License, version 2 (GPL-2.0)
*
* Translated By : Basil Taha Alhitary - www.alhitary.net
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
	'ACP_WELCOMEROBOT_MOD_TITLE'					=> 'موضوع الترحيب',
	'ACP_WELCOMEROBOT_CONFIG_TITLE'					=> 'موضوع الترحيب',
	'ACP_WELCOMEROBOT_TITLE'						=> 'موضوع الترحيب',
	'ACP_WELCOMEROBOT_LEGEND1'						=> 'الإعدادات',
	'ACP_WELCOMEROBOT_CONFIG_ENABLE'				=> 'تفعيل ',
	'ACP_WELCOMEROBOT_CONFIG_FORUM'					=> 'المنتدى ',
	'ACP_WELCOMEROBOT_CONFIG_FORUM_EXPLAIN'			=> 'اظهار الموضوع في هذا المنتدى.',
	'ACP_WELCOMEROBOT_CONFIG_USERNAME'				=> 'اسم المرسل ',
	'ACP_WELCOMEROBOT_CONFIG_USERNAME_EXPLAIN'		=> 'إسم المرسل سيظهر في نهاية الموضوع.',
	'ACP_WELCOMEROBOT_CONFIG_TOPICTITLE'			=> 'عنوان الموضوع',
	'ACP_WELCOMEROBOT_CONFIG_TOPICTITLE_EXPLAIN'	=> '',
	'ACP_WELCOMEROBOT_CONFIG_DETAIL'				=> 'محتوى الموضوع ',
	'ACP_WELCOMEROBOT_CONFIG_DETAIL_EXPLAIN'		=> '',
	'ACP_WELCOMEROBOT_CONFIG_HELP'					=> 'ملاحظة :<br />تستطيع استخدام `%user` ( إسم المستخدم الجديد ) و `%robot` ( إسم المرسل ) و `%board` ( إسم المنتدى ) لعرضهم في عنوان أو محتوى الموضوع.',
	'ACP_WELCOMEROBOT_SETTINGS'						=> 'الإعدادات',
	'ACP_WELCOMEROBOT_SUCCESS'						=> 'تم حفظ الإعدادات بنجاح.',
	'ACP_WELCOMEROBOT_ERROR'						=> 'اسم المرسل الذي أدخلته غير مقبول.',
	'ACP_WELCOMEROBOT_ERROR2'						=> 'يجب عليك تحديد المنتدى.',
	'ACL_A_WELCOMEROBOT_MOD'						=> 'Can manage the Welcome Topic Robot settings',
));
