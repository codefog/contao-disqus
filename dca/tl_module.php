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
 * Load tl_content language file
 */
System::loadLanguageFile('tl_content');


/**
 * Add a palette to tl_module
 */
$GLOBALS['TL_DCA']['tl_module']['palettes']['disqus'] = '{title_legend},name,headline,type;{disqus_legend},disqus_shortname,disqus_identifier;{template_legend:hide},disqus_template;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space';


/**
 * Add fields to tl_content
 */
$GLOBALS['TL_DCA']['tl_module']['fields']['disqus_shortname'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['disqus_shortname'],
	'exclude'                 => true,
	'inputType'               => 'text',
	'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50'),
	'sql'                     => "varchar(255) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_module']['fields']['disqus_identifier'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['disqus_identifier'],
	'exclude'                 => true,
	'inputType'               => 'text',
	'eval'                    => array('maxlength'=>255, 'tl_class'=>'w50'),
	'sql'                     => "varchar(255) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_module']['fields']['disqus_template'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['disqus_template'],
	'default'                 => 'disqus_default',
	'exclude'                 => true,
	'inputType'               => 'select',
	'options_callback'        => array('tl_module_disqus', 'getDisqusTemplates'),
	'eval'                    => array('tl_class'=>'w50'),
	'sql'                     => "varchar(255) NOT NULL default ''"
);


/**
 * Provide miscellaneous methods that are used by the data configuration array.
 */
class tl_module_disqus extends Backend
{

	/**
	 * Return all Disqus templates as array
	 * @param DataContainer
	 * @return array
	 */
	public function getDisqusTemplates(DataContainer $dc)
	{
		$intPid = $dc->activeRecord->pid;

		if ($this->Input->get('act') == 'overrideAll')
		{
			$intPid = $this->Input->get('id');
		}

		return $this->getTemplateGroup('disqus_', $intPid);
	}
}
