<?php

/**
 * Reminder block edit page
 *
 * @package    block_reminder
 * @copyright  2020 Sadaf Ebadi, Zishan Ahmad
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
 
class block_reminder_edit_form extends block_edit_form {
 
    protected function specific_definition($mform) {
      
        // Section header title according to language file.
        $mform->addElement('header', 'config_header', get_string('blocksettings', 'block'));
        // show information checkbox
        $mform->addElement('advcheckbox', 'config_advcheckbox', get_string('advcheckbox', 'block_reminder'), null , array(0, 1));
 
    }
}