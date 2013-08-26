<?php
/**
 * Theme version info
 *
 * @package    theme
 * @subpackage bootstrap3
 * @copyright  2013 Luis Miguel Garrido, https://github.com/luismiguelgarrido
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
*/

class theme_bootstrap3_core_renderer extends core_renderer {
    public function heading($text, $level = 2, $classes = 'main', $id = null) {
        global $COURSE;
        $topicoutline = get_string('topicoutline');
        if ($text == $topicoutline) {
            $text = '';
        }
        if ($text == get_string('weeklyoutline')) {
            $text = '';
        }
        $content = parent::heading($text, $level, $classes, $id);
        return $content;
    }
    public function navbar() {
        $items = $this->page->navbar->get_items();
        $htmlblocks = array();
        $itemcount = count($items);
        $separator =  '&nbsp;/ ';
        for ($i=0;$i < $itemcount;$i++) {
            $item = $items[$i];
            if ($item->type == "0" || $item->type == "30") {
                continue;
            }
            $item->hideicon = true;
            if ($i===0) {
                $content = html_writer::tag('li', $this->render($item));
            } else {
                $content = html_writer::tag('li', $separator.$this->render($item));
            }
            $htmlblocks[] = $content;
        }
        $navbarcontent = html_writer::tag('span', get_string('pagepath'), array('class'=>'accesshide'));
        $navbarcontent .= html_writer::tag('ul', join('', $htmlblocks));
        return $navbarcontent;
    }

    static $icons = array(
            'docs' => 'question-sign',
            'book' => 'book',
            'chapter' => 'file',
            'spacer' => 'spacer',
            'generate' => 'gift',
            'add' => 'plus',
            't/hide' => 'eye-open',
            'i/hide' => 'eye-open',
            't/show' => 'eye-close',
            'i/show' => 'eye-close',
            't/assignroles' => 'icon-glass',
            't/add' => 'plus',
            't/right' => 'arrow-right',
            't/left' => 'arrow-left',
            't/up' => 'arrow-up',
            't/down' => 'arrow-down',
            't/edit' => 'edit',
            't/editstring' => 'tag',
            't/copy' => 'repeat',
            't/delete' => 'remove',
            'i/edit' => 'pencil',
            'i/settings' => 'list-alt',
            'i/grades' => 'grades',
            'i/group' => 'user',
            't/groupn' => 'share-alt',
            't/switch_plus' => 'plus-sign',
            't/switch_minus' => 'minus-sign',
            'i/filter' => 'filter',
            't/move' => 'resize-vertical',
            'i/move_2d' => 'move',
            'i/backup' => 'cog',
            'i/restore' => 'cog',
            'i/return' => 'repeat',
            'i/reload' => 'refresh',
            'i/roles' => 'user',
            'i/user' => 'user',
            'i/users' => 'user',
            'i/publish' => 'publish',
            'i/navigationitem' => 'chevron-right' );

    public function block_controls($controls) {
        if($this->page->theme->settings->enableglyphicons) {
            if (empty($controls)) {
                return '';
            }
            $controlshtml = array();
            foreach ($controls as $control) {
                $controlshtml[] = self::a(array('href'=>$control['url'], 'title'=>$control['caption']), self::moodle_icon($control['icon']));
            }
            return self::div(array('class'=>'commands'), implode($controlshtml));
        } else {
            return parent::block_controls($controls);
        }
    }

    protected static function a($attributes, $content) {
        return html_writer::tag('a', $content, $attributes);
    }

    protected static function div($attributes, $content) {
        return html_writer::tag('div', $content, $attributes);
    }

    protected static function span($attributes, $content) {
        return html_writer::tag('span', $content, $attributes);
    }

    protected static function icon($name, $text=null) {
        if (!$text) {$text = $name;}
		return "<i class='glyphicon glyphicon-$name'></i>";
    }
    protected static function moodle_icon($name) {
        return self::icon(self::$icons[$name]);
    }
    public function icon_help() {
        return self::icon('question-sign');
    }

    public function action_icon($url, pix_icon $pixicon, component_action $action = null, array $attributes = null, $linktext=false) {
        if($this->page->theme->settings->enableglyphicons) {
             
            if (!($url instanceof moodle_url)) {
                $url = new moodle_url($url);
            }
            $attributes = (array)$attributes;

            if (empty($attributes['class'])) {
                $attributes['class'] = 'action-icon';
            }

            $icon = $this->render($pixicon);

            if ($linktext) {
                $text = $pixicon->attributes['alt'];
            } else {
                $text = '';
            }

            return $this->action_link($url, $text.$icon, $action, $attributes);
        } else {
             return parent::action_icon($url, $pixicon, $action, $attributes , $linktext);
        }
    }
     
    protected function render_pix_icon(pix_icon $icon) {
        if($this->page->theme->settings->enableglyphicons) {
            if (isset(self::$icons[$icon->pix])) {
                return self::icon(self::$icons[$icon->pix]);
            } else {
                return parent::render_pix_icon($icon);
            }
        } else {
            return parent::render_pix_icon($icon);
        }

    }

}
?>
