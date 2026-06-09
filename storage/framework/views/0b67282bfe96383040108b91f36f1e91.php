

<?php $__env->startSection('content'); ?>
<div class="admin-breadcrumb mb-2">
    Admin · <span>Booking</span>
</div>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="page-title mb-0">Kelola Booking</h1>
</div>

<div class="admin-table-wrapper card card-table p-0">
    <table class="table table-borderless align-middle mb-0 admin-table">
        <thead>
        <tr>
            <th style="width: 60px;">#</th>
            <th style="width: 110px;">Tanggal</th>
            <th>Film</th>
            <th style="width: 200px;">Bioskop / Studio</th>
            <th style="width: 160px;">User</th>
            <th style="width: 160px;">Kursi</th>
            <th style="width: 140px;">Total</th>
            <th style="width: 120px;">Status</th>
            <th style="width: 180px;" class="text-end">Aksi</th>
        </tr>
        </thead>

        <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <?php
                $schedule = $booking->schedule;
                $movie    = $schedule?->movie;
                $studio   = $schedule?->studio;
                $cinema   = $studio?->cinema;
            ?>

            <tr>
                <td class="text-muted"><?php echo e($bookings->firstItem() + $index); ?></td>

                <td>
                    <?php echo e(optional($schedule?->start_time)->format('d-m-Y')); ?><br>
                    <small class="text-muted">
                        <?php echo e(optional($schedule?->start_time)->format('H:i')); ?> WIB
                    </small>
                </td>

                <td class="fw-semibold">
                    <?php echo e($movie?->title ?? '-'); ?>

                </td>

                <td>
                    <?php echo e($cinema?->name ?? '-'); ?><br>
                    <small class="text-muted">
                        <?php echo e($studio?->name ?? ''); ?>

                    </small>
                </td>

                <td>
                    <?php echo e($booking->user?->name ?? '-'); ?><br>
                    <small class="text-muted">
                        <?php echo e($booking->user?->email ?? ''); ?>

                    </small>
                </td>

                <td>
                    <?php echo e($booking->tickets->pluck('seat.seat_code')->join(', ') ?: '-'); ?>

                </td>

                <td>
                    Rp <?php echo e(number_format($booking->total_price, 0, ',', '.')); ?>

                </td>

                
                <td>
                    <?php if($booking->status === 'paid'): ?>
                        <span class="badge bg-success-subtle text-success px-3 py-1 rounded-pill">
                            Lunas
                        </span>
                    <?php else: ?>
                        <span class="badge bg-warning-subtle text-warning px-3 py-1 rounded-pill">
                            Pending
                        </span>
                    <?php endif; ?>
                </td>

                
                <td class="text-end">
                    <?php if($booking->status === 'paid'): ?>
                        <button class="btn btn-sm btn-outline-light px-3" disabled>
                            Sudah Lunas
                        </button>
                    <?php else: ?>
                        
                        <span class="badge bg-secondary-subtle text-light px-3 py-2 rounded-pill"
                              style="opacity:.85;">
                            Menunggu user bayar
                        </span>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td colspan="9" class="text-center text-muted py-4">
                    Belum ada booking.
                </td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>

<div class="mt-3">
    <?php echo e($bookings->links()); ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\PAW\BIOSKOP TUBES\BIOSKOP\resources\views\bookings\index.blade.php ENDPATH**/ ?>