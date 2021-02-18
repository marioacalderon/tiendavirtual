<?php if ($message = $this->session->flashdata('success')) { ?>
    <div class="alert alert-success alert-dismissible show fade">
        <div class="alert-body">
            <button class="close" data-dismiss="alert">
            <span>&times;</span>
            </button>
            <?php echo $message; ?>
        </div>
    </div>
<?php } if ($message = $this->session->flashdata('error')) { ?>
    <div class="alert alert-danger alert-dismissible show fade">
        <div class="alert-body">
            <button class="close" data-dismiss="alert">
            <span>&times;</span>
            </button>
            <?php echo $message; ?>
        </div>
    </div>
<?php } ?>