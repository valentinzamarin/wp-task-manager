<template>
  <div>
    <h1 class="text-3xl mb-4">
      ToDo App
    </h1>
    <Form :newTaskItem="addTaskToList"/>
    <Tasks :tasks="reversedTasks" :changeStatus="changeTaskStatus" :deleteTask="removeTaskFromList"/>
  </div>
</template>

<script>
import axios from "axios";
import Form from './components/form/index.vue';
import Tasks from "./components/tasks/index.vue";

export default {
  name: 'App',
  components: {
    Form,
    Tasks
  },
  data() {
    return {
      tasks: [],
    }
  },
  created() {
    this.fetchTasks();
  },
  computed: {
    reversedTasks() {
      return [...this.tasks].reverse();
    }
  },
  methods: {
    fetchTasks() {
      axios.get(tasks_plugin_data.api_url)
          .then(response => {
            this.tasks = response.data;
          })
          .catch(error => {
            console.error('Error fetching articles:', error);
          });
    },
    addTaskToList( response ) {
      const newTask = {
        id: response.id,
        title: response.title,
        description: response.description,
      };
      this.tasks.push(newTask);
    },
    changeTaskStatus(id) {
      const task = this.tasks.find(task => task.id === id);

      if (task) {
        const updatedStatus = !task.status;
        axios.patch(tasks_plugin_data.api_url, {
          id: id,
          status: updatedStatus ? 1 : 0
        })
            .then(response => {
              if (response.data.success) {
                task.status = updatedStatus;
              } else {
                console.error('Failed to update task status');
              }
            })
            .catch(error => {
              console.error('Error updating task status:', error);
            });
      }
    },
    removeTaskFromList( item, id) {
      axios.post(tasks_plugin_data.api_delete, {
        task_id: id
      })
          .then(response => {
            if (response.data.success) {
              this.tasks = this.tasks.filter(task => task.id !== id);
              item.remove();
            } else {
              console.error('Failed to delete task');
            }
          })
          .catch(error => {
            console.error('Error deleting task:', error);
          });

    },
  }
};
</script>