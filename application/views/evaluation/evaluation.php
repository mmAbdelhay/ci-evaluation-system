<div class="container">
    <?php if (validation_errors()) : ?>
        <div class="alert alert-danger">
            <?php echo validation_errors(); ?>
        </div>
    <?php endif; ?>
    <div class="card">
        <div class="card-header">
            <h5>Evaluation form for <b><?= $name ?></b></h5>
        </div>
        <div class="card-body">
            <p>Email : <?= $email ?></p>
            <p>Evaluator : <?= $this->session->userdata('email') ?></p>
        </div>
    </div>
    <br>
    <?php echo form_open('evaluation/submitEvaluation'); ?>
    <input type="hidden" name="empID" value="<?= $id ?>">
    <input type="hidden" name="name" value="<?= $name ?>">
    <input type="hidden" name="email" value="<?= $email ?>">
    <div class="form-group">
        <label>Period of Evaluation</label>
        <select class="custom-select" required name="period">
            <option value="first">First half</option>
            <option value="second">Second half</option>
        </select>
    </div>
    <br><br>
    <h5 class="text-center">First competency</h5><br>

    <div class="form-group">
        <label><b>Administrative evaluation :</b></label>
        <input type="range" class="custom-range" min="1" max="5" name="administrative">
    </div>
    <hr>
    <hr>
    <h5 class="text-center">Second competency</h5><br>
    <p><b>Survey evaluation :</b></p><br>
    <div class="form-row">
        <div class="col-md-3 mb-3">
            <label>Quality of work</label>
            <input type="range" name="quality_of_work" class="custom-range" min="1" max="5" id="customRange2" required>
        </div>
        <div class="col-md-3 mb-3">
            <label>Technical skills</label>
            <input type="range" name="technical_skills" class="custom-range" min="1" max="5" id="customRange2" required>
        </div>
        <div class="col-md-3 mb-3">
            <label>Honesty</label>
            <input type="range" name="honesty" class="custom-range" min="1" max="5" id="customRange2" required>
        </div>
        <div class="col-md-3 mb-3">
            <label>Creativity</label>
            <input type="range" name="creativity" class="custom-range" min="1" max="5" id="customRange2" required>
        </div>
    </div>
    <div class="form-row">
        <div class="col-md-3 mb-3">
            <label>Attendance</label>
            <input type="range" name="attendance" class="custom-range" min="1" max="5" id="customRange2" required>
        </div>
        <div class="col-md-3 mb-3">
            <label>Productivity</label>
            <input type="range" name="productivity" class="custom-range" min="1" max="5" id="customRange2" required>
        </div>
        <div class="col-md-3 mb-3">
            <label>Independent work</label>
            <input type="range" name="independent_work" class="custom-range" min="1" max="5" id="customRange2" required>
        </div>
        <div class="col-md-3 mb-3">
            <label>Communication</label>
            <input type="range" name="communication" class="custom-range" min="1" max="5" id="customRange2" required>
        </div>
    </div>
    <div class="form-row">
        <div class="col-md-3 mb-3">
            <label>Integrity</label>
            <input type="range" name="integrity" class="custom-range" min="1" max="5" id="customRange2" required>
        </div>
        <div class="col-md-3 mb-3">
            <label>Punctuality</label>
            <input type="range" name="punctuality" class="custom-range" min="1" max="5" id="customRange2" required>
        </div>
        <div class="col-md-3 mb-3">
            <label>Coworker relations</label>
            <input type="range" name="coworker_relations" class="custom-range" min="1" max="5" id="customRange2" required>
        </div>
        <div class="col-md-3 mb-3">
            <label>Work consistency</label>
            <input type="range" name="work_consistency" class="custom-range" min="1" max="5" id="customRange2" required>
        </div>
    </div>
    <div class="form-group">
        <label>Notes</label>
        <textarea class="form-control" name="notes" id="editor" placeholder="add notes"></textarea>
    </div>
    <br>
    <button type="submit" onclick="return confirm('do you really want to submit \nnote: if you miss a range it will considered as average')" class="btn btn-primary btn-block float-right">Evaluate</button>

    <?php echo form_close(); ?>
</div>
<br><br>
<script>
    ClassicEditor
        .create(document.querySelector('#editor'))
        .catch(error => {
            console.error(error);
        });
</script>