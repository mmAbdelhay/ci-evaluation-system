<h2 style="text-align: center">Evaluation sheet</h2>
<p style="text-align: right; position: relative; top: 30px"><strong>Total score (100%) : <?= $totalScore ?> % </strong></p>
<b>Evaluation ID : <?= $id ?></b>
<p class="card-text">Employee ID : <?= $empID ?></p>
<p class="card-text">Employee name : <?= $empName ?></p>
<p class="card-text">Employee email : <?= $empEmail ?></p>
<hr>
<p class="card-text">Direct manager ID : <?= $managerID ?></p>
<p class="card-text">Direct manager name : <?= $managerName ?></p>
<p class="card-text">Direct manager email : <?= $managerEmail ?></p>
<hr>
<p class="card-text">Evaluation period : <?= $period ?></p>
<p class="card-text">Created at :<?= $createdAt ?></p>
<hr>
<h5 style="text-decoration: underline;text-align: center;font-size: large">First competency (1 : 5)</h5>
<div style="text-align: left; float: left">
    <p>Administrative <b><?= $administrative ?></b> out of 5</p>
</div>
<div style="text-align: right">
    <p><b>First competency average <?= $administrative ?> out of 5</b></p>
</div>
<hr>
<h5 style="text-decoration: underline;text-align: center;font-size: large">Second competency "Survey" (1 : 5)</h5><br>
<div style="text-align: left; float: left">
    <p>Quality of work : <b><?= $quality_of_work ?></b> out of 5</p>
    <p>Technical skills : <b><?= $technical_skills ?></b> out of 5</p>
    <p>Honesty : <b><?= $honesty ?> </b>out of 5</p>
    <p>Creativity : <b><?= $creativity ?> </b>out of 5</p>
    <p>Attendance : <b><?= $attendance ?></b> out of 5</p>
    <p>Independent work : <b><?= $independent_work ?></b> out of 5</p>
</div>
<div style="text-align: right">
    <p>Communication : <b><?= $communication ?></b> out of 5</p>
    <p>Integrity : <b><?= $integrity ?></b> out of 5</p>
    <p>Punctuality : <b><?= $punctuality ?></b> out of 5</p>
    <p>Coworker relations : <b><?= $coworker_relations ?></b> out of 5</p>
    <p>Work consistency : <b><?= $work_consistency ?> </b>out of 5</p>
    <p>Productivity : <b><?= $productivity ?> </b>out of 5</p>
</div>
<p style="text-align: right"><b>Second competency average : <?= $firstAvg ?> out of 5</b></p>
<hr>
<p style="text-align: center">powered by "company name"</p>

