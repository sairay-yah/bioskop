


<?php $__env->startSection('content'); ?>
<?php
    $booking  = $ticket->booking;
    $schedule = $booking->schedule;
    $movie    = $schedule->movie;
    $studio   = $schedule->studio;
    $cinema   = $studio->cinema;

    $start = $schedule->start_time instanceof \Carbon\Carbon
        ? $schedule->start_time
        : \Carbon\Carbon::parse($schedule->start_time);

    $seats = $booking->tickets
        ->map(fn($t) => optional($t->seat)->seat_code)
        ->filter()
        ->implode(', ');
?>

<div class="page-wrap">
    
    <div class="page-head">
        <div>
            <div class="page-kicker">E-TICKET</div>
            <h1 class="page-title"><?php echo e($movie->title); ?></h1>
            <div class="page-subtitle">
                Tunjukkan QR ini saat masuk studio. Jangan dishare sembarangan 😼
            </div>
        </div>

        <div class="chip chip-success">AKTIF</div>
    </div>

    
    <div class="glass-card ticket-card">
        <div class="ticket-grid">

            
            <div class="ticket-left">

                <div class="ticket-block">
                    <div class="ticket-label">Kode Booking</div>
                    <div class="ticket-value mono"><?php echo e($booking->booking_code); ?></div>
                </div>

                <div class="ticket-block">
                    <div class="ticket-label">Kode Tiket (QR)</div>
                    <div class="ticket-value mono"><?php echo e($ticket->ticket_code); ?></div>
                </div>

                <div class="ticket-block">
                    <div class="ticket-label">Kursi</div>
                    <div class="ticket-value"><?php echo e($seats ?: '-'); ?></div>
                </div>

                <div class="ticket-block">
                    <div class="ticket-label">Jadwal</div>
                    <div class="ticket-value"><?php echo e($start->format('d-m-Y H:i')); ?> WIB</div>
                </div>

                <div class="ticket-block">
                    <div class="ticket-label">Bioskop</div>
                    <div class="ticket-value">
                        <?php echo e($cinema->name); ?> (<?php echo e($studio->name); ?>)
                        <div class="ticket-sub"><?php echo e($cinema->address); ?></div>
                    </div>
                </div>

                <div class="divider-soft"></div>

                <div class="ticket-actions">
                    <a href="<?php echo e(route('home')); ?>" class="btn-pill btn-pill-primary">
                        Kembali ke Beranda
                    </a>
                    <a href="<?php echo e(route('bookings.history')); ?>" class="btn-pill btn-pill-muted">
                        Riwayat Pesanan
                    </a>
                </div>
            </div>

            
            <div class="ticket-qr-wrapper">
                <div class="ticket-qr-card">
                    <div class="ticket-qr-title">SCAN QR</div>
                    <div class="ticket-qr-subtitle">Valid untuk 1x masuk</div>

                    
                    <img
                        src="<?php echo e(asset('images/QRIS.jpg')); ?>"
                        alt="QR Code"
                        class="ticket-qr-image"
                    >

                    <div class="ticket-qr-note">
                        Datang minimal <strong>15 menit</strong> sebelum jadwal 🎬
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\PAW\BIOSKOP TUBES\BIOSKOP\resources\views/tickets/show.blade.php ENDPATH**/ ?>