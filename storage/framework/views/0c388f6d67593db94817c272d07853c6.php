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
                <li class="breadcrumb-item"><a href="#">Pelanggan</a></li>
            </ol>
        </nav>
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">Data Pelanggan</h1>
                <p class="mb-0">List data seluruh pelanggan</p>
            </div>
            <div>
                <a href="<?php echo e(route('pelanggan.create')); ?>" class="btn btn-success text-white"><i
                        class="far fa-question-circle me-1"></i> Tambah Pelanggan</a>
            </div>
        </div>
    </div>

    
    <?php if(session('create')): ?>
        <div class="alert alert-info">
            <?php echo session('create'); ?>

        </div>
    <?php endif; ?>

    
    <?php if(session('update')): ?>
        <div class="alert alert-info">
            <?php echo session('update'); ?>

        </div>
    <?php endif; ?>

    
    <?php if(session('delete')): ?>
        <div class="alert alert-info">
            <?php echo session('delete'); ?>

        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-12 mb-4">
            <div class="card border-0 shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <form method="GET" action="<?php echo e(route('pelanggan.index')); ?>" class="mb-3">
                            <div class="row">
                                <div class="col-md-2">
                                    <select name="gender" class="form-select" onchange="this.form.submit()">
                                        <option value="">All</option>
                                        <option value="Male" <?php echo e(request('gender') == 'Male' ? 'selected' : ''); ?>>Male</option>
                                        <option value="Female" <?php echo e(request('gender') == 'Female' ? 'selected' : ''); ?>>Female</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <input type="text" name="search" class="form-control" value="<?php echo e(request('search')); ?>"
                                            placeholder="Search">
                                        <button type="submit" class="input-group-text">
                                            <svg class="icon icon-xxs" fill="currentColor" viewBox="0 0 20 20"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                        </button>
                                        <?php if(request('search')): ?>
                                            <a href="<?php echo e(request()->fullUrlWithQuery(['search' => null])); ?>"
                                                class="btn btn-outline-secondary ml-3" id="clear-search"> Clear</a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <table id="table-pelanggan" class="table table-centered table-nowrap mb-0 rounded">
                            <thead class="thead-light">
                                <tr>
                                    <th class="border-0">First Name</th>
                                    <th class="border-0">Last Name</th>
                                    <th class="border-0">Birthday</th>
                                    <th class="border-0">Gender</th>
                                    <th class="border-0">Email</th>
                                    <th class="border-0">Phone</th>
                                    <th class="border-0 rounded-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $dataPelanggan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($item->first_name); ?></td>
                                        <td><?php echo e($item->last_name); ?></td>
                                        <td><?php echo e($item->birthday); ?></td>
                                        <td><?php echo e($item->gender); ?></td>
                                        <td><?php echo e($item->email); ?></td>
                                        <td><?php echo e($item->phone); ?></td>
                                        <td>
                                            
                                            <div class="d-flex gap-1">

                                                
                                                <a href="<?php echo e(route('pelanggan.show', $item->pelanggan_id)); ?>" class="btn btn-info btn-sm text-white">
                                                    <i class="fas fa-eye me-1"></i>Detail
                                                </a>

                                                
                                                <a href="<?php echo e(route('pelanggan.edit', $item->pelanggan_id)); ?>" class="btn btn-primary btn-sm">
                                                    <i class="fas fa-edit me-1"></i>Edit
                                                </a>

                                                
                                                <form action="<?php echo e(route('pelanggan.destroy', $item->pelanggan_id)); ?>" method="POST"
                                                    style="display:inline" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="fas fa-trash-alt me-1"></i>Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>

                        <div class="mt-3">
                            <?php echo e($dataPelanggan->links('pagination::bootstrap-5')); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\2SIA_Geta_framework\laragon-6.0-minimal\laragon-6.0-minimal\www\geta-strawberry\resources\views/admin/pelanggan/index.blade.php ENDPATH**/ ?>