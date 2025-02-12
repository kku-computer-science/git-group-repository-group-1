

<?php $__env->startSection('content'); ?>

<div class="container">
    <div class="card" style="padding: 16px;">
        <div class="card-body">
            <h4 class="card-title">Highlight List</h4>

            <!-- ADD New Highlight Button -->
            <a class="btn btn-primary mb-3" href="<?php echo e(route('highlights.create')); ?>">
                <i class="mdi mdi-plus"></i> Add Highlight
            </a>

            <div class="table-responsive">
                <table id="highlightsTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Priority</th>
                            <th>Status</th>
                            <th>Actions</th> <!-- New Column for Actions -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $highlights; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $highlight): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($i + 1); ?></td>
                            <td><?php echo e($highlight->title); ?></td>
                            <td><?php echo e(Str::limit($highlight->description, 80)); ?></td>
                            <td>
                                <img src="<?php echo e(asset($highlight->image_url)); ?>" alt="Highlight Image" width="100">
                            </td>
                            <td><?php echo e($highlight->priority); ?></td>
                            <td><?php echo e(ucfirst($highlight->status)); ?></td>
                            <td>
                                <!-- Edit Button -->
                                <a class="btn btn-outline-success btn-sm" href="<?php echo e(route('highlights.edit', $highlight->id)); ?>" title="Edit">
                                    <i class="mdi mdi-pencil"></i>
                                </a>

                                <!-- Delete Form -->
                                <form action="<?php echo e(route('highlights.destroy', $highlight->id)); ?>" method="POST" style="display:inline;">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-outline-danger btn-sm show_confirm" title="Delete">
                                        <i class="mdi mdi-delete"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
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
        $('#highlightsTable').DataTable(); // Initialize DataTable
    });

    // Sweet Alert for Delete Confirmation
    $('.show_confirm').click(function(event) {
        var form = $(this).closest("form");
        event.preventDefault();
        swal({
            title: `Are you sure?`,
            text: "If you delete this, it will be gone forever.",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                swal("Highlight deleted successfully!", {
                    icon: "success",
                }).then(function() {
                    form.submit();
                });
            }
        });
    });
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('dashboards.users.layouts.user-dash-layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Project_2-master\Project_2-master\resources\views/highlights/index.blade.php ENDPATH**/ ?>