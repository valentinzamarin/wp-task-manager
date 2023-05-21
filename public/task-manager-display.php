<div>
    <form id="task-form" class="mb-3">
        <div class="mb-3">
            <label for="name">Task Name</label>
            <input type="text" class="form-control is-required" id="name" name="name" placeholder="Task...">
        </div>
        <div class="mb-3">
            <label for="description">Task Description</label>
            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
        </div>
        <div class="row mb-3">
            <div class="col-sm-6">
                <label for="date">Date</label>
                <input type="text" name="date" class="form-control is-required" placeholder="Date...">
            </div>
            <div class="col-sm-6">
                <label for="estimate">Time</label>
                <input type="number" class="form-control" name="estimate" placeholder="Estimate time..">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Add Task</button>
    </form>
    <div id="task-list"></div>
</div>
