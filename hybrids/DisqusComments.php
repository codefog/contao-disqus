<?php

/**
 * disqus extension for Contao Open Source CMS
 * 
 * Copyright (C) 2013 Codefog
 * 
 * @package disqus
 * @link    http://codefog.pl
 * @author  Kamil Kuzminski <kamil.kuzminski@codefog.pl>
 * @license LGPL
 */


/**
 * Run in a custom namespace, so the class can be replaced
 */
namespace Disqus;


/**
 * Disqus comments system hybrid.
 */
class DisqusComments extends \DisqusHybrid
{

	/**
	 * Display a wildcard in the back end
	 * @return string
	 */
	public function generate()
	{
		if (TL_MODE == 'BE')
		{
			$objTemplate = new \BackendTemplate('be_wildcard');

			$objTemplate->wildcard = '### DISQUS COMMENTS SYSTEM ###';
			$objTemplate->title = $this->headline;
			$objTemplate->id = $this->id;
			$objTemplate->link = $this->name;

			return $objTemplate->parse();
		}

		return parent::generate();
	}


	/**
	 * Generate the module
	 */
	protected function compile()
	{
		$this->Template->buffer = \Disqus::generateComments($this->disqus_shortname, $this->disqus_identifier);
	}
}
