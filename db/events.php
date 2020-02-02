<?php

/**
 * Reminder block observers.
 *
 * @package    block_reminder
 * @copyright  2020 Sadaf Ebadi, Zishan Ahmad
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

// observers is an array and lists all event handlers
$observer = array(
    array(
        'eventname' => '\mod_data\event\record_updated',
        'callback' => 'record_updated_observer::record_updated',
    ),
);