<div class="container">
    <table class="table table-hover display" id="allNonEvaluated">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        <?php if (!empty($employees)) : ?>
            <?php foreach ($employees as $employee) : ?>
                <tr>
                    <th scope="row"><?= $employee->id ?></th>
                    <td><?= $employee->name ?></td>
                    <td><?= $employee->email ?></td>
                    <td>
                        <?php echo form_open('evaluation/evaluate'); ?>
                        <input type="hidden" name="id" value="<?= $employee->id ?>">
                        <input type="hidden" name="name" value="<?= $employee->name ?>">
                        <input type="hidden" name="email" value="<?= $employee->email ?>">
                        <input type="submit" class="btn btn-outline-info" value="Evaluate">
                        <?php echo form_close(); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>
</div>
<script>
    $(document).ready(function () {
        $('#allNonEvaluated').DataTable();
    });
</script>