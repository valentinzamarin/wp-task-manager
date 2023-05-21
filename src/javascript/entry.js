const form  = document.querySelector( '#task-form' );
const taskList = document.querySelector( '#task-list');

import TaskManagerForm from './classes/formHandler';
import taskManagerList from "./classes/taskList";

new TaskManagerForm( form, taskList );
new taskManagerList( taskList );

import {Datepicker} from "vanillajs-datepicker";

document.querySelectorAll('input[name="date"]').forEach( datepicker => {
    new Datepicker(datepicker, {});
})
