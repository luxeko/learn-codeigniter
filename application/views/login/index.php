<div class="container mt-5">
    <h3>Login Admin Page</h3>
    <?php if ($this->session->flashdata('success_logout')) { ?>
        <div class="alert alert-success"><?php echo $this->session->flashdata('success_logout') ?></div>
    <?php } elseif ($this->session->flashdata('error')) { ?>
        <div class="alert alert-danger"><?php echo $this->session->flashdata('error') ?></div>
    <?php } ?>
    <form action="<?php echo base_url('login-user') ?>" method="post">
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" name="email">
        </div>
        <?php echo form_error('email') ?>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <?php echo form_error('password') ?>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>