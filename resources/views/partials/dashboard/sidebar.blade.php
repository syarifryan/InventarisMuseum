<ul>
    <li>
        <div class="menu-title">MAIN</div>
        <ul>
            <li>
                <a href="{{url('/dashboard')}}">
                    <div class="tooltip-item in-active" data-bs-toggle="tooltip" data-bs-placement="right" title=""
                        data-bs-original-title="Dashboard" aria-label="Dashboard"></div>

                    <span>
                        <i class="iconly-Curved-Home"></i>
                        <span>Dashboard</span>
                    </span>
                </a>
            </li>
            {{-- @can('article-index')
            <li>
                <a href="{{route('dashboard.article.index')}}">
                    <span>
                        <i class="iconly-Curved-Document"></i>
                        <span>Koleksi Museum</span>
                    </span>
                </a>
            </li>
            @endcan --}}
           
        </ul>
    </li>

    <li>
        <div class="menu-title">INDEX</div>
        <ul>
            @can('article-index')
            <li>
                <a href="{{route('dashboard.article.index')}}">
                    <span>
                        <i class="iconly-Curved-Document"></i>
                        <span>Koleksi Museum</span>
                    </span>
                </a>
            </li>
            @endcan
           
        </ul>
    </li>

    <li>
        <div class="menu-title">MASTER</div>
        <ul>
            @can('news-index')
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
                        <a href="{{url('/dashboard/news')}}">
                            <span>Add Inventaris</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('news.category.index')}}">
                            <span>Category</span>
                        </a>
                    </li>
                </ul>
            </li>
            @endcan
        </ul>
    </li>
    
    <li>
        <div class="menu-title">Setting</div>
        <ul>
            @can('user-index')
            <li>
                <a href="{{route('dashboard.user.index')}}">
                    <div class="tooltip-item in-active" data-bs-toggle="tooltip" data-bs-placement="right" title=""
                        data-bs-original-title="User" aria-label="User"></div>
                    <span>
                        <i class="iconly-Curved-People"></i>
                        <span>User</span>
                    </span>
                </a>
            </li>
            @endcan
            @can('role-index')
            <li>
                <a href="{{url('/dashboard/role')}}">
                    <div class="tooltip-item in-active" data-bs-toggle="tooltip" data-bs-placement="right" title=""
                        data-bs-original-title="Role & Permission" aria-label="Role & Permission"></div>
                    <span>
                        <i class="iconly-Light-Lock"></i>
                        <span>Role & Permission</span>
                    </span>
                </a>
            </li>
            @endcan
            <li>
                <a href="{{url('/dashboard/profile')}}">
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
