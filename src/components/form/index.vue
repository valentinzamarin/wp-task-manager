<template>
  <form @submit.prevent="taskFormHandler" class="mb-4" >
    <div class="mb-4">
      <input type="text"
             name="task_title"
             id="task_title"
             class="border border-gray py-2 px-4 text-sm leading-1 flex rounded-lg w-full"
             placeholder="Enter Task Title ..">
    </div>
    <div class="mb-4">
      <textarea
          id="task_description"
          name="task_description"
          class="border border-gray py-2 px-4 text-sm leading-1 flex rounded-lg w-full resize-none"
          placeholder="Leave a description.."
          rows="5"
      ></textarea>
    </div>
    <div>
      <input type="submit" value="Add Task" class="bg-blue-500 hover:bg-blue-700 text-white text-sm font-bold py-2 px-4 rounded">
    </div>
  </form>
</template>

<script>
import axios from 'axios';
export default {
  props: {
    newTaskItem: {
      type: Function,
    }
  },
  methods: {
    taskFormHandler( evt ) {
      let $this = evt.target,
          taskTitle = $this.task_title.value,
          taskDescription = $this.task_description.value;
      if( taskTitle === '' ) {
        alert('Title is empty');
        return false;
      }

      axios.post( tasks_plugin_data.api_url , {
        task_title: taskTitle,
        task_description: taskDescription
      })
          .then(response => {
            this.newTaskItem( response.data );
          })
          .catch(error => {
            console.error('Error adding task:', error);
          });

      $this.reset();
    }
  }
}
</script>