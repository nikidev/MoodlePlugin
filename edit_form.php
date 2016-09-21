<?php
 
class block_simplehtml_edit_form extends block_edit_form {
 
    protected function specific_definition($mform) {
 
        // Section header title according to language file.
        $mform->addElement('header', 'configheader', get_string('blocksettings', 'block'));
 
        // // A sample string variable with a default value.
        // $mform->addElement('text', 'config_text', get_string('blockstring', 'block_simplehtml'));
        // $mform->setDefault('config_text', 'default value');
        // $mform->setType('config_text', PARAM_RAW);




        $mform->addElement('text', 'config_title', get_string('blocktitle', 'block_simplehtml'));
	    $mform->setDefault('config_title', 'default value');
	    $mform->setType('config_title', PARAM_TEXT);

        
        $mform->addElement('textarea', 'config_content', get_string('blockcontent', 'block_simplehtml'), 'wrap="virtual" rows="20" cols="50"');
        $mform->setDefault('config_content', 'default value');
        $mform->setType('config_content', PARAM_TEXT);


        $mform->addElement('text', 'config_footer', get_string('blockfooter', 'block_simplehtml'));
        $mform->setDefault('config_footer', 'default value');
        $mform->setType('config_footer', PARAM_TEXT); 

        $mform->addElement('checkbox', 'licenseagreement', get_string('licenseagreement', 'block_simplehtml'));       
 
    }
}