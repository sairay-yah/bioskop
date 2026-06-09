

<?php $__env->startSection('content'); ?>
<h2>Profil Saya</h2>

<p>Nama: <?php echo e($user->name); ?><br>
Username: <?php echo e($user->username); ?><br>
Role: <?php echo e($user->role); ?></p>

<h3>Tiket Aktif</h3>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Film</th>
            <th>Jadwal</th>
            <th>Kursi</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
    <?php $__empty_1 = true; $__currentLoopData = $aktif; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <tr>
            <td><?php echo e($b->schedule->movie->title); ?></td>
            <td><?php echo e($b->schedule->start_time->format('d-m-Y H:i')); ?></td>
            <td>
                <?php $__currentLoopData = $b->tickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php echo e($t->seat->seat_code); ?>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </td>
            <td>
                <?php if($b->tickets->count()): ?>
                    <a href="<?php echo e(route('tickets.show', $b->tickets->first())); ?>" class="btn btn-sm btn-primary">Lihat Tiket</a>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr><td colspan="4">Tidak ada tiket aktif.</td></tr>
    <?php endif; ?>
    </tbody>
</table>

<h3>Riwayat Transaksi</h3>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Kode Booking</th>
            <th>Film</th>
            <th>Jadwal</th>
            <th>Status</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
    <?php $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($b->booking_code); ?></td>
            <td><?php echo e($b->schedule->movie->title); ?></td>
            <td><?php echo e($b->schedule->start_time->format('d-m-Y H:i')); ?></td>
            <td><?php echo e(strtoupper($b->status)); ?></td>
            <td>Rp <?php echo e(number_format($b->total_price,0,',','.')); ?></td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\PAW\BIOSKOP TUBES\BIOSKOP\resources\views\profile\index.blade.php ENDPATH**/ ?>