<?php

declare(strict_types=1);

use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;

require_once('./../vendor/autoload.php');

$options = new QROptions(
  [
    'eccLevel' => QRCode::ECC_L,
    'outputType' => QRCode::OUTPUT_MARKUP_SVG,
    'version' => 5,
  ]
);

$qrcode = (new QRCode($options))->render('http://43.157.195.44:30180');
?>
<?= $this->extend('template') ?>
<?= $this->section('content') ?>
<style>
    .sidebar {
        display: block;
    }
    
    li {
        list-style-type: none;
    }

    
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

<div class="container-fluid">
    <div class="py-3"><h1 style="color: #1fab89;">Inventory Management</h1></div>     
    <div class="row">
        <div class="col-3 col-sm-2" style="background-color: #00b8a9; position: relative; padding-left: 0;">
            <ul class="sidebar fix">
                <li class="nav-item py-5">
                    <a class="nav-link text-warp" id="product-1" href="<?= base_url('inventory/?search=screw') ?>">Screw</a>
                </li>
                <li class="nav-item py-5">
                    <a class="nav-link text-warp" id="product-2" href="<?= base_url('inventory/?search=copper+wire') ?>">Copper Wire</a>
                </li>
                <li class="nav-item py-5">
                    <a class="nav-link text-warp" id="product-3" href="<?= base_url('inventory/?search=iron+core') ?>">Iron Core</a>
                </li>
                <li class="nav-item py-5">
                    <a class="nav-link text-warp" id="product-4" href="<?= base_url('inventory/?search=pipe') ?>">Pipe</a>
                </li>
                <li class="nav-item py-5">
                    <a class="nav-link text-warp" id="product-4" href="<?= base_url('inventory') ?>">All</a>
                </li>
                <button class="popup btn btn-warning button-xs button-md" style="color: #1fab89;">Quick Access to Inventory Page, Click to Download
                    <a href="<?= $qrcode ?>" download="QRCode.png">
                        <img src='<?= $qrcode ?>' alt='QR Code' width='80' height='80'>
                    </a>
                </button>  
            </ul>
        </div>
        <div class="content col-9 col-sm-10">
            <div class="col-12 col-md-7">
                <form method="get" action="<?= base_url('inventory/'); ?>">
                    <div class="input-group">
                        <input type="text" class="form-control" Placeholder="Enter Specification or Place" name="search">
                        <button class="btn btn-warning" type="submit">Search</button>
                    </div>
                </form>
            </div>
            <div class="col-12  col-sm-12 py-3">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Specification</th>
                                <th>Place</th>
                                <th>Stock number</th>
                                <th>Stock Change</th>
                                <th>Delete</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                        <form id="inventoryForm" method="get" action="<?= base_url('inventory/'); ?>">
                        <?php foreach ($items as $item): ?>
                            <tr>
                                <td data-label="Specification"><?= esc($item['specification']) ?><input type="hidden" value="<?= esc($item['specification']) ?>" name="specifications[]"></td>
                                <td data-label="Place"><input type="text" value="<?= esc($item['place']) ?>" name="place[]"></td>
                                <td data-label="Stock number"><?= esc($item['stock_number']) ?><input type="hidden" value="<?= esc($item['stock_number']) ?>" name="stock_number[]"></td>
                                <td data-label="Stock Change"><input type="number" value="0" name="stock_chnage[]"></td>
                                <td data-label="Delete"><a class="btn btn-danger button-xs button-md" href="<?= base_url('inventory/delete/' . $item['specification']) ?>" onclick="return confirm('Are you sure you want to delete <?= esc($item['specification']) ?>?')">Delete</a>
                                <td data-label="Edit"><a class="btn btn-primary button-xs button-md" href="<?= base_url('inventory/addedit/'.$item['specification']);?>" id="Edit">Edit</a>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <?= $pager ?>
                        </ul>
                    </nav>
                    <div class="offset-md-6">
                        <a class="btn btn-warning button-xs button-md" href="<?= base_url('/inventory/addedit/');?>">Add Items</a>
                        <button type="button" class="btn btn-warning button-xs button-md" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom" aria-controls="offcanvasBottom">View Change Details</button>
                        <div class="offcanvas offcanvas-bottom" tabindex="-1" id="offcanvasBottom" aria-labelledby="offcanvasBottomLabel">
                            <div class="offcanvas-header">
                                <h5 class="offcanvas-title" id="offcanvasBottomLabel">Changes</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body small">
                                No change.
                            </div>
                        </div>
                        <button type="button" class="btn btn-warning button-xs button-md" id="submission">Submission</button>
                    </div>
                </form>    
            </div>
        </div>
    </div>
</div>

<script>
    const inputValues = {};

    document.querySelectorAll('input[type="number"], input[type="text"]').forEach(input => {
        input.addEventListener('change', function() {
            const newValue = this.value;
            const row = this.closest('tr');
            const specification = row.querySelector('td:nth-child(1)').textContent;

            if (!inputValues[specification]) {
                inputValues[specification] = [];
            }
            
            inputValues[specification].push(newValue);

            const offcanvasBody = document.querySelector('.offcanvas-body');
            //Reference: https://chat.openai.com/share/814d0c29-d9ea-447f-9889-825f07ff468a
            offcanvasBody.innerHTML = Object.entries(inputValues)
                .map(([spec, values]) => `${spec}: ${values.map(value => value).join(', ')}`)
                .join('<br>');
        });
    });

    document.getElementById('submission').addEventListener('click', function() {
        document.getElementById('inventoryForm').method = 'post';
        document.getElementById('inventoryForm').action = '<?= base_url('/inventory/update'); ?>';
        document.getElementById('inventoryForm').submit();
    });

</script>

<?= $this->endSection() ?>