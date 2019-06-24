<?php $__env->startSection('title', 'Editar Usuario'); ?>

<?php $__env->startSection('content'); ?>

    <br>
    <h4>Editar usuario <?php echo e($user->name); ?></h4>

    <form method="POST" action="<?php echo e(url("users/{$user->id}")); ?>" class="needs-validation" novalidate>
        <?php echo e(csrf_field()); ?>

        <?php echo e(method_field('PUT')); ?>


        <div class="input-group">
	        <span>
                <i class="fa fa-user-circle" aria-hidden="true"></i>
            </span>
            <input type="text" name="name" class="form-control" placeholder="Nombre" value="<?php echo e(old('name', $user->name)); ?>" />
        </div>
        <?php if($errors->has('name')): ?>
            <div class="alert alert-danger">
                <p><?php echo e($errors->first('name')); ?></p>
            </div>
        <?php endif; ?>
        <br>
        <div class="input-group">
	        <span>
                <i class="fa fa-envelope" aria-hidden="true"></i>
            </span>
            <input type="text" name="email" class="form-control" placeholder="Correo electrónico" value="<?php echo e(old('email', $user->email)); ?>" />
        </div>
        <?php if($errors->has('email')): ?>
            <div class="alert alert-danger">
                <p><?php echo e($errors->first('email')); ?></p>
            </div>
        <?php endif; ?>
        <br>
        <div class="input-group">
	        <span>
                <i class="fa fa-briefcase" aria-hidden="true"></i>
            </span>
            <input type="number" name="profession_id" class="form-control" placeholder="Id de profesión" value="<?php echo e(old('profession_id', $user->profession_id)); ?>" />
        </div>
        <?php if($errors->has('profession_id')): ?>
            <div class="alert alert-danger">
                <p><?php echo e($errors->first('profession_id')); ?></p>
            </div>
        <?php endif; ?>
        <br>
        <div class="input-group">
	        <span>
                <i class="fa fa-lock" aria-hidden="true"></i>
            </span>
            <input type="password" name="password" class="form-control" placeholder="Contraseña" />
        </div>
        <?php if($errors->has('password')): ?>
            <div class="alert alert-danger">
                <p><?php echo e($errors->first('password')); ?></p>
            </div>
        <?php endif; ?>
        <br>
        <button type="submit">Actualizar usuario</button>
    </form>

    <p>
        <a href="<?php echo e(route('users.index')); ?>">Regresar al listado de usuarios</a>
    </p>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>