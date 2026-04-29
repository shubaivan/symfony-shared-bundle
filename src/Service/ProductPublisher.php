<?php

declare(strict_types=1);

namespace Shared\Service;

use Shared\Dto\ProductDto;
use Shared\Entity\ProductBase;
use Shared\Message\ProductSyncMessage;
use Symfony\Component\Messenger\MessageBusInterface;

final class ProductPublisher
{
    public function __construct(private readonly MessageBusInterface $messageBus)
    {
    }

    public function publish(ProductBase $product): void
    {
        $this->messageBus->dispatch(new ProductSyncMessage(ProductDto::fromEntity($product)));
    }
}
