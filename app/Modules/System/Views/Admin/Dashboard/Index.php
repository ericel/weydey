<section class="content-header">
    <h1><?= __d('system', 'Dashboard'); ?></h1>
    <ol class="breadcrumb">
        <li><a href='<?= site_url('admin/dashboard'); ?>'><i class="fa fa-dashboard"></i> <?= __d('system', 'Dashboard'); ?></a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

<?= Session::getMessages(); ?>

<div class="box box-widget">
    <div class="box-body">
        <h4><strong><?= __d('system', 'Yup. This is the Dashboard.'); ?></strong></h4>
        <!-- Here is the section -->
     
      <section id="counter" class="counter">
            <div class="main_counter_area">
                <div class="overlay p-y-3">
                    <div class="container">
                        <div class="row">
                            <div class="main_counter_content text-center white-text wow fadeInUp">
                                <div class="col-md-3">
                                    <div class="single_counter p-y-2 m-t-1">
                                        <i class="fa fa-headphones m-b-1"></i>
                                        <h2 class="statistic-counter"><?php echo count($audios); ?></h2>
                                        <p>Added Audios</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="single_counter p-y-2 m-t-1">
                                        <i class="fa fa-file-video-o m-b-1"></i>
                                        <h2 class="statistic-counter"><?php echo count($videos); ?></h2>
                                        <p>Added Videos</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="single_counter p-y-2 m-t-1">
                                        <i class="fa fa-refresh m-b-1"></i>
                                        <h2 class="statistic-counter">0</h2>
                                        <p>Published Blogs</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="single_counter p-y-2 m-t-1">
                                        <i class="fa fa-beer m-b-1"></i>
                                        <h2 class="statistic-counter">0</h2>
                                        <p>Added Places</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- End of counter Section -->


<!-- Add this script before </body> -->
    </div>
</div>

</section>
