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
 * Post installation script for local_materiel
 *
 * @package    local_materiel
 * @copyright  2025 Your Name
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Post installation procedure
 */
function xmldb_local_materiel_install() {
    global $DB;

    // Create the MMI_materiel cohort if it doesn't exist.
    $cohort = $DB->get_record('cohort', ['idnumber' => 'MMI_materiel']);

    if (!$cohort) {
        $cohort = new stdClass();
        $cohort->contextid = context_system::instance()->id;
        $cohort->name = 'MMI Matériel';
        $cohort->idnumber = 'MMI_materiel';
        $cohort->description = 'Cohorte pour les utilisateurs ayant accès à la gestion du matériel';
        $cohort->descriptionformat = FORMAT_HTML;
        $cohort->visible = 1;
        $cohort->timecreated = time();
        $cohort->timemodified = time();

        $DB->insert_record('cohort', $cohort);
    }

    return true;
}
