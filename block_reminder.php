<?php

/**
 * This file contains the reminder block class, based upon block_base.
 *
 * @package    block_reminder
 * @copyright  2020 Sadaf Ebadi, Zishan Ahmad
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Class block_reminder
 *
 * @package    block_reminder
 * @copyright  2020 Sadaf Ebadi, Zishan Ahmad
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class block_reminder extends block_base {
    function init() {
        $this->title = get_string('pluginname', 'block_reminder');
    }

    function get_content() {
        global $USER, $DB, $OUTPUT;

        if ($this->content !== NULL) {
            return $this->content;
        }

        $this->content = new stdClass;
        $this->content->text = '';
        $this->content->footer = '';

        if (empty($this->instance)) {
            return $this->content;
        }

        
        if(isloggedin() && !isguestuser()) {

            //show information text only if the checkbox in the plugin instance setting is clicked
            if($this->config->advcheckbox) {
    
                $informationTitle = get_string('contentInformationTitle', 'block_reminder');
                $informationText = get_string('contentInformationText', 'block_reminder');
                $contentText = html_writer::start_tag('div', array('style' => 'font-size:12px;'));
                $contentText .= html_writer::tag('strong', $informationTitle);
                $contentText .= html_writer::tag('p', $informationText);
                $contentText .= html_writer::end_tag('div');
                $this->content->text .= $contentText;
            }
            
            //get record to show and set its flag to 1, 
            //so it won't get shown when the next question button gets clicked
            $blockRecord = $this->get_random_unflagged_record();
            $blockRecord->flag = 1;
            $DB->update_record('questions', $blockRecord);

            //since an update occured, the update information is written into the standard_log_storage
            $this->log_record_update();

            $text = get_string('question', 'block_reminder');
            $text .= html_writer::tag('h3', $blockRecord->question);
            $text .= get_string('answer', 'block_reminder');
            $text .= html_writer::tag('h3', $blockRecord->answer);
            $text .= html_writer::tag('br', null);
            $text .= $OUTPUT->single_button('#' , get_string('button', 'block_reminder'));
            
            $this->content->text .= $text;
        }
        
        return $this->content;
    }

    //returns a random record which flag is not set to 1,
    //if all flags are set to 1, then the helper function 'set_default_flags' is called
    function get_random_unflagged_record() {
        global $DB;

        $recordsLength = $DB->count_records('questions');
        $randomId = rand(1, $recordsLength);
        $randomRecord = $DB->get_record('questions', [id => $randomId]);

        while(true) {
            if($randomRecord->flag == 0) {
                break;
            }
            if($DB->count_records('questions', [flag => 1]) == $recordsLength) {
                $this->set_default_flags();
            }

            $randomId = rand(1, $recordsLength);
            $randomRecord = $DB->get_record('questions', [id => $randomId]);
        }

        return $randomRecord;
    }

    //helper method
    function set_default_flags() {
        global $DB;

        $records = $DB->get_records('questions', [flag=>1]);
        foreach($records as &$record) {
            $record->flag = 0;
            $DB->update_record('questions', $record);
        }
        unset($record);
    }

    //not tested yet
    //since we dont know how to use the logging api to log into the standard_log_store,
    //this method does our job without accessing the logging api
    function log_record_update() {
        global $USER, $DB;

        $standard_log_record = new stdClass;
        $standard_log_record->eventname = 'custom_record_updated';
        $standard_log_record->component = 'mod_data';
        $standard_log_record->action = 'reminder_block_question_updated';
        $standard_log_record->target = 'user';
        $standard_log_record->crud = 'u';
        $standard_log_record->edulevel = 0;
        $standard_log_record->contextid = 1;
        $standard_log_record->contextlevel = 5;
        $standard_log_record->contextinstanceid = 30;
        $standard_log_record->userid = $USER->id;
        $standard_log_record->anonymous = 0;
        $standard_log_record->timecreated = time();

        $DB->insert_record('logstore_standard_log', $standard_log_record);
    }
}


