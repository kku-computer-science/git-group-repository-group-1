

<?php $__env->startSection('content'); ?>

<div class="container">
    <div class="card shadow-sm p-4">
        <div class="card-body">
            <h4 class="card-title">Highlight List</h4>

            <!-- ADD New Highlight Button -->
            <a class="btn btn-primary mb-3" href="<?php echo e(route('highlights.create')); ?>">
                <i class="mdi mdi-plus"></i> Add Highlight
            </a>

            <div class="table-responsive">
                <table id="highlightsTable" class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>No.</th>
                            <th>Title (EN)</th>
                            <th>Title (TH)</th>
                            <th>Description (EN)</th>
                            <th>Description (TH)</th>
                            <th>Image (EN)</th>
                            <th>Image (TH)</th>
                            <th>Tags</th>
                            <th>Priority</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $highlights; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $highlight): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="text-center"><?php echo e($i + 1); ?></td>
                            <td><?php echo e($highlight->title_en); ?></td>
                            <td><?php echo e($highlight->title_th); ?></td>
                            <td style="max-width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                <?php echo e($highlight->description_en); ?>

                            </td>
                            <td style="max-width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                <?php echo e($highlight->description_th); ?>

                            </td>
                            <td class="text-center">
                                <img src="<?php echo e(asset($highlight->image_url_en)); ?>" alt="Highlight EN" class="img-thumbnail" width="80">
                            </td>
                            <td class="text-center">
                                <img src="<?php echo e(asset($highlight->image_url_th)); ?>" alt="Highlight TH" class="img-thumbnail" width="80">
                            </td>
                            <!--show highlight tag-->
                            <td>
                                <?php if($highlight->hasTags()->count() > 0): ?>
                                    <span class="badge badge-primary">Has Tags</span>
                                <?php else: ?>
                                <?php endif; ?>
                            </td>

                            <td class="text-center"><?php echo e($highlight->priority); ?></td>
                            <td class="text-center">
                                <!-- Edit Button -->
                                <a class="btn btn-outline-success btn-sm" href="<?php echo e(route('highlights.edit', $highlight->id)); ?>" title="Edit">
                                    <i class="mdi mdi-pencil"></i>
                                </a>

                                <!-- Delete Button with Modal -->
                                <button class="btn btn-outline-danger btn-sm delete-btn" data-id="<?php echo e($highlight->id); ?>">
                                    <i class="mdi mdi-delete"></i>
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Deletion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this highlight? This action cannot be undone.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- jQuery & DataTables -->
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.0/js/dataTables.bootstrap4.min.js"></script>

<script>
    $(document).ready(function() {
        $('#highlightsTable').DataTable({
            "pageLength": 10
        });

        // Delete Confirmation Modal
        $('.delete-btn').click(function() {
            let id = $(this).data('id');
            let action = "<?php echo e(url('highlights')); ?>/" + id;
            $('#deleteForm').attr('action', action);
            $('#deleteModal').modal('show');
        });
    });
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('dashboards.users.layouts.user-dash-layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\git-group-repository-group-1\code\resources\views/highlights/index.blade.php ENDPATH**/ ?>