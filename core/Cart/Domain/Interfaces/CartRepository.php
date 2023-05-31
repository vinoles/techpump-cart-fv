<?php

namespace Core\Cart\Domain\Interfaces;

use Darryldecode\Cart\CartCollection;

interface CartRepository
{
    /**
     * Get items of the cart
     *
     * @return CartCollection
     */
    public function items(): CartCollection;

    /**
     * Add item to cart
     *
     * @param  int  productId
     * @param  int  $quantity
     * @return void
     */
    public function addItem(int $productId, int $quantity): void;

    /**
     * Update item in the cart
     *
     * @param  int  productId
     * @param  int  $quantity
     * @return void
     */
    public function updateItem(int $productId, int $quantity): void;

    /**
     * Delete item in the cart
     *
     * @param  int  productId
     * @return void
     */
    public function deleteItem(int $productId): void;

    /**
     * Clear card
     *
     * @return void
     */
    public function clearCart(): void;

    /**
     * Get subtotal card
     *
     * @return float
     */
    public function getSubTotal(): float;

    /**
     * Get total card
     *
     * @return float
     */
    public function getTotal(): float;

    /**
     * Get token cart
     *
     * @return string
     */
    public function getToken(): string;
}
