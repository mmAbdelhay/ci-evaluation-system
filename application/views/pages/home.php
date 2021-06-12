<div class="container">
    <h2>this our home</h2>
    <p>id : <?= $this->session->userdata('user_id') ?></p>
    <p>email : <?= $this->session->userdata('email') ?></p>
    <p>role : <?= $this->session->userdata('role') ?></p>
    <?php if ($this->session->userdata('role') == 'superManager') : ?>
        <a class="btn btn-outline-primary float-right" href="<?php echo base_url(); ?>directManager/register">create direct manager</a>
    <?php endif; ?>
    <?php if ($this->session->userdata('role') == 'directManager') : ?>
        <a class="btn btn-outline-primary float-right" href="<?php echo base_url(); ?>employee/register">create employee</a>
    <?php endif; ?>
    <?php if ($this->session->userdata('role') == 'employee') : ?>
        <p>welcome employee</p>
    <?php endif; ?>
</div>