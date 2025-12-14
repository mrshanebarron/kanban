<template>
  <div class="flex gap-4 overflow-x-auto pb-4">
    <div
      v-for="column in columns"
      :key="column.id"
      class="flex-shrink-0 w-80 bg-gray-100 rounded-lg"
      @dragover.prevent
      @drop="handleDrop($event, column.id)"
    >
      <div class="p-3 font-semibold text-gray-700 border-b border-gray-200 flex items-center justify-between">
        <span>{{ column.title }}</span>
        <span class="text-sm text-gray-500 bg-gray-200 px-2 py-0.5 rounded-full">{{ getColumnItems(column.id).length }}</span>
      </div>
      <div class="p-2 space-y-2 min-h-[200px]">
        <div
          v-for="item in getColumnItems(column.id)"
          :key="item.id"
          draggable="true"
          @dragstart="handleDragStart($event, item)"
          @dragend="handleDragEnd"
          :class="['p-3 bg-white rounded-lg shadow-sm border border-gray-200 cursor-move hover:shadow-md transition-shadow', draggingId === item.id && 'opacity-50']"
        >
          <slot name="item" :item="item">
            <h4 class="font-medium text-gray-900">{{ item.title }}</h4>
            <p v-if="item.description" class="text-sm text-gray-500 mt-1">{{ item.description }}</p>
          </slot>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { ref, computed } from 'vue';

export default {
  name: 'SbKanban',
  props: {
    columns: { type: Array, default: () => [] },
    items: { type: Array, default: () => [] }
  },
  emits: ['update:items', 'move'],
  setup(props, { emit }) {
    const draggingId = ref(null);
    const draggedItem = ref(null);

    const getColumnItems = (columnId) => {
      return props.items.filter(item => item.columnId === columnId);
    };

    const handleDragStart = (e, item) => {
      draggingId.value = item.id;
      draggedItem.value = item;
      e.dataTransfer.effectAllowed = 'move';
      e.dataTransfer.setData('text/plain', item.id);
    };

    const handleDragEnd = () => {
      draggingId.value = null;
      draggedItem.value = null;
    };

    const handleDrop = (e, columnId) => {
      e.preventDefault();
      if (draggedItem.value && draggedItem.value.columnId !== columnId) {
        const updatedItems = props.items.map(item =>
          item.id === draggedItem.value.id ? { ...item, columnId } : item
        );
        emit('update:items', updatedItems);
        emit('move', { item: draggedItem.value, fromColumn: draggedItem.value.columnId, toColumn: columnId });
      }
      handleDragEnd();
    };

    return { draggingId, getColumnItems, handleDragStart, handleDragEnd, handleDrop };
  }
};
</script>
