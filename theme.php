<?php

namespace Forge\Themes\Robertodonetta;

use \Forge\Core\App\App;
use \Forge\Core\Abstracts\Theme;
use \Forge\Core\App\Auth;
use \Forge\Core\Classes\ContentNavigation;
use \Forge\Core\Classes\Fields;
use \Forge\Core\Classes\Localization;
use \Forge\Core\Classes\Settings;
use \Forge\Core\Classes\Utils;




class RobertodonettaTheme extends Theme {
    public $lessVariables = [
        'color-brand' => '#D32F2F', //'#D32F2F',
        'color-grey' => '#ABABAB',
        'color-grey-dark' => '#222222',
        'color-grey-medium' => 'rgba(0,0,13,0.6)',
        'color-grey-light' => '#F2F2F2',
        'color-grey-lightest' => '#F8F8F8',
        'color-grey-on-white' => 'rgba(255, 255, 255, 0.4)',
        'color-grey-dark-on-white' => '#4C4C4C'
    ];

    public function tinyUrl() {
        return $this->url().'css/compiled/main.css';
    }

    public function tinyFormats() {
        return [
            [
                'title' => i('Heading 1', 'rodo-theme'),
                'block' => 'h1'
            ],
            [
                'title' => i('Heading 2', 'rodo-theme'),
                'block' => 'h2'
            ],
            [
                'title' => i('Heading 3', 'rodo-theme'),
                'block' => 'h3'
            ],
            [
                'title' => i('Alternative paragraph', 'rodo-theme'),
                'selector' => 'p',
                'classes' => 'alternative'
            ],
            [
                'title' => i('Lead Text', 'rodo-theme'),
                'selector' => 'p',
                'classes' => 'lead'
            ],
        ];
    }

    public function start() {
        $this->addSettingsFields();
        $this->registerNavigations();
    }

    public function globals() {
        $searchView = App::instance()->vm->getViewByName('search');

        $curTitle = false;
        if(count(Utils::getUriComponents()) > 1 && App::instance()->page) {
            $curTitle = App::instance()->page->getMeta('title');
        }

        return [
            'logo' => $this->url().'images/logo.svg',
            'home_url' => Utils::getHomeUrl(),
            'shopping_cart' => \Forge\Modules\ForgeShoppingcart\Cart::trigger(),
            'main_title' => Settings::get('rodo-main-title-'.Localization::getCurrentLanguage()),
            'primary_navigation' => ContentNavigation::getNavigationList('primary-nav'),
            'secondary_navigation' => ContentNavigation::getNavigationList('secondary-nav'),
            'footer_copyright' => Settings::get('rodo-footer-copyright-'.Localization::getCurrentLanguage()),
            'footer_webdesign' => Settings::get('rodo-footer-webdesign-'.Localization::getCurrentLanguage()),
            'footer_navigation' => ContentNavigation::getNavigationList('footer-nav'),
            'lang_selection' => Localization::getLanguageSelection(),
            'search_base' => $searchView->buildURL(),
            'curTitle' => $curTitle,
            'fb_image' => Utils::getHomeUrl().'themes/robertodonetta/images/facebook.svg'
        ];
    }

    private function registerNavigations() {
        ContentNavigation::registerPosition('primary-nav', i('Main Navigation', 'rodo-theme'));
        ContentNavigation::registerPosition('secondary-nav', i('Secondary Navigation', 'rodo-theme'));
        ContentNavigation::registerPosition('footer-nav', i('Footer Navigation', 'rodo-theme'));
    }

    public function styles() {
        // load core if wanted...
        $this->addStyle(CORE_WWW_ROOT."ressources/css/externals/bootstrap.core.min.css", true);


        $this->addStyle($this->directory()."css/reset.less");
        $this->addStyle($this->directory()."css/animations.less");
        $this->addStyle($this->directory()."css/main.less");
        $this->addStyle($this->directory()."css/overlay.less");
        $this->addStyle($this->directory()."css/header.less");
        $this->addStyle($this->directory()."css/footer.less");

        // externals
        $this->addStyle("//fonts.googleapis.com/css?family=Lora:400,400i,700,700i", true);
        $this->addStyle('//fonts.googleapis.com/css?family=Roboto:700', true);

        // blocks
        $this->addStyle($this->directory()."css/blocks/rd_arrow.less");
        $this->addStyle($this->directory()."css/blocks/rd_button.less");
        $this->addStyle($this->directory()."css/blocks/rd_bigteaser.less");
        $this->addStyle($this->directory()."css/blocks/rd_smallteaser.less");
        $this->addStyle($this->directory()."css/blocks/rd_longtext.less");
        $this->addStyle($this->directory()."css/blocks/rd_forms.less");
        $this->addStyle($this->directory()."css/blocks/rd_listings.less");
        $this->addStyle($this->directory()."css/blocks/rd_collection.less");
        $this->addStyle($this->directory()."css/blocks/rd_components.less");

        $this->addStyle($this->directory()."css/responsive.less");
    }

    public function scripts() {
        $this->addScript(CORE_WWW_ROOT."ressources/scripts/externals/jquery.js", true, 0);
        $this->addScript(CORE_WWW_ROOT."ressources/scripts/externals/bootstrap.js", true);
        $this->addScript(CORE_WWW_ROOT."ressources/scripts/helpers.js", true);

        $this->addScript($this->url(). '/scripts/navigation.js', true);
        $this->addScript($this->url(). '/scripts/overlay.js', true);
    }

    public function customHeader() {
        return App::instance()->render($this->directory().'templates/', "head", array(
            'favicon_url' => $this->url().'images/favicon/',
            'color' => $this->lessVariables['color-brand']
        ));
    }

    private function addSettingsFields() {
        if(! Auth::allowed("manage.settings", true)) {
            return;
        }

        Settings::addTab('rodo-theme', i('Roberto Donetta Theme', 'rodo-theme'));

        $settings = Settings::instance();
        $key = 'rodo-main-title-'.Localization::getCurrentLanguage();
        $settings->registerField(
            Fields::text(array(
            'key' => $key,
            'label' => i('Define the title for the page.', 'rodo-theme'),
            'hint' => ''
        ), Settings::get($key)), $key, 'left', 'rodo-theme');

        $key = 'rodo-footer-copyright-'.Localization::getCurrentLanguage();
        $settings->registerField(
            Fields::text(array(
            'key' => $key,
            'label' => i('Copyright Text on the bottom left.', 'rodo-theme'),
            'hint' => ''
        ), Settings::get($key)), $key, 'right', 'rodo-theme');

        $key = 'rodo-footer-webdesign-'.Localization::getCurrentLanguage();
        $settings->registerField(
            Fields::text(array(
            'key' => $key,
            'label' => i('Webdesign By Text', 'rodo-theme'),
            'hint' => ''
        ), Settings::get($key)), $key, 'right', 'rodo-theme');
    }
}

?>
