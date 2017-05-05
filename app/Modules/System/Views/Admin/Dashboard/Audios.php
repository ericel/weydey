<section class="content-header">
    <h1><?= __d('system', 'Audios'); ?></h1>
    <ol class="breadcrumb">
        <li><a href='<?= site_url('admin/audios'); ?>'><i class="fa fa-headphones"></i> <?= __d('system', 'Audios'); ?></a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

<?= Session::getMessages(); ?>

<div class="box box-widget">
    <div class="box-body">
        <h4><strong><?= __d('system', 'Edit Your Audios Here.'); ?></strong></h4>
       <div class="table-responsive">          
        <table class="table">
            <thead>
            <tr>
                <th>File ID</th>
                <th>Filename </th>
                <th>File Img</th>
                <th>File Date</th>
                <th>Author</th>
                <th>Downloads</th>
                <th>Views</th>
                <th>File</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($audios as $audio){ ?>
            <tr>
                <td><?php echo $audio->fileID; ?></td>
                <td><?php echo $audio->filename; ?><br> <a class="btn btn-primary" href="/edit/audio/<?php echo Str::slug($audio->filename).'-'.$audio->fileID; ?>"> Edit</a></td>
                <td><?php echo $audio->fileImg; ?><br>
                    <img src="<?php echo resource_url(''. $audio->fileImg.''); ?>" width="40px" height="20px">
                </td>
                <td><?php echo $audio->created_at; ?></td>
                <td><?php echo $audio->username; ?></td>
                <td>0</td>
                <td><?php echo $audio->fileViews; ?></td>
                <td><?php echo $audio->file; ?><br>
                <audio controls>
                <source src="<?php echo resource_url(''. $audio->file.''); ?>" type="audio/ogg">
                <source src="<?php echo resource_url(''. $audio->file.''); ?>" type="audio/mpeg">
                Your browser does not support the audio tag.
                </audio>
                </td>
            </tr>
            <?php } ?>
            </tbody>
        </table>
        </div>
    </div>
</div>

</section>
