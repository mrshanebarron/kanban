<?php

namespace MrShaneBarron\kanban;

use Illuminate\Support\ServiceProvider;
use MrShaneBarron\kanban\Livewire\kanban;
use MrShaneBarron\kanban\View\Components\kanban as Bladekanban;
use Livewire\Livewire;

class kanbanServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/ld-kanban.php', 'ld-kanban');
    }

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'ld-kanban');

        Livewire::component('ld-kanban', kanban::class);

        $this->loadViewComponentsAs('ld', [
            Bladekanban::class,
        ]);

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/ld-kanban.php' => config_path('ld-kanban.php'),
            ], 'ld-kanban-config');

            $this->publishes([
                __DIR__ . '/../resources/views' => resource_path('views/vendor/ld-kanban'),
            ], 'ld-kanban-views');
        }
    }
}
