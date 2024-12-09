<?= $this->extend('template') ?>
<?= $this->section('content') ?>
<style>
    li {
        list-style-type: none;
    }

    body {
        background-color: #f8f3d4;
    }

    input[type="text"],input[type="date"], select {
        border: 1px solid rgb(221, 221, 221);
        border-radius: 5px;
        color: #48466d;
    }

    label, h6, fieldset {
        color: #48466d;
    }

    /* References: https://dev.to/turinumugisha_s/the-most-awesome-trick-for-tables-mobile-responsiveness-you-will-ever-need-32cp */
    @media (max-width: 576px) {
        ul {
            font-size: 1rem;
        }
        .fix {
            padding-left: 0; position: fixed;
            text-align: center;
        }
        table {
            border: 0;
        }
        table thead {
            border: none;
            clip: rect(0 0 0 0);
            height: 100px;
            margin: -1px;
            overflow: hidden;
            padding: 0;
            position: absolute;
            width: 100px;
        }

        table tr {
            border-bottom: 3px solid #ddd;
            display: block;
            margin-bottom: .625em;
        }

        table td {
            border-bottom: 1px solid #ddd;
            display: block;
            font-size: .8em;
            text-align: right;
        }

        table td::before {
            content: attr(data-label);
            float: left;
            font-weight: bold;
            text-transform: uppercase;
        }

        table td:last-child {
            border-bottom: 0;
        }
        input[type="text"] {
            width: 8rem;
        }
        input[type="number"] {
            width: 8rem;
        }
    }
</style>
<h1 class="p-4" style="color: #00b8a9;">Search for results</h1>
<h3 class="p-4" style="color: #00b8a9;">View inventory changes</h3>
<div class="row" style="padding: 0; margin: 0;">
    <form class="m-3 p-3 col-6" method="post" action="<?= base_url('sort/result'); ?>">
        <div class="row">
            <legend class="col-form-label col-lg-2">Type</legend>
            <div class="col-sm-10 pt-2">

                <select class=" col-sm-7" id="type" name="type" required>
                    <option value="screw">Screw</option>
                    <option value="iron core">Iron Core</option>
                    <option value="copper wire">Copper Wire</option>
                    <option value="pipe">Pipe</option>
                </select>

            </div>
        </div>
        <div class="row">
            <label for="specification" class="col-lg-2 col-form-label">Specification</label>
            <div class="col-sm-10">
                <input type="text" name="specification" id="specification" class="col-sm-7" placeholder="E.g. Screw A" aria-label="specification" required>
            </div>
        </div>
        <div class="row">
            <label for="startTime" class="col-lg-2 col-form-label">Start Time</label>
            <div class="col-sm-10">
                <input type="date" id="startTime" name="startTime" class="col-sm-7" aria-label="start time" required>
            </div>
        </div>
        <div class="row">
            <label for="endTime" class="col-lg-2 col-form-label">End Time</label>
            <div class="col-sm-10">
                <input type="date" id="endTime" name="endTime" class="col-sm-7" aria-label="end time" required>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-1 mt-3">
                <button type="submit" class="btn btn-primary offset-md-2">Submit</button>
            </div>
        </div>
    </form>
    <div class="col-md-5 col-12">
        <h4>Result</h4>
        <div id="chartContainer" style="height: 370px; width: 100%;"></div>
    </div>
</div>
<?php
 
 $dataPoints = []; 

 foreach ($stockHistory as $record) {
     $dataPoints[] = [
         "y" => $record['stock'],
         "label" => $record['time'] 
     ];
 }
 
?>
<script>
window.onload = function () {
 
 var chart = new CanvasJS.Chart("chartContainer", {
     title: {
         text: "Inventory Changes"
     },
     axisY: {
         title: "Number"
     },
     data: [{
         type: "stepLine",
         dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
     }]
 });
 chart.render();
  
}
</script>
<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
<?= $this->endSection() ?>