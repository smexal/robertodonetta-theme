<?php

namespace Forge\Themes\Robertodonetta\Collections;

use Forge\Core\Classes\Builder;
use \Forge\Core\Abstracts\DataCollection;
use \Forge\Core\Classes\Localization;
use \Forge\Core\App\App;



class DocumentationCollection extends DataCollection {
    public $permission = "manage.collection.sites";

    protected function setup() {
        $this->preferences['name'] = 'rdon-documentation';
        $this->preferences['title'] = i('Documentation', 'rodo-theme');
        $this->preferences['all-title'] = i('Manage Documentation', 'rodo-theme');
        $this->preferences['add-label'] = i('Add Documentation', 'rodo-theme');
        $this->preferences['single-item'] = i('Documentation', 'rodo-theme');
        $this->preferences['has_categories'] = true;
        $this->preferences['has_status'] = true;
        $this->preferences['has_image'] = true;

        $this->custom_fields();
    }

    public function render($item) {
        return;
    }

    private function custom_fields() {
        $this->addFields(
        [
            [
                'key' => 'main_text',
                'label' => i('Text', 'forge-events'),
                'multilang' => true,
                'type' => 'wysiwyg',
                'order' => 30,
                'position' => 'left',
                'hint' => ''
            ],  
        ]);
    }
}

?>
