<ul>
    <li>
        <div class="menu-title">MAIN</div>
        <ul>
            <li>
                <a href="<?php echo e(url('/dashboard')); ?>">
                    <div class="tooltip-item in-active" data-bs-toggle="tooltip" data-bs-placement="right" title=""
                        data-bs-original-title="Dashboard" aria-label="Dashboard"></div>

                    <span>
                        <i class="iconly-Curved-Home"></i>
                        <span>Dashboard</span>
                    </span>
                </a>
            </li>
            
           
        </ul>
    </li>

    <li>
        <div class="menu-title">INDEX</div>
        <ul>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('article-index')): ?>
            <li>
                <a href="<?php echo e(route('dashboard.article.index')); ?>">
                    <span>
                        <i class="iconly-Curved-Document"></i>
                        <span>Koleksi Museum</span>
                    </span>
                </a>
            </li>
            <?php endif; ?>
           
        </ul>
    </li>

    <li>
        <div class="menu-title">MASTER</div>
        <ul>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('news-index')): ?>
            <li>
                <a href="javascript:;" class="submenu-item">
                    <span>
                        <i class="iconly-Curved-Discovery"></i>
                        <span>Inventaris</span>
                    </span>

                    <div class="menu-arrow"></div>
                </a>

                <ul class="submenu-children" data-level="1">
                    <li>
                        <a href="<?php echo e(url('/dashboard/news')); ?>">
                            <span>Add Inventaris</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo e(route('news.category.index')); ?>">
                            <span>Category</span>
                        </a>
                    </li>
                </ul>
            </li>
            <?php endif; ?>
        </ul>
    </li>
    
    <li>
        <div class="menu-title">Setting</div>
        <ul>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user-index')): ?>
            <li>
                <a href="<?php echo e(route('dashboard.user.index')); ?>">
                    <div class="tooltip-item in-active" data-bs-toggle="tooltip" data-bs-placement="right" title=""
                        data-bs-original-title="User" aria-label="User"></div>
                    <span>
                        <i class="iconly-Curved-People"></i>
                        <span>User</span>
                    </span>
                </a>
            </li>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('role-index')): ?>
            <li>
                <a href="<?php echo e(url('/dashboard/role')); ?>">
                    <div class="tooltip-item in-active" data-bs-toggle="tooltip" data-bs-placement="right" title=""
                        data-bs-original-title="Role & Permission" aria-label="Role & Permission"></div>
                    <span>
                        <i class="iconly-Light-Lock"></i>
                        <span>Role & Permission</span>
                    </span>
                </a>
            </li>
            <?php endif; ?>
            <li>
                <a href="<?php echo e(url('/dashboard/profile')); ?>">
                    <div class="tooltip-item in-active" data-bs-toggle="tooltip" data-bs-placement="right" title=""
                        data-bs-original-title="Profil" aria-label="Profil"></div>
                    <span>
                        <i class="iconly-Curved-User"></i>
                        <span>Profil</span>
                    </span>
                </a>
            </li>
        </ul>
    </li>
</ul>
<?php /**PATH C:\laragon\www\Inventaris\resources\views/partials/dashboard/sidebar.blade.php ENDPATH**/ ?>