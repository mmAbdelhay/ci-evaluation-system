<div class="container">
    <table class="table table-hover display" id="allPendingEvaluations">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Employee </th>
            <th scope="col">Direct manager</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php if (!empty($evaluations)) : ?>
            <?php foreach ($evaluations as $evaluation) : ?>
                <tr>
                    <th scope="row"><?= $evaluation->id ?></th>
                    <td><a href="<?php echo base_url(); ?>employee/getEvaluation/<?= $evaluation->empID ?>"><?= $evaluation->empName ?></a></td>
                    <td><?= $evaluation->directManagerName ?></td>
                    <td>
                        <?php echo form_open('superManager/acceptEvaluation'); ?>
                        <input type="hidden" name="id" value="<?= $evaluation->id ?>">
                        <input type="submit" class="btn btn-outline-info float-left mr-2" value="Accept">
                        <?php echo form_close(); ?>
                        <?php echo form_open('superManager/rejectEvaluation'); ?>
                        <input type="hidden" name="id" value="<?= $evaluation->id ?>">
                        <input type="submit" class="btn btn-outline-danger float-left mr-2" value="Reject">
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
        $('#allPendingEvaluations').DataTable();
    });
</script>