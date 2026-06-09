

<?php $__env->startSection('content'); ?>
<div class="container">

    <h1 class="mb-3"><?php echo e($movie->title); ?></h1>

    <?php if($movie->poster): ?>
        <img src="<?php echo e(asset('storage/' . $movie->poster)); ?>" 
             alt="Poster <?php echo e($movie->title); ?>" 
             style="width:250px; border-radius:8px;" 
             class="mb-4">
    <?php endif; ?>

    <p><strong>Genre:</strong> <?php echo e($movie->genre); ?></p>
    <p><strong>Durasi:</strong> <?php echo e($movie->duration); ?> menit</p>
    <p><strong>Rating Umur:</strong> <?php echo e($movie->age_rating); ?></p>

    <hr>

    <h4>Deskripsi</h4>
    <p><?php echo e($movie->description); ?></p>

    <hr>

    <h4>Jadwal Tersedia</h4>

    <?php if(isset($schedules) && count($schedules) > 0): ?>
        <ul>
            <?php $__currentLoopData = $schedules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $schedule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li>
                    <strong><?php echo e($schedule->start_time); ?></strong>
                    — Studio: <?php echo e($schedule->studio->name ?? 'Tidak ada info studio'); ?>

                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    <?php else: ?>
        <p><em>Belum ada jadwal untuk film ini.</em></p>
    <?php endif; ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\PAW\BIOSKOP TUBES\BIOSKOP\resources\views\admin\movies\show.blade.php ENDPATH**/ ?>