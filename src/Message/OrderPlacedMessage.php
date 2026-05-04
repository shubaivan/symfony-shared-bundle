<?php

declare(strict_types=1);

namespace Shared\Message;

final class OrderPlacedMessage
{
    public function __construct(
        public readonly string $productId,
        public readonly int $quantityOrdered,
    ) {
    }
}
