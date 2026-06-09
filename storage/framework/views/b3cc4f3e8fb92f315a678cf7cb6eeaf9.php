


<?php $__env->startSection('content'); ?>
<div class="movie-page">

    
    <div class="admin-page-header mb-4">
        <div class="admin-breadcrumb text-muted mb-1">
            Admin • Jadwal
        </div>
        <h1 class="page-title mb-0">
            Tambah Jadwal Film
        </h1>
    </div>

    
    <div class="card admin-form-card">
        <form action="<?php echo e(route('admin.schedules.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>

            
            <div class="mb-3">
                <label for="movie_id" class="form-label">Film</label>
                <select name="movie_id" id="movie_id"
                        class="form-select <?php $__errorArgs = ['movie_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                    <option value="" disabled selected>-- Pilih Film --</option>
                    <?php $__currentLoopData = $movies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $movie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($movie->id); ?>" <?php echo e(old('movie_id') == $movie->id ? 'selected' : ''); ?>>
                            <?php echo e($movie->title); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php $__errorArgs = ['movie_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="invalid-feedback d-block"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            
            <div class="mb-3">
                <label for="studio_id" class="form-label">Studio</label>
                <select name="studio_id" id="studio_id"
                        class="form-select <?php $__errorArgs = ['studio_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                    <option value="" disabled selected>-- Pilih Studio --</option>
                    <?php $__currentLoopData = $studios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $studio): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($studio->id); ?>" <?php echo e(old('studio_id') == $studio->id ? 'selected' : ''); ?>>
                            <?php echo e($studio->name); ?> - <?php echo e($studio->cinema->name); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php $__errorArgs = ['studio_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="invalid-feedback d-block"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            
            <div class="mb-3">
                <label for="start_time" class="form-label">Waktu Mulai</label>
                <div class="position-relative">
                    <input
                        type="datetime-local"
                        name="start_time"
                        id="start_time"
                        value="<?php echo e(old('start_time')); ?>"
                        class="form-control <?php $__errorArgs = ['start_time'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                    <span class="datetime-icon">
                        <i class="bi bi-calendar-event"></i>
                    </span>
                </div>
                <?php $__errorArgs = ['start_time'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="invalid-feedback d-block"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            
            <div class="mb-4">
                <label for="end_time" class="form-label">Waktu Selesai</label>
                <div class="position-relative">
                    <input
                        type="datetime-local"
                        name="end_time"
                        id="end_time"
                        value="<?php echo e(old('end_time')); ?>"
                        class="form-control <?php $__errorArgs = ['end_time'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                    <span class="datetime-icon">
                        <i class="bi bi-calendar-event"></i>
                    </span>
                </div>
                <?php $__errorArgs = ['end_time'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="invalid-feedback d-block"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            
            <div class="d-flex justify-content-between">
                <a href="<?php echo e(route('admin.schedules.index')); ?>" class="btn btn-outline-light booking-btn-ghost">
                    Kembali
                </a>
                <button type="submit" class="btn btn-primary booking-btn-primary">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\PAW\BIOSKOP TUBES\BIOSKOP\resources\views/admin/schedules/create.blade.php ENDPATH**/ ?>