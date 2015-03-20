<?php
/**
*
* Welcome Robot extension for the phpBB Forum Software package.
* French translation by Galixte (http://www.galixte.com)
*
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
	'ACP_WELCOMEROBOT_MOD_TITLE'					=> 'Sujet automatique de bienvenue',
	'ACP_WELCOMEROBOT_CONFIG_TITLE'					=> 'Sujet automatique de bienvenue',
	'ACP_WELCOMEROBOT_TITLE'						=> 'Sujet automatique de bienvenue',
	'ACP_WELCOMEROBOT_LEGEND1'						=> 'Paramètres',
	'ACP_WELCOMEROBOT_CONFIG_ENABLE'				=> 'Activer',
	'ACP_WELCOMEROBOT_CONFIG_FORUM'					=> 'Forum',
	'ACP_WELCOMEROBOT_CONFIG_FORUM_EXPLAIN'			=> 'Créer les sujets dans ce forum.',
	'ACP_WELCOMEROBOT_CONFIG_USERNAME'				=> 'Auteur des sujets',
	'ACP_WELCOMEROBOT_CONFIG_USERNAME_EXPLAIN'		=> 'Nom de l’auteur des sujets de bienvenue.',
	'ACP_WELCOMEROBOT_CONFIG_TOPICTITLE'			=> 'Titre des sujets',
	'ACP_WELCOMEROBOT_CONFIG_TOPICTITLE_EXPLAIN'	=> 'Titre des sujets créés lors de l’enregistrement de nouveaux utilisateurs.',
	'ACP_WELCOMEROBOT_CONFIG_DETAIL'				=> 'Contenu des sujets',
	'ACP_WELCOMEROBOT_CONFIG_DETAIL_EXPLAIN'		=> 'Contenu des sujets créés lors de l’enregistrement de nouveaux utilisateurs.',
	'ACP_WELCOMEROBOT_CONFIG_HELP'					=> 'Note :<br />Vous pouvez utiliser `%user`, `%robot` et `%board` pour afficher dans le titre et le contenu du sujet, le nom du dernier utilisateur enregistré, le nom de l’auteur du sujet et le nom du site.',
	'ACP_WELCOMEROBOT_SETTINGS'						=> 'Paramètres',
	'ACP_WELCOMEROBOT_SUCCESS'						=> 'Paramètres sauvegardés avec succès.',
	'ACP_WELCOMEROBOT_ERROR'						=> 'Le nom de l’auteur est invalide.',
	'ACP_WELCOMEROBOT_ERROR2'						=> 'Sélectionner un forum.',
));
