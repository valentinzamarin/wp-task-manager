<template>
  <div
      v-for="task in tasks"
      v-if="tasks.length > 0"
      :key="task.id"
      class="relative p-6 bg-white border border-gray rounded-lg mb-3.5 last:mb-0"
  >
    <button @click.prevent="todoRemoveHandler( $event, task.id)" class="outline-none bg-transparent">
      <svg class="absolute right-2 top-2 font-black size-6 text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none"
           viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/>
    </svg>
    </button>

    <h5
        class="text-base text-xl font-medium border-b mb-4"
        :class="{ 'line-through': task.status == 1 }"
    >
      {{ task.title }}
    </h5>

    <p class="text-sm font-n">
      {{ task.description }}
    </p>
    <div class="mt-5">
      <button
          @click.prevent="taskStatusHandler( task.id )"
          class="bg-transparent hover:bg-green-400 text-green-500 text-xs font-semibold hover:text-white py-1 px-2 border border-green-500 hover:border-transparent rounded">
        Completed
      </button>
    </div>
  </div>
  <div v-else>
    <div class="relative p-6 bg-white border border-gray rounded-lg mb-3.5 last:mb-0">
      Empty
    </div>
  </div>
</template>

<script>
export default {
  props: {
    tasks: {
      type: Array,
    },
    changeStatus: {
      type: Function,
    },
    deleteTask: {
      type: Function,
    }
  },
  methods: {
    taskStatusHandler( task ) {
      this.changeStatus( task );
    },
    todoRemoveHandler( event, id ) {
      const itemToRemove = event.currentTarget.parentElement
      this.deleteTask( itemToRemove, id )
    },
  }
}
</script>