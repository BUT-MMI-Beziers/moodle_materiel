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
 * Edit type page
 *
 * @package    local_materiel
 * @copyright  2025 Your Name
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once('../../config.php');
require_once($CFG->dirroot . '/local/materiel/lib.php');

require_login();

if (!local_materiel_user_has_access()) {
    throw new moodle_exception('nopermissions', 'error');
}

$id = optional_param('id', 0, PARAM_INT);

$context = context_system::instance();
$PAGE->set_url(new moodle_url('/local/materiel/edit_type.php', ['id' => $id]));
$PAGE->set_context($context);
$PAGE->set_title(get_string('pluginname', 'local_materiel'));
$PAGE->set_heading(get_string('pluginname', 'local_materiel'));

$returnurl = new moodle_url('/local/materiel/manage_types.php');

// Load type if editing.
$type = new \local_materiel\materiel_type($id);

// Create form.
$mform = new \local_materiel\form\type_form();

// Set form data.
if ($id) {
    $formdata = [
        'id' => $type->id,
        'name' => $type->name,
        'description' => $type->description,
    ];
    $mform->set_data($formdata);
}

if ($mform->is_cancelled()) {
    redirect($returnurl);
} else if ($data = $mform->get_data()) {
    $type->name = $data->name;
    $type->description = $data->description;

    if ($type->save()) {
        redirect($returnurl, get_string('type_saved', 'local_materiel'), null, \core\output\notification::NOTIFY_SUCCESS);
    } else {
        redirect($returnurl, get_string('error_saving', 'local_materiel'), null, \core\output\notification::NOTIFY_ERROR);
    }
}

echo $OUTPUT->header();
echo $OUTPUT->heading($id ? get_string('edit_type', 'local_materiel') : get_string('add_type', 'local_materiel'));
$mform->display();
echo $OUTPUT->footer();
