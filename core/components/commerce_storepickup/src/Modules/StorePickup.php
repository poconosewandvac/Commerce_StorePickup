<?php

declare(strict_types=1);

namespace PoconoSewVac\StorePickup\Modules;

use modmore\Commerce\Admin\Configuration\About\ComposerPackages;
use modmore\Commerce\Admin\Sections\SimpleSection;
use modmore\Commerce\Events\Admin\PageEvent;
use modmore\Commerce\Modules\BaseModule;
use Symfony\Component\EventDispatcher\EventDispatcher;

require_once dirname(__DIR__, 2) . '/vendor/autoload.php';

class StorePickup extends BaseModule {

    public function getName()
    {
        $this->adapter->loadLexicon('commerce_storepickup:default');
        return $this->adapter->lexicon('commerce_storepickup');
    }

    public function getAuthor()
    {
        return 'Tony Klapatch';
    }

    public function getDescription()
    {
        return $this->adapter->lexicon('commerce_storepickup.description');
    }

    public function initialize(EventDispatcher $dispatcher)
    {
        // Load our lexicon
        $this->adapter->loadLexicon('commerce_storepickup:default');

        // Add the xPDO package, so Commerce can detect the derivative classes
        $root = dirname(__DIR__, 2);
        $path = $root . '/model/';
        $this->adapter->loadPackage('commerce_storepickup', $path);
    }

    public function getModuleConfiguration(\comModule $module)
    {
        $fields = [];

        return $fields;
    }
}
