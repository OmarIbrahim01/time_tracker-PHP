<?php
require 'inc/functions.php';

$page = "tasks";
$pageTitle = "Task List | Time Tracker";


if (isset($_GET['delete_task_id'])){
    if(delete_task($_GET['delete_task_id'])){
        header('Location:task_list.php');
        exit;
    }else{
        echo "string";
    }
}


include 'inc/header.php';
?>
<div class="section catalog random">

    <div class="col-container page-container">
        <div class="col col-70-md col-60-lg col-center">

            <h1 class="actions-header">Task List</h1>
            <div class="actions-item">
                <a class="actions-link" href="task.php">
                    <span class="actions-icon">
                        <svg viewbox="0 0 64 64"><use xlink:href="#task_icon"></use></svg>
                    </span>
                Add Task</a>
            </div>

            <div class="form-container">
              <ul class="items">
                <?php foreach (get_task_list() as $task): ?>
                    <p><a href="task_edit.php?task_id=<?php echo $task['task_id'] ?>"><?php echo $task['title']; ?></a><a href='task_list.php?delete_task_id=<?php echo $task['task_id'] ?>' class='remove-button' onclick="return  confirm('Do you want to delete this task Y/N')">Remove</a></p>
                <?php endforeach; ?>
              </ul>
            </div>

        </div>
    </div>
</div>

<?php include("inc/footer.php"); ?>
