<?php
/**
 * Theme version info
 *
 * @package    theme
 * @subpackage bootstrap3
 * @copyright  2013 Luis Miguel Garrido, https://github.com/luismiguelgarrido
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
*/

defined('MOODLE_INTERNAL') || die;

if ($ADMIN->fulltree) {
    
    $name = 'theme_bootstrap3/notes';
    $heading = get_string('notes', 'theme_bootstrap3');
    $information = get_string('notesdesc', 'theme_bootstrap3');
    $setting = new admin_setting_heading($name, $heading, $information);
    $settings->add($setting);
	
	$name = 'theme_bootstrap3/logo_url';
    $title = get_string('logo_url','theme_bootstrap3');
    $description = get_string('logo_urldesc', 'theme_bootstrap3');
    $setting = new admin_setting_configtext($name, $title, $description, '', PARAM_URL);
    $settings->add($setting);
    
    $name = 'theme_bootstrap3/customcss';
    $title = get_string('customcss','theme_bootstrap3');
    $description = get_string('customcssdesc', 'theme_bootstrap3');
    $default = '';
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $settings->add($setting);
    
    $name = 'theme_bootstrap3/gakey';
	$title = get_string('gakey','theme_bootstrap3');
	$description = get_string('gakeydesc', 'theme_bootstrap3');
	$setting = new admin_setting_configtext($name, $title, $description, '');
	$settings->add($setting);

}