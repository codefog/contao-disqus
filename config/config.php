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
 * Extension version
 */
@define('DISQUS_VERSION', '1.0');
@define('DISQUS_BUILD', '0');


/**
 * Front end modules
 */
$GLOBALS['FE_MOD']['miscellaneous']['disqus'] = 'DisqusComments';


/**
 * Content elements
 */
$GLOBALS['TL_CTE']['includes']['disqus'] = 'DisqusComments';
