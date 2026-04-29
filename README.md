# symfony-shared-bundle

Shared code between `product-service` and `order-service`.

Provides:

- `Shared\Entity\ProductBase` — Doctrine mapped superclass with `id`, `name`, `price`, `quantity`
- `Shared\Dto\ProductDto` — JSON shape used in API responses and RabbitMQ payloads
- `Shared\Message\ProductSyncMessage` — message dispatched when a product is created/updated
- `Shared\Messenger\AmqpRoutingConfig` — exchange + queue names used by both services

## Install

```bash
composer config repositories.shared vcs https://github.com/shubaivan/symfony-shared-bundle
composer require shubaivan/symfony-shared-bundle:dev-master
```

Then register the bundle in `config/bundles.php`:

```php
Shared\SharedBundle::class => ['all' => true],
```
