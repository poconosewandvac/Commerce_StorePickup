<?php

declare(strict_types=1);

use modmore\Commerce\Admin\Widgets\Form\CountryField;
use modmore\Commerce\Admin\Widgets\Form\TextareaField;
use modmore\Commerce\Admin\Widgets\Form\TextField;
use modmore\Commerce\Admin\Widgets\Form\Validation\Required;
use modmore\Commerce\Admin\Widgets\Form\Tab;

/**
 * StorePickup for Commerce.
 *
 * Copyright 2021 by Tony Klapatch <tony@klapatch.net>
 *
 * This file is meant to be used with Commerce by modmore. A valid Commerce license is required.
 *
 * @package commerce_storepickup
 * @license See core/components/commerce_storepickup/docs/license.txt
 */
class StorePickupShippingMethod extends comShippingMethod
{
    public function getModelFields()
    {
        $fields = [];

        $fields[] = new Tab($this->commerce, [
            'label' => $this->adapter->lexicon('commerce_storepickup.pickup_address'),
            'description' => $this->adapter->lexicon('commerce_storepickup.pickup_address_desc'),
        ]);

        $fields[] = new TextField($this->commerce, [
            'name' => 'properties[fullname]',
            'label' => $this->adapter->lexicon('commerce.address.fullname'),
            'value' => $this->getProperty('fullname'),
        ]);

        $fields[] = new TextField($this->commerce, [
            'name' => 'properties[firstname]',
            'label' => $this->adapter->lexicon('commerce.address.firstname'),
            'value' => $this->getProperty('firstname'),
        ]);

        $fields[] = new TextField($this->commerce, [
            'name' => 'properties[lastname]',
            'label' => $this->adapter->lexicon('commerce.address.lastname'),
            'value' => $this->getProperty('lastname'),
        ]);

        $fields[] = new TextField($this->commerce, [
            'name' => 'properties[email]',
            'label' => $this->adapter->lexicon('commerce.address.email'),
            'value' => $this->getProperty('email'),
        ]);

        $fields[] = new TextField($this->commerce, [
            'name' => 'properties[company]',
            'label' => $this->adapter->lexicon('commerce.address.company'),
            'value' => $this->getProperty('company'),
        ]);

        $fields[] = new TextField($this->commerce, [
            'name' => 'properties[address1]',
            'label' => $this->adapter->lexicon('commerce.address.address1'),
            'value' => $this->getProperty('address1'),
        ]);

        $fields[] = new TextField($this->commerce, [
            'name' => 'properties[address2]',
            'label' => $this->adapter->lexicon('commerce.address.address2'),
            'value' => $this->getProperty('address2'),
        ]);

        $fields[] = new TextField($this->commerce, [
            'name' => 'properties[address3]',
            'label' => $this->adapter->lexicon('commerce.address.address3'),
            'value' => $this->getProperty('address3'),
        ]);

        $fields[] = new TextField($this->commerce, [
            'name' => 'properties[zip]',
            'label' => $this->adapter->lexicon('commerce.address.zip'),
            'value' => $this->getProperty('zip'),
        ]);

        $fields[] = new TextField($this->commerce, [
            'name' => 'properties[city]',
            'label' => $this->adapter->lexicon('commerce.address.city'),
            'value' => $this->getProperty('city'),
        ]);

        $fields[] = new TextField($this->commerce, [
            'name' => 'properties[state]',
            'label' => $this->adapter->lexicon('commerce.address.state'),
            'value' => $this->getProperty('state'),
        ]);

        $fields[] = new CountryField($this->commerce, [
            'name' => 'properties[country]',
            'label' => $this->adapter->lexicon('commerce.address.country'),
            'value' => $this->getProperty('country'),
            'validation' => [
                new Required(),
            ]
        ]);

        $fields[] = new TextField($this->commerce, [
            'name' => 'properties[phone]',
            'label' => $this->adapter->lexicon('commerce.address.phone'),
            'value' => $this->getProperty('phone'),
        ]);

        $fields[] = new TextField($this->commerce, [
            'name' => 'properties[mobile]',
            'label' => $this->adapter->lexicon('commerce.address.mobile'),
            'value' => $this->getProperty('mobile'),
        ]);

        $fields[] = new TextareaField($this->commerce, [
            'name' => 'properties[notes]',
            'label' => $this->adapter->lexicon('commerce.address.notes'),
            'value' => $this->getProperty('notes'),
        ]);

        return $fields;
    }
}
