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
 * Library functions for local_materiel
 *
 * @package    local_materiel
 * @copyright  2025 Your Name
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Add link to the plugin in the navigation menu
 *
 * @param global_navigation $navigation
 */
function local_materiel_extend_navigation(global_navigation $navigation) {
    global $PAGE;

    if (has_capability('local/materiel:view', context_system::instance())) {
        $node = $navigation->add(
            get_string('materiel', 'local_materiel'),
            new moodle_url('/local/materiel/index.php'),
            navigation_node::TYPE_CUSTOM,
            null,
            'local_materiel',
            new pix_icon('i/folder', '')
        );
        $node->showinflatnavigation = true;
    }
}
