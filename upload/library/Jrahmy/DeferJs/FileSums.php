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
        return array(
                'library/Jrahmy/DeferJs/Defer.php' => 'c012b8dd6d359e268b6e60a0d4de2690',
                'library/Jrahmy/DeferJs/Listener.php' => '8e2781624cf1286cb3c52a68563931a7',

		);
    }
}
