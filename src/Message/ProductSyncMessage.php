<?php

declare(strict_types=1);

namespace Shared\Message;

use Shared\Dto\ProductDto;

final class ProductSyncMessage
{
    public function __construct(public readonly ProductDto $product)
    {
    }
}
