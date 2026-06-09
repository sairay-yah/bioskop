

<?php $__env->startSection('content'); ?>
<div class="container px-0">

    
    <div class="mb-2 text-muted small">
        <p class="admin-subtitle">Admin · Jadwal</p>
    </div>

    
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="page-title mb-0">Kelola Jadwal Film</h1>

        <a href="<?php echo e(route('admin.schedules.create')); ?>" class="btn btn-primary">
            + Tambah Jadwal
        </a>
    </div>

    
    <div class="card card-admin-table">
        <div class="table-responsive">
            <table class="table table-borderless align-middle admin-table mb-0">
                <thead>
                    <tr>
                        <th style="width: 4%">#</th>
                        <th>Film</th>
                        <th style="width: 26%">Tanggal &amp; Jam</th>
                        <th style="width: 15%">Studio</th>
                        <th style="width: 25%">Bioskop</th>
                        <th style="width: 14%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $schedules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $schedule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <?php
                            $movie  = $schedule->movie;
                            $studio = $schedule->studio;
                            $cinema = $studio?->cinema;

                            $start = $schedule->start_time instanceof \Carbon\Carbon
                                ? $schedule->start_time
                                : \Carbon\Carbon::parse($schedule->start_time);

                            $end = $schedule->end_time instanceof \Carbon\Carbon
                                ? $schedule->end_time
                                : \Carbon\Carbon::parse($schedule->end_time);
                        ?>

                        <tr>
                            
                            <td class="text-muted small">
                                <?php echo e($loop->iteration); ?>

                            </td>

                            
                            <td>
                                <div class="fw-semibold">
                                    <?php echo e($movie->title); ?>

                                </div>
                            </td>

                            
                            <td>
                                <div class="schedule-time-main">
                                    <?php echo e($start->format('d-m-Y')); ?>

                                </div>
                                <div class="schedule-time-sub">
                                    <?php echo e($start->format('H:i')); ?> - <?php echo e($end->format('H:i')); ?> WIB
                                </div>
                            </td>

                            
                            <td>
                                <div class="schedule-studio">
                                    <?php echo e($studio?->name ?? '-'); ?>

                                </div>
                            </td>

                            
                            <td>
                                <div class="schedule-cinema-name">
                                    <?php echo e($cinema?->name ?? '-'); ?>

                                </div>
                                <?php if($cinema?->address): ?>
                                    <div class="schedule-cinema-address">
                                        <?php echo e($cinema->address); ?>

                                    </div>
                                <?php endif; ?>
                            </td>

                            
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="<?php echo e(route('admin.schedules.edit', $schedule)); ?>"
                                       class="btn btn-sm btn-warning px-3 rounded-pill">
                                        Edit
                                    </a>

                                    <form action="<?php echo e(route('admin.schedules.destroy', $schedule)); ?>"
                                          method="POST"
                                          onsubmit="return confirm('Yakin ingin menghapus jadwal ini?')">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit"
                                                class="btn btn-sm btn-danger px-3 rounded-pill">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">
                                Belum ada jadwal film yang dibuat.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\PAW\BIOSKOP TUBES\BIOSKOP\resources\views/admin/schedules/index.blade.php ENDPATH**/ ?>