<div class="container">
    <h2 class="text-center">Evaluation sheet</h2><br>
    <div class="card">
        <div class="card-header">
            <b>Evaluation ID : <?= $id ?></b>
            <a class="btn btn-sm btn-outline-info float-right"
               href="<?php echo base_url(); ?>evaluation/getpdf/<?= $empID ?>">Export evaluation as pdf</a>
        </div>
        <div class="card-body" style="display: flex; justify-content: space-between">
            <div>
                <p class="card-text">Employee ID : <?= $empID ?></p>
                <p class="card-text">Employee name : <?= $empName ?></p>
                <p class="card-text">Employee email : <?= $empEmail ?></p>
            </div>
            <div>
                <p class="card-text">Direct manager ID : <?= $managerID ?></p>
                <p class="card-text">Direct manager name : <?= $managerName ?></p>
                <p class="card-text">Direct manager email : <?= $managerEmail ?></p>
            </div>
            <div>
                <p class="card-text">Evaluation period : <?= $period ?></p>
                <p class="card-text">Created at :<?= $createdAt ?></p>
                <p><strong>Total score (100%) : <?= $totalScore ?> % </strong></p>
            </div>
        </div>
        <div class="card-body">
            <h5 class="text-center" style="text-decoration: underline">First competency (1 : 5)</h5>
            <div style="display: flex; justify-content: space-between">
                <p>Administrative <b><?= $administrative ?></b> out of 5</p>
                <p><b>First competency average <?= $administrative ?> out of 5</b></p>
            </div>
            <hr>
            <h5 class="text-center" style="text-decoration: underline">Second competency "Survey" (1 : 5)</h5><br>
            <div style="display: flex; justify-content: space-between">
                <div style="justify-content: center">
                    <p>Quality of work : <b><?= $quality_of_work ?></b> out of 5</p>
                    <p>Technical skills : <b><?= $technical_skills ?></b> out of 5</p>
                    <p>Honesty : <b><?= $honesty ?> </b>out of 5</p>
                </div>
                <div style="justify-content: center">
                    <p>Creativity : <b><?= $creativity ?> </b>out of 5</p>
                    <p>Attendance : <b><?= $attendance ?></b> out of 5</p>
                    <p>Independent work : <b><?= $independent_work ?></b> out of 5</p>
                </div>
                <div style="justify-content: center">
                    <p>Communication : <b><?= $communication ?></b> out of 5</p>
                    <p>Integrity : <b><?= $integrity ?></b> out of 5</p>
                    <p>Punctuality : <b><?= $punctuality ?></b> out of 5</p>
                </div>
                <div style="justify-content: center">
                    <p>Coworker relations : <b><?= $coworker_relations ?></b> out of 5</p>
                    <p>Work consistency : <b><?= $work_consistency ?> </b>out of 5</p>
                    <p>Productivity : <b><?= $productivity ?> </b>out of 5</p>
                </div>
            </div>
            <div>
                <p class="float-right"><b>Second competency average : <?= $firstAvg ?> out of 5</b></p>
            </div>
        </div>
        <div class="card-footer">
            <p class="text-center">powered by "company name"</p>
        </div>
    </div>
    <br><br>
</div>