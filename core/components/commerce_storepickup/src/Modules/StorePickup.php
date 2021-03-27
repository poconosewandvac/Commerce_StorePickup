<?php

declare(strict_types=1);

namespace PoconoSewVac\StorePickup\Modules;

use modmore\Commerce\Admin\Configuration\About\ComposerPackages;
use modmore\Commerce\Admin\Sections\SimpleSection;
use modmore\Commerce\Events\Admin\PageEvent;
use modmore\Commerce\Modules\BaseModule;
use modmore\Commerce\Events\Checkout;
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

        $dispatcher->addListener(\Commerce::EVENT_CHECKOUT_AFTER_STEP, [$this, 'setShippingAddress']);
    }

    public function setShippingAddress(Checkout $event)
    {
        $stepKey = $event->getStepKey();

        if ($stepKey !== 'shipping') {
            return;
        }

        $order = $event->getOrder();
        $shippingAddress = $order->getShippingAddress();
        $billingAddress = $order->getBillingAddress();
        $shipments = $order->getShipments();

        foreach ($shipments as $shipment) {
            $shippingMethod = $shipment->getShippingMethod();
            if (!($shippingMethod instanceof \StorePickupShippingMethod)) {
                continue;
            }

            // Add on customer specific information to store pickup shipping address
            $newAddress = array_merge($shippingMethod->getAddress(), [
                'email' => $shippingAddress->get('email'),
                'phone' => $shippingAddress->get('phone'),
            ]);

            // Add new address if shipping and billing are the same to prevent the billing address from changing
            if ($shippingAddress === $billingAddress) {
                // if ship adr is same as bill adr, update to set previous ship adr to be the new bill adr
                if ($shippingAddress->get('type') === 'shipping') {
                    $shippingAddress->set('type', 'billing');
                    $shippingAddress->save();
                }

                $newShippingAddress = $this->adapter->newObject('comOrderAddress');
                $newShippingAddress->fromArray($newAddress);
                $order->addAddress($newShippingAddress, 'shipping');
            } else {
                $shippingAddress->fromArray($newAddress);
                $shippingAddress->save();
            }
        }
    }

    public function getModuleConfiguration(\comModule $module)
    {
        $fields = [];

        return $fields;
    }
}
