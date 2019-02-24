<?php
/**
 * @package    Joomla.Cli
 *
 * @copyright  Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

/**
 * A command line cron job to attempt to remove files that should have been deleted at update.
 */

// We are a valid entry point.
const _JEXEC = 1;


// Load system defines
if (file_exists(dirname(__DIR__) . '/defines.php'))
{
	require_once dirname(__DIR__) . '/defines.php';

	
}

if (!defined('_JDEFINES'))
{
	define('JPATH_BASE', dirname(__DIR__));
	require_once JPATH_BASE . '/includes/defines.php';
}

// Get the framework.
require_once JPATH_LIBRARIES . '/import.legacy.php';

// Bootstrap the CMS libraries.
require_once JPATH_LIBRARIES . '/cms.php';


// Configure error reporting to maximum for CLI output.
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Load Library language
$lang = JFactory::getLanguage();

// Try the files_joomla file in the current language (without allowing the loading of the file in the default language)
$lang->load('files_joomla.sys', JPATH_SITE, null, false, false)
// Fallback to the files_joomla file in the default language
|| $lang->load('files_joomla.sys', JPATH_SITE, null, true);

/**
 * A command line cron job to attempt to remove files that should have been deleted at update.
 *
 * @since  3.0
 */
class MakeDefector extends JApplicationCli
{
	/**
	 * Entry point for CLI script
	 *
	 * @return  void
	 *
	 * @since   3.0
	 */
	public function doExecute()
	{
		
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
		$columns = array('subject', 'body');
		$values = array($db->quote('TEST FROM CLI'), $db->quote('TEST'));
		$query
			->insert($db->quoteName('#__acymailing_mail'))
			->columns($db->quoteName($columns))
			->values(implode(',', $values));
		$db->setQuery($query);
		$db->execute();

		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
		$columns = array('subject', 'body');
		$values = array($db->quote('TEST FROM CLI 2'), $db->quote('TEST 2'));
		$query
			->insert($db->quoteName('#__acymailing_mail'))
			->columns($db->quoteName($columns))
			->values(implode(',', $values));
		$db->setQuery($query);
		$db->execute();

		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
		$columns = array('subject', 'body');
		$values = array($db->quote('TEST FROM CLI 3'), $db->quote('TEST 3'));
		$query
			->insert($db->quoteName('#__acymailing_mail'))
			->columns($db->quoteName($columns))
			->values(implode(',', $values));
		$db->setQuery($query);
		$db->execute();
		
	}
}

// Instantiate the application object, passing the class name to JCli::getInstance
// and use chaining to execute the application.
JApplicationCli::getInstance('MakeDefector')->execute();
