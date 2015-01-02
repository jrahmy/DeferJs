<?php

/*
 * This file is part of a XenForo add-on.
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
                'library/Jrahmy/DeferJs/Listener.php' => '8f7a41e1b4765828a5c7c316c083515d',
                'library/Jrahmy/DeferJs/Deferrer.php' => 'a7a9af7718542c083f6866cdb0125509',

        ];
    }
}
