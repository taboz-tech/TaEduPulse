<?php defined('BASEPATH') OR exit('') ?>

<div class='col-sm-6'>
    <?= isset($range) && !empty($range) ? $range : ""; ?>
</div>

<div class='col-xs-12'>
    <div class="panel panel-primary">
        <!-- Default panel contents -->
        <div class="panel-heading">Staff</div>
        <?php if($allStaffs): ?>
        <div class="table table-responsive">
            <table class="table table-bordered table-striped table-hover" style="background-color: #f5f5f5">
                <thead>
                    <tr>
                        <th>SN</th>
                        <th>NAME</th>
                        <th>SURNAME</th>
                        <th>GENDER</th>
                        <th>NATIONAL ID</th>
                        <th>STAFF ID</th>
                        <th>PHONE</th>
                        <th>ADDRESS</th>
                        <th>EMAIL</th>
                        <th>JOB TITTLE</th>
                        <th>SALARY</th>
                        <th>DOB</th>
                        <th>DEPARTMENT</th>
                        <th>ADVANCE PAYMENT</th>
                        <th>OVERTIME</th>
                        <th>DATE JOINED</th>
                        <th>STATUS</th>
                        <th>EDIT</th>
                        <th>DELETE</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($allStaffs as $get): ?>
                    <tr>
                        <input type="hidden" value="<?=$get->id?>" class="curStaffId">
                        <th class="staffSN"><?=$sn?>.</th>
                        <td><span id="staffName-<?=$get->id?>"><?=$get->name?></span></td>
                        <td><span id="staffSurname-<?=$get->id?>"><?=$get->surname?></td>
                        <td><span id="staffGender-<?=$get->id?>"><?=$get->gender?></td>
                        <td><span id="staffNational_id-<?=$get->id?>"><?=$get->national_id?></td>
                        <td><span id="staffStaff_id-<?=$get->id?>"><?=$get->staff_id?></td>
                        <td><span id="staffPhone-<?=$get->id?>"><?=$get->phone?></td>
                        <td><span id="staffAddress-<?=$get->id?>"><?=$get->address?></td>
                        <td><span id="staffEmail-<?=$get->id?>"><?=$get->email?></td>
                        <td><span id="staffJob_tittle-<?=$get->id?>"><?=$get->job_tittle?></td>
                        <td><span id="staffSalary-<?=$get->id?>"><?=$get->basic_salary?></td>
                        <td><span id="staffDob-<?=$get->id?>"><?=$get->dob?></td>
                        <td><span id="staffDepartment-<?=$get->id?>"><?=$get->department?></td>
                        <td><span id="staffAdvancePayment-<?=$get->id?>"><?=$get->advance_payment?></td>
                        <td><span id="staffOvertime-<?=$get->id?>"><?=$get->overtime?></td>
                        <td><span id="staffDate_joined-<?=$get->id?>"><?=$get->dateAdded?></td>
                        <td class="text-center staffStatus text-success" id="staffStatus-<?=$get->id?>">
                            <?php if($get->status == "1"): ?>
                            <i class="fa fa-toggle-on pointer"></i>
                            <?php else: ?>
                            <i class="fa fa-toggle-off pointer"></i>
                            <?php endif; ?>
                        </td>
                        <td class="text-center text-primary">
                            <span class="editStaff" id="edit-<?=$get->id?>"><i class="fa fa-pencil pointer"></i> </span>
                        </td>
                        <td class="text-center"><i class="fa fa-trash text-danger delStaff pointer"></i></td>
                    </tr>
                    <?php $sn++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <!-- table div end-->
        <?php else: ?>
        <ul><li>No Staff</li></ul>
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
