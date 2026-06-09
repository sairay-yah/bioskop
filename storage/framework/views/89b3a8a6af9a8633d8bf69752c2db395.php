

<?php $__env->startSection('content'); ?>
<h2>Admin Dashboard</h2>

<div class="row">
    <div class="col-md-4">
        <div class="card mb-3">
            <div class="card-body">
                Total Booking: <?php echo e($totalBooking); ?>

            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card mb-3">
            <div class="card-body">
                Booking Paid: <?php echo e($totalPaid); ?>

            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card mb-3">
            <div class="card-body">
                Total Income: Rp <?php echo e(number_format($totalIncome,0,',','.')); ?>

            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\PAW\BIOSKOP TUBES\BIOSKOP\resources\views\admin\dashboard.blade.php ENDPATH**/ ?>