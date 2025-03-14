<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
<style>
  /* Submenu hidden by default */
.submenu {
    display: none;
    padding-left: 20px;
    list-style: none;
    background-color: #f9f9f9;
}

.submenu-item {
    padding: 5px 0;
}

.submenu-link {
    text-decoration: none;
    color: #333;
    padding: 5px;
    display: block;
}

/* Show submenu when 'show' class is added */
.submenu.show {
    display: block;
}

/* Active state for menu items */
.menu-item.active > .menu-link {
    background-color: #ddd;
}

</style>
  <!-- ! Hide app brand if navbar-full -->
  <div class="app-brand demo">
    <a href="{{url('/')}}" class="app-brand-link">
      <!-- <span class="app-brand-logo demo">
        @include('_partials.macros',["width"=>25,"withbg"=>'var(--bs-primary)'])
      </span>
      <span class="app-brand-text demo menu-text fw-bold ms-2">{{config('variables.templateName')}}</span> -->
      <img src="{{asset('assets/images/sj_logo.png')}}" style ="width:200px;height:50px;"/>
    </a>

    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
      <i class="bx bx-chevron-left bx-sm align-middle"></i>
    </a>
  </div>

  <div class="menu-inner-shadow"></div>

  <ul class="menu-inner py-1">
    <?php
    $userData = session('user_data');

    if ($userData) {
        // Get the role id from session data
        $roleId = $userData['role'];

        // Get the permissions for the role
        $menuPermissions = \App\Models\Menu_permissions::where('role_id', $roleId)->get();

        // Retrieve menus and submenus based on permissions
        $menus = \App\Models\Menu::whereIn('id', $menuPermissions->pluck('menu_id'))
            ->with(['subMenus' => function ($query) use ($menuPermissions) {
                $query->whereIn('id', $menuPermissions->pluck('submenu_id'));
            }])
            ->where('status', 'Active')
            ->orderby('menu_order','ASC')
            ->get();

        // Format the data
        $formattedData = [
            'menu' => $menus->map(function ($menu) {
                $submenu = $menu->subMenus->map(function ($sub) {
                    return [
                        'url' => $sub->url,
                        'name' => $sub->name,
                        'slug' => $sub->slug,
                    ];
                });

                return [
                    'url' => $menu->url,
                    'name' => $menu->name,
                    'icon' => $menu->icon,
                    'slug' => $menu->slug,
                    'submenu' => $submenu->isEmpty() ? null : $submenu,
                ];
            }),
        ];

        $menuData = $formattedData['menu'];
    } else {
        $menuData = []; // Handle the case where user_data is not in the session
    }
    ?>

    @foreach ($menuData as $menu)
        {{-- Menu headers --}}
        @if (isset($menu['menuHeader']))
            <li class="menu-header small text-uppercase">
                <span class="menu-header-text">{{ __($menu['menuHeader']) }}</span>
            </li>
        @else
            @php
                $activeClass = null;
                $currentRouteName = Route::currentRouteName();

                if ($currentRouteName === $menu['slug']) {
                    $activeClass = 'active';
                } elseif (!empty($menu['submenu'])) {
                    foreach ($menu['submenu'] as $subMenu) {
                        if ($currentRouteName === $subMenu['slug']) {
                            $activeClass = 'active open';
                            break;
                        }
                    }
                }
            @endphp

            {{-- Main menu --}}
            <li class="menu-item {{ $activeClass }}">
                <a href="{{ isset($menu['url']) ? url($menu['url']) : 'javascript:void(0);' }}" class="menu-link {{ !empty($menu['submenu']) ? 'menu-toggle' : '' }}">
                    @isset($menu['icon'])
                        <i class="{{ $menu['icon'] }}"></i>
                    @endisset
                    <div>{{ __($menu['name']) }}</div>
                </a>

                {{-- Submenu --}}
                @if (!empty($menu['submenu']))
                    <ul class="submenu">
                        @foreach ($menu['submenu'] as $subMenu)
                            <li class="submenu-item">
                                <a href="{{ url($subMenu['url']) }}" class="submenu-link">{{ __($subMenu['name']) }}</a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </li>
        @endif
    @endforeach
</ul>

</aside>
<script>
  document.addEventListener("DOMContentLoaded", function () {
    // Find all menu items that can have submenus
    const menuItems = document.querySelectorAll('.menu-toggle');

    menuItems.forEach(item => {
        item.addEventListener('click', function (e) {
            // Prevent default behavior (if it's a link)
            e.preventDefault();

            // Toggle the 'open' class to show or hide the submenu
            const submenu = this.nextElementSibling;
            if (submenu && submenu.classList.contains('submenu')) {
                submenu.classList.toggle('show');
            }
        });
    });
});

</script>
