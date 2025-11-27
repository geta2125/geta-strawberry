<?php $__env->startSection('content'); ?>
    <div class="py-4">
        <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
            <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                <li class="breadcrumb-item">
                    <a href="#">
                        <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                            </path>
                        </svg>
                    </a>
                </li>
                <li class="breadcrumb-item"><a href="<?php echo e(route('pelanggan.index')); ?>">Pelanggan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detail Pelanggan</li>
            </ol>
        </nav>

        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">Detail Pelanggan</h1>
                <p class="mb-0">Informasi pelanggan dan file pendukung.</p>
            </div>
            <div>
                <a href="<?php echo e(route('pelanggan.index')); ?>" class="btn btn-primary">Kembali</a>
            </div>
        </div>
    </div>

    <?php if(session('success')): ?>
        <div class="alert alert-info"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <div class="row">
        <div class="col-12 mb-4">
            <div class="card border-0 shadow mb-4">
                <div class="card-body">

                    
                    <h5 class="mb-3">Informasi Umum</h5>
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <p><strong>Nama:</strong> <?php echo e($pelanggan->first_name); ?> <?php echo e($pelanggan->last_name); ?></p>
                            <p><strong>Email:</strong> <?php echo e($pelanggan->email); ?></p>
                            <p><strong>No HP:</strong> <?php echo e($pelanggan->phone); ?></p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Tanggal Lahir:</strong> <?php echo e($pelanggan->birthday); ?></p>
                            <p><strong>Jenis Kelamin:</strong> <?php echo e($pelanggan->gender); ?></p>
                        </div>
                    </div>

                    <hr>

                    
                    <h5 class="mb-3">File Pendukung</h5>

                    <?php if($files->count()): ?>
                        <ul class="list-group mt-3">
                            <?php $__currentLoopData = $files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="list-group-item d-flex justify-content-between align-items-center">

                                    
                                    <a href="<?php echo e(asset('uploads/multiple/' . $file->filename)); ?>" target="_blank"
                                        class="fw-semibold">
                                        <?php echo e($file->filename); ?>

                                    </a>

                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    <?php else: ?>
                        <p class="text-muted">Belum ada file yang diupload.</p>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\geta-strawberry\resources\views/admin/pelanggan/show.blade.php ENDPATH**/ ?>