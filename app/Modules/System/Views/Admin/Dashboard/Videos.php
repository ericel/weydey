<section class="content-header">
    <h1><?= __d('system', 'Videos'); ?></h1>
    <ol class="breadcrumb">
        <li><a href='<?= site_url('admin/videos'); ?>'><i class="fa fa-file-video-o"></i> <?= __d('system', 'Videos'); ?></a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

<?= Session::getMessages(); ?>

<div class="box box-widget">
    <div class="box-body">
        <h4><strong><?= __d('system', 'Edit Your Videos Here.'); ?></strong></h4>
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
             <?php foreach($videos as $video){ ?>
            <tr>
                <td><?php echo $video->fileID; ?></td>
                <td><?php echo $video->filename; ?><br> <a class="btn btn-primary" href="/edit/video/<?php echo Str::slug($video->filename).'-'.$video->fileID; ?>"> Edit</a></td>
                <td><?php echo $video->fileImg; ?><br>
                    <img src="<?php echo resource_url(''. $video->fileImg.''); ?>" width="40px" height="20px">
                </td>
                <td><?php echo $video->created_at; ?></td>
                <td><?php echo $video->username; ?></td>
                <td>0</td>
                <td><?php echo $video->fileViews; ?></td>
                <td><?php echo $video->file; ?><br>
                <video controls height="70px" width="100px">
                <source src="<?php echo resource_url(''. $video->file.''); ?>" type="video/mp4">
                Your browser does not support the video tag.
                </video>
                </td>
            </tr>
            <?php } ?>
            </tbody>
        </table>
        </div>
    </div>
</div>

</section>
