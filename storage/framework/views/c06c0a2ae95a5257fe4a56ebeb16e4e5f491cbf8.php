<?php $__env->startSection('title', 'Crear Usuario'); ?>

<?php $__env->startSection('content'); ?>

    <div class="card">
        <h4 class="card-header">Crear usuario</h4>
        <div class="card-body">

            <?php if($errors->any()): ?>
                <div class="alert alert-danger">
                    <h6>Por favor corregir los siguiente errores:</h6>
                    <ul>
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form method="post" action="<?php echo e(url('users')); ?>" class="needs-validation" novalidate>
                <?php echo csrf_field(); ?>


                <div class="inner-addon left-addon">
                    <span>
                        <i class="fa fa-user-circle" aria-hidden="true"></i>
                    </span>
                    <input type="text" name="name" class="form-control" placeholder="Nombre" value="<?php echo e(old('name')); ?>" />
                </div>
                <br>
                <div class="input-group">
                    <span>
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                    </span>
                    <input type="text" name="email" class="form-control" placeholder="Correo electrónico" value="<?php echo e(old('email')); ?>" />
                </div>
                <br>
                <div class="input-group">
                    <span>
                        <i class="fa fa-briefcase" aria-hidden="true"></i>
                    </span>
                    <input type="number" name="profession_id" class="form-control" placeholder="Id de profesión" value="<?php echo e(old('profession_id')); ?>" />
                </div>
                <br>
                <div class="input-group">
	                <span>
                        <i class="fa fa-lock" aria-hidden="true"></i>
                    </span>
                    <input type="password" name="password" class="form-control" placeholder="Contraseña" />
                </div>
                <br>
                <button type="submit" class="btn btn-primary">Crear usuario</button>
                <a href="<?php echo e(route('users.index')); ?>" class="btn btn-link">Regresar al listado de usuarios</a>
            </form>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>