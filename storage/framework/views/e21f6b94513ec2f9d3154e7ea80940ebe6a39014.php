<?php $__env->startSection('title', 'Listado de usuarios'); ?>

<?php $__env->startSection('content'); ?>

    <div class="d-flex justify-content-between align-items-end mb-3">
        <h1 class="pb-1"><?php echo e($title); ?></h1>
        <p>
            <a href="<?php echo e(route('users.new')); ?>" class="btn btn-primary">Nuevo Usuario</a>
        </p>
    </div>
    
    <?php if($users->isNotEmpty()): ?>
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Correo</th>
                <th scope="col">Acciones</th>
            </tr>
            </thead>
            <tbody>
            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <th scope="row"><?php echo e($user->id); ?></th>
                    <td><?php echo e($user->name); ?></td>
                    <td><?php echo e($user->email); ?></td>
                    <td>
                        <form action="<?php echo e(route('users.destroy', $user)); ?>" method="POST">
                            <?php echo e(csrf_field()); ?>

                            <?php echo e(method_field('DELETE')); ?>

                            <a href="<?php echo e(route('users.show', $user)); ?>"><i class="fas fa-eye btn btn-link"></i></a>
                            <a href="<?php echo e(route('users.edit', $user)); ?>"><i class="fas fa-edit btn btn-link"></i></a>|
                            <button type="submit" class="btn btn-link"><i class="fas fa-trash-alt btn btn-link"></i></button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No hay usuarios registrados </p>
    <?php endif; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>