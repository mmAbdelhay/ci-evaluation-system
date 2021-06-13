<div class="container">
    <h2 class="text-center">Home page</h2>
    <p><b>Logged in user info :</b></p>
    <ul>
        <li>id : <?= $this->session->userdata('user_id') ?></li>
        <li>email : <?= $this->session->userdata('email') ?></li>
        <li>role : <?= $this->session->userdata('role') ?></li>
    </ul>
    <?php if ($this->session->userdata('role') == 'superManager') : ?>
        <a class="btn btn-outline-primary float-right mr-2" href="<?php echo base_url(); ?>directManager/register">create direct
            manager</a>
        <a class="btn btn-outline-primary float-right mr-2" href="<?php echo base_url(); ?>superManager/allPendingEvaluation">All pending
            evaluations</a>
    <?php endif; ?>
    <?php if ($this->session->userdata('role') == 'directManager') : ?>
        <a class="btn btn-outline-primary float-right mr-2" href="<?php echo base_url(); ?>employee/register">create employee</a>
        <a class="btn btn-outline-primary float-right mr-2" href="<?php echo base_url(); ?>directManager/index">Non evaluated
            employees</a>
        <a class="btn btn-outline-primary float-right mr-2" href="<?php echo base_url(); ?>directManager/getAllEvaluatedEmployees">All
            evaluated employees</a>
    <?php endif; ?>
    <?php if ($this->session->userdata('role') == 'employee') : ?>
        <a class="btn btn-outline-primary float-right mr-2"
           href="<?php echo base_url(); ?>employee/getEvaluation/<?= $this->session->userdata('user_id') ?>">Show my
            evaluation</a>
    <?php endif; ?>
</div>