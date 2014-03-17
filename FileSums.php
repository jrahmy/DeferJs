<?php

/*
 * This file is part of a XenForo addon.
 *
 * (c) Jeremy P <http://xenforo.com/community/members/jeremy-p.450/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jrahmy\DeferJs;

/**
 * Filesums for XenForo File Health Check.
 *
 * @author Jeremy P <http://xenforo.com/community/members/jeremy-p.450/>
 */
class FileSums
{
    /**
     * Provides an associative array of filenames to hashes.
     *
     * @return array An associative array of filesums.
     */
    public static function getHashes()
    {
        return [
                'library/Jrahmy/DeferJs/Defer.php' => '24030e1b159867a88fc137f309d20f12',
                'library/Jrahmy/DeferJs/Listener.php' => '018eb9cdebdbc9f25db764b8ab6871cd',

        ];
    }
}
