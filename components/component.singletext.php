<?php

namespace Forge\Themes\Robertodonetta\Components;

use Forge\Core\Abstracts\Component;
use Forge\Core\App\App;
use Forge\Core\Classes\ContentNavigation;
use Forge\Core\Classes\Media;


class SingletextComponent extends Component {
    public $settings = array();
    public function prefs() {
        $this->settings = [
            [
                "label" => i('Title', 'rodo-theme'),
                "hint" => '',
                "key" => "text",
                "type" => "wysiwyg"
            ],
            [
                "label" => i('Image', 'rodo-theme'),
                "hint" => 'An Image which will be placed on the top right of the text.',
                "key" => "image",
                "type" => "image"
            ]
        ];
        return array(
            'name' => i('Single Text', 'rodo-theme'),
            'description' => i('For long text elements.', 'rodo-theme'),
            'id' => 'rodo_text',
            'image' => '',
            'level' => 'inner',
            'container' => false
        );
    }
    public function content() {
        $img = new Media($this->getField('image'));
        return App::instance()->render(App::instance()->tm->theme->directory()."templates/components/", "text", [
            'text' => $this->getField('text'),
            'image' => $img->getUrl()
        ]);
    }
    public function customBuilderContent() {
        return App::instance()->render(CORE_TEMPLATE_DIR."components/builder/", "text", array(
            'text' => i('Text-Block', 'rodo-theme')
        ));
    }
}
?>