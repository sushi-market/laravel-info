# laravel-info

A debug info page for Laravel applications — think `phpinfo()` but for your Laravel stack.

Available at `/laravel-info`, protected by Basic Auth outside of the `local` environment.

## Installation

```bash
composer require sushi-market/laravel-info
```

The package auto-discovers itself via Laravel's package discovery. No manual provider registration needed.

## Built-in sections

| Section     | What it shows                                              |
|-------------|------------------------------------------------------------|
| Stack       | Laravel version, PHP version, SAPI, Octane, Vite          |
| Environment | App environment, server IP, client IP                      |
| Config      | Cache driver, queue driver, session driver, mail, timezone, locale, debug mode |
| Runtime     | Memory usage, peak memory, request time, OPcache status    |
| Cache       | Whether packages/services/config/events/routes are cached  |
| Services    | Database connectivity, Redis connectivity, Horizon status  |

## Auth

In any environment other than `local`, the page requires Basic Auth. Set the password in your `.env`:

```env
LARAVEL_INFO_PASSWORD=your-secret-password
```

The username is ignored — only the password is checked.

If `LARAVEL_INFO_PASSWORD` is not set, access is denied.

## Adding custom sections

Implement the `Section` interface:

```php
use DF\LaravelInfo\Contracts\Section;

class QueueSection implements Section
{
    public function title(): string
    {
        return 'Queue';
    }

    public function data(): array
    {
        return [
            'Driver'     => config('queue.default'),
            'Failed jobs' => \DB::table('failed_jobs')->count(),
        ];
    }
}
```

Register it in your `AppServiceProvider`:

```php
use DF\LaravelInfo\LaravelInfo;

public function boot(): void
{
    app(LaravelInfo::class)->addSection(new QueueSection());
}
```

The section will appear as a card on the page automatically.

## Route

```
GET /laravel-info
```

Named route: `laravel-info.index`
