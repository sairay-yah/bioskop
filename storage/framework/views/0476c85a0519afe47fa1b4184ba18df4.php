


<?php $__env->startSection('content'); ?>
<h1 class="page-title mb-3">Riwayat Pesanan</h1>

<?php if($bookings->isEmpty()): ?>
    <div class="card-glass p-4">
        <p class="mb-1 fw-semibold">Belum ada pesanan</p>
        <p class="mb-0 text-muted">
            Yuk pilih film di halaman utama lalu pesan tiketmu 🎬
        </p>
    </div>
<?php else: ?>
    <div class="admin-table-wrapper card card-table p-0">
        <table class="table table-borderless align-middle mb-0 admin-table">
            <thead>
            <tr>
                <th style="width: 120px;">Tanggal</th>
                <th>Film</th>
                <th style="width: 260px;">Bioskop</th>
                <th style="width: 170px;">Kursi</th>
                <th style="width: 140px;">Total</th>
                <th style="width: 120px;">Status</th>
                <th style="width: 150px;" class="text-end">Aksi</th>
            </tr>
            </thead>
            <tbody>
            <?php $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $schedule = $booking->schedule;
                    $movie    = $schedule->movie;
                    $studio   = $schedule->studio;
                    $cinema   = $studio->cinema;

                    $start = $schedule->start_time instanceof \Carbon\Carbon
                        ? $schedule->start_time
                        : \Carbon\Carbon::parse($schedule->start_time);

                    $seats = $booking->tickets
                        ->map(fn($ticket) => optional($ticket->seat)->seat_code)
                        ->filter()
                        ->implode(', ');

                    $status      = $booking->status ?? 'pending';
                    $firstTicket = $booking->tickets->first();
                ?>

                <tr>
                    <td>
                        <div class="schedule-time-main"><?php echo e($start->format('d-m-Y')); ?></div>
                        <div class="schedule-time-sub"><?php echo e($start->format('H:i')); ?> WIB</div>
                    </td>

                    <td class="fw-semibold"><?php echo e($movie->title); ?></td>

                    <td>
                        <div class="schedule-cinema-name"><?php echo e($cinema->name); ?></div>
                        <div class="schedule-cinema-address"><?php echo e($studio->name); ?> · <?php echo e($cinema->address); ?></div>
                    </td>

                    <td><?php echo e($seats ?: '-'); ?></td>

                    <td>Rp <?php echo e(number_format($booking->total_price, 0, ',', '.')); ?></td>

                    <td>
                        <?php if($status === 'paid' || $status === 'lunas'): ?>
                            <span class="badge bg-success rounded-pill px-3">Lunas</span>
                        <?php elseif($status === 'pending'): ?>
                            <span class="badge bg-warning text-dark rounded-pill px-3">Pending</span>
                        <?php else: ?>
                            <span class="badge bg-secondary rounded-pill px-3"><?php echo e(ucfirst($status)); ?></span>
                        <?php endif; ?>
                    </td>

                    <td class="text-end aksi-col">
                        <?php if($status === 'paid' || $status === 'lunas'): ?>
                            <?php if($firstTicket): ?>
                                <a href="<?php echo e(route('tickets.show', ['ticket' => $firstTicket->id, 'from' => 'history'])); ?>"
                                   class="btn btn-sm btn-primary btn-aksi">
                                    Lihat E-Ticket
                                </a>
                            <?php else: ?>
                                <span class="text-muted small">Tiket belum tersedia</span>
                            <?php endif; ?>

                        <?php elseif($status === 'pending'): ?>
                            <a href="<?php echo e(route('payment.show', ['booking' => $booking->id, 'from' => 'history'])); ?>"
                               class="btn btn-sm btn-success btn-aksi">
                                Bayar
                            </a>

                        <?php else: ?>
                            <span class="text-muted small">Tidak tersedia</span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\PAW\BIOSKOP TUBES\BIOSKOP\resources\views/bookings/history.blade.php ENDPATH**/ ?>