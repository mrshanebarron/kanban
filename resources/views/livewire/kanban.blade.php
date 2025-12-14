<div
    x-data="{
        draggedItem: null,
        draggedFrom: null,
        handleDragStart(e, itemId, columnId) {
            this.draggedItem = itemId;
            this.draggedFrom = columnId;
            e.dataTransfer.effectAllowed = 'move';
        },
        handleDrop(e, columnId) {
            e.preventDefault();
            if (this.draggedItem && this.draggedFrom !== columnId) {
                $wire.moveItem(this.draggedItem, this.draggedFrom, columnId);
            }
            this.draggedItem = null;
            this.draggedFrom = null;
        },
        handleDragOver(e) {
            e.preventDefault();
            e.dataTransfer.dropEffect = 'move';
        }
    }"
    class="flex gap-4 overflow-x-auto pb-4"
>
    @foreach($columns as $column)
        <div
            @dragover="handleDragOver($event)"
            @drop="handleDrop($event, '{{ $column['id'] }}')"
            class="flex-shrink-0 w-72 bg-gray-100 rounded-lg p-4"
        >
            <div class="flex items-center justify-between mb-4">
                <h3 class="font-semibold text-gray-700">{{ $column['title'] }}</h3>
                <span class="px-2 py-1 text-xs font-medium bg-gray-200 rounded-full">
                    {{ count(array_filter($items, fn($item) => $item['column'] === $column['id'])) }}
                </span>
            </div>
            <div class="space-y-3 min-h-[200px]">
                @foreach(array_filter($items, fn($item) => $item['column'] === $column['id']) as $item)
                    <div
                        draggable="true"
                        @dragstart="handleDragStart($event, '{{ $item['id'] }}', '{{ $column['id'] }}')"
                        class="bg-white p-4 rounded-lg shadow-sm border cursor-move hover:shadow-md transition-shadow"
                    >
                        <h4 class="font-medium text-gray-900 mb-1">{{ $item['title'] }}</h4>
                        @if(isset($item['description']))
                            <p class="text-sm text-gray-500">{{ $item['description'] }}</p>
                        @endif
                        @if(isset($item['tags']))
                            <div class="mt-2 flex flex-wrap gap-1">
                                @foreach($item['tags'] as $tag)
                                    <span class="px-2 py-0.5 text-xs bg-blue-100 text-blue-700 rounded">{{ $tag }}</span>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach
</div>
