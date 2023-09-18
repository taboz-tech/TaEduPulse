<?php defined('BASEPATH') OR exit('') ?>

<div class='col-sm-6'>
    <?= isset($range) && !empty($range) ? $range : ""; ?>
</div>

<div class='col-xs-12'>
    <div class="panel panel-primary">
        <!-- Default panel contents -->
        <div class="panel-heading">Students</div>
        <?php if($allStudents): ?>
        <div class="table table-responsive">
            <table class="table table-bordered table-striped table-hover" style="background-color: #f5f5f5">
                <thead>
                    <tr>
                        <th>SN</th>
                        <th>STUDENT NAME</th>
                        <th>STUDENT SURNAME</th>
                        <th>STUDENT ID</th>
                        <th>CLASS NAME</th>
                        <th>PARENT NAME</th>
                        <th>RELATIONSHIP</th>
                        <th>PARENT PHONE</th>
                        <th>ADDRESS</th>
                        <th>FEES</th>
                        <th>OWED FEES</th>
                        <th>GENDER</th>
                        <th>HEALTHY STATUS</th>
                        <th>EDIT</th>
                        <th>DELETE</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($allStudents as $get): ?>
                    <tr>
                        <input type="hidden" value="<?=$get->id?>" class="curStudentId">
                        <th class="studentSN"><?=$sn?>.</th>
                        <td><span id="studentName-<?=$get->id?>"><?=$get->name?></span></td>
                        <td><span id="studentSurname-<?=$get->id?>"><?=$get->surname?></td>
                        <td><span id="studentStudent_id-<?=$get->id?>"><?=$get->student_id?></td>
                        <td><span id="studentClass_name-<?=$get->id?>"><?=$get->class_name?></td>
                        <td><span id="studentParent_name-<?=$get->id?>"><?=$get->parent_name?></td>
                        <td><span id="studentRelationship-<?=$get->id?>"><?=$get->relationship?></td>
                        <td><span id="studentParent_phone-<?=$get->id?>"><?=$get->parent_phone?></td>
                        <td><span id="studentAddress-<?=$get->id?>"><?=$get->address?></td>
                        <td><span id="studentFees-<?=$get->id?>"><?=number_format($get->fees,2)?></td>
                        <td class="<?= ($get->owed_fees < 0) ? 'bg-success' : '' ?>">
                            <span id="studentOwed_fees-<?=$get->id?>">
                                <?= ($get->owed_fees < 0) ? '<i class="fa fa-check"></i>' : '' ?> <?= number_format($get->owed_fees, 2) ?>
                            </span>
                        </td>
                        <td><span id="studentGender-<?=$get->id?>"><?=$get->gender?></td>
                        <td><span id="studentHealthy_status-<?=$get->id?>"><?=$get->healthyStatus?></td>
                        <td class="text-center text-primary">
                            <span class="editStudent" id="edit-<?=$get->id?>"><i class="fa fa-pencil pointer"></i> </span>
                        </td>
                        <td class="text-center"><i class="fa fa-trash text-danger delStudent pointer"></i></td>
                    </tr>
                    <?php $sn++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <!-- table div end-->
        <?php else: ?>
        <ul><li>No Students</li></ul>
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
