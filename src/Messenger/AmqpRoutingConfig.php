<?php

declare(strict_types=1);

namespace Shared\Messenger;

final class AmqpRoutingConfig
{
    public const EXCHANGE = 'products';
    public const QUEUE_PRODUCT_SYNC = 'product_sync';
    public const ROUTING_KEY_PRODUCT_SYNC = 'product.sync';

    public const EXCHANGE_ORDERS = 'orders';
    public const QUEUE_ORDER_PLACED = 'order_placed';
}
