<?php echo form_open('directManager/register'); ?>
<div class="d-flex justify-content-center align-items-center container ">
    <div class="col-md-4 col-md-offset-4">
        <h1 class="text-center"><?= $title; ?></h1>
        <?php if (validation_errors()) : ?>
            <div class="alert alert-danger">
                <?php echo validation_errors(); ?>
            </div>
        <?php endif; ?>
        <div class="form-group">
            <input type="text" class="form-control" name="name" placeholder="Name">
        </div>
        <div class="form-group">
            <input type="email" class="form-control" name="email" placeholder="Email">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="Password">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="password2" placeholder="Confirm Password">
        </div>
        <div class="form-group">
            <label>Creator :</label>
            <select class="form-control" id="exampleFormControlSelect1" disabled name="creator">
                <option value="<?= $this->session->userdata('user_id') ?>"><?= $this->session->userdata('email') ?></option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Register</button>
    </div>
    <br>
    <?php echo form_close(); ?>
</div>
<br>
