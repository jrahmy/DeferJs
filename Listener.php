<?php

/*
 * This file is part of a XenForo add-on.
 *
 * (c) Jeremy P <https://xenforo.com/community/members/jeremy-p.450/>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

namespace Jrahmy\DeferJs;

/**
 * Provides static methods to extend the XenForo API.
 *
 * @author Jeremy P <https://xenforo.com/community/members/jeremy-p.450/>
 */
class Listener
{
    /**
     * Alters front controller output.
     *
     * @param \XenForo_FrontController $frontController The XenForo front controller
     * @param string                   $output          The view output
     */
    public static function frontControllerPostView(\XenForo_FrontController $frontController, &$output)
    {
        // only run on public pages
        if (!$frontController->getDependencies() instanceof
            \XenForo_Dependencies_Public
        ) {
            return;
        }

        // disable for attachment output (in case of HTML attachments)
        if ($frontController->route()->getControllerName() ===
            'XenForo_ControllerPublic_Attachment'
        ) {
            return;
        }

        // only run on html pages
        if (strpos($output, '<html') === false) {
            return;
        }

        // chrome xss auditor blocks with deferred wysiwyg on post request
        $wysiwyg = (strpos($output, 'redactor') or strpos($output, 'tinymce'));
        if ($frontController->getRequest()->isPost() and $wysiwyg) {
            return;
        }

        // get blacklist from backend
        $blacklist = explode(
            "\n",
            str_replace(
                "\r",
                '',
                trim(
                    \XenForo_Application::getOptions()->jrahmy_deferJs_blacklist
                )
            )
        );

        $deferrer  = new Deferrer($output, $blacklist);
        $output = $deferrer->defer();
    }

    /**
     * Adds filesums to the XenForo File Health Check.
     *
     * @param \XenForo_ControllerAdmin_Abstract $controller The current admin controller
     * @param array                             $hashes     An array of filesums
     */
    public static function fileHealthCheck(
        \XenForo_ControllerAdmin_Abstract $controller,
        array &$hashes
    ) {
        $hashes += FileSums::getHashes();
    }
}
