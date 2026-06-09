

<?php $__env->startSection('content'); ?>
<?php
    use Carbon\Carbon;
?>

<div class="admin-breadcrumb mb-2">
    Admin · <span>Filter Jadwal</span>
</div>

<div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-3">
    <div>
        <h1 class="page-title mb-1">Filter Jadwal per Hari</h1>
        <div class="text-muted small">
            Pilih tanggal untuk melihat jadwal + jumlah kursi tersedia.
        </div>
    </div>

    <form method="GET" action="<?php echo e(route('admin.schedules.availability')); ?>" class="d-flex gap-2 align-items-center">
        <input type="date" name="date" value="<?php echo e($date); ?>" class="form-control" style="max-width: 190px;">
        <button class="btn btn-primary btn-pill px-4" type="submit">Filter</button>
    </form>
</div>

<div class="card-glass p-0 overflow-hidden">
    <div class="table-responsive">
        <table class="table table-borderless align-middle mb-0 admin-table">
            <thead class="table-head">
            <tr>
                <th style="width:110px;">Jam</th>
                <th>Film</th>
                <th style="width:220px;">Bioskop / Studio</th>
                <th style="width:120px;">Total</th>
                <th style="width:120px;">Booked</th>
                <th style="width:120px;">Tersedia</th>
                <th style="width:160px;" class="text-end">Aksi</th>
            </tr>
            </thead>

            <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $schedules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $schedule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <?php
                    $totalSeats = $schedule->studio?->seats?->count() ?? 0;
                    $bookedIds  = $bookedSeatIdsBySchedule->get($schedule->id, collect());
                    $bookedCount = $bookedIds->count();
                    $availableCount = max(0, $totalSeats - $bookedCount);
                    $start = Carbon::parse($schedule->start_time);
                ?>

                <tr class="table-row">
                    <td>
                        <div class="fw-semibold"><?php echo e($start->format('H:i')); ?></div>
                        <div class="small text-muted"><?php echo e($start->format('d-m-Y')); ?></div>
                    </td>

                    <td class="fw-semibold">
                        <?php echo e($schedule->movie->title ?? '-'); ?>

                    </td>

                    <td>
                        <div><?php echo e($schedule->studio?->cinema?->name ?? '-'); ?></div>
                        <div class="small text-muted"><?php echo e($schedule->studio?->name ?? '-'); ?></div>
                    </td>

                    <td><?php echo e($totalSeats); ?></td>
                    <td><?php echo e($bookedCount); ?></td>

                    <td class="fw-semibold">
                        <span class="<?php echo e($availableCount > 0 ? 'text-success' : 'text-danger'); ?>">
                            <?php echo e($availableCount); ?>

                        </span>
                    </td>

                    <td class="text-end">
                        <a href="<?php echo e(route('admin.schedules.availability.detail', $schedule)); ?>"
                           class="btn btn-sm btn-outline-light btn-pill px-3">
                            Lihat Kursi
                        </a>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="7" class="text-center text-muted py-5">
                        Tidak ada jadwal di tanggal ini.
                    </td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\PAW\BIOSKOP TUBES\BIOSKOP\resources\views\admin\movies\availability.blade.php ENDPATH**/ ?>