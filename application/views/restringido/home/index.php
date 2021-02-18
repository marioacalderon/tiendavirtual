<?php $this->load->view('restringido/layouts/navbar'); ?>

    <?php $this->load->view('restringido/layouts/sidebar'); ?>

    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-body">

                <?php if ($message = $this->session->flashdata('success')): ?>
                    <div class="alert alert-success alert-dismissible show fade">
                        <div class="alert-body">
                            <button class="close" data-dismiss="alert">
                            <span>&times;</span>
                            </button>
                            <?php echo $message; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- add content here -->
            </div>
        </section>

        <?php $this->load->view('restringido/layouts/sidebar_settings'); ?>

    </div>

