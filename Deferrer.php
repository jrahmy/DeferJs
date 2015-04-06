<?php

/*
 * This file is part of a XenForo add-on.
 *
 * (c) Jeremy P <http://xenforo.com/community/members/jeremy-p.450/>
 * Parts derived from XFOptimise by Luke Foreman
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jrahmy\DeferJs;

/**
 * Provides a means to move all javascript to the end of the page.
 *
 * @author Jeremy P <http://xenforo.com/community/members/jeremy-p.450/>
 */
class Deferrer
{
    /**
     * The output we're filtering.
     *
     * @var string
     */
    protected $output;

    /**
     * The blacklisted search terms.
     *
     * @var array
     */
    protected $blacklist;

    /**
     * Concatenated deferred matches.
     *
     * @var string
     */
    protected $deferred;

    /**
     * Constructor.
     *
     * @param string $output    The output to filter
     * @param array  $blacklist An array of blacklisted snippets
     */
    public function __construct($output, array $blacklist)
    {
        $this->output    = $output;
        $this->blacklist = $blacklist;
    }

    /**
     * Defer all (un)matching javascripts.
     *
     * @return string The filtered output
     */
    public function defer()
    {
        // scoop up unblacklisted javascripts
        $this->output = preg_replace_callback(
            '/\s*?<script.*?>.*?<\/script>\s*?/is',
            [$this, 'collect'],
            $this->output
        );

        // place them before the body tag
        $this->output = preg_replace(
            '/(<\/body>)/i',
            $this->deferred.'$1',
            $this->output,
            1
        );

        return $this->output;
    }

    /**
     * Collect unblacklisted scripts into the deferred property. To be used
     * with preg_replace_callback().
     *
     * @param array $matches An array of matches
     *
     * @return string The matched JS if blacklisted, or nothing otherwise
     */
    protected function collect($matches)
    {
        // swap comments for CDATA
        $matches[0] = str_replace(
            ['<!--', '-->'],
            [' /* <![CDATA[ */ ', ' /* ]]> */ '],
            $matches[0]
        );

        if ($this->blacklisted($matches[0])) {
            // leave match in place
            return $matches[0];
        }

        $this->deferred .= trim($matches[0]);

        // remove match from output
        return '';
    }

    /**
     * Check if the given match contains any blacklisted code.
     *
     * @param string $match The match to search
     *
     * @return bool True if blacklisted, false if not
     */
    protected function blacklisted($match)
    {
        // cycle through for matches
        foreach ($this->blacklist as $snippet) {
            if (stripos($match, $snippet) !== false) {
                return true;
            }
        }

        return false;
    }
}
