<?php

/**
 * Reminder block caps.
 *
 * @package    block_reminder
 * @copyright  2020 Sadaf Ebadi, Zishan Ahmad
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

 defined('MOODLE_INTERNAL') || die();

 function xmldb_block_reminder_install() {
    global $DB;

    $questionOne = new stdClass;
    $questionOne->question = 'Mit was beschäftigt sich die Diskrete Modellierung?';
    $questionOne->answer = "Lorem ipsum diskrete Modellierung.";
    $questionOne->flag = 0;

    $questionTwo = new stdClass;
    $questionTwo->question = 'React oder Angular?';
    $questionTwo->answer = "HTML.";
    $questionTwo->flag = 0;

    $questionThree = new stdClass;
    $questionThree->question = 'Was ist eine Zusammenhangskomponente?';
    $questionThree->answer = "Bla bla bla.";
    $questionThree->flag = 0;

    $questionFour = new stdClass;
    $questionFour->question = 'Bringt das Informatik-Studium etwas?';
    $questionFour->answer = "No. Lorem ipsum. Sin dolor.";
    $questionFour->flag = 0;

    $recordsArr = array($questionOne, $questionTwo, $questionThree, $questionFour);

    $DB->insert_records('questions', $recordsArr);
 }