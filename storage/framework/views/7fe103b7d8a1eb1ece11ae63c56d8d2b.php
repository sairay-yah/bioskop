

<?php $__env->startSection('content'); ?>
<div class="admin-breadcrumb mb-2">
    Admin · <span>Film</span>
</div>

<h1 class="page-title mb-3">Edit Film</h1>

<div class="card admin-card-form p-4 p-md-5">
    <form action="<?php echo e(route('admin.movies.update', $movie)); ?>"
          method="POST"
          enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <div class="row g-4">
            
            <div class="col-lg-7">
                <div class="mb-3">
                    <label class="form-label" for="title">Judul Film</label>
                    <input type="text"
                           id="title"
                           name="title"
                           class="form-control <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                           value="<?php echo e(old('title', $movie->title)); ?>"
                           required>
                    <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="description">Deskripsi / Sinopsis</label>
                    <textarea id="description"
                              name="description"
                              rows="4"
                              class="form-control <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                              required><?php echo e(old('description', $movie->description)); ?></textarea>
                    <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label" for="duration">Durasi (menit)</label>
                        <input type="number"
                               id="duration"
                               name="duration"
                               class="form-control <?php $__errorArgs = ['duration'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                               value="<?php echo e(old('duration', $movie->duration)); ?>"
                               required>
                        <?php $__errorArgs = ['duration'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label" for="genre">Genre</label>
                        <input type="text"
                               id="genre"
                               name="genre"
                               class="form-control <?php $__errorArgs = ['genre'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                               value="<?php echo e(old('genre', $movie->genre)); ?>"
                               required>
                        <?php $__errorArgs = ['genre'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label" for="age_rating">Rating Umur</label>
                        <input type="text"
                               id="age_rating"
                               name="age_rating"
                               class="form-control <?php $__errorArgs = ['age_rating'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                               value="<?php echo e(old('age_rating', $movie->age_rating)); ?>"
                               placeholder="SU, 13+, 17+"
                               required>
                        <?php $__errorArgs = ['age_rating'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                <div class="mt-3">
                    <label class="form-label" for="base_price">Harga Dasar Tiket</label>
                    <input type="number"
                           id="base_price"
                           name="base_price"
                           class="form-control <?php $__errorArgs = ['base_price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                           value="<?php echo e(old('base_price', $movie->base_price)); ?>"
                           required>
                    <?php $__errorArgs = ['base_price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    <div class="form-text-small mt-1">
                        Masukkan harga dalam rupiah tanpa titik/koma, misal: <strong>35000</strong>.
                    </div>
                </div>
            </div>

            
            <div class="col-lg-5">
                <div class="mb-3">
                    <label class="form-label" for="poster">Poster Film</label>
                    <input type="file"
                           id="poster"
                           name="poster"
                           class="form-control <?php $__errorArgs = ['poster'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                           accept="image/*">
                    <?php $__errorArgs = ['poster'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    <div class="form-text-small mt-1">
                        Biarkan kosong jika tidak ingin mengganti poster.
                    </div>
                </div>

                <div class="mb-3">
                    <div class="form-label">Poster Saat Ini</div>
                    <?php if($movie->poster): ?>
                        <div class="admin-poster-wrapper">
                            <img src="<?php echo e(asset('storage/' . $movie->poster)); ?>"
                                 alt="Poster <?php echo e($movie->title); ?>"
                                 class="admin-poster-img">
                        </div>
                    <?php else: ?>
                        <div class="admin-poster-placeholder">
                            Tidak ada poster
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-between mt-4">
            <a href="<?php echo e(route('admin.movies.index')); ?>"
               class="btn btn-outline-light px-4">
                Kembali
            </a>

            <button type="submit" class="btn btn-primary px-5">
                Update
            </button>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\PAW\BIOSKOP TUBES\BIOSKOP\resources\views\admin\movies\edit.blade.php ENDPATH**/ ?>