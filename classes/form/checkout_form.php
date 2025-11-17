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
 * Checkout form
 *
 * @package    local_materiel
 * @copyright  2025 Your Name
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_materiel\form;

defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir . '/formslib.php');

/**
 * Form for checking out materiel
 */
class checkout_form extends \moodleform {

    /**
     * Form definition
     */
    public function definition() {
        $mform = $this->_form;

        // Hidden materiel ID.
        $mform->addElement('hidden', 'id');
        $mform->setType('id', PARAM_INT);

        // User autocomplete.
        $options = [
            'ajax' => 'core_user/form_user_selector',
            'multiple' => false,
            'valuehtmlcallback' => function($userid) {
                global $DB, $OUTPUT;
                $user = $DB->get_record('user', ['id' => $userid]);
                $useroptiondata = [
                    'fullname' => fullname($user),
                    'email' => $user->email,
                ];
                return $OUTPUT->render_from_template('core_user/form_user_selector_suggestion', $useroptiondata);
            },
        ];

        $mform->addElement('autocomplete', 'userid', get_string('user', 'local_materiel'), [], $options);
        $mform->addRule('userid', get_string('required'), 'required', null, 'client');

        // Notes.
        $mform->addElement('textarea', 'notes', get_string('notes', 'local_materiel'), ['rows' => 3, 'cols' => 50]);
        $mform->setType('notes', PARAM_TEXT);

        // Action buttons.
        $this->add_action_buttons(true, get_string('checkout', 'local_materiel'));
    }
}
