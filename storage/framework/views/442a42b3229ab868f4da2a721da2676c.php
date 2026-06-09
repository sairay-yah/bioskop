

<?php $__env->startSection('content'); ?>
<div class="admin-breadcrumb mb-2">
    Admin · <span>Film</span>
</div>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="page-title mb-0">Daftar Film</h1>

    <a href="<?php echo e(route('admin.movies.create')); ?>" class="btn btn-primary">
        + Tambah Film
    </a>
</div>

<div class="admin-table-wrapper card card-table p-0">
    <table class="table table-borderless align-middle mb-0 admin-table">
        <thead>
        <tr>
            <th style="width: 60px;">#</th>
            <th style="width: 110px;">Poster</th>
            <th>Judul</th>
            <th style="width: 160px;">Genre</th>
            <th style="width: 130px;">Durasi</th>
            <th style="width: 150px;">Harga Dasar</th>
            <th style="width: 160px;" class="text-end">Aksi</th>
        </tr>
        </thead>
        <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $movies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $movie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td class="text-muted"><?php echo e($index + 1); ?></td>
                <td>
                    <?php if($movie->poster): ?>
                        <img src="<?php echo e(asset('storage/' . $movie->poster)); ?>"
                             alt="<?php echo e($movie->title); ?>"
                             class="rounded"
                             style="width: 70px; height: 96px; object-fit: cover;">
                    <?php else: ?>
                        <span class="text-muted">-</span>
                    <?php endif; ?>
                </td>
                <td class="fw-semibold"><?php echo e($movie->title); ?></td>
                <td><?php echo e($movie->genre); ?></td>
                <td><?php echo e($movie->duration); ?> menit</td>
                <td>Rp <?php echo e(number_format($movie->base_price, 0, ',', '.')); ?></td>
                <td class="text-end">
                    <a href="<?php echo e(route('admin.movies.edit', $movie)); ?>"
                       class="btn btn-sm btn-warning px-3 me-1">
                        Edit
                    </a>

                    <form action="<?php echo e(route('admin.movies.destroy', $movie)); ?>"
                          method="POST"
                          class="d-inline"
                          onsubmit="return confirm('Yakin ingin menghapus film ini?')">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn-sm btn-danger px-3">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td colspan="7" class="text-center text-muted py-4">
                    Belum ada film yang ditambahkan.
                </td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\PAW\BIOSKOP TUBES\BIOSKOP\resources\views/admin/movies/index.blade.php ENDPATH**/ ?>