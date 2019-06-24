<?php $__env->startSection('title', "Usuario <?php echo e($user->id); ?>"); ?>

<?php $__env->startSection('content'); ?>

    <h1>Usuario #<?php echo e($user->id); ?></h1>

    <p>Nombre del usuario: <?php echo e($user->name); ?></p>
    <p>Correo electrónico: <?php echo e($user->email); ?></p>

    <p>
        <a href="<?php echo e(route('users.index')); ?>">Regresar</a>
    </p>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>