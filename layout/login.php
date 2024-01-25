<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * A login page layout for the boost theme.
 *
 * @package   theme_ucl
 * @copyright 2024 Stuart Lamour
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

// UCL Login redirect.
global $CFG;
$ssoconfig = get_config('theme_ucl', 'ssoenableredirecttoaad');
if ($ssoconfig) {
    /* Redirect login page to single sign on, unless altlogin is passed. */
    $ucllogin = new moodle_url($CFG->wwwroot.'/auth/oidc/');
    $altlogin = optional_param('altlogin', [], PARAM_INT);
    if (!$altlogin) {
        header('Location: '.$ucllogin);
    }
}

$bodyattributes = $OUTPUT->body_attributes();

$templatecontext = [
    'sitename' => format_string($SITE->shortname, true, ['context' => context_course::instance(SITEID), "escape" => false]),
    'output' => $OUTPUT,
    'bodyattributes' => $bodyattributes,
];

echo $OUTPUT->render_from_template('theme_boost/login', $templatecontext);

