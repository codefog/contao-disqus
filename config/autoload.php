<?php

/**
 * disqus extension for Contao Open Source CMS
 *
 * Copyright (C) 2013 Codefog Ltd
 *
 * @package disqus
 * @author  Codefog Ltd <http://codefog.pl>
 * @author  Kamil Kuzminski <kamil.kuzminski@codefog.pl>
 * @license LGPL
 */


/**
 * Register the namespace
 */
ClassLoader::addNamespace('Disqus');


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	'Disqus\Disqus'         => 'system/modules/disqus/classes/Disqus.php',
	'Disqus\DisqusHybrid'   => 'system/modules/disqus/classes/DisqusHybrid.php',
	'Disqus\DisqusComments' => 'system/modules/disqus/hybrids/DisqusComments.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'disqus'         => 'system/modules/disqus/templates',
	'disqus_default' => 'system/modules/disqus/templates'
));
