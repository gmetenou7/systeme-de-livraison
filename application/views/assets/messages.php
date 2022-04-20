<?php if($this->session->flashdata('success')){ ?>
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong><?php echo $this->session->flashdata('success'); ?></strong>
    </div>
<?php }else if($this->session->flashdata('error')){  ?>
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong><?php echo $this->session->flashdata('error'); ?></strong>
    </div>
<?php }else if($this->session->flashdata('warning')){  ?>
    <div class="alert alert-warning alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong><?php echo $this->session->flashdata('warning'); ?></strong>
    </div>
<?php }else if($this->session->flashdata('info')){  ?>
    <div class="alert alert-info alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong><?php echo $this->session->flashdata('info'); ?></strong>
    </div>
<?php } ?>