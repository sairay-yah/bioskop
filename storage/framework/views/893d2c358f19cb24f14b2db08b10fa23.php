

<?php $__env->startSection('content'); ?>
<?php
    use Carbon\Carbon;

    $movie  = $schedule->movie;
    $studio = $schedule->studio;
    $cinema = $studio->cinema;
    $start  = Carbon::parse($schedule->start_time);

    // seats grouped per row: A, B, C...
    $seatRows = $studio->seats
        ->sortBy(function ($s) {
            preg_match('/^([A-Za-z]+)(\d+)$/', $s->seat_code, $m);
            $row = strtoupper($m[1] ?? 'Z');
            $num = intval($m[2] ?? 0);
            return $row.'-'.str_pad((string)$num, 4, '0', STR_PAD_LEFT);
        })
        ->groupBy(function ($s) {
            preg_match('/^([A-Za-z]+)/', $s->seat_code, $m);
            return strtoupper($m[1] ?? '-');
        });

    // ambil max angka kursi (buat header 1..N)
    $maxCols = $seatRows
        ->map(function ($rowSeats) {
            return $rowSeats->map(function ($s) {
                preg_match('/\d+/', $s->seat_code, $mm);
                return intval($mm[0] ?? 0);
            })->max();
        })
        ->max() ?? 10;

    $aisleAfter = 5; // 5-5 aisle (ubah kalau mau 4-4 dll)
?>

<div class="seat-header-wrap">
    <div class="seat-header">
        <h1 class="seat-title">Kursi Studio</h1>

        <div class="seat-subtitle">
            <span class="seat-subtitle-movie"><?php echo e($movie->title); ?></span>
            <span class="seat-dot">•</span>
            <span><?php echo e($cinema->name); ?> (<?php echo e($studio->name); ?>)</span>
            <span class="seat-dot">•</span>
            <span class="seat-subtitle-time">
                <?php echo e($start->format('d-m-Y H:i')); ?> WIB
            </span>
        </div>
    </div>

    <a href="<?php echo e(route('admin.schedules.availability', ['date' => $start->toDateString()])); ?>"
       class="btn-back">
        ← Kembali
    </a>
</div>


<div class="seatroom">

    <div class="seatroom-legend">
        <div class="legend-pill">
            <span class="dot dot-free"></span> Tersedia
        </div>
        <div class="legend-pill">
            <span class="dot dot-booked"></span> Terbooking
        </div>
    </div>

    <div class="screen-wrap">
        <div class="screen-glow"></div>
        <div class="screen-text">LAYAR</div>
    </div>

    
    <div class="seat-cols">
        <div class="seat-cols-spacer"></div>
        <div class="seat-cols-grid" style="--cols: <?php echo e($maxCols); ?>; --aisleAfter: <?php echo e($aisleAfter); ?>;">
            <?php for($i = 1; $i <= $maxCols; $i++): ?>
                <div class="col-num <?php echo e($i == $aisleAfter ? 'after-aisle' : ''); ?>">
                    <?php echo e($i); ?>

                </div>
            <?php endfor; ?>
        </div>
    </div>

    
    <div class="seat-map" style="--cols: <?php echo e($maxCols); ?>; --aisleAfter: <?php echo e($aisleAfter); ?>;">
        <?php $__currentLoopData = $seatRows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rowLetter => $rowSeats): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="seat-row">
                <div class="row-letter"><?php echo e($rowLetter); ?></div>

                <div class="row-grid">
                    <?php for($i = 1; $i <= $maxCols; $i++): ?>
                        <?php
                            // cari seat sesuai nomor kolom (misal A5)
                            $seat = $rowSeats->first(function ($s) use ($i) {
                                preg_match('/\d+/', $s->seat_code, $mm);
                                return intval($mm[0] ?? 0) === $i;
                            });

                            $isBooked = $seat ? in_array($seat->id, $bookedSeatIds) : false;
                        ?>

                        <?php if($seat): ?>
                            <div class="seat <?php echo e($isBooked ? 'seat-booked' : 'seat-free'); ?>"
                                 style="<?php echo e($i == $aisleAfter ? 'margin-right: var(--aisleGap);' : ''); ?>"
                                 title="<?php echo e($seat->seat_code); ?> - <?php echo e($isBooked ? 'Terbooking' : 'Tersedia'); ?>">
                                <?php echo e($seat->seat_code); ?>

                            </div>
                        <?php else: ?>
                            
                            <div class="seat seat-empty"
                                 style="<?php echo e($i == $aisleAfter ? 'margin-right: var(--aisleGap);' : ''); ?>">
                            </div>
                        <?php endif; ?>
                    <?php endfor; ?>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\PAW\BIOSKOP TUBES\BIOSKOP\resources\views\admin\schedules\availability_detail.blade.php ENDPATH**/ ?>