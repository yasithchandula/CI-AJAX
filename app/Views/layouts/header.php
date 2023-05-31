<Html>
    <head>
    </head>
    <body>
        <nav class="navbar bg-dark  navbar-expand-lg bg-body-tertiary " data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="<?=base_url('user_index')?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?=base_url('student')?>">Student Management</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?=base_url('course')?>">Course Management</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Order Management
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li>
                                <a class="dropdown-item" href="<?=base_url('order')?>">Preapproved Orders</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href='<?=base_url('user_logout')?>'>Logout</a>
                    </li>
                </ul>
            </div>
        </div>
        </nav>
    </body>
</Html>