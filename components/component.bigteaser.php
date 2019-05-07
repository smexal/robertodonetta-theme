<?php

namespace Forge\Themes\Robertodonetta\Components;

use \Forge\Core\Classes\Media;
use \Forge\Core\Abstracts\Component;
use \Forge\Core\App\App;
use \Forge\Core\Classes\ContentNavigation;



class BigteaserComponent extends Component {
    public $settings = array();
    public function prefs() {
        $this->settings = [
            [
                "label" => i('Title', 'rodo-theme'),
                "hint" => '',
                "key" => "title",
                "type" => "text"
            ],
            [
                "label" => i('Lead Text', 'rodo-theme'),
                "hint" => 'Bigger leading Text.',
                "key" => "lead",
                "type" => "text"
            ],
            [
                "label" => i('Main Text', 'rodo-theme'),
                "hint" => '',
                "key" => "main_text",
                "type" => "wysiwyg"
            ],
            [
                "label" => i('Primary Button Text', 'rodo-theme'),
                "hint" => '',
                "key" => "main_button_text",
                "type" => "text"
            ],
            [
                "label" => i('Primary Button Link', 'rodo-theme'),
                "hint" => '',
                "key" => "main_button_link",
                "type" => "select",
                "values" => ContentNavigation::getPossibleItems(),
                "grouped" => true,
                "chosen" => true
            ],
            [
                "label" => i('Secondary Button Text', 'rodo-theme'),
                "hint" => '',
                "key" => "secondary_button_text",
                "type" => "text"
            ],
            [
                "label" => i('Secondary Button Link', 'rodo-theme'),
                "hint" => '',
                "key" => "secondary_button_link",
                "type" => "select",
                "values" => ContentNavigation::getPossibleItems(),
                "grouped" => true,
                "chosen" => true
            ],
            [
                "label" => i('Third Button Text', 'rodo-theme'),
                "hint" => '',
                "key" => "third_button_text",
                "type" => "text"
            ],
            [
                "label" => i('Third Button Link', 'rodo-theme'),
                "hint" => '',
                "key" => "third_button_link",
                "type" => "select",
                "values" => ContentNavigation::getPossibleItems(),
                "grouped" => true,
                "chosen" => true
            ]
        ];
        return array(
            'name' => i('Teaser', 'rodo-theme'),
            'description' => i('Big Teaser Element with Text and Images', 'rodo-theme'),
            'id' => 'rodo_big_teaser',
            'image' => '',
            'level' => 'inner',
            'container' => false
        );
    }
    public function content() {

        // get image random...
        $image = false;

        // get all header files
        $header_dir = 'themes/robertodonetta/header-images/';
        $dir = DOC_ROOT.$header_dir;
        $header_files = scandir($dir, 1);

        // remove "." and ".." from array
        array_pop($header_files);
        array_pop($header_files);

        $id = rand(0,count($header_files)-1);
        $image = WWW_ROOT.$header_dir.$header_files[$id];


        return App::instance()->render(App::instance()->tm->theme->directory()."templates/components/", "bigteaser", [
            'title' => $this->getField('title'),
            'lead' => $this->getField('lead'),
            'text' => $this->getField('main_text'),
            'btn_text_one' => $this->getField('main_button_text'),
            'btn_url_one' => ContentNavigation::parseHashUrl($this->getField('main_button_link')),
            'btn_text_two' => $this->getField('secondary_button_text'),
            'btn_url_two' => ContentNavigation::parseHashUrl($this->getField('secondary_button_link')),
            'btn_text_three' => $this->getField('third_button_text'),
            'btn_url_three' => ContentNavigation::parseHashUrl($this->getField('third_button_link')),
            'image' => $image
        ]);
    }
    public function customBuilderContent() {
        return App::instance()->render(CORE_TEMPLATE_DIR."components/builder/", "text", array(
            'text' => i('Big Teaser Element', 'rodo-theme')
        ));
    }
}
?>