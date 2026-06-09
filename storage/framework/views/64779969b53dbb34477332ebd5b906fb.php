

<?php $__env->startSection('content'); ?>
<?php
    use Carbon\Carbon;

    $start = $schedule->start_time instanceof \Carbon\Carbon
        ? $schedule->start_time
        : Carbon::parse($schedule->start_time);

    // ====== BUILD SEAT MAP (ROW LETTER + NUMBER) ======
    // seat_code format: A1, A2, B10, dst
    $seatMap = [];     // [rowLetter][num] = seat
    $rowOrder = [];    // keep row ordering
    $maxNum = 0;

    foreach ($seats as $s) {
        $code = $s->seat_code ?? ('K'.$s->id);

        // ambil row letter + nomor
        // contoh: A10 => row=A, num=10
        if (preg_match('/^([A-Za-z]+)\s*(\d+)$/', trim($code), $m)) {
            $row = strtoupper($m[1]);
            $num = (int) $m[2];
        } else {
            // fallback kalau seat_code aneh
            $row = 'Z';
            $num = (int) $s->id;
        }

        $seatMap[$row][$num] = $s;
        $rowOrder[$row] = true;
        if ($num > $maxNum) $maxNum = $num;
    }

    // urutkan row A..Z
    $rows = array_keys($rowOrder);
    sort($rows);

    // atur lorong (bisa ubah)
    $aisleAfter = 5;           // bikin gap setelah kolom 5
    $aisleGapPx = 18;          // jarak lorong
?>

<div class="booking-page container-xxl">

    <div class="row g-4 align-items-start">
        
        <div class="col-lg-4">
            <div class="card booking-info-card">
                <div class="card-body">
                    <p class="booking-section-label mb-2">Tiket kamu untuk</p>
                    <h3 class="booking-movie-title mb-1"><?php echo e($schedule->movie->title); ?></h3>
                    <p class="booking-movie-subtitle mb-3"><?php echo e($schedule->movie->description); ?></p>

                    <div class="booking-movie-meta mb-3">
                        <p class="mb-1">
                            <span>Durasi</span>
                            <strong><?php echo e($schedule->movie->duration); ?> menit</strong>
                        </p>
                        <p class="mb-1">
                            <span>Genre</span>
                            <strong><?php echo e($schedule->movie->genre); ?></strong>
                        </p>
                        <p class="mb-1">
                            <span>Rating Umur</span>
                            <strong><?php echo e($schedule->movie->age_rating); ?></strong>
                        </p>
                        <p class="mb-1">
                            <span>Harga / Kursi</span>
                            <strong>Rp <?php echo e(number_format($schedule->movie->base_price, 0, ',', '.')); ?></strong>
                        </p>
                    </div>

                    <hr class="booking-divider">

                    <div class="booking-location mb-3">
                        <p class="mb-1">
                            <span>Studio</span>
                            <strong><?php echo e($schedule->studio->name); ?></strong>
                        </p>
                        <p class="mb-1">
                            <span>Bioskop</span>
                            <strong><?php echo e($schedule->studio->cinema->name); ?></strong>
                        </p>
                        <p class="booking-address mb-2">
                            <?php echo e($schedule->studio->cinema->address); ?>

                        </p>
                        <p class="mb-0">
                            <span>Jadwal</span>
                            <strong><?php echo e($start->format('d M Y · H:i')); ?> WIB</strong>
                        </p>
                    </div>

                    <hr class="booking-divider">

                    <div class="booking-legend">
                        <div class="legend-item">
                            <span class="legend-dot legend-dot-free"></span> Tersedia
                        </div>
                        <div class="legend-item">
                            <span class="legend-dot legend-dot-booked"></span> Terisi
                        </div>
                        <div class="legend-item">
                            <span class="legend-dot legend-dot-selected"></span> Dipilih
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="col-lg-8">
            <div class="card booking-seat-card">
                <div class="card-body">

                    
                    <div class="screen-wrapper text-center mb-4">
                        <div class="screen-bar">LAYAR</div>
                        <p class="screen-subtitle mb-0">Pilih kursi terbaikmu menghadap layar</p>
                    </div>

                    
                    <form action="<?php echo e(route('booking.checkout', $schedule)); ?>" method="POST">
                        <?php echo csrf_field(); ?>

                        
                        <div class="user-seat-cols mb-2">
                            <div class="user-seat-cols-spacer"></div>

                            <div class="user-seat-cols-grid"
                                 style="--cols: <?php echo e($maxNum); ?>; --aisleAfter: <?php echo e($aisleAfter); ?>; --aisleGap: <?php echo e($aisleGapPx); ?>px;">
                                <?php for($i=1; $i <= $maxNum; $i++): ?>
                                    <div class="user-col-num <?php echo e($i == $aisleAfter ? 'after-aisle' : ''); ?>">
                                        <?php echo e($i); ?>

                                    </div>
                                <?php endfor; ?>
                            </div>
                        </div>

                        
                        <div class="user-seat-map"
                             style="--cols: <?php echo e($maxNum); ?>; --aisleAfter: <?php echo e($aisleAfter); ?>; --aisleGap: <?php echo e($aisleGapPx); ?>px;">
                            <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rowLetter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="user-seat-row">
                                    <div class="user-row-letter"><?php echo e($rowLetter); ?></div>

                                    <div class="user-row-grid">
                                        <?php for($i=1; $i <= $maxNum; $i++): ?>
                                            <?php
                                                $seat = $seatMap[$rowLetter][$i] ?? null;
                                            ?>

                                            <?php if($seat): ?>
                                                <?php
                                                    $booked  = in_array($seat->id, $bookedSeatIds);
                                                    $label   = $seat->seat_code ?? ($rowLetter.$i);
                                                    $inputId = 'seat-'.$seat->id;
                                                ?>

                                                <div class="user-seat-cell <?php echo e($i == $aisleAfter ? 'after-aisle' : ''); ?>">
                                                    <input
                                                        type="checkbox"
                                                        id="<?php echo e($inputId); ?>"
                                                        name="seat_ids[]"
                                                        value="<?php echo e($seat->id); ?>"
                                                        class="seat-checkbox"
                                                        <?php echo e($booked ? 'disabled' : ''); ?>

                                                    >
                                                    <label
                                                        for="<?php echo e($inputId); ?>"
                                                        class="seat-label <?php echo e($booked ? 'seat-booked' : 'seat-free'); ?>"
                                                        title="<?php echo e($booked ? 'Kursi sudah dipesan' : 'Kursi tersedia'); ?>"
                                                    >
                                                        <?php echo e($label); ?>

                                                    </label>
                                                </div>
                                            <?php else: ?>
                                                
                                                <div class="user-seat-cell placeholder <?php echo e($i == $aisleAfter ? 'after-aisle' : ''); ?>"></div>
                                            <?php endif; ?>
                                        <?php endfor; ?>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>

                        <?php $__errorArgs = ['seat_ids'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="text-danger small mt-2"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                        <?php if(session('error')): ?>
                            <div class="text-danger small mt-2"><?php echo e(session('error')); ?></div>
                        <?php endif; ?>

                        <div class="d-flex justify-content-between align-items-center mt-4 flex-wrap gap-2">
                            <a href="<?php echo e(url()->previous()); ?>" class="btn btn-outline-light px-4 booking-btn-ghost">
                                Kembali
                            </a>
                            <button class="btn btn-primary px-4 booking-btn-primary" type="submit">
                                Lanjut ke Pembayaran
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\PAW\BIOSKOP TUBES\BIOSKOP\resources\views\bookings\seats.blade.php ENDPATH**/ ?>