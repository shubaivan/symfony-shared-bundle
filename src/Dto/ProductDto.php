<?php

declare(strict_types=1);

namespace Shared\Dto;

use Shared\Entity\ProductBase;
use Symfony\Component\Uid\Uuid;

final class ProductDto implements \JsonSerializable
{
    public function __construct(
        public readonly string $id,
        public readonly string $name,
        public readonly float $price,
        public readonly int $quantity,
    ) {
    }

    public static function fromEntity(ProductBase $product): self
    {
        return new self(
            id: (string) $product->getId(),
            name: $product->getName(),
            price: $product->getPrice(),
            quantity: $product->getQuantity(),
        );
    }

    /**
     * @param array{id: string, name: string, price: float|string, quantity: int} $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'],
            name: $data['name'],
            price: (float) $data['price'],
            quantity: (int) $data['quantity'],
        );
    }

    public function uuid(): Uuid
    {
        return Uuid::fromString($this->id);
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->price,
            'quantity' => $this->quantity,
        ];
    }
}
