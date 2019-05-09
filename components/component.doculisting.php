<?php

namespace Forge\Themes\Robertodonetta\Components;

use Forge\Core\App\App;
use Forge\Core\App\ModifyHandler;
use Forge\Core\Components\ListingComponent;
use Forge\Core\Classes\Media;
use Forge\Core\Classes\Localization;


class DoculistingComponent extends ListingComponent {
    protected $collection = 'rdon-documentation';
    protected $order = 'created';
    protected $orderDirection = 'ASC';

    public function prefs() {
        ModifyHandler::instance()->add('modify_collection_listing_items', [$this, 'modifyFilterListingItems']);

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

    public function modifyFilterListingItems($items) {
        $filtered = [];
        // nothing to filter...
        if(! array_key_exists('f', $_GET) || $_GET['f'] == 0 ) {
            return $items;
        }

        foreach($items as $item) {
            $categories = $item->getMeta('categories');
            if(! is_array($categories)) {
                continue;
            }
            if(in_array($_GET['f'], $categories)) {
                $filtered[] = $item;
            }
        }

        return $filtered;
    }

    public function getFilter() {
        $collection = App::instance()->cm->getCollection('rdon-documentation');
        $categories = $collection->getCategories();
        $lang = Localization::getCurrentLanguage();
        $add = '';
        if(! array_key_exists('f', $_GET) || $_GET['f'] == 0) {
            $add = 'class="active"';
        }
        $return = '<a href="?f=0" '.$add.'>'.i('Show all', 'rodo-theme.').'</a>';
        foreach($categories as $cat) {
            $catMeta = json_decode($cat['meta']);
            $addClass = '';
            if(array_key_exists('f', $_GET) && $_GET['f'] == $cat['id']) {
                $addClass= 'active';
            }
            $return.='<a href="?f='.$cat['id'].'" class="'.$addClass.'">'.$catMeta->$lang->name.'</a>';
        }
        return $return;
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
            'detailLink' => $item->url()
        ));
    }
}
?>
