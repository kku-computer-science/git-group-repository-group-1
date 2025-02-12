

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="card" style="padding: 16px;">
        <div class="card-body">
            <h4 class="card-title">Edit Highlight</h4>
            <form action="<?php echo e(route('highlights.update', $highlight->id)); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                <div class="mb-3">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control" value="<?php echo e($highlight->title); ?>" required>
                </div>
                <div class="mb-3">
                    <label>Description</label>
                    <textarea name="description" class="form-control"><?php echo e($highlight->description); ?></textarea>
                </div>
                <div class="mb-3">
                    <label>Current Image</label><br>
                    <img src="<?php echo e(asset($highlight->image_url)); ?>" width="100">
                </div>
                <div class="mb-3">
                    <label>New Image</label>
                    <input type="file" name="image" class="form-control">
                </div>
                <div class="mb-3">
                    <label>Priority</label>
                    <input type="number" name="priority" class="form-control" value="<?php echo e($highlight->priority); ?>" required>
                </div>
                <div class="mb-3">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value="active" <?php echo e($highlight->status == 'active' ? 'selected' : ''); ?>>Active</option>
                        <option value="inactive" <?php echo e($highlight->status == 'inactive' ? 'selected' : ''); ?>>Inactive</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-success">Update</button>
                <a href="<?php echo e(route('highlights.index')); ?>" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('dashboards.users.layouts.user-dash-layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Project_2-master\Project_2-master\resources\views/highlights/edit.blade.php ENDPATH**/ ?>