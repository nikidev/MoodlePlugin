<?php
//extend the block list or block base
class block_simplehtml extends block_base {
    public function init() 
    {
        $this->title = get_string('pluginname', 'block_simplehtml');
    }


    function specialization()
    {
	    	
    	if (isset($this->config)) 
    	{
	        if (empty($this->config->title)) 
	        {
	            $this->title = get_string('pluginname', 'block_simplehtml');            
	        }
	        else 
	        {
	            $this->title = $this->config->title;
	        }
 
	        if (empty($this->config->text)) 
	        {
	            $this->config->text = get_string('pluginname', 'block_simplehtml');
	        } 

    	}

		// $this->title = $this->config->title;

    }

    public function get_content() 
    {

    	//---------------block base-----------//

	    // if ($this->content !== null) 
	    // {
	    //   return $this->content;
	    // }
	 
	    // $this->content         =  new stdClass;
	    // $this->content->text   = $this->config->content;
	    // $this->content->footer =  $this->config->footer;
	 
	    // return $this->content;

	    //----------block list---------///
   
		  //  if ($this->content !== null) 
		  //  {
	   //  		return $this->content;
	 	 //   }
		 
		  // $this->content         = new stdClass;
		  // $this->content->items  = array();
		  // $this->content->icons  = array();
		  // $this->content->text   = $this->config->content;
		  // $this->content->footer =  $this->config->footer;
		 
		  // $this->content->items[] = html_writer::tag('a', 'Menu Option 1', array('href' => 'some_file.php'));
		  // $this->content->icons[] = html_writer::empty_tag('img', array('src' => '../images/arrow.png', 'class' => 'icon'));

    	// return $this->content;
		 
		global $COURSE, $DB, $PAGE;




 		
		$url = new moodle_url('/blocks/simplehtml/view.php', array('blockid' => $this->instance->id, 'courseid' => $COURSE->id));

		$addpicurl = new moodle_url('/blocks/simplehtml/pix/add.png');
		$this->content->footer = html_writer::link($url, html_writer::tag('img', '', array('src' => $addpicurl, 'alt' => get_string('addpage'), 'class'=>'crud-options')));
		$this->content->footer .= html_writer::link($url,get_string('addpage', 'block_simplehtml'));
		
		if (!empty($this->config->text)) 
		{
			$this->content->text = $this->config->text;
		}

		// Check to see if we are in editing mode
		$canmanage = $PAGE->user_is_editing($this->instance->id);
		$this->content->text = '';
		// Display links in the block to the pages
		if ($simplehtmlpages = $DB->get_records('block_simplehtml', array('blockid' => $this->instance->id))) 
		{
		    $this->content->text .= html_writer::start_tag('ul',array('class' => 'links'));
		    foreach ($simplehtmlpages as $simplehtmlpage) 
		    {


		    	if($canmanage)
		    	{
			    	$pageparam = array('blockid' => $this->instance->id, 
	                  'courseid' => $COURSE->id, 
	                  'id' => $simplehtmlpage->id);
		            $editurl = new moodle_url('/blocks/simplehtml/view.php', $pageparam);
		            $editpicurl = new moodle_url('/blocks/simplehtml/pix/edit.png');
		            $edit = html_writer::link($editurl, html_writer::tag('img', '', array('src' => $editpicurl, 'alt' => get_string('edit'),'class'=>'crud-options')));

		            $deleteparam = array('id' => $simplehtmlpage->id, 'courseid' => $COURSE->id);
				    $deleteurl = new moodle_url('/blocks/simplehtml/delete.php', $deleteparam);
				    $deletepicurl = new moodle_url('/blocks/simplehtml/pix/delete.png');
				    $delete = html_writer::link($deleteurl, html_writer::tag('img', '', array('src' => $deletepicurl, 'alt' => get_string('delete'),'class'=>'crud-options')));
		    	}
		    	else
		    	{
		    		$edit = '';
		    		$delete = '';
		    	}

		        $pageurl = new moodle_url('/blocks/simplehtml/view.php', array('blockid' => $this->instance->id, 'courseid' => $COURSE->id, 'id' => $simplehtmlpage->id, 'viewpage' => 'true'));
		        $this->content->text .= html_writer::start_tag('li');
		        $this->content->text .= html_writer::link($pageurl, $simplehtmlpage->pagetitle);
		        $this->content->text .= $edit;
		        $this->content->text .= $delete;
		        $this->content->text .= html_writer::end_tag('li');
		    }
		    $this->content->text .= html_writer::end_tag('ul');
		}

	}


	public function instance_delete() 
	{
	    global $DB;
	    $DB->delete_records('block_simplehtml', array('blockid' => $this->instance->id));
	}

	public function instance_allow_multiple() 
	{
  		return true;
	}


	 function has_config() 
	 {
	 	return true;
	 }

	
	
}