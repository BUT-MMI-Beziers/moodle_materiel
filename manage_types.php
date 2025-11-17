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
 * Manage types page
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

$context = context_system::instance();
$PAGE->set_url(new moodle_url('/local/materiel/manage_types.php'));
$PAGE->set_context($context);
$PAGE->set_title(get_string('pluginname', 'local_materiel'));
$PAGE->set_heading(get_string('pluginname', 'local_materiel'));

echo $OUTPUT->header();
echo $OUTPUT->heading(get_string('manage_types', 'local_materiel'));

// Add button.
echo html_writer::start_div('mb-3');
echo html_writer::link(
    new moodle_url('/local/materiel/edit_type.php'),
    get_string('add_type', 'local_materiel'),
    ['class' => 'btn btn-primary']
);
echo html_writer::end_div();

// Get all types.
$types = \local_materiel\materiel_type::get_all();

if (empty($types)) {
    echo html_writer::tag('p', get_string('no_types', 'local_materiel'), ['class' => 'alert alert-info']);
} else {
    $table = new html_table();
    $table->head = [
        get_string('name', 'local_materiel'),
        get_string('description', 'local_materiel'),
        get_string('actions', 'local_materiel'),
    ];
    $table->attributes['class'] = 'generaltable';

    foreach ($types as $type) {
        $actions = [];

        // Edit.
        $actions[] = html_writer::link(
            new moodle_url('/local/materiel/edit_type.php', ['id' => $type->id]),
            $OUTPUT->pix_icon('t/edit', get_string('edit')),
            ['title' => get_string('edit')]
        );

        // Delete.
        $actions[] = html_writer::link(
            new moodle_url('/local/materiel/delete_type.php', ['id' => $type->id]),
            $OUTPUT->pix_icon('t/delete', get_string('delete')),
            ['title' => get_string('delete')]
        );

        $row = [
            html_writer::tag('strong', $type->name),
            $type->description,
            implode(' ', $actions),
        ];

        $table->data[] = $row;
    }

    echo html_writer::table($table);
}

echo html_writer::div(
    html_writer::link(new moodle_url('/local/materiel/index.php'), get_string('back_to_list', 'local_materiel')),
    'mt-3'
);

echo $OUTPUT->footer();
