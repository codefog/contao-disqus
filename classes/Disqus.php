<?php

/**
 * disqus extension for Contao Open Source CMS
 *
 * Copyright (C) 2013 Codefog
 *
 * @package disqus
 * @author  Codefog <http://codefog.pl>
 * @author  Kamil Kuzminski <kamil.kuzminski@codefog.pl>
 * @license LGPL
 */

namespace Disqus;


/**
 * Provide class to handle Disqus system
 */
class Disqus
{

	/**
	 * Generate the comments and return them as HTML string
	 * @param string
	 * @param mixed
	 * @return string
	 */
	public static function generateComments($strShortname, $varIdentifier=null)
	{
		$objTemplate = new \FrontendTemplate('disqus');
		$objTemplate->shortname = $strShortname;
		$objTemplate->identifier = $varIdentifier;

		return $objTemplate->parse();
	}
}
