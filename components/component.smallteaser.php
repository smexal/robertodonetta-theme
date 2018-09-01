<?php

namespace Forge\Themes\Robertodonetta\Components;

use Forge\Core\Abstracts\Component;
use Forge\Core\App\App;
use Forge\Core\Classes\ContentNavigation;
use Forge\Core\Classes\Media;


class SmallteaserComponent extends Component {
    public $settings = array();
    public function prefs() {
        $this->settings = [
            [
                "label" => i('Title 1', 'rodo-theme'),
                "hint" => '',
                "key" => "title1",
                "type" => "text"
            ],
            [
                "label" => i('Text 1', 'rodo-theme'),
                "hint" => 'Bigger leading Text.',
                "key" => "text1",
                "type" => "text"
            ],
            [
                "label" => i('Box Link 1', 'rodo-theme'),
                "hint" => '',
                "key" => "link1",
                "type" => "select",
                "chosen" => true,
                "grouped" => true,
                "values" => ContentNavigation::getPossibleItems()
            ],
            [
                "label" => i('Image 1', 'rodo-theme'),
                "hint" => '',
                "key" => "image1",
                "type" => "image"
            ],
            [
                "label" => i('Title 2', 'rodo-theme'),
                "hint" => '',
                "key" => "title2",
                "type" => "text"
            ],
            [
                "label" => i('Text 2', 'rodo-theme'),
                "hint" => 'Bigger leading Text.',
                "key" => "text2",
                "type" => "text"
            ],
            [
                "label" => i('Box Link 2', 'rodo-theme'),
                "hint" => '',
                "key" => "link2",
                "type" => "select",
                "chosen" => true,
                "grouped" => true,
                "values" => ContentNavigation::getPossibleItems()
            ],
            [
                "label" => i('Image 2', 'rodo-theme'),
                "hint" => '',
                "key" => "image2",
                "type" => "image"
            ],
        ];
        return array(
            'name' => i('Double Teaser', 'rodo-theme'),
            'description' => i('Double Teaser Element with Text & Link', 'rodo-theme'),
            'id' => 'rodo_small_teaser',
            'image' => '',
            'level' => 'inner',
            'container' => false
        );
    }
    public function content() {
        $img1 = new Media($this->getField('image1'));
        $img1 = $img1->getSizedImage(560*2, 346*2);

        $img2 = new Media($this->getField('image2'));
        $img2 = $img2->getSizedImage(560*2, 346*2);

        return App::instance()->render(App::instance()->tm->theme->directory()."templates/components/", "smallteaser", [
            'title1' => $this->getField('title1'),
            'text1' => $this->getField('text1'),
            'link1' => ContentNavigation::parseHashUrl($this->getField('link1')),
            'image1' => $img1,
            'title2' => $this->getField('title2'),
            'text2' => $this->getField('text2'),
            'link2' => ContentNavigation::parseHashUrl($this->getField('link2')),
            'image2' => $img2,
        ]);
    }
    public function customBuilderContent() {
        return App::instance()->render(CORE_TEMPLATE_DIR."components/builder/", "text", array(
            'text' => i('Small Teaser Element', 'rodo-theme')
        ));
    }
}
?>