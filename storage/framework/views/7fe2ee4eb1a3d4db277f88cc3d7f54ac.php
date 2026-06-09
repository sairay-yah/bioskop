

<?php $__env->startSection('content'); ?>
<?php
    $schedule = $booking->schedule;
    $movie    = $schedule->movie;
    $studio   = $schedule->studio;
    $cinema   = $studio->cinema;

    $start = $schedule->start_time instanceof \Carbon\Carbon
        ? $schedule->start_time
        : \Carbon\Carbon::parse($schedule->start_time);

    $firstTicket = $booking->tickets->first();
?>

<div class="page-wrap">
    <div class="page-head">
        <div>
            <div class="page-kicker">PEMBAYARAN</div>
            <h1 class="page-title">Booking <span class="text-glow"><?php echo e($booking->booking_code); ?></span></h1>
            <div class="page-subtitle">
                Scan QRIS untuk bayar (simulasi). Setelah itu klik <b>Refresh</b> untuk masuk ke E-Ticket.
            </div>
        </div>
    </div>

    <div class="glass-card payment-card">
        <div class="payment-grid">
            
            <div class="payment-left">
                <div class="section-title">Detail Pesanan</div>

                <div class="info-list">
                    <div class="info-row">
                        <div class="info-label">Film</div>
                        <div class="info-value"><?php echo e($movie->title); ?></div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">Jadwal</div>
                        <div class="info-value"><?php echo e($start->format('d-m-Y H:i')); ?> WIB</div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">Bioskop</div>
                        <div class="info-value">
                            <?php echo e($cinema->name); ?> (<?php echo e($studio->name); ?>)
                            <div class="info-sub"><?php echo e($cinema->address); ?></div>
                        </div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">Jumlah Kursi</div>
                        <div class="info-value"><?php echo e($booking->seat_count); ?></div>
                    </div>

                    <div class="info-row total-row">
                        <div class="info-label">Total</div>
                        <div class="info-value price">
                            Rp <?php echo e(number_format($booking->total_price, 0, ',', '.')); ?>

                        </div>
                    </div>
                </div>

                <div class="hint-box">
                    <div class="hint-title">Tips</div>
                    <div class="hint-text">
                        Kalau E-Ticket belum kebuka setelah klik Refresh,
                        berarti status booking kamu masih <b>pending</b> (belum dianggap paid di sistem).
                    </div>
                </div>
            </div>

            
            <div class="payment-right">
                <div class="section-title text-center">QRIS</div>

                <div class="qr-wrap">
                    <img src="<?php echo e(asset('images/QRIS.jpg')); ?>" alt="QRIS" class="qr-image">
                </div>

            <div class="mt-3 d-flex justify-content-center gap-2 flex-wrap">

            
                <form action="<?php echo e(route('payment.refresh', $booking->id)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                    <button type="submit" class="btn btn-success px-4 btn-aksi">
                        Refresh (Ke E-Ticket)
                        </button>
                    </form>

                
                    <a href="<?php echo e(route('bookings.history')); ?>" class="btn btn-primary px-4 btn-aksi">
                    Riwayat Pesanan
                </a>

                </div>


                <div class="mini-note text-center">
                    Dengan klik refresh, kamu “cek ulang” status booking kamu. Kalau sudah paid, tiket langsung tampil.
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\PAW\BIOSKOP TUBES\BIOSKOP\resources\views/payment/show.blade.php ENDPATH**/ ?>