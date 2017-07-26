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
                "values" => ContentNavigation::getPossibleItems()
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
                "values" => ContentNavigation::getPossibleItems()
            ],
            [
                "label" => i('Image One', 'rodo-theme'),
                "hint" => '',
                "key" => "image_one",
                "type" => "image"
            ],
            [
                "label" => i('Image Two', 'rodo-theme'),
                "hint" => '',
                "key" => "image_two",
                "type" => "image"
            ],
            [
                "label" => i('Layout Type', 'rodo-theme'),
                "hint" => '',
                "key" => "layout_type",
                "type" => "select",
                "values" => [
                    'type_one' => i('Type #1 - Text on the left, images on the right.', 'rodo-theme'),
                    'type_two' => i('Type #2 - Text in the center, images left and right.', 'rodo-theme')
                ]
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
        $imgOne = new Media($this->getField('image_one'));
        $imgOne = $imgOne->getUrl(true);
        $imgTwo = new Media($this->getField('image_two'));
        $imgTwo = $imgTwo->getUrl(true);

        return App::instance()->render(App::instance()->tm->theme->directory()."templates/components/", "bigteaser", [
            'layout_type' => $this->getField('layout_type'),
            'title' => $this->getField('title'),
            'lead' => $this->getField('lead'),
            'text' => $this->getField('main_text'),
            'btn_text_one' => $this->getField('main_button_text'),
            'btn_url_one' => ContentNavigation::parseHashUrl($this->getField('main_button_link')),
            'btn_text_two' => $this->getField('secondary_button_text'),
            'btn_url_two' => ContentNavigation::parseHashUrl($this->getField('secondary_button_link')),
            'image_one' => $imgOne,
            'image_two' => $imgTwo
        ]);
    }
    public function customBuilderContent() {
        return App::instance()->render(CORE_TEMPLATE_DIR."components/builder/", "text", array(
            'text' => i('Big Teaser Element', 'rodo-theme')
        ));
    }
}
?>