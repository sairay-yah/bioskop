<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Bioskop Laravel</title>

    
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

    
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
    <div class="container">
        <a class="navbar-brand" href="<?php echo e(route('home')); ?>">TriVerse Cinema's</a>

        <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarMain">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarMain">

            
            <ul class="navbar-nav me-auto">
                <?php if(auth()->guard()->check()): ?>
                    <?php if(auth()->user()->role === 'admin'): ?>

                        <li class="nav-item">
                            <a class="nav-link <?php echo e(request()->routeIs('admin.movies.*') ? 'active' : ''); ?>"
                               href="<?php echo e(route('admin.movies.index')); ?>">
                                Film
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link <?php echo e(request()->routeIs('admin.schedules.*') && !request()->routeIs('admin.schedules.availability*') ? 'active' : ''); ?>"
                               href="<?php echo e(route('admin.schedules.index')); ?>">
                                Jadwal
                            </a>
                        </li>

                        
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(request()->routeIs('admin.schedules.availability*') ? 'active' : ''); ?>"
                               href="<?php echo e(route('admin.schedules.availability')); ?>">
                                Filter Jadwal
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link <?php echo e(request()->routeIs('admin.bookings.*') ? 'active' : ''); ?>"
                               href="<?php echo e(route('admin.bookings.index')); ?>">
                                Pesanan
                            </a>
                        </li>

                    <?php elseif(auth()->user()->role === 'pelanggan'): ?>

                        <li class="nav-item">
                            <a class="nav-link <?php echo e(request()->routeIs('bookings.history') ? 'active' : ''); ?>"
                               href="<?php echo e(route('bookings.history')); ?>">
                                Riwayat
                            </a>
                        </li>

                    <?php endif; ?>
                <?php endif; ?>
            </ul>

            
            <ul class="navbar-nav ms-auto align-items-center">
                <?php if(auth()->guard()->check()): ?>
                    <li class="nav-item me-2">
                        <span class="navbar-user"><?php echo e(auth()->user()->name); ?></span>
                    </li>
                    <li class="nav-item">
                        <form action="<?php echo e(route('logout')); ?>" method="POST" class="d-inline">
                            <?php echo csrf_field(); ?>
                            <button class="btn btn-sm btn-outline-light rounded-pill px-3" type="submit">
                                Logout
                            </button>
                        </form>
                    </li>
                <?php else: ?>
                    <li class="nav-item me-1">
                        <a class="nav-link" href="<?php echo e(route('login')); ?>">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('register')); ?>">Register</a>
                    </li>
                <?php endif; ?>
            </ul>

        </div>
    </div>
</nav>

<main class="app-shell">
    <div class="container">
        
        <?php if(session('success')): ?>
            <div class="alert alert-success mb-3"><?php echo e(session('success')); ?></div>
        <?php endif; ?>

        <?php if(session('error')): ?>
            <div class="alert alert-danger mb-3"><?php echo e(session('error')); ?></div>
        <?php endif; ?>

        <?php echo $__env->yieldContent('content'); ?>
    </div>
</main>

<footer class="app-footer">
    &copy; <?php echo e(date('Y')); ?> Bioskop Laravel. All rights reserved.
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\PAW\BIOSKOP TUBES\BIOSKOP\resources\views\layouts\app.blade.php ENDPATH**/ ?>