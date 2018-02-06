<?php
require 'inc/functions.php';

$pageTitle = "Edit Project | Time Tracker";
$page = "projects";
$title = $category = '' ;



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = trim(filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING));
    $category = trim(filter_input(INPUT_POST, 'category', FILTER_SANITIZE_STRING));
    $project_id = trim(filter_input(INPUT_POST, 'project_id', FILTER_SANITIZE_NUMBER_INT));
    var_dump($project_id);

    if (empty($title) || empty($category)){
        $error_message = "Please fill in the required fields: Title, Category";
    }elseif (empty($project_id)){
        $error_message = 'No Project ID';
    }else {

       if (edit_project($project_id, $title, $category) == true){
        header('Location:project_list.php');
        exit;
       }else {
        $error_message = 'Could not add project';
       }
    }
}else{
}

include 'inc/header.php';
?>

<div class="section page">
    <div class="col-container page-container">
        <div class="col col-70-md col-60-lg col-center">
            <h1 class="actions-header">Edit Project</h1>
            <?php if (isset($error_message)){
                echo "<p class='message'>".$error_message."</p>";
            } ?>
                
            <form class="form-container form-add" method="post" action="project_edit.php?p_id=<?php echo $_GET['p_id']?>">
                <table>
                    <tr>
                        <th><label for="title">Title<span class="required">*</span></label></th>
                        <td><input type="text" id="title" name="title" value="<?php echo(htmlspecialchars($title)); ?>" /></td>
                    </tr>
                    <tr>
                        <th><label for="category">Category<span class="required">*</span></label></th>
                        <td><select id="category" name="category">
                                <option value="">Select One</option>
                                <option value="Billable">Billable</option>
                                <option value="Charity">Charity</option>
                                <option value="Personal">Personal</option>
                        </select></td>
                    </tr>
                </table>
                <input type="hidden" id="project_id" name="project_id" value="<?php echo $_GET['p_id']; ?>" />
                <input class="button button--primary button--topic-php" type="submit" value="Submit" />
            </form>
        </div>
    </div>
</div>

<?php include "inc/footer.php"; ?>
