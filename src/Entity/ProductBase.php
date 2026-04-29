<?php

declare(strict_types=1);

namespace Shared\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\MappedSuperclass]
abstract class ProductBase
{
    #[ORM\Id]
    #[ORM\Column(type: 'uuid', unique: true)]
    protected Uuid $id;

    #[ORM\Column(type: 'string', length: 255)]
    protected string $name;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    protected string $price;

    #[ORM\Column(type: 'integer')]
    protected int $quantity;

    public function __construct(string $name, float $price, int $quantity, ?Uuid $id = null)
    {
        $this->id = $id ?? Uuid::v4();
        $this->name = $name;
        $this->price = number_format($price, 2, '.', '');
        $this->quantity = $quantity;
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getPrice(): float
    {
        return (float) $this->price;
    }

    public function setPrice(float $price): void
    {
        $this->price = number_format($price, 2, '.', '');
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }
}
