# Store Pickup for Commerce

Set customer's shipping address to a custom store address for in-store pickup orders. This can be used to ensure taxes are calculated correctly for shipping address based taxes.

## Setup

1. Install the package from modx.com extras
2. Enable the Commerce module in the Commerce dashboard
3. Setup a store pickup shipping method, enter the store address for pickup (the customer's phone and email address will be added to this address). **Make sure the priority of this method is a higher number than any non-pickup methods to prevent the address from being overridden in case this method is selected as the default**.