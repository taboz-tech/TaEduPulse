<?php defined('BASEPATH') OR exit('') ?>

<div class='col-sm-6'>
    <?= isset($range) && !empty($range) ? $range : ""; ?>
</div>

<div class='col-xs-12'>
    <div class="panel panel-primary">
        <!-- Default panel contents -->
        <div class="panel-heading">Teachers</div>
        <?php if($allTeachers): ?>
        <div class="table table-responsive">
            <table class="table table-bordered table-striped table-hover" style="background-color: #f5f5f5">
                <thead>
                    <tr>
                        <th>SN</th>
                        <th>NAME</th>
                        <th>SURNAME</th>
                        <th>GENDER</th>
                        <th>NATIONAL ID</th>
                        <th>PROFESSION</th>
                        <th>PHONE</th>
                        <th>ADDRESS</th>
                        <th>SUBJECT</th>
                        <th>DEPARTMENT</th>
                        <th>DATE JOINED</th>
                        <th>EDIT</th>
                        <th>DELETE</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($allTeachers as $get): ?>
                    <tr>
                        <input type="hidden" value="<?=$get->id?>" class="curTeacherId">
                        <th class="teacherSN"><?=$sn?>.</th>
                        <td><span id="teacherName-<?=$get->id?>"><?=$get->name?></span></td>
                        <td><span id="teacherSurname-<?=$get->id?>"><?=$get->surname?></td>
                        <td><span id="teacherGender-<?=$get->id?>"><?=$get->gender?></td>
                        <td><span id="teacherNational_id-<?=$get->id?>"><?=$get->national_id?></td>
                        <td><span id="teacherProfession-<?=$get->id?>"><?=$get->profession?></td>
                        <td><span id="teacherPhone-<?=$get->id?>"><?=$get->phone?></td>
                        <td><span id="teacherAddress-<?=$get->id?>"><?=$get->address?></td>
                        <td><span id="teacherSubject-<?=$get->id?>"><?=$get->subject?></td>
                        <td><span id="teacherDepartment-<?=$get->id?>"><?=$get->department?></td>
                        <td><span id="teacherDate_joined-<?=$get->id?>"><?=$get->dateAdded?></td>
                        <td class="text-center text-primary">
                            <span class="editTeacher" id="edit-<?=$get->id?>"><i class="fa fa-pencil pointer"></i> </span>
                        </td>
                        <td class="text-center"><i class="fa fa-trash text-danger delTeacher pointer"></i></td>
                    </tr>
                    <?php $sn++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <!-- table div end-->
        <?php else: ?>
        <ul><li>No Teachers</li></ul>
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
