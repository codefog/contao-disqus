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


/**
 * Add a palette to tl_content
 */
$GLOBALS['TL_DCA']['tl_content']['palettes']['disqus'] = '{type_legend},type,headline;{disqus_legend},disqus_shortname,disqus_identifier;{template_legend:hide},disqus_template;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space';


/**
 * Add fields to tl_content
 */
$GLOBALS['TL_DCA']['tl_content']['fields']['disqus_shortname'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['disqus_shortname'],
	'exclude'                 => true,
	'inputType'               => 'text',
	'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50'),
	'sql'                     => "varchar(255) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['disqus_identifier'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['disqus_identifier'],
	'exclude'                 => true,
	'inputType'               => 'text',
	'eval'                    => array('maxlength'=>255, 'tl_class'=>'w50'),
	'sql'                     => "varchar(255) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['disqus_template'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['disqus_template'],
	'default'                 => 'disqus_default',
	'exclude'                 => true,
	'inputType'               => 'select',
	'options_callback'        => array('tl_content_disqus', 'getDisqusTemplates'),
	'eval'                    => array('tl_class'=>'w50'),
	'sql'                     => "varchar(255) NOT NULL default ''"
);


/**
 * Provide miscellaneous methods that are used by the data configuration array.
 */
class tl_content_disqus extends Backend
{

	/**
	 * Return all Disqus templates as array
	 * @param DataContainer
	 * @return array
	 */
	public function getDisqusTemplates(DataContainer $dc)
	{
		$intTheme = 0;
		$intPid = $dc->activeRecord->pid;

		if ($this->Input->get('act') == 'overrideAll')
		{
			$intPid = $this->Input->get('id');
		}

		$objPage = $this->Database->prepare("SELECT id FROM tl_page WHERE id=(SELECT pid FROM tl_article WHERE id=?)")
								  ->limit(1)
								  ->execute($intPid);

		// Get the current theme
		if ($objPage->numRows)
		{
			$objPage = $this->getPageDetails($objPage->id);

			if ($objPage->layout)
			{
				$objLayout = $this->Database->prepare("SELECT pid FROM tl_layout WHERE id=?")
											->limit(1)
											->execute($objPage->layout);

				// Set the current theme ID
				if ($objLayout->numRows)
				{
					$intTheme = $objLayout->pid;
				}
			}
		}

		return $this->getTemplateGroup('disqus_', $intTheme);
	}
}
