<?php $__env->startSection('content'); ?>
<h1 class="page-title">Daftar Film</h1>

<div class="row">
    <?php $__currentLoopData = $movies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $movie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-md-3 mb-4">
            <div class="card movie-card d-flex flex-column h-100">

                <?php if($movie->poster): ?>
                    <img src="<?php echo e(asset('storage/' . $movie->poster)); ?>" 
                         class="movie-poster" 
                         alt="<?php echo e($movie->title); ?>">
                <?php endif; ?>

                <div class="card-body d-flex flex-column">
                    <h5 class="movie-title mb-1"><?php echo e($movie->title); ?></h5>

                    <p class="movie-genre mb-0">
                        Genre: <?php echo e($movie->genre); ?>

                    </p>
                    <p class="movie-duration mb-3">
                        Durasi: <?php echo e($movie->duration); ?> menit
                    </p>

                    <div class="mt-auto pt-2">
                        <a href="<?php echo e(route('movies.show', $movie)); ?>" 
                           class="btn btn-primary w-100">
                            Detail
                        </a>
                    </div>
                </div>

            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\PAW\BIOSKOP TUBES\BIOSKOP\resources\views/home.blade.php ENDPATH**/ ?>