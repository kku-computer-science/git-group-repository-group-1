

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="card shadow-sm p-4">
        <div class="card-body">
            <h4 class="card-title">Edit Highlight</h4>

            <form action="<?php echo e(route('highlights.update', $highlight->id)); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <div class="mb-3">
                    <label>Title (EN)</label>
                    <input type="text" name="title_en" class="form-control" value="<?php echo e(old('title_en', $highlight->title_en)); ?>" required>
                </div>

                <div class="mb-3">
                    <label>Title (TH)</label>
                    <input type="text" name="title_th" class="form-control" value="<?php echo e(old('title_th', $highlight->title_th)); ?>" required>
                </div>

                <div class="mb-3">
                    <label>Description (EN)</label>
                    <textarea name="description_en" class="form-control"><?php echo e(old('description_en', $highlight->description_en)); ?></textarea>
                </div>

                <div class="mb-3">
                    <label>Description (TH)</label>
                    <textarea name="description_th" class="form-control"><?php echo e(old('description_th', $highlight->description_th)); ?></textarea>
                </div>
    
                <div class="row mb-3">
                    <div class="col-md-3">
                        <label class="d-block">Current Image (EN)</label>
                        <img src="<?php echo e(asset($highlight->image_url_en)); ?>" class="img-thumbnail" width="150">
                        <div class="custom-file mt-2">
                            <input type="file" name="image_en" class="custom-file-input" id="image_en"> 
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label class="d-block">Current Image (TH)</label>
                        <img src="<?php echo e(asset($highlight->image_url_th)); ?>" class="img-thumbnail" width="150">
                        <div class="custom-file mt-2">
                            <input type="file" name="image_th" class="custom-file-input" id="image_th"> 
                        </div>
                    </div>
                </div>


                <!-- Tags -->
                <div class="mb-3">
                    <div class="col-md-3">
                        <label class="d-block">Tags</label>
                        <div id="selected-tags">
                            <?php $__currentLoopData = $highlightTags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <span class="badge badge-primary m-2"><?php echo e($tag); ?>

                                    <span class="remove-tag" style="cursor:pointer">&times;</span>
                                    <input type="hidden" name="tags[]" value="<?php echo e($tag); ?>">
                                </span>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <button type="button" class="btn btn-secondary btn-sm mt-2" data-toggle="modal" data-target="#tagModal">
                                Add Tag
                        </button>

                    </div>
                </div>

                <div class="mb-3">
                    <label>Priority</label>
                    <input type="number" name="priority" class="form-control" value="<?php echo e(old('priority', $highlight->priority)); ?>">
                </div>

                <button type="submit" class="btn btn-success">Update</button>
                <a href="<?php echo e(route('highlights.index')); ?>" class="btn btn-secondary">Cancel</a>
            </form>

             <!-- Modal for Tags -->
             <div class="modal fade" id="tagModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Select Tags</h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <?php if(!empty($existingTags) && is_iterable($existingTags)): ?>
                                <?php $__currentLoopData = $existingTags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <button type="button" class="btn btn-outline-primary tag-option m-1">
                                        <?php echo e(is_object($tag) ? $tag->name : $tag); ?>

                                    </button>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <p class="text-muted">No tags available</p>
                            <?php endif; ?>

                            <div class="mt-3">
                                <input type="text" id="newTagName" class="form-control border rounded" placeholder="Enter new tag">
                                <button type="button" id="addNewTag" class="btn btn-primary mt-2">Add New Tag</button>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // เลือกแท็กจากรายการที่มีอยู่
    $('.tag-option').click(function() {
        var tag = $(this).text().trim();
        if ($('#selected-tags input[value="'+tag+'"]').length == 0) {
            $('#selected-tags').append(`
                <span class="badge badge-primary m-1">${tag}
                    <span class="remove-tag" style="cursor:pointer">&times;</span>
                    <input type="hidden" name="tags[]" value="${tag}">
                </span>
            `);
        }
        $('#tagModal').modal('hide');
    });

    // เพิ่มแท็กใหม่ลงใน Database
    $('#addNewTag').click(function() {
        let tagName = $('#newTagName').val().trim();
        if (tagName === '') {
            alert('Please enter a tag name.');
            return;
        }

        $.ajax({
            url: "<?php echo e(route('tags.store')); ?>",
            method: "POST",
            data: {
                name: tagName,
                _token: "<?php echo e(csrf_token()); ?>"
            },
            success: function(response) {
                if (response.success) {
                    $('#selected-tags').append(`
                        <span class="badge badge-primary m-1">${response.tag.name}
                            <span class="remove-tag" style="cursor:pointer">&times;</span>
                            <input type="hidden" name="tags[]" value="${response.tag.id}">
                        </span>
                    `);
                    $('#newTagName').val('');
                }
            },
            error: function(xhr) {
                alert('Error adding tag. Check console for details.');
                console.error(xhr.responseText);
            }
        });
    });

    // ลบแท็กที่เลือก
    $(document).on('click', '.remove-tag', function(){
        $(this).parent('.badge').remove();
    });
});
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('dashboards.users.layouts.user-dash-layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\git-group-repository-group-1\code\resources\views/highlights/edit.blade.php ENDPATH**/ ?>