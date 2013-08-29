<?php
/**
 * Theme version info
 *
 * @package    theme
 * @subpackage bootstrap3
 * @copyright  2013 Luis Miguel Garrido, https://github.com/luismiguelgarrido
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
*/

$trackurl = '';

global $DB;
if ($COURSE->id != 1 ){
    $userroles = get_user_roles_in_course($USER->id,$COURSE->id);
	$trackurl .= '/' . strip_tags($userroles);
	if ($category = $DB->get_record('course_categories',array('id'=>$COURSE->category))){
	    $trackurl .= '/' . urlencode($category->name);
	}
	$trackurl .= '/' . urlencode($COURSE->shortname);
}

$navbar = $OUTPUT->page->navbar->get_items();

$first = array_shift($navbar);

foreach ($navbar as $item) {
    if ($item->type == "30") {
        $trackurl .= '/' . urlencode($item->title) ;
    }
    if ($item->type == "40") {
        $trackurl .= '/' . urlencode($item->text) ;
        $trackurl .= '/' . urlencode($item->title) ;
    }
    if ($item->type == "60") {
        $trackurl .= '/' . urlencode($item->title) ;
    }
}
?>

<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', '<?php echo $PAGE->theme->settings->gakey;?>']);
  _gaq.push(['_trackPageview','<?php echo $trackurl;?>']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>

