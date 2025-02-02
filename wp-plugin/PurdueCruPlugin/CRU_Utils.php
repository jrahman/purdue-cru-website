<?php

class CRU_Utils {

    /**
     * Retrieve the results for any action which redirected to the current page
     *
     * @return mixed An associative array with a message and success code, FALSE if no result
     */
    public static function get_action_result() {
        $action_result = array();
        if (CRU_Utils::get_request_param('success') !== FALSE) {
            $action_result['success'] = CRU_Utils::get_request_param('success');
        } 
        if (CRU_Utils::get_request_param('message') !== FALSE) {
            $action_result['message'] = CRU_Utils::get_request_param('message');
        }
        if (isset($action_result['success']) && isset($action_result['message'])) {
            return $action_result;
        } else {
            return FALSE;
        }
    }

    /*
     *
     * Print result passed in URI from the dispatch page
     *
     */
    public static function print_action_result($action_result) {?>
<div id="action-message" <?php if ($action_result !== FALSE) {if ($action_result['success']) echo('class="updated"'); else echo('class="error"');} ?>>
    <p>
    <?php 
	    // Print the result message if defined
	    if($action_result !== FALSE)
		    echo(htmlspecialchars(urldecode($action_result['message']))); 
    ?>
    </p>
</div>
    <?php
    }


    /**
     * Get a action request parameter from POST or GET data
     *
     * @param string key the name of the parameter
     * @return mixed the string value of the parameter if the key was found, FALSE otherwise
     */
    public static function get_request_param($key) {
        if (isset($_POST[$key])) {
            return $_POST[$key];
        } else if (isset($_GET[$key])) {
            return $_GET[$key];
        } else {
            return FALSE;
        }   
    }


    /**
     * Constants for table names (without Wordpress prefix)
     *
     * @var string
     */
    const _small_groups_table   = "cru_small_groups";
    const _target_areas_table   = "cru_target_areas";
    const _area_contacts_table  = "cru_area_contacts";
    const _provider_table       = "cru_wireless_providers";


    /**
     * Constants defining the various affilition types
     *
     */
    const _student_group_leader = 0;
	const _student_area_leader  = 1;
    const _staff_area_leader    = 5;

	public static $_affiliation_names = array(
		CRU_Utils::_student_group_leader    => "Student Group Leader",
		CRU_Utils::_staff_area_leader       => "Staff Area Leader",
		CRU_Utils::_student_area_leader     => "Student Area Leader"
	);


    /**
     * Regexs for various input data types
     *
     * @var string
     */
    const _phone_number_regex   = "/^[2-9][0-9][0-9]-[2-9][0-9][0-9]-[0-9]{4,4}$/";
    const _id_regex             = "/^[:digit:]+$/";
    const _email_regex          = "/^  @ $/";
}
?>
