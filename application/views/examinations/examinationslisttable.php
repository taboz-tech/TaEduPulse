<?php defined('BASEPATH') OR exit(''); ?>

<div class='col-sm-6'>
    <?= isset($range) && !empty($range) ? $range : ""; ?>
</div>

<div class='col-xs-12'>
    <div class="panel panel-primary">
        <!-- Default panel contents -->
        <div class="panel-heading">Students for Registration</div>
        <?php if($allStudents): ?>
        <div class="table table-responsive">
            <table class="table table-bordered table-striped table-hover" style="background-color: #f5f5f5">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Surname</th>
                        <th>Class</th>
                        <th>Number of Subjects</th>
                        <th>ZIMSEC Reg Number</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($allStudents as $get): ?>
                    <tr>
                        <input type="hidden" value="<?=$get->id?>" class="curStudentId">
                        <td><span id="studentName-<?=$get->id?>"><?=$get->name?></span></td>
                        <td><span id="studentSurname-<?=$get->id?>"><?=$get->surname?></span></td>
                        <td><span id="studentClass_name-<?=$get->id?>"><?=$get->class_name?></span></td>
                        <td>
                            <?php
                                // Convert the comma-separated subjects to an array
                                $subjectsArray = !empty($get->subjects) ? explode(',', $get->subjects) : [];

                                // Check if any subjects are available
                                if (!empty($subjectsArray)) {
                                    echo '<span id="numberOfSubjects-' . $get->id . '">' . count($subjectsArray) . '</span>';
                                } else {
                                    echo '<span id="numberOfSubjects-' . $get->id . '">N/A</span>';
                                }
                            ?>
                        </td>                           
                        <td><span id="zimsecRegNumber-<?=$get->id?>"><?=$get->zimsec_registration_number ?: 'N/A'?></span></td>
                        
                        <td class="text-center text-primary">
                            <!-- Register Button -->
                            <a href="#" data-student-id="<?=$get->id?>" class="btn btn-success btn-sm registerButton">Register</a>

                            <!-- View Details Button -->
                            <a href="#" data-student-id="<?=$get->id?>" class="btn btn-info btn-sm viewButton">View Details</a>
                        </td>

                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <!-- table div end-->
        <?php else: ?>
        <p>No students available for registration.</p>
        <?php endif; ?>
    </div>
    <!--- panel end-->
</div>

<!---Pagination div-->
<div class="col-sm-12 text-center">
    <ul class="pagination">
        <?= isset($links) ? $links : "" ?>
    </ul>
</div>
