<?php
$settings->add(new admin_setting_heading(
            'headerconfig',
            get_string('headerconfig', 'block_simplehtml'),
            get_string('descconfig', 'block_simplehtml')
        ));
 
$settings->add(new admin_setting_configcheckbox(
            'pluginname/Allow_HTML',
            get_string('labelallowhtml', 'block_simplehtml'),
            get_string('descallowhtml', 'block_simplehtml'),
            '0'
        ));