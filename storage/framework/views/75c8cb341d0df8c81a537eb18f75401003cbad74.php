<header>
    <div class="row w-100 m-0">
        <div class="col ps-18 pe-16 px-sm-24">
            <div class="row w-100 align-items-center justify-content-between position-relative">
                <div class="col w-auto hp-flex-none hp-mobile-sidebar-button me-24 px-0" data-bs-toggle="offcanvas"
                    data-bs-target="#mobileMenu" aria-controls="mobileMenu">
                    <button type="button" class="btn btn-text btn-icon-only">
                        <i class="ri-menu-fill hp-text-color-black-80 hp-text-color-dark-30 lh-1"
                            style="font-size: 24px;"></i>
                    </button>
                </div>

                <div
                    class="hp-header-text-info col col-lg-14 col-xl-16 hp-header-start-text d-flex align-items-center hp-horizontal-none">
                </div>

                <div class="col hp-flex-none w-auto pe-0">
                    <div class="row align-items-center justify-content-end">
                        <div class="hover-dropdown-fade w-auto px-0 ms-6 position-relative hp-cursor-pointer d-flex align-items-center">
                            <div class="avatar-item d-flex align-items-center justify-content-center rounded-circle"
                                style="width: 40px; height: 40px;">
                                <img src="<?php echo e(asset('app-assets/img/default-profile.svg')); ?>">
                            </div>

                            <div class="hp-header-profile-menu dropdown-fade position-absolute pt-18"
                                style="top: 100%; width: 260px;">
                                <div
                                    class="rounded border hp-border-color-black-40 hp-bg-black-0 hp-bg-dark-100 hp-border-color-dark-80 p-24">
                                    <span class="d-block h5 hp-text-color-black-100 hp-text-color-dark-0 mb-6">Profile
                                        Settings</span>

                                    <a href="<?php echo e(route('dashboard.user.profile')); ?>"
                                        class="hp-p1-body hp-text-color-primary-1 hp-text-color-dark-primary-2 hp-hover-text-color-primary-2">View
                                        Profile</a>

                                    <div class="divider my-12"></div>

                                    <div class="row">
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user-index')): ?>
                                        <div class="col-12">
                                            <a href="<?php echo e(route('dashboard.user.index')); ?>"
                                            class="d-flex align-items-center hp-p1-body py-4 px-10 hp-transition hp-hover-bg-primary-4 hp-hover-bg-dark-primary hp-hover-bg-dark-80 rounded"
                                            style="margin-left: -10px; margin-right: -10px;">
                                            <i class="iconly-Curved-People me-8" style="font-size: 16px;"></i>
                                            
                                            <span class="ml-8">Explore Users</span>
                                        </a>
                                        </div>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('role-index')): ?>
                                        <div class="col-12">
                                            <a href="<?php echo e(route('dashboard.user.role.index')); ?>"
                                            class="d-flex align-items-center hp-p1-body py-4 px-10 hp-transition hp-hover-bg-primary-4 hp-hover-bg-dark-primary hp-hover-bg-dark-80 rounded"
                                            style="margin-left: -10px; margin-right: -10px;">
                                            <i class="iconly-Light-Lock me-8" style="font-size: 16px;"></i>
                                            
                                            <span class="hp-ml-8">Role & Permission</span>
                                        </a>
                                        </div>
                                        <?php endif; ?>
                                    </div>

                                    <div class="divider my-12"></div>

                                    <a href="#" class="hp-p1-body" data-bs-toggle="modal" data-bs-target="#ModalLogout">Logout</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<?php /**PATH C:\laragon\www\Inventaris\resources\views/partials/dashboard/navbar.blade.php ENDPATH**/ ?>