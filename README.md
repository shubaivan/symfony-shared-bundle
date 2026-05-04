# symfony-shared-bundle

Shared Symfony 6.4 bundle for the [product-service](https://github.com/shubaivan/product-service) / [order-service](https://github.com/shubaivan/order-service) microservices. Owns the cross-service contracts so both sides agree on shape and routing.

## What it provides

| Class | Purpose |
|---|---|
| `Shared\Entity\ProductBase` | Doctrine `#[ORM\MappedSuperclass]` defining `id (UUID)`, `name`, `price (decimal)`, `quantity`. Each service extends it with its own `App\Entity\Product`. |
| `Shared\Dto\ProductDto` | Wire shape for products (also `JsonSerializable` for HTTP responses). |
| `Shared\Message\ProductSyncMessage` | Published by product-service whenever a product is created or updated. |
| `Shared\Message\OrderPlacedMessage` | Published by order-service after every successful order; consumed by product-service to decrement master quantity. |
| `Shared\Service\ProductPublisher` | Tiny helper around `MessageBusInterface` for the product-service publish path. |
| `Shared\Messenger\AmqpRoutingConfig` | Constants for exchange and queue names. |

## How services depend on it

Each service's `composer.json`:

```json
{
  "repositories": {
    "shared": {
      "type": "vcs",
      "url": "https://github.com/shubaivan/symfony-shared-bundle"
    }
  },
  "require": {
    "shubaivan/symfony-shared-bundle": "dev-master"
  }
}
```

Then register the bundle in `config/bundles.php`:

```php
Shared\SharedBundle::class => ['all' => true],
```

The bundle's `SharedExtension` auto-loads its own `services.yaml`, which registers `ProductPublisher` as an autowired service. No further wiring needed in the host application.

## Why a bundle and not just a library

A bundle gives you DI integration for free (services register on kernel boot), bundle lifecycle hooks if you ever need them, and matches the convention Symfony developers expect for cross-cutting code. The mapped superclass mechanism lets two separate databases share column definitions without sharing a table.

## Full architecture

See [`tech-task-stack`](https://github.com/shubaivan/tech-task-stack).
