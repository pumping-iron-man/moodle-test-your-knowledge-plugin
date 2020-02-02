<?php

/**
 * Reminder block specific event handler.
 *
 * @package    block_reminder
 * @copyright  2020 Sadaf Ebadi, Zishan Ahmad
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

class record_updated_observer {
    public static function record_updated(\mod_data\event\record_updated $event) {
        global $DB;

        $user = $DB->get_record('user', array('id' => $event->userid));

        echo $user->firstname . 'created the record_updated_event.';

        return true;
    }
}

