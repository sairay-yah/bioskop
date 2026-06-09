

<?php $__env->startSection('content'); ?>
<div class="admin-breadcrumb mb-2">
    Admin · <span>Pesanan</span>
</div>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="page-title mb-0">Kelola Pesanan</h1>
</div>

<?php if(session('success')): ?>
    <div class="alert alert-success mb-3">
        <?php echo e(session('success')); ?>

    </div>
<?php endif; ?>

<div class="admin-table-wrapper card card-table p-0">
    <table class="table table-borderless align-middle mb-0 admin-table">
        <thead>
        <tr>
            <th style="width: 60px;">#</th>
            <th style="width: 110px;">Tanggal</th>
            <th>Film</th>
            <th style="width: 220px;">Bioskop / Studio</th>
            <th style="width: 180px;">User</th>
            <th style="width: 160px;">Kursi</th>
            <th style="width: 140px;">Total</th>
            <th style="width: 120px;">Status</th>
            <th style="width: 160px;" class="text-end">Aksi</th>
        </tr>
        </thead>
        <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <?php
                $schedule    = $booking->schedule;
                $movie       = $schedule?->movie;
                $studio      = $schedule?->studio;
                $cinema      = $studio?->cinema;
                $start       = $schedule?->start_time;
                $firstTicket = $booking->tickets->first();
            ?>

            <tr>
                <td class="text-muted"><?php echo e($bookings->firstItem() + $index); ?></td>

                <td>
                    <?php if($start): ?>
                        <?php echo e(\Carbon\Carbon::parse($start)->format('d-m-Y')); ?><br>
                        <small class="schedule-time-sub">
                            <?php echo e(\Carbon\Carbon::parse($start)->format('H:i')); ?> WIB
                        </small>
                    <?php else: ?>
                        <span class="text-muted">-</span>
                    <?php endif; ?>
                </td>

                <td class="fw-semibold">
                    <?php echo e($movie?->title ?? '-'); ?>

                </td>

                <td>
                    <?php echo e($cinema?->name ?? '-'); ?><br>
                    <small class="schedule-cinema-address">
                        <?php echo e($studio?->name ?? ''); ?>

                    </small>
                </td>

                <td>
                    <?php echo e($booking->user?->name ?? '-'); ?><br>
                    <small class="schedule-time-sub">
                        <?php echo e($booking->user?->email ?? ''); ?>

                    </small>
                </td>

                <td>
                    <?php echo e($booking->tickets->pluck('seat.seat_code')->filter()->join(', ') ?: '-'); ?>

                </td>

                <td>
                    Rp <?php echo e(number_format($booking->total_price, 0, ',', '.')); ?>

                </td>

                <td>
                    <?php if($booking->status === 'paid'): ?>
                        <span class="badge rounded-pill px-3 py-1"
                              style="background: rgba(34,197,94,0.18); color:#4ade80;">
                            Lunas
                        </span>
                    <?php else: ?>
                        <span class="badge rounded-pill px-3 py-1"
                              style="background: rgba(250,204,21,0.18); color:#facc15;">
                            Pending
                        </span>
                    <?php endif; ?>
                </td>

                <td class="text-end">
                    <?php if($booking->status !== 'paid'): ?>
                        <form action="<?php echo e(route('admin.bookings.mark-paid', $booking)); ?>"
                              method="POST"
                              class="d-inline"
                              onsubmit="return confirm('Konfirmasi pembayaran booking ini sebagai LUNAS?');">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="btn btn-sm btn-success px-3">
                                Konfirmasi Lunas
                            </button>
                        </form>
                    <?php else: ?>
                        <button class="btn btn-sm btn-outline-light px-3" disabled>
                            Sudah Lunas
                        </button>
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

<?php if($bookings->hasPages()): ?>
    <div class="mt-3 d-flex justify-content-end">
        <?php echo e($bookings->onEachSide(1)->links()); ?>

    </div>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\PAW\BIOSKOP TUBES\BIOSKOP\resources\views\admin\bookings\index.blade.php ENDPATH**/ ?>