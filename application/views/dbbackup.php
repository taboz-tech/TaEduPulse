<?php
defined('BASEPATH') OR exit('');
?>

<div class="pwell hidden-print"> 
    <div class="row">
            <div class="col-sm-6">
                <a href="<?=base_url()?>misc/backupDb"><button class="btn btn-primary">Backup Database</button></a>
            </div>

        <br class="visible-xs">
        
        <div class="col-sm-6">
            <button class="btn btn-info" id="importdb">Import Data</button>
            <span class="help-block">File must be of type .sqlite</span>
            <input type="file" id="selecteddbfile" class="hidden" accept=".sqlite">
            <span class="help-block" id="dbFileMsg"></span>
        </div>
    </div>
</div>