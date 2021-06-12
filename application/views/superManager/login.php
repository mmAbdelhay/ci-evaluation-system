<?php echo form_open('superManager/login'); ?>
<div class="d-flex justify-content-center align-items-center container ">
        <div class="col-md-4 col-md-offset-4">
            <h2 class="text-center">Super Manager <?php echo $title; ?></h2><hr>
            <div class="form-group">
                <input type="text" name="email" class="form-control" placeholder="Enter Email" required autofocus>
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Enter Password" required
                       autofocus>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Login</button>
        </div>
    </div>
<?php echo form_close(); ?>
