<?php
function block_simplehtml_images() {
    return array(html_writer::tag('img', '', array('alt' => get_string('red', 'block_simplehtml'), 'src' => "pix/picture0.gif")),
                html_writer::tag('img', '', array('alt' => get_string('blue', 'block_simplehtml'), 'src' => "pix/picture1.gif")),
                html_writer::tag('img', '', array('alt' => get_string('green', 'block_simplehtml'), 'src' => "pix/picture2.gif")));
}

function block_simplehtml_print_page($simplehtml, $return = false) 
{
	global $OUTPUT, $COURSE;

	$display = $OUTPUT->heading($simplehtml->pagetitle);

	$display .= $OUTPUT->box_start('page-box');

			if($simplehtml->displaydate) 
			{	
				$display .= html_writer::start_tag('div', array('class' => 'simplehtml displaydate'));
		    	$display .= userdate($simplehtml->displaydate);
		    	$display .= html_writer::end_tag('div');

			}


			if ($simplehtml->displaypicture) 
 			{
	   
			    $images = block_simplehtml_images();
			    $display .= $images[$simplehtml->picture];
			    $display .= html_writer::start_tag('p');
			    $display .= clean_text($simplehtml->description);
			    $display .= html_writer::end_tag('p');
			}

			if($return) 
			{
		    	return $display;
			} 
			else 
			{
		    	echo $display;
			}

			$display .= clean_text($simplehtml->displaytext);


 	$display .= $OUTPUT->box_end('page-box');

 	

}