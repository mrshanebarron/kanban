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
        $this->mergeConfigFrom(__DIR__ . '/../config/sb-kanban.php', 'sb-kanban');
    }

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'sb-kanban');

        Livewire::component('sb-kanban', kanban::class);

        $this->loadViewComponentsAs('ld', [
            Bladekanban::class,
        ]);

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/sb-kanban.php' => config_path('sb-kanban.php'),
            ], 'sb-kanban-config');

            $this->publishes([
                __DIR__ . '/../resources/views' => resource_path('views/vendor/sb-kanban'),
            ], 'sb-kanban-views');
        }
    }
}
