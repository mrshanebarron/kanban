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

    public function moveItem(string $itemId, string $toColumn): void
    {
        foreach ($this->items as $index => $item) {
            if ($item['id'] === $itemId) {
                $this->items[$index]['column'] = $toColumn;
                break;
            }
        }
        $this->dispatch('item-moved', itemId: $itemId, to: $toColumn);
    }

    public function render()
    {
        return view('sb-kanban::livewire.kanban');
    }
}
