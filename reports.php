<?php
require 'inc/functions.php';

$page = "reports";
$pageTitle = "Reports | Time Tracker";
$filter = 'All';

include 'inc/header.php';
?>
<div class="col-container page-container">
    <div class="col col-70-md col-60-lg col-center">
        <div class="col-container">
            <h1 class='actions-header'>Reports</h1>
        </div>
        <div class="section page">
            <div class="wrapper">
                <table>
                    <?php $total = $project_id = $project_total = 0;
                        foreach (get_task_list ($filter) as $task) {
                            if ($project_id != $task['project_id']){
                                if($project_id > 0){
                                    echo "<tr><th class='project-total-label colspan'2'>Project Total</th><th class='project-total-number'>".$project_total."</th></tr>";
                                    $project_total = 0;
                                }
                                $project_id = $task['project_id'];
                                echo "<thead\n><tr\n><th>".$task['project']."</th><th>Date</th><th>Time</th></tr\n></thead\n>";
                            }    
                            echo "<tr>\n
                            <td>".$task['title']."</td>
                            <td>".$task['date']."</td>
                            <td>".$task['time']."</td>
                            </tr>";


                            $total += $task['time'];
                            $project_total += $task['time'];      
                        }
                    ?>
                    <tr>
                        
                        <th class='grand-total-label' colspan='2'>Grand Total</th>
                        <th class='grand-total-number'><?php echo $total;; ?></th>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include "inc/footer.php"; ?>

