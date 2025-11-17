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
 * Materiel type class
 *
 * @package    local_materiel
 * @copyright  2025 Your Name
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_materiel;

defined('MOODLE_INTERNAL') || die();

/**
 * Class for managing materiel types
 */
class materiel_type {

    /** @var int Type ID */
    public $id;

    /** @var string Type name */
    public $name;

    /** @var string Type description */
    public $description;

    /** @var int Creation timestamp */
    public $timecreated;

    /** @var int Last modification timestamp */
    public $timemodified;

    /**
     * Constructor
     *
     * @param int $id Type ID (0 for new type)
     */
    public function __construct($id = 0) {
        if ($id) {
            $this->load($id);
        }
    }

    /**
     * Load type from database
     *
     * @param int $id Type ID
     * @return bool Success
     */
    public function load($id) {
        global $DB;

        if ($record = $DB->get_record('local_materiel_types', ['id' => $id])) {
            $this->id = $record->id;
            $this->name = $record->name;
            $this->description = $record->description;
            $this->timecreated = $record->timecreated;
            $this->timemodified = $record->timemodified;
            return true;
        }
        return false;
    }

    /**
     * Save type to database
     *
     * @return bool Success
     */
    public function save() {
        global $DB;

        $now = time();
        $record = new \stdClass();
        $record->name = $this->name;
        $record->description = $this->description;
        $record->timemodified = $now;

        if (!empty($this->id)) {
            $record->id = $this->id;
            return $DB->update_record('local_materiel_types', $record);
        } else {
            $record->timecreated = $now;
            $this->id = $DB->insert_record('local_materiel_types', $record);
            $this->timecreated = $now;
            $this->timemodified = $now;
            return !empty($this->id);
        }
    }

    /**
     * Delete type from database
     *
     * @return bool Success
     */
    public function delete() {
        global $DB;

        if (!empty($this->id)) {
            return $DB->delete_records('local_materiel_types', ['id' => $this->id]);
        }
        return false;
    }

    /**
     * Get all types
     *
     * @return array Array of materiel_type objects
     */
    public static function get_all() {
        global $DB;

        $records = $DB->get_records('local_materiel_types', null, 'name ASC');
        $types = [];

        foreach ($records as $record) {
            $type = new self();
            $type->id = $record->id;
            $type->name = $record->name;
            $type->description = $record->description;
            $type->timecreated = $record->timecreated;
            $type->timemodified = $record->timemodified;
            $types[] = $type;
        }

        return $types;
    }
}
