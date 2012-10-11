<?php

require_once 'OntoWiki/Controller/Component.php';

/**
 * Controller for OntoWiki
 *
 * @category   OntoWiki
 * @package    OntoWiki_extensions_components_page
 * @author     Sebastian Dietzold <dietzold@informatik.uni-leipzig.de>
 * @author     Philipp Frischmuth <pfrischmuth@googlemail.com>
 * @copyright  Copyright (c) 2008, {@link http://aksw.org AKSW}
 * @license    http://opensource.org/licenses/gpl-license.php GNU General Public License (GPL)
 * @version    $Id$
 */
class PageController extends OntoWiki_Controller_Component
{
    /**
     * Default action. Forwards to get action.
     */
    public function __call($action, $params)
    {
        $owApp = OntoWiki::getInstance();
        $owNavigation = $owApp->getNavigation();
        $owNavigation->disableNavigation();

        $pagename = str_replace('Action', '', $action);
        $pageTitles = $this->_privateConfig->titles->toArray();

        if (isset($pageTitles[$pagename])) {
            $this->view->placeholder('main.window.title')->set($this->_owApp->translate->_($pageTitles[$pagename]));
        } else {
            $this->view->placeholder('main.window.title')->set($this->_owApp->translate->_($pagename));
        }

        $this->render($pagename);
    }
}
