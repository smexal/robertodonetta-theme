<?php

namespace Forge\Themes\Robertodonetta\Components;

use Forge\Core\Abstracts\Component;
use Forge\Core\App\App;
use Forge\Core\Classes\ContentNavigation;


class SmallteaserComponent extends Component {
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
                "label" => i('Text', 'rodo-theme'),
                "hint" => 'Bigger leading Text.',
                "key" => "text",
                "type" => "text"
            ],
            [
                "label" => i('Box Link', 'rodo-theme'),
                "hint" => '',
                "key" => "link",
                "type" => "select",
                "values" => ContentNavigation::getPossibleItems()
            ]
        ];
        return array(
            'name' => i('Small Teaser', 'rodo-theme'),
            'description' => i('Small Teaser Element with Text & Link', 'rodo-theme'),
            'id' => 'rodo_small_teaser',
            'image' => '',
            'level' => 'inner',
            'container' => false
        );
    }
    public function content() {

        return App::instance()->render(App::instance()->tm->theme->directory()."templates/components/", "smallteaser", [
            'title' => $this->getField('title'),
            'text' => $this->getField('text'),
            'link' => ContentNavigation::parseHashUrl($this->getField('link'))
        ]);
    }
    public function customBuilderContent() {
        return App::instance()->render(CORE_TEMPLATE_DIR."components/builder/", "text", array(
            'text' => i('Small Teaser Element', 'rodo-theme')
        ));
    }
}
?>