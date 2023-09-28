<?php defined('BASEPATH') OR exit(''); ?>

<div class='col-sm-6'>
    <?= isset($range) && !empty($range) ? $range : ""; ?>
</div>

<div class='col-xs-12'>
    <div class="panel panel-primary">
        <!-- Default panel contents -->
        <div class="panel-heading">Assets</div>
        <?php if($allassets): ?>
        <div class="table table-responsive">
            <table class="table table-bordered table-striped table-hover" style="background-color: #f5f5f5">
                <thead>
                    <tr>
                        <th>SN</th>
                        <th>Asset Number</th>
                        <th>Description</th>
                        <th>Serial Number</th>
                        <th>Location</th>
                        <th>Purchase Date</th>
                        <th>Supplier</th>
                        <th>Cost</th>
                        <th>Depreciation Method</th>
                        <th>Depreciation Rate</th>
                        <th>Useful Life</th>
                        <th>Owner</th>
                        <th>EDIT</th>
                        <th>DELETE</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($allassets as $asset): ?>
                    <tr>
                        <input type="hidden" value="<?=$asset->id?>" class="curAssetId">
                        <th class="assetSN"><?=$sn?>.</th>
                        <td><span id="assetNumber-<?=$asset->id?>"><?=$asset->asset_number?></span></td>
                        <td><span id="description-<?=$asset->id?>"><?=$asset->description?></span></td>
                        <td><span id="serialNumber-<?=$asset->id?>"><?=$asset->serial_number?></span></td>
                        <td><span id="location-<?=$asset->id?>"><?=$asset->location?></span></td>
                        <td><span id="purchaseDate-<?=$asset->id?>"><?=$asset->purchase_date?></span></td>
                        <td><span id="supplier-<?=$asset->id?>"><?=$asset->supplier?></span></td>
                        <td><span id="cost-<?=$asset->id?>"><?=$asset->cost?></span></td>
                        <td><span id="depreciationMethod-<?=$asset->id?>"><?=$asset->depreciation_method?></span></td>
                        <td><span id="depreciationRate-<?=$asset->id?>"><?=$asset->depreciation_rate?></span></td>
                        <td>
                            <?php
                            $depreciationMethod = $asset->depreciation_method;
                            $usefulLife = 0;

                            if ($depreciationMethod === "Straight-Line") {
                                // Calculate Useful Life for Straight-Line
                                $usefulLife = $asset->cost / ($asset->depreciation_rate > 0 ? $asset->depreciation_rate : 1);
                            } elseif ($depreciationMethod === "Declining Balance") {
                                // Calculate Useful Life for Declining Balance without salvage value
                                $usefulLife = 1 / $asset->depreciation_rate;
                            } else {
                                // Unsupported depreciation method message
                                ?>
                                Unsupported depreciation method
                                <?php
                            }
                            ?>
                            <?= number_format($usefulLife, 2) ?>
                        </td>

                        <td><span id="owner-<?=$asset->id?>"><?=$asset->owner?></span></td>
                        <td class="text-center text-primary">
                            <span class="editAsset" id="edit-<?=$asset->id?>"><i class="fa fa-pencil pointer"></i> </span>
                        </td>
                        <td class="text-center"><i class="fa fa-trash text-danger delAsset pointer"></i></td>
                    </tr>
                    <?php $sn++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <!-- table div end-->
        <?php else: ?>
        <ul><li>No Assets</li></ul>
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
