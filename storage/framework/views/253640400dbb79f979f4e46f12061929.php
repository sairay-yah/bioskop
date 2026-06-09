

<?php $__env->startSection('content'); ?>
<div class="container px-0">

    
    <div class="mb-2 text-muted small">
        Admin · Jadwal
    </div>

    
    <h1 class="page-title mb-3">
        Edit Jadwal Film
    </h1>

    
    <div class="card card-admin-form">
        <div class="card-body">
            <form action="<?php echo e(route('admin.schedules.update', $schedule)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <?php
                    $startValue = $schedule->start_time instanceof \Carbon\Carbon
                        ? $schedule->start_time->format('Y-m-d\TH:i')
                        : \Carbon\Carbon::parse($schedule->start_time)->format('Y-m-d\TH:i');

                    $endValue = $schedule->end_time instanceof \Carbon\Carbon
                        ? $schedule->end_time->format('Y-m-d\TH:i')
                        : \Carbon\Carbon::parse($schedule->end_time)->format('Y-m-d\TH:i');
                ?>

                
                <div class="mb-3">
                    <label class="form-label" for="movie_id">Film</label>
                    <select name="movie_id" id="movie_id" class="form-control">
                        <?php $__currentLoopData = $movies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $movie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($movie->id); ?>"
                                <?php echo e(old('movie_id', $schedule->movie_id) == $movie->id ? 'selected' : ''); ?>>
                                <?php echo e($movie->title); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php $__errorArgs = ['movie_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="text-danger small mt-1"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                
                <div class="mb-3">
                    <label class="form-label" for="studio_id">Studio</label>
                    <select name="studio_id" id="studio_id" class="form-control">
                        <?php $__currentLoopData = $studios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $studio): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($studio->id); ?>"
                                <?php echo e(old('studio_id', $schedule->studio_id) == $studio->id ? 'selected' : ''); ?>>
                                <?php echo e($studio->name); ?> - <?php echo e($studio->cinema->name); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php $__errorArgs = ['studio_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="text-danger small mt-1"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                
                <div class="mb-3">
                    <label class="form-label" for="start_time">Waktu Mulai</label>
                    <input
                        type="datetime-local"
                        name="start_time"
                        id="start_time"
                        class="form-control"
                        value="<?php echo e(old('start_time', $startValue)); ?>"
                    >
                    <?php $__errorArgs = ['start_time'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="text-danger small mt-1"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                
                <div class="mb-4">
                    <label class="form-label" for="end_time">Waktu Selesai</label>
                    <input
                        type="datetime-local"
                        name="end_time"
                        id="end_time"
                        class="form-control"
                        value="<?php echo e(old('end_time', $endValue)); ?>"
                    >
                    <?php $__errorArgs = ['end_time'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="text-danger small mt-1"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                
                <div class="d-flex justify-content-between">
                    <a href="<?php echo e(route('admin.schedules.index')); ?>" class="btn btn-outline-light">
                        Kembali
                    </a>

                    <button type="submit" class="btn btn-primary">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\PAW\BIOSKOP TUBES\BIOSKOP\resources\views\admin\schedules\edit.blade.php ENDPATH**/ ?>