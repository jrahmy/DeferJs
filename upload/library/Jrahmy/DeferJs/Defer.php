<?php

/*
 * This file is part of a XenForo addon.
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
class Defer
{
    /**
     * The output we're filtering.
     *
     * @var string
     */
    protected $output;

    /**
     * Concatenated deferred matches.
     *
     * @var string
     */
    protected $deferred;

    /**
     * Constructor.
     *
     * @param string $output The output to filter
     */
    public function __construct($output)
    {
        $this->output = $output;
    }

    /**
     * Defer all (un)matching javascripts.
     *
     * @return string The filtered output.
     */
    public function defer()
    {
        // scoop up unblacklisted javascripts
        $this->output = preg_replace_callback(
            '/<script.*?>.*?<\/script>/is',
			array($this, 'collect'),
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
     * @param array $matches An array of matches.
     *
     * @return string The matched JS if blacklisted, or nothing otherwise.
     */
    protected function collect($matches)
    {
        // swap comments for CDATA
        $matches[0] = str_replace(
            array('<!--', '-->'),
            array(' /* <![CDATA[ */ ', ' /* ]]> */ '),
            $matches[0]
        );

        if ($this->blacklisted($matches[0])) {
            // leave match in place
            return $matches[0];
        }

        $this->deferred .= $matches[0];

        // remove match from output
        return '';
    }

    /**
     * Check if the given match contains any blacklisted code.
     *
     * @param string $match The match to search.
     *
     * @return bool True if blacklisted, false if not.
     */
    protected function blacklisted($match)
    {
        // get blacklist from backend
        $options = \XenForo_Application::get('options');
        $blacklist = explode(
            "\n",
            str_replace("\r", '', trim($options->deferJs_blacklist))
        );

        // cycle through for matches
        foreach ($blacklist as $snippet) {
            if (stripos($match, $snippet) !== false) {
                return true;
            }
        }

        return false;
    }
}
