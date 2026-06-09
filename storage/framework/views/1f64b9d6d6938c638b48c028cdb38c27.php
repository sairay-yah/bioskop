

<?php $__env->startSection('content'); ?>
<?php if(session('error') || session('success')): ?>
    <?php
        $type = session('error') ? 'error' : 'success';
        $message = session($type);
        $bgColor = $type === 'error' ? 'bg-red-500' : 'bg-green-500';
        $id = $type . 'Message';
        $closeFunction = 'close' . ucfirst($type) . 'Message';
    ?>

    <div id="<?php echo e($id); ?>" class="<?php echo e($bgColor); ?> text-white p-4 rounded-lg mb-6 relative">
        <span><?php echo e($message); ?></span>
        <button class="absolute right-5 text-white font-bold" onclick="<?php echo e($closeFunction); ?>()">X</button>
    </div>

    <script>
        function <?php echo e($closeFunction); ?>() {
            document.getElementById('<?php echo e($id); ?>').classList.add('hidden');
        }

        setTimeout(function() {
            var el = document.getElementById('<?php echo e($id); ?>');
            if (el) el.classList.add('hidden');
        }, 5000);
    </script>
<?php endif; ?>

<div class="bg-white p-6 rounded shadow mb-4">
    <h1 class="text-3xl font-semibold text-gray-800 mb-2">Manajemen Artikel</h1>
    <p class="text-gray-700 mb-6">Selamat datang di halaman manajemen artikel! Di sini Anda dapat menambah, mengedit, dan menghapus artikel sesuai kebutuhan.</p>

    <div class="mb-4">
        <a href="<?php echo e(route('admin.create')); ?>" class="bg-blue-600 text-white py-2 px-6 rounded-full shadow hover:bg-blue-700 transition duration-200">
            Tambah Artikel
        </a>
    </div>
</div>

<div class="bg-white p-6 rounded shadow">
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        <?php $__empty_1 = true; $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="relative bg-white p-4 rounded-lg shadow-lg hover:shadow-xl transform hover:scale-105 transition duration-200 group">
                <?php if($article->image): ?>
                    <img src="<?php echo e(asset('storage/' . $article->image)); ?>" alt="<?php echo e($article->title); ?>" class="w-full h-28 object-cover rounded mb-4 relative z-10">
                <?php endif; ?>

                <div class="flex justify-between items-center mt-4 relative z-10">
                    <h2 class="text-xl font-semibold text-gray-900 pr-4">
                        <?php echo e($article->title); ?>

                    </h2>
                    <div class="flex space-x-4">
                        <a href="<?php echo e(route('admin.edit', $article)); ?>" class="text-blue-600 hover:underline z-20">Edit</a>
                        <p>|</p>
                        <form action="<?php echo e(route('admin.destroy', $article)); ?>" method="POST" class="inline z-20">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                        </form>
                    </div>
                </div>

                <p class="text-sm text-gray-700 mt-2 mb-2 text-justify relative z-10">
                    <?php echo e(Str::limit($article->content, 100)); ?>

                </p>
                <a href="<?php echo e(route('articles.show', $article->id)); ?>" class="hover:underline text-blue-600 font-medium">Baca Selengkapnya</a>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="col-span-4 text-center text-gray-600 font-medium">
                Tidak Ada Artikel yang Tersedia.
            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\PAW\BIOSKOP TUBES\BIOSKOP\resources\views\admin\index.blade.php ENDPATH**/ ?>