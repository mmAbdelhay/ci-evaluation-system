<!doctype html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
          integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js" defer></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/28.0.0/classic/ckeditor.js"></script>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/main.css">

    <title>Evaluation system</title>
</head>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="<?php echo base_url(); ?>">Evaluation system</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <?php if (!$this->session->userdata('logged_in')) : ?>
            <ul class="navbar-nav mr-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                       data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">
                        Login
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="<?php echo base_url(); ?>superManager/login">super manager</a>
                        <a class="dropdown-item" href="<?php echo base_url(); ?>directManager/login">direct
                            manager</a>
                        <a class="dropdown-item" href="<?php echo base_url(); ?>employee/login">employee</a>
                    </div>
                </li>
            </ul>
        <?php endif; ?>
        <?php if ($this->session->userdata('logged_in')) : ?>
            <div class="navbar-nav">
                <a class="nav-link active" aria-current="page" href="<?php echo base_url(); ?>">Home</a>
            </div>
            <div class="navbar-nav">
                <?php if ($this->session->userdata('role') == 'superManager') : ?>
                    <a class="nav-link active" aria-current="page" href="<?php echo base_url(); ?>superManager/logout">Logout</a>
                <?php endif; ?>
                <?php if ($this->session->userdata('role') == 'directManager') : ?>
                    <a class="nav-link active" aria-current="page" href="<?php echo base_url(); ?>directManager/logout">Logout</a>
                <?php endif; ?>
                <?php if ($this->session->userdata('role') == 'employee') : ?>
                    <a class="nav-link active" aria-current="page" href="<?php echo base_url(); ?>employee/logout">Logout</a>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</nav>
<br>
<div class="container">
    <?php if ($this->session->flashdata('user_registered')) : ?>
        <?php echo '<p class="alert alert-success">' . $this->session->flashdata('user_registered') . '</p>'; ?>
    <?php endif; ?>
    <?php if ($this->session->flashdata('login_failed')): ?>
        <?php echo '<p class="alert alert-danger">' . $this->session->flashdata('login_failed') . '</p>'; ?>
    <?php endif; ?>
    <?php if ($this->session->flashdata('user_loggedin')): ?>
        <?php echo '<p class="alert alert-success">' . $this->session->flashdata('user_loggedin') . '</p>'; ?>
    <?php endif; ?>
    <?php if ($this->session->flashdata('user_loggedout')): ?>
        <?php echo '<p class="alert alert-success">' . $this->session->flashdata('user_loggedout') . '</p>'; ?>
    <?php endif; ?>
    <?php if ($this->session->flashdata('evaluation_accepted')): ?>
        <?php echo '<p class="alert alert-success">' . $this->session->flashdata('evaluation_accepted') . '</p>'; ?>
    <?php endif; ?>
    <?php if ($this->session->flashdata('evaluation_rejected')): ?>
        <?php echo '<p class="alert alert-success">' . $this->session->flashdata('evaluation_rejected') . '</p>'; ?>
    <?php endif; ?>
</div>
<br><br>
