
<?php if ($this->session->has_userdata('success')) { ?>
    <div class="alert alert-success alert-dismissible show fade">
        <div class="alert-body">
            <button class="close" data-dismiss="alert">
            <span>&times;</span>
            </button>
            <?php echo $this->session->flashdata('success') ?>
        </div>
    </div>
<?php } ?>