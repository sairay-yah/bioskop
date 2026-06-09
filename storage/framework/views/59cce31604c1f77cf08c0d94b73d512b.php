

<?php $__env->startSection('content'); ?>
<?php
    $movie  = $schedule->movie;
    $studio = $schedule->studio;
    $cinema = $studio->cinema;
    $start = $schedule->start_time instanceof \Carbon\Carbon
        ? $schedule->start_time
        : \Carbon\Carbon::parse($schedule->start_time);

    // kalau seat_code kamu formatnya A1, A2, dst — kita sort biar rapi
    $sortedSeats = $seats->sortBy('seat_code');
?>

<h1 class="page-title mb-2">Kursi (Read Only)</h1>
<p class="text-muted mb-3">
    <?php echo e($movie->title); ?> · <?php echo e($cinema->name); ?> · <?php echo e($studio->name); ?> · <?php echo e($start->format('d-m-Y H:i')); ?> WIB
</p>

<div class="card-glass p-4">
    <div class="mb-3 d-flex gap-2 flex-wrap">
        <span class="badge bg-success rounded-pill px-3">Tersedia</span>
        <span class="badge bg-secondary rounded-pill px-3">Terbooking</span>
    </div>

    <div class="seat-grid-admin">
        <?php $__currentLoopData = $sortedSeats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $seat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php $isBooked = in_array($seat->id, $bookedSeatIds); ?>
            <div class="seat-item-admin <?php echo e($isBooked ? 'is-booked' : 'is-free'); ?>">
                <?php echo e($seat->seat_code); ?>

            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\PAW\BIOSKOP TUBES\BIOSKOP\resources\views\admin\schedules\seats.blade.php ENDPATH**/ ?>