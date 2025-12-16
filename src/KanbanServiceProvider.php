<?php

namespace MrShaneBarron\Kanban;

use Illuminate\Support\ServiceProvider;
use MrShaneBarron\Kanban\Livewire\Kanban;
use MrShaneBarron\Kanban\View\Components\Kanban as BladeKanban;
use Livewire\Livewire;

class KanbanServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/sb-kanban.php', 'sb-kanban');
    }

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'sb-kanban');

        Livewire::component('sb-kanban', Kanban::class);

        $this->loadViewComponentsAs('ld', [
            BladeKanban::class,
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
