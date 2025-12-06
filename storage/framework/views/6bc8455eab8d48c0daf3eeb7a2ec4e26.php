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
                <li class="breadcrumb-item active" aria-current="page">User</li>
            </ol>
        </nav>
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">Daftar User</h1>
                <p class="mb-0">Manajemen data pengguna sistem.</p>
            </div>
            <div>
                <a href="<?php echo e(route('user.create')); ?>" class="btn btn-primary">
                    <i class="fas fa-plus me-1"></i> Tambah User
                </a>
            </div>
        </div>
    </div>


    
    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Sukses!</strong> <?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>


    <?php if(session('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> <?php echo e(session('error')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>


    <div class="card border-0 shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-centered table-nowrap mb-0 rounded">
                    <thead class="thead-light">
                        <tr>
                            <th class="border-0 rounded-start">#</th>
                            <th class="border-0">NAME</th>
                            <th class="border-0">EMAIL</th>
                            <th class="border-0">PASSWORD</th>
                            <th class="border-0">ROLE</th> <!-- KOLOM BARU -->
                            <th class="border-0 rounded-end">ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $dataUser; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e($index + 1); ?></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img class="avatar rounded-circle me-2"
                                            src="<?php echo e($user->profile_picture ? asset('storage/' . $user->profile_picture) : asset('assets-admin/img/team/profile-picture-3.jpg')); ?>"
                                            alt="<?php echo e($user->name); ?>" width="30"
                                            onerror="this.src='<?php echo e(asset('assets-admin/img/team/profile-picture-3.jpg')); ?>'">
                                        <span><?php echo e($user->name); ?></span>
                                    </div>
                                </td>
                                <td><?php echo e($user->email); ?></td>
                                <td>
                                    <span class="badge bg-secondary">
                                        <?php echo e(substr($user->password, 0, 20)); ?>...
                                    </span>
                                </td>
                                <td>
                                    <?php if($user->role == 'Super Admin'): ?>
                                        <span class="badge bg-danger"><?php echo e($user->role); ?></span>
                                    <?php elseif($user->role == 'Administrator'): ?>
                                        <span class="badge bg-primary"><?php echo e($user->role); ?></span>
                                    <?php elseif($user->role == 'Pelanggan'): ?>
                                        <span class="badge bg-success"><?php echo e($user->role); ?></span>
                                    <?php elseif($user->role == 'Mitra'): ?>
                                        <span class="badge bg-warning text-dark"><?php echo e($user->role); ?></span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary"><?php echo e($user->role ?? 'Belum diatur'); ?></span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="<?php echo e(route('user.edit', $user->id)); ?>" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="<?php echo e(route('user.destroy', $user->id)); ?>" method="POST" class="d-inline"
                                            onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="btn btn-sm btn-outline-danger ms-1">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="6" class="text-center py-4">
                                    <div class="text-muted">
                                        <i class="fas fa-users fa-2x mb-2"></i><br>
                                        Belum ada data user.
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>


            
            <?php if($dataUser->hasPages()): ?>
                <div class="mt-3">
                    <?php echo e($dataUser->links('pagination::bootstrap-5')); ?>

                </div>
            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\geta-strawberry\resources\views/admin/user/index.blade.php ENDPATH**/ ?>