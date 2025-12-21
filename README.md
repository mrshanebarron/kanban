# Kanban

A kanban board component for Laravel applications. Drag and drop cards between columns for project management. Works with Livewire and Vue 3.

## Installation

```bash
composer require mrshanebarron/kanban
```

## Livewire Usage

### Basic Usage

```blade
<livewire:sb-kanban
    :columns="[
        ['id' => 'todo', 'title' => 'To Do'],
        ['id' => 'progress', 'title' => 'In Progress'],
        ['id' => 'done', 'title' => 'Done']
    ]"
    :items="$tasks"
/>
```

### Livewire Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `columns` | array | `[]` | Column definitions |
| `items` | array | `[]` | Card items with columnId |

## Vue 3 Usage

### Setup

```javascript
import { SbKanban } from './vendor/sb-kanban';
app.component('SbKanban', SbKanban);
```

### Basic Usage

```vue
<template>
  <SbKanban
    :columns="columns"
    v-model:items="tasks"
    @move="handleMove"
  />
</template>

<script setup>
import { ref } from 'vue';

const columns = [
  { id: 'backlog', title: 'Backlog' },
  { id: 'todo', title: 'To Do' },
  { id: 'in-progress', title: 'In Progress' },
  { id: 'done', title: 'Done' }
];

const tasks = ref([
  { id: '1', title: 'Design homepage', columnId: 'todo' },
  { id: '2', title: 'Setup database', columnId: 'in-progress' },
  { id: '3', title: 'Create API endpoints', columnId: 'backlog' },
  { id: '4', title: 'Write tests', columnId: 'backlog' }
]);

const handleMove = ({ item, fromColumn, toColumn }) => {
  console.log(`Moved "${item.title}" from ${fromColumn} to ${toColumn}`);
};
</script>
```

### Custom Card Template

```vue
<template>
  <SbKanban :columns="columns" v-model:items="tasks">
    <template #item="{ item }">
      <div class="space-y-2">
        <h4 class="font-medium">{{ item.title }}</h4>
        <p class="text-sm text-gray-500">{{ item.description }}</p>
        <div class="flex items-center gap-2">
          <span class="px-2 py-0.5 text-xs bg-blue-100 text-blue-700 rounded">
            {{ item.priority }}
          </span>
          <img
            v-if="item.assignee"
            :src="item.assignee.avatar"
            class="w-6 h-6 rounded-full ml-auto"
          />
        </div>
      </div>
    </template>
  </SbKanban>
</template>
```

### Project Management Example

```vue
<template>
  <div class="p-4">
    <h1 class="text-2xl font-bold mb-4">Sprint Board</h1>

    <SbKanban
      :columns="sprintColumns"
      v-model:items="sprintItems"
      @move="updateTaskStatus"
    >
      <template #item="{ item }">
        <div>
          <div class="flex items-center justify-between mb-2">
            <span class="text-xs text-gray-500">#{{ item.ticketId }}</span>
            <span :class="priorityClass(item.priority)">{{ item.priority }}</span>
          </div>
          <h4 class="font-medium text-gray-900">{{ item.title }}</h4>
          <p v-if="item.estimate" class="text-xs text-gray-500 mt-1">
            Est: {{ item.estimate }}h
          </p>
        </div>
      </template>
    </SbKanban>
  </div>
</template>
```

### Vue Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `columns` | Array | `[]` | Column definitions |
| `items` | Array | `[]` | Items with columnId property |

### Events

| Event | Payload | Description |
|-------|---------|-------------|
| `update:items` | `items[]` | Items array changed |
| `move` | `{ item, fromColumn, toColumn }` | Card moved |

### Slots

| Slot | Props | Description |
|------|-------|-------------|
| `item` | `{ item }` | Custom card template |

## Column Object

```javascript
{
  id: 'column-id',  // Unique identifier
  title: 'Column Name'  // Display title
}
```

## Item Object

```javascript
{
  id: 'item-id',        // Unique identifier
  title: 'Task Title',  // Required
  description: 'Details',  // Optional
  columnId: 'todo'      // Which column it belongs to
}
```

## Features

- **Drag and Drop**: Native HTML5 drag/drop
- **Column Counts**: Shows item count per column
- **Visual Feedback**: Opacity change while dragging
- **Custom Cards**: Slot for custom card content
- **Horizontal Scroll**: Overflow handling for many columns

## Styling

Uses Tailwind CSS:
- Gray column backgrounds
- White card backgrounds
- Shadow on cards
- Hover shadow enhancement
- Badge for column counts

## Requirements

- PHP 8.1+
- Laravel 10, 11, or 12
- Tailwind CSS 3.x

## License

MIT License
