<?= $this->extend('template') ?>
<?= $this->section('content') ?>
<style>
    /* References: https://dev.to/turinumugisha_s/the-most-awesome-trick-for-tables-mobile-responsiveness-you-will-ever-need-32cp */
    @media (max-width: 576px) {
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
    }
</style>

<div class="container">
    <div class="py-3"><h2 style="color: #1fab89;">Operation Management</h1></div>
    <form method="get" action="<?= base_url('operation/'); ?>">
        <div class="input-group">
            <input type="text" class="form-control" recordholder="Enter Name or Employee ID" name="search">
            <button class="btn btn-warning" type="submit">Search</button>
        </div>
    </form>
    <div class="o-table">
        <table class="table table-striped mt-3">
            <thead>
                <tr>
                    <th>Record ID</th>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Record</th>
                    <th>Time</th>
                    <th>Approve</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($records as $record): ?>
                <tr>
                    <td data-label="Record ID"><?= esc($record['record_id']) ?></td>
                    <td data-label="ID"><?= esc($record['id']) ?></td>
                    <td data-label="Name"><?= esc($record['name']) ?></td>
                    <td data-label="Record">
                        <?php
                            if ($record['old_position'] !== null && $record['new_position'] !== null) {
                               echo esc($record['specification']) . ': ' . esc($record['old_position']) . ' to ' . esc($record['new_position']);
                            } else if ($record['old_position'] == null && $record['new_position'] !== null) {
                                echo esc($record['specification']) . ': ' . esc($record['new_position']);
                            }
                            
                            if ($record['stock_change'] !== null) {
                                if ($record['stock_change'] > 0) {
                                    echo esc($record['specification']) . ': +' . esc($record['stock_change']);
                                } else {
                                    echo esc($record['specification']) . ': ' . esc($record['stock_change']);
                                }
                            }
                        ?>
                    <td data-label="Time"><?= esc($record['time']) ?></td>
                    <td data-label="Approve">
                    <?php if ($record['approve'] == 'waiting'): ?>
                        <button class="btn btn-success mx-1" onclick="updateApproval('<?= $record['record_id'] ?>', 'yes', '<?= $record['old_position'] ?>', '<?= $record['new_position'] ?>', '<?= $record['stock_change'] ?>', '<?= $record['specification'] ?>')">Yes</button>
                        <button class="btn btn-danger" onclick="updateApproval('<?= $record['record_id'] ?>', 'no', '<?= $record['old_position'] ?>', '<?= $record['new_position'] ?>', '<?= $record['stock_change'] ?>', '<?= $record['specification'] ?>')">No</button>
                    <?php else: ?>
                        <?= esc($record['approve']) ?>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <div class="offset-md-11">
            <a class="btn btn-warning button-xs button-md" href="<?= base_url('operation/adduser');?>">Add User</a>
        </div>
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
            <?= $pagerLink -> links() ?>
            </ul>
        </nav>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    function updateApproval(recordId, approval, old_position, new_position, stock_change, specification) {
        $.ajax({
            url: '<?= base_url('operation/approve') ?>',
            type: 'POST',
            data: {
                record_id: recordId,
                approve: approval,
                specification: specification,
                old_position: old_position,
                new_position: new_position,
                stock_change: stock_change
            },
            success: function(response) {
                    window.location.reload();
                },
            error: function() {
                console.log("Error: " + status + ", " + error);
                console.log("Response: ", xhr.responseText);
                alert('Error in sending request. Status: ' + status + ', Error: ' + error);
            }
        });
    }
</script>
<?= $this->endSection() ?>