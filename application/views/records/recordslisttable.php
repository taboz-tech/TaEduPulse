<?php defined('BASEPATH') OR exit(''); ?>

<div class='col-sm-6'>
    <?= isset($range) && !empty($range) ? $range : ""; ?>
</div>

<div class='col-xs-12'>
    <div class="panel panel-primary">
        <!-- Default panel contents -->
        <div class="panel-heading">Records</div>
        <?php if($allReports): ?>
        <div class="table table-responsive">
            <table class="table table-bordered table-striped table-hover" style="background-color: #f5f5f5">
                <thead>
                    <tr>
                        <th>SN</th>
                        <th>Record Name</th>
                        <th>Download</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($allReports as $key => $report): ?>
                    <tr>
                        <th><?= $sn ?></th>
                        <td><?= $report['file_name'] ?></td>
                        <td class="text-center"><a href="<?= $report['download_link'] ?>" class="text-primary" download><i class="fa fa-download pointer"></i></a></td>
                    </tr>
                    <?php $sn++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <!-- table div end-->
        <?php else: ?>
        <ul><li>No Records</li></ul>
        <?php endif; ?>
    </div>
    <!--- panel end-->
</div>

<!--- Pagination div -->
<div class="col-sm-12 text-center">
    <ul class="pagination">
        <?= isset($links) ? $links : "" ?>
    </ul>
</div>
