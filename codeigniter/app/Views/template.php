<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>The Inventory Management System- <?= esc($name) ?></title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <style>
            .nav-link, .nav-link:focus {
                color: #ffde7d;
            }

            .nav-link:hover {
            color:#f08a5d;
            }
            li {
                list-style-type: none;
            }
        </style>
    </head>
    <body>
        <header>
        <?php if (session()->has('error')): ?>
            <div class="alert alert-danger" style="margin: 0;">
                <?= session('error'); ?>
            </div>
        <?php elseif (session()->has('success')): ?>
            <div class="alert alert-success" style="margin: 0;">
                <?= session('success'); ?>
            </div>
        <?php endif; ?>
            <nav class="navbar navbar-expand-lg py-3" style="background-color: #00b8a9;">
                <div class="container">
                    <a class="navbar-brand col-6" href="#" style="color: #f8f3d4;">Charlie and the factory</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapseBar" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse col-6 text-md-end" id="collapseBar">
                        <ul class="nav ms-auto">
                            <li class="nav-item">
                                <a class="nav-link <?= service('router')->getMatchedRoute()[0] == 'inventory' ? 'active' : ''; ?>" aria-current="inventory" href="<?= base_url('inventory'); ?>">Inventory</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?= service('router')->getMatchedRoute()[0] == 'operation' ? 'active' : ''; ?>" aria-label="operation history" href="<?= base_url('operation'); ?>">Operation History</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?= service('router')->getMatchedRoute()[0] == 'sort' ? 'active' : ''; ?>" aria-label="organize data" href="<?= base_url('sort'); ?>">Organize Data</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url('/logout');?>" aria-label="log out">Log Out</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>

        <main>
            <?= $this->renderSection('content') ?>
        </main>
    </body>
    <!-- Bootstap JS.  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
 </html>