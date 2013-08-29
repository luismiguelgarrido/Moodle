<?php
/**
 * Theme version info
 *
 * @package    theme
 * @subpackage bootstrap3
 * @copyright  2013 Luis Miguel Garrido, https://github.com/luismiguelgarrido
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
*/

defined('MOODLE_INTERNAL') || die();

function bootstrap_user_settings($css, $theme) {
    global $CFG;
    if (!empty($theme->settings->customcss)) {
        $customcss = $theme->settings->customcss;
    } else {
        $customcss = null;
    }

    $tag = '[[setting:customcss]]';
    $css = str_replace($tag, $customcss, $css);

    
    if ($theme->settings->enableglyphicons == 1) {
        $bootstrapicons = '
        [class ^="icon-"],[class *=" icon-"] { background-image: url("'.$CFG->wwwroot.'/theme/image.php?theme=bootstrap3&component=theme&image=glyphicons-halflings"); }';
        $css .= $bootstrapicons;
    }

    return $css;
}