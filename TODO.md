# TODO: Implement Direct Checkout in Cart

## Tasks
- [x] Update app/Livewire/Cart.php: Add placeOrder method to handle checkout logic for both guests and non-guests
- [x] Modify resources/views/livewire/cart.blade.php: Conditionally show billing form for guests and confirm button for non-guests
- [x] Test the implementation to ensure it works for both user types (Server started, ready for manual testing)

## Details
- For guests: Show billing form above "Cash on Delivery" button
- For non-guests: Show "Confirm" button instead of "Cash on Delivery" link
- Use logic inspired from checkout without redirecting
