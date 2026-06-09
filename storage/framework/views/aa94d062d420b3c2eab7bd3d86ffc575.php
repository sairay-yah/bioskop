<?php $__env->startSection('content'); ?>
<div class="auth-wrapper">
    <div class="card auth-card card-compact">
        <h1 class="auth-title text-center">Masuk</h1>
        <p class="auth-subtitle text-center">
            Silakan login untuk memesan tiket bioskop.
        </p>

        <form method="POST" action="<?php echo e(route('login')); ?>">
            <?php echo csrf_field(); ?>

            
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input id="username"
                       type="text"
                       name="username"
                       value="<?php echo e(old('username')); ?>"
                       required
                       autofocus
                       class="form-control <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="invalid-feedback">
                        <?php echo e($message); ?>

                    </div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input id="password"
                       type="password"
                       name="password"
                       required
                       class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="invalid-feedback">
                        <?php echo e($message); ?>

                    </div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="form-check">
                    <input type="checkbox"
                           name="remember"
                           id="remember"
                           class="form-check-input"
                           <?php echo e(old('remember') ? 'checked' : ''); ?>>
                    <label for="remember" class="form-check-label">
                        Remember Me
                    </label>
                </div>
            </div>

            <button type="submit" class="btn btn-primary w-100 mb-3">
                Login
            </button>

            <div class="text-center">
                <span class="form-text-small">
                    Belum punya akun?
                </span>
                <a href="<?php echo e(route('register')); ?>" class="btn-link-soft">
                    Daftar sekarang
                </a>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\PAW\BIOSKOP TUBES\BIOSKOP\resources\views/auth/login.blade.php ENDPATH**/ ?>