<?php

namespace MrShaneBarron\Kanban\Livewire;

use Livewire\Component;

class Kanban extends Component
{
    public array $columns = [];
    public array $items = [];

    public function mount(
        array $columns = [],
        array $items = []
    ): void {
        $this->columns = $columns;
        $this->items = $items;
    }

    public function moveItem(string $itemId, string $fromColumn, string $toColumn): void
    {
        $this->dispatch('item-moved', itemId: $itemId, from: $fromColumn, to: $toColumn);
    }

    public function render()
    {
        return view('ld-kanban::livewire.kanban');
    }
}
