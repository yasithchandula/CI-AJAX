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
            <div class="navbar-nav">
                <a class="nav-link active" aria-current="page" href="<?=base_url('user_index')?>">Home</a>
                <a class="nav-link" href="<?=base_url('student')?>">Student Management</a>
                <a class="nav-link" href="<?=base_url('course')?>">Course Management</a>
                <a class="nav-link" href='<?=base_url('user_logout')?>'>Logout</a>
            </div>
            </div>
        </div>
        </nav>
    </body>
</Html>