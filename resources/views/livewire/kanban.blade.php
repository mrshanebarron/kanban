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
    style="display: flex; gap: 16px; overflow-x: auto; padding-bottom: 16px;"
>
    @foreach($this->columns as $column)
        <div
            @dragover="handleDragOver($event)"
            @drop="handleDrop($event, '{{ $column['id'] }}')"
            style="flex-shrink: 0; width: 288px; background: #f3f4f6; border-radius: 8px; padding: 16px;"
        >
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 16px;">
                <h3 style="font-weight: 600; color: #374151; margin: 0;">{{ $column['title'] }}</h3>
                <span style="padding: 4px 8px; font-size: 12px; font-weight: 500; background: #e5e7eb; border-radius: 9999px;">
                    {{ count(array_filter($this->items, fn($item) => $item['column'] === $column['id'])) }}
                </span>
            </div>
            <div style="display: flex; flex-direction: column; gap: 12px; min-height: 200px;">
                @foreach(array_filter($this->items, fn($item) => $item['column'] === $column['id']) as $item)
                    <div
                        draggable="true"
                        @dragstart="handleDragStart($event, '{{ $item['id'] }}', '{{ $column['id'] }}')"
                        style="background: white; padding: 16px; border-radius: 8px; box-shadow: 0 1px 2px rgba(0,0,0,0.05); border: 1px solid #e5e7eb; cursor: move; transition: box-shadow 0.15s;"
                        onmouseover="this.style.boxShadow='0 4px 6px rgba(0,0,0,0.1)'"
                        onmouseout="this.style.boxShadow='0 1px 2px rgba(0,0,0,0.05)'"
                    >
                        <h4 style="font-weight: 500; color: #111827; margin: 0 0 4px 0;">{{ $item['title'] }}</h4>
                        @if(isset($item['description']))
                            <p style="font-size: 14px; color: #6b7280; margin: 0;">{{ $item['description'] }}</p>
                        @endif
                        @if(isset($item['tags']))
                            <div style="margin-top: 8px; display: flex; flex-wrap: wrap; gap: 4px;">
                                @foreach($item['tags'] as $tag)
                                    <span style="padding: 2px 8px; font-size: 12px; background: #dbeafe; color: #1d4ed8; border-radius: 4px;">{{ $tag }}</span>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach
</div>
