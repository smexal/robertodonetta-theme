<?php

namespace Forge\Themes\Robertodonetta\Components;

use Forge\Core\App\App;
use Forge\Core\App\ModifyHandler;
use Forge\Core\Components\ListingComponent;
use Forge\Core\Classes\Media;


class DoculistingComponent extends ListingComponent {
    protected $collection = 'rdon-documentation';
    protected $order = 'created';
    protected $oderDirection = 'DESC';

    public function prefs() {
        $this->settings = [
            [
                "label" => i('Title', 'forge-events'),
                "hint" => 'Title, which will be displayed on top of the listing.',
                'key' => 'title',
                'type' => 'text',
            ],
            [
                "label" => i('Display Image', 'forge-events'),
                "hint" => i('Display event image as background.', 'forge-events'),
                'key' => 'display_image',
                'type' => 'checkbox',
            ]
        ];
        return array(
            'name' => i('Documentation Listing', 'forge-events'),
            'description' => i('Listing for the documentation collections.', 'forge-events'),
            'id' => 'rodo-docu-listing',
            'image' => '',
            'level' => 'inner',
            'container' => false
        );
    }

    public function renderItem($item) {
        if($item->getMeta('collection_image')) {
            $image = new Media($item->getMeta('collection_image'));
        } else {
            $image = false;
        }
        $classes = '';
    
        return App::instance()->render(App::instance()->tm->theme->directory()."templates/components/", 'docu-listing', array(
            'classes' => $classes,
            'title' => $item->getMeta('title'),
            'description' => $item->getMeta('description'),
            'image' => $image ? $image->getSizedImage(120, 80) : false,
        ));
    }
}
?>
