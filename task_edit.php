<?php
require 'inc/functions.php';

$pageTitle = "Edit Task | Time Tracker";
$page = "tasks";
$project_id = $title = $date = $time = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $project_id = trim(filter_input(INPUT_POST, 'project_id', FILTER_SANITIZE_NUMBER_INT));
    $title = trim(filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING));
    $date = trim(filter_input(INPUT_POST, 'date', FILTER_SANITIZE_STRING));
    $time = trim(filter_input(INPUT_POST, 'time', FILTER_SANITIZE_NUMBER_INT));
    $task_id = filter_input(INPUT_POST, 'task_id', FILTER_SANITIZE_NUMBER_INT);

    $date_match = explode('/', $date);
    var_dump($date_match);

    if(empty($project_id) || empty($title) || empty($date) || empty($time)){
        $error_message = 'Please fill in the required fields: Preject, Title, Date, Time';
    }elseif(count($date_match) != 3 || strlen($date_match[0])!=2 || strlen($date_match[1])!=2 || strlen($date_match[2])!=4 || !checkdate($date_match[0], $date_match[1], $date_match[2])){
        $error_message = 'Invalid Date';
    }else{
        if (edit_task($task_id, $project_id, $title, $date, $time) == true){
            header('Location:task_list.php');
            exit;
        }else{
            $error_message = 'Could not add task';
        }
    }
}

include 'inc/header.php';
?>

<div class="section page">
    <div class="col-container page-container">
        <div class="col col-70-md col-60-lg col-center">
            <h1 class="actions-header">Add Task</h1>
            <?php if (isset($error_message)){
                echo "<p class='message'>".$error_message.'</p>';
            } ?>
            <form class="form-container form-add" method="post" action="task_edit.php?task_id=<?php echo $_GET['task_id'] ?>">
                <table>
                    <tr>
                        <th>
                            <label for="project_id">Project</label>
                        </th>
                        <td>
                            <select name="project_id" id="project_id">
                                <option value="">Select One</option>
                                <?php foreach(get_project_list() as $project): ?>
                                    <option value="<?php echo $project['project_id']; ?>"><?php echo $project['title']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="title">Title<span class="required">*</span></label></th>
                        <td><input type="text" id="title" name="title" value="<?php echo(htmlspecialchars($title)); ?>" /></td>
                    </tr>
                    <tr>
                        <th><label for="date">Date<span class="required">*</span></label></th>
                        <td><input type="text" id="date" name="date" value="<?php echo(htmlspecialchars($date)); ?>" placeholder="mm/dd/yyyy" /></td>
                    </tr>
                    <tr>
                        <th><label for="time">Time<span class="required">*</span></label></th>
                        <td><input type="text" id="time" name="time" value="<?php echo(htmlspecialchars($time)); ?>" /> minutes</td>
                    </tr>
                </table>
                <input type="hidden" name="task_id" value="<?php echo $_GET['task_id'] ?>">
                <input class="button button--primary button--topic-php" type="submit" value="Submit" />
            </form>
        </div>
    </div>
</div>

<?php include "inc/footer.php"; ?>
