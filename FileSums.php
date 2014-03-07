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
                'library/Jrahmy/DeferJs/Defer.php' => 'dd1c56280620524f17f67bec97e130d2',
                'library/Jrahmy/DeferJs/Listener.php' => '92328936564bd79c9fc988a9b8abda0c',

        ];
    }
}
