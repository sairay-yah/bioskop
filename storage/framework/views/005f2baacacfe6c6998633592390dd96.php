

<?php $__env->startSection('content'); ?>
<div class="movie-page container-xxl">

    
    <div class="movie-hero">
        
        <div class="movie-hero-poster">
            <?php if($movie->poster): ?>
                <img src="<?php echo e(asset('storage/'.$movie->poster)); ?>"
                     alt="<?php echo e($movie->title); ?>"
                     class="movie-poster-img">
            <?php else: ?>
                <div class="movie-poster-placeholder">
                    <span><?php echo e(substr($movie->title, 0, 1)); ?></span>
                </div>
            <?php endif; ?>
        </div>

        
        <div class="movie-hero-info">

            
            <h1 class="movie-title-main">
                <?php echo e($movie->title); ?>

            </h1>

            
            <p class="movie-description-main">
                <?php echo e($movie->description); ?>

            </p>

            
            <div class="movie-meta-grid">
                <div class="movie-meta-item">
                    <span class="meta-label">Durasi</span>
                    <span class="meta-value"><?php echo e($movie->duration); ?> menit</span>
                </div>

                <div class="movie-meta-item">
                    <span class="meta-label">Genre</span>
                    <span class="meta-pill"><?php echo e($movie->genre); ?></span>
                </div>

                <div class="movie-meta-item">
                    <span class="meta-label">Rating Umur</span>
                    <span class="meta-pill pill-age"><?php echo e($movie->age_rating); ?></span>
                </div>

                <div class="movie-meta-item">
                    <span class="meta-label">Harga Dasar</span>
                    <span class="meta-price">
                        Rp <?php echo e(number_format($movie->base_price, 0, ',', '.')); ?>

                    </span>
                </div>
            </div>

        </div>
    </div>

    
    <div class="movie-schedule card mt-4">
        <div class="card-header d-flex justify-content-between align-items-center movie-schedule-header">
            <div>
                <h2 class="movie-schedule-title mb-0">Jadwal Tayang</h2>
                <p class="movie-schedule-subtitle mb-0">
                    Pilih jadwal yang kamu mau, lalu lanjutkan ke pemilihan kursi.
                </p>
            </div>
        </div>

        <div class="table-responsive movie-schedule-table">
            <table class="table align-middle mb-0">
                <thead>
                    <tr>
                        <th class="col-3">Tanggal &amp; Jam</th>
                        <th class="col-2">Studio</th>
                        <th class="col-5">Bioskop</th>
                        <th class="col-2 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $schedules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $schedule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <?php
                        $start = $schedule->start_time instanceof \Carbon\Carbon
                            ? $schedule->start_time
                            : \Carbon\Carbon::parse($schedule->start_time);
                    ?>

                    <tr>
                        <td>
                            <div class="schedule-time-main">
                                <?php echo e($start->format('d M Y')); ?>

                            </div>
                            <div class="schedule-time-sub">
                                <?php echo e($start->format('H:i')); ?> WIB
                            </div>
                        </td>

                        <td>
                            <span class="schedule-studio">
                                <?php echo e($schedule->studio->name); ?>

                            </span>
                        </td>

                        <td>
                            <div class="schedule-cinema-name">
                                <?php echo e($schedule->studio->cinema->name); ?>

                            </div>
                            <div class="schedule-cinema-address">
                                <?php echo e($schedule->studio->cinema->address); ?>

                            </div>
                        </td>

                        <td class="text-center">
                            <?php if(auth()->guard()->check()): ?>
                                <?php if(auth()->user()->role === 'pelanggan'): ?>
                                    <a href="<?php echo e(route('booking.seats', ['schedule' => $schedule->id])); ?>"
                                       class="btn btn-success btn-sm schedule-cta">
                                        Pilih Kursi
                                    </a>
                                <?php else: ?>
                                    <span class="badge bg-secondary">Login sebagai pelanggan</span>
                                <?php endif; ?>
                            <?php else: ?>
                                <a href="<?php echo e(route('login')); ?>" class="btn btn-outline-primary btn-sm schedule-cta">
                                    Login untuk pesan
                                </a>
                            <?php endif; ?>
                        </td>
                    </tr>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="4" class="text-center text-muted py-4">
                            Belum ada jadwal tayang untuk film ini.
                        </td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\PAW\BIOSKOP TUBES\BIOSKOP\resources\views/movies/show.blade.php ENDPATH**/ ?>