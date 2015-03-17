<?php
namespace BERGWERK\BwrkOnepage\Controller;


/* * *************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2014
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 * ************************************************************* */

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

class OnepageController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * @var \BERGWERK\BwrkOnepage\Domain\Repository\ContentRepository
     * @inject
     */
    protected $contentRepository;

    public function showOnepageAction()
    {
        $settings = $this->settings;
        $pages = $settings['pages'];
        $pagesArr = array();

        $pageIds = explode(',', $pages);
        foreach($pageIds as $pageId)
        {
            $contentArr = array();

            $contentElements = $this->contentRepository->findByPid($pageId);

            foreach($contentElements as $contentElement)
            {
                if($contentElement->getColPos() == "0")
                {
                    $contentArr[] = $contentElement->getUid();
                }
            }
            $pagesArr[] = array(
                'id' => $pageId,
                'contentElements' => $contentArr
            );
        }
        $this->view->assign('pages', $pagesArr);
    }
}