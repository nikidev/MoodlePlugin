<?php
require_once('../../config.php');
 
$courseid = required_param('courseid', PARAM_INT);
$id = optional_param('id', 0, PARAM_INT);
$confirm = optional_param('confirm', 0, PARAM_INT);
 
if (!$course = $DB->get_record('course', array('id' => $courseid))) {
    print_error('invalidcourse', 'block_simplehtml', $courseid);
}
 
require_login($course);
 
if(! $simplehtmlpage = $DB->get_record('block_simplehtml', array('id' => $id))) {
    print_error('nopage', 'block_simplehtml', '', $id);
}
 
$site = get_site();
$PAGE->set_url('/blocks/simplehtml/view.php', array('id' => $id, 'courseid' => $courseid));
$heading = $site->fullname . ' :: ' . $course->shortname . ' :: ' . $simplehtmlpage->pagetitle;
$PAGE->set_heading($heading);


if (!$confirm) 
{
    $optionsno = new moodle_url('/course/view.php', array('id' => $courseid));
    $optionsyes = new moodle_url('/blocks/simplehtml/delete.php', array('id' => $id, 'courseid' => $courseid, 'confirm' => 1, 'sesskey' => sesskey()));
    echo $OUTPUT->confirm(get_string('deletepage', 'block_simplehtml', $simplehtmlpage->pagetitle), $optionsyes, $optionsno);
} 
else 
{
    if (confirm_sesskey()) 
    {
        if (!$DB->delete_records('block_simplehtml', array('id' => $id))) 
        {
            print_error('deleteerror', 'block_simplehtml');
        }
    } 
    else 
    {
        print_error('sessionerror', 'block_simplehtml');
    }
    $url = new moodle_url('/course/view.php', array('id' => $courseid));
    redirect($url);
}
echo $OUTPUT->header();
echo $OUTPUT->footer();