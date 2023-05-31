<?php

namespace Core\Cart\Infrastructure\Repositories;

use Core\Product\Application\UseCases\FindProduct;
use Core\Product\Infrastructure\Repositories\Product as ProductRepository;
use Darryldecode\Cart\CartCollection;

final class Cart
{
    /**
     * The repository product.
     *
     * @var  FindProduct
     */
    private $findProduct;

    /**
     * Create a new instance.
     *
     */
    public function __construct()
    {
        $this->findProduct = new FindProduct(new ProductRepository());
    }

    /**
     * Get items of the cart
     *
     * @return CartCollection
     */
    public function items(): CartCollection
    {
        return \Cart::session($this->getToken())
            ->getContent();
    }

    /**
     * Add item to cart
     *
     * @param  int  productId
     * @param  int  $quantity
     * @return void
     */
    public function addItem(int $productId, int $quantity): void
    {
        $product = $this->findProduct->execute($productId);

        \Cart::session($this->getToken())
            ->add([
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $quantity,
                'attributes' => [
                    'image' => $product->image,
                ],
            ]);
    }

    /**
     * Update item in the cart
     *
     * @param  int  productId
     * @param  int  $quantity
     * @return void
     */
    public function updateItem(int $productId, int $quantity): void
    {
        \Cart::session($this->getToken())
            ->update(
                $productId,
                [
                    'quantity' => [
                        'relative' => false,
                        'value' => $quantity,
                    ],
                ]
            );
    }

    /**
     * Delete item in the cart
     *
     * @param  int  productId
     * @return void
     */
    public function deleteItem(int $productId): void
    {
        \Cart::session($this->getToken())
            ->remove($productId);
    }

    /**
     * Clear card
     *
     * @return void
     */
    public function clearCart(): void
    {
        \Cart::session($this->getToken())->clear();

        session()->forget('token-cart');
    }

    /**
     * Get subtotal card
     *
     * @return float
     */
    public function getSubTotal(): float
    {
        return \Cart::session($this->getToken())->getSubTotal();
    }

    /**
     * Get total card
     *
     * @return float
     */
    public function getTotal(): float
    {
        return \Cart::session($this->getToken())->getTotal();
    }

    /**
     * Get token cart
     *
     * @return string
     */
    public function getToken(): string
    {
        return session('token-cart');
    }
}
