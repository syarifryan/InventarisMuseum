<div class="modal fade" id="ModalLogout" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close hp-bg-none d-flex align-items-center justify-content-center"
                    data-bs-dismiss="modal" aria-label="Close">
                    <i class="ri-close-line hp-text-color-dark-0 lh-1" style="font-size: 24px;"></i>
                </button>
            </div>

            <div class="modal-body text-center">
                <h4 class="h4">Are you sure you want to sign out?</h4>
            </div>

            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancel</button>
                <form action="<?php echo e(route('logout')); ?>" method="POST"> 
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn btn-outline-danger">Logout</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\laragon\www\Inventaris\resources\views/partials/logout.blade.php ENDPATH**/ ?>