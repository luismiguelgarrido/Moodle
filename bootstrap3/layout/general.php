<?php
/**
 * Theme version info
 *
 * @package    theme
 * @subpackage bootstrap3
 * @copyright  2013 Luis Miguel Garrido, https://github.com/luismiguelgarrido
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
*/

$hasheading = ($PAGE->heading);
$hasnavbar = (empty($PAGE->layout_options['nonavbar']) && $PAGE->has_navbar());
$hasfooter = (empty($PAGE->layout_options['nofooter']));
$hasheader = (empty($PAGE->layout_options['noheader']));
$hassidepre = $PAGE->blocks->region_has_content('side-pre', $OUTPUT);
$hassidepost = $PAGE->blocks->region_has_content('side-post', $OUTPUT);
$showsidepre = ($hassidepre && !$PAGE->blocks->region_completely_docked('side-pre', $OUTPUT));
$showsidepost = ($hassidepost && !$PAGE->blocks->region_completely_docked('side-post', $OUTPUT));
$custommenu = $OUTPUT->custom_menu();
$hascustommenu = (empty($PAGE->layout_options['nocustommenu']) && !empty($custommenu));
$bodyclasses = array();
if ($showsidepre && !$showsidepost) {
    $bodyclasses[] = 'side-pre-only';
} else if ($showsidepost && !$showsidepre) {
    $bodyclasses[] = 'side-post-only';
} else if (!$showsidepost && !$showsidepre) {
    $bodyclasses[] = 'content-only';
}
if ($hascustommenu) {
    $bodyclasses[] = 'has_custom_menu';
}
$doctype = $OUTPUT->doctype() ?>

<!DOCTYPE html>
<html <?php echo $OUTPUT->htmlattributes() ?>>
    <head>
        <meta charset="utf-8">
        <title><?php echo $PAGE->title ?></title>
        <meta name="description" content="<?php p(strip_tags(format_text($SITE->summary, FORMAT_HTML))) ?>" />
        <link rel="shortcut icon" href="<?php echo $OUTPUT->pix_url('favicon', 'theme')?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php echo $OUTPUT->standard_head_html() ?>
        <?php include($CFG->dirroot . "/theme/bootstrap3/layout/analytics.php"); ?>
    </head>

    <body id="<?php p($PAGE->bodyid) ?>" class="<?php p($PAGE->bodyclasses.' '.join(' ', $bodyclasses)) ?>">
		<?php echo $OUTPUT->standard_top_of_body_html() ?>
        
        <?php if ($hascustommenu) { ?>
            <div id="custommenuwrap">
                <nav id="custommenu">
                    <?php echo $custommenu; ?>
                </nav>
            </div>
        <?php } ?>
        
        <div id="page" class="container">
        
            <?php if ($hasheader) { ?>
            <!-- START OF HEADER -->
                <header id="page-header" class="row">
					<section class="headerlogo col-lg-12 col-md-12 col-sm-12">
						<img src="<?php echo $PAGE->theme->settings->logo_url; ?>">
                    </section>
					<section class="headermenu">
						<?php echo $PAGE->headingmenu;?>
					</section>
					<?php if ($hasnavbar) { ?>
					<footer class="col-lg-12 col-md-12 col-sm-12">
						<div class="breadcrumb"><?php echo $OUTPUT->navbar(); ?></div>
						<div class="navbutton"> <?php echo $PAGE->button; ?></div>
					</footer>
					<?php } ?>
                </header>
            <!-- END OF HEADER -->
            <?php } ?>
            
            <!--  BOOTSTRAP RESPONSIVE -->
            <div role="main">
                <article id="page-content" class="row">
                    <?php if ($hassidepre) { ?>
                        <aside class="col-lg-3 col-md-3 col-sm-4">
                        <?php echo $OUTPUT->blocks_for_region('side-pre') ?>
                        </aside>
                    <?php } ?>
                    <?php if($hassidepre && $hassidepost){ ?>
                        <section class="col-lg-6 col-md-6 col-sm-6">
                    <?php }elseif($hassidepre || $hassidepost){ ?>
                        <section class="col-lg-9 col-md-9 col-sm-8">
                    <?php }else{ ?>
                        <section class="col-lg-12 col-md-12 col-sm-12">
                    <?php } echo $OUTPUT->main_content() ?>
                        </section>
                        
                    <?php if ($hassidepost) { ?>                
                        <section class="col-lg-3 col-md-3 col-sm-3">
                        <?php echo $OUTPUT->blocks_for_region('side-post') ?>
                        </section>
                    <?php }; ?>          
                </article>
            <!--  END BOOTSTRAP RESPONSIVE -->
        
            <!-- START OF FOOTER -->
                <footer id="page-footer" class="row">
                	<div class="col-lg-6 col-md-6 col-sm-6">
                        <p class="helplink">
                            <?php echo page_doc_link(get_string('moodledocslink')) ?>
                        </p>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
							<div class="pull-right"><?php echo $OUTPUT->lang_menu();?></div>
                    	</div>
                    </div>
					<?php echo $OUTPUT->standard_footer_html();?>
                </footer>
            <!-- END OF FOOTER -->
            </div>
            
        </div><!-- END OF PAGE -->
    
     	<?php echo $OUTPUT->standard_end_of_body_html() ?>

    <!----------------------- JAVASCRIPTS ------------------------>
    <script src="http://code.jquery.com/jquery-1.9.0.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
    <script src="<?php echo $CFG->wwwroot;?>/theme/bootstrap3/js/bootstrap.min.js"></script>
    <script src="<?php echo $CFG->wwwroot;?>/theme/bootstrap3/js/bootstrap-select.min.js"></script>
    <script src="<?php echo $CFG->wwwroot;?>/theme/bootstrap3/js/jquery-selectBoxIt.min.js"></script>
    <script>
        $(window).on('load', function () {
            $('#id_auth').selectpicker();
        });
        $("select").selectBoxIt();
        $('#id_auth').selectpicker();
        $('table').addClass('col-lg-8 col-md-8 col-sm-8 col-xs-8');
    </script>
    </body>
</html>