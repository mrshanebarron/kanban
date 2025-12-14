# Laravel Design Kanban

Drag and drop kanban board component for Laravel. Supports Livewire, Blade, and Vue 3.

## Installation

```bash
composer require mrshanebarron/kanban
```

## Usage

### Livewire Component

```blade
<livewire:ld-kanban />
```

### Blade Component

```blade
<x-ld-kanban />
```

## Configuration

Publish the config file:

```bash
php artisan vendor:publish --tag=ld-kanban-config
```

## Customization

### Publishing Views

```bash
php artisan vendor:publish --tag=ld-kanban-views
```

## License

MIT
