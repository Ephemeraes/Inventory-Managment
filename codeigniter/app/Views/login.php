<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>The Inventory Management System- <?= esc($name) ?></title>
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <!-- Bootstrap Icons -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    </head>
    <body>
        <header>
            <?php if (session()->has('error')): ?>
                <div class="alert alert-danger" style="margin: 0;">
                    <?= session('error'); ?>
                </div>
            <?php endif; ?>
            <nav class="navbar navbar-expand-lg py-3" style="background-color: #00b8a9;">
                <div class="container">
                    <a class="navbar-brand" href="#" style="color: #f8f3d4;">Charlie and the factory</a>
                </div>
            </nav>
        </header>

        <main>
            <section class="py-5" style="background-color: #f8f3d4;">
                <div class="container" style="background-color: #f8f3d4;">
                    <div class="row">
                        <div class="col-lg-6">
                            <h2 style="color: #f6416c;">Welcome!<br>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cup-hot-fill" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M.5 6a.5.5 0 0 0-.488.608l1.652 7.434A2.5 2.5 0 0 0 4.104 16h5.792a2.5 2.5 0 0 0 2.44-1.958l.131-.59a3 3 0 0 0 1.3-5.854l.221-.99A.5.5 0 0 0 13.5 6H.5ZM13 12.5a2.01 2.01 0 0 1-.316-.025l.867-3.898A2.001 2.001 0 0 1 13 12.5Z"/>
                                <path d="m4.4.8-.003.004-.014.019a4.167 4.167 0 0 0-.204.31 2.327 2.327 0 0 0-.141.267c-.026.06-.034.092-.037.103v.004a.593.593 0 0 0 .091.248c.075.133.178.272.308.445l.01.012c.118.158.26.347.37.543.112.2.22.455.22.745 0 .188-.065.368-.119.494a3.31 3.31 0 0 1-.202.388 5.444 5.444 0 0 1-.253.382l-.018.025-.005.008-.002.002A.5.5 0 0 1 3.6 4.2l.003-.004.014-.019a4.149 4.149 0 0 0 .204-.31 2.06 2.06 0 0 0 .141-.267c.026-.06.034-.092.037-.103a.593.593 0 0 0-.09-.252A4.334 4.334 0 0 0 3.6 2.8l-.01-.012a5.099 5.099 0 0 1-.37-.543A1.53 1.53 0 0 1 3 1.5c0-.188.065-.368.119-.494.059-.138.134-.274.202-.388a5.446 5.446 0 0 1 .253-.382l.025-.035A.5.5 0 0 1 4.4.8Zm3 0-.003.004-.014.019a4.167 4.167 0 0 0-.204.31 2.327 2.327 0 0 0-.141.267c-.026.06-.034.092-.037.103v.004a.593.593 0 0 0 .091.248c.075.133.178.272.308.445l.01.012c.118.158.26.347.37.543.112.2.22.455.22.745 0 .188-.065.368-.119.494a3.31 3.31 0 0 1-.202.388 5.444 5.444 0 0 1-.253.382l-.018.025-.005.008-.002.002A.5.5 0 0 1 6.6 4.2l.003-.004.014-.019a4.149 4.149 0 0 0 .204-.31 2.06 2.06 0 0 0 .141-.267c.026-.06.034-.092.037-.103a.593.593 0 0 0-.09-.252A4.334 4.334 0 0 0 6.6 2.8l-.01-.012a5.099 5.099 0 0 1-.37-.543A1.53 1.53 0 0 1 6 1.5c0-.188.065-.368.119-.494.059-.138.134-.274.202-.388a5.446 5.446 0 0 1 .253-.382l.025-.035A.5.5 0 0 1 7.4.8Zm3 0-.003.004-.014.019a4.077 4.077 0 0 0-.204.31 2.337 2.337 0 0 0-.141.267c-.026.06-.034.092-.037.103v.004a.593.593 0 0 0 .091.248c.075.133.178.272.308.445l.01.012c.118.158.26.347.37.543.112.2.22.455.22.745 0 .188-.065.368-.119.494a3.198 3.198 0 0 1-.202.388 5.385 5.385 0 0 1-.252.382l-.019.025-.005.008-.002.002A.5.5 0 0 1 9.6 4.2l.003-.004.014-.019a4.149 4.149 0 0 0 .204-.31 2.06 2.06 0 0 0 .141-.267c.026-.06.034-.092.037-.103a.593.593 0 0 0-.09-.252A4.334 4.334 0 0 0 9.6 2.8l-.01-.012a5.099 5.099 0 0 1-.37-.543A1.53 1.53 0 0 1 9 1.5c0-.188.065-.368.119-.494.059-.138.134-.274.202-.388a5.446 5.446 0 0 1 .253-.382l.025-.035A.5.5 0 0 1 10.4.8Z"/>
                            </svg>
                            <h2 style="color: #f6416c;">Inventory Management System</h1>
                            <p class="lead" style="color: #88304e;">Hello</p>
                        </div>
                        <div class="col-lg-5" style="color: #48466d;">
                            <form method="post" action="<?= base_url('/authenticate'); ?>">
                                <div>
                                    <h2>Account</h2>
                                    <label for="id" class="form-label pt-3">Employee ID</label>
                                    <input type="text" class="form-control" id="id" name="id" placeholder="Enter your ID" required>
                                    <label for="password" class="form-label pt-3">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" name="password" required>
                                    <button type="submit" class="btn btn-outline-secondary my-3">Log In</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>

            <section class="py-5" style="background-color: #ffde7d;">
                <div class="container">
                    <h3 class="text-center mb-4" style="color: #48466d;">Login to View</h2>
                    <div class="row">
                        <div class="col-lg-4 mb-4">
                            <div class="card" style="color: #48466d;">
                                <div class="card-body">
                                    <h4 class="card-title">Inventory Management</h4>
                                    <p class="card-text">Simplify inventory management with various functionalities.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 mb-4">
                            <div class="card" style="color: #48466d;">
                                <div class="card-body">
                                    <h4 class="card-title">Operation Management</h4>
                                    <p class="card-text">Review and revise operation histories at any time, everywhere. </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 mb-4">
                            <div class="card">
                                <div class="card-body" style="color: #48466d;">
                                    <h4 class="card-title">Efficient Data Solution</h4>
                                    <p class="card-text">Sort inventory data with specific requirements for decision-making.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <footer class="pt-3 pb-1" style="background-color: #00b8a9;">
            <div class="container">
                <div class="row" style="color: #f8f3d4;">
                    <div class="col-md-6">
                        <p>Contact Me By</p>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <p class="me-3 d-inline">Email: uqstudent@uqconnect.edu.au</p>
                        <p class="d-inline">Phone: 040-000-000</p>
                    </div>
                </div>
            </div>
        </footer>
    </body>
</html>