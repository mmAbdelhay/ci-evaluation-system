<div class="container">
    <table class="table table-hover display" id="allEvaluatedEmployees" >
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Period</th>
            <th scope="col">1 st competency (1:5)</th>
            <th scope="col">2 st competency (1:5)</th>
            <th scope="col">Total Score %</th>
        </tr>
        </thead>
        <tbody>
        <?php if (!empty($employees)) : ?>
            <?php foreach ($employees as $employee) : ?>
                <tr>
                    <th scope="row"><?= $employee->id ?></th>
                    <td><a href="<?php echo base_url(); ?>employee/getEvaluation/<?= $employee->empID ?>"><?= $employee->name ?></a></td>
                    <td><?= $employee->period ?></td>
                    <td><?= $employee->administrative ?></td>
                    <td><?= $employee->firstAvg ?></td>
                    <td><?= $employee->totalScore ?></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>
</div>
<script>
    $(document).ready(function () {
        $('#allEvaluatedEmployees').DataTable();
    });
</script>