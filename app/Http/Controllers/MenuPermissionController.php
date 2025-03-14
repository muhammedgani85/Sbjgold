<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Menu_permissions;
use App\Models\Roles;
use Illuminate\Http\Request;

class MenuPermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

      $userRole =$userData = session('user_data')->role; // Assuming the role is stored in the 'role' field of the User model

    // Check if the role is 9 or 10
    if ($userRole == 9 || $userRole == 10) {
        $roles = Roles::all();
        $menus = Menu::with('subMenus')->get();
        $selectedPermissions = [];

        // If role is selected, fetch the existing permissions
        if ($roleId = request('role_id')) {
            $selectedPermissions = Menu_permissions::where('role_id', $roleId)
                                                 ->get()
                                                 ->map(function ($permission) {
                                                     return $permission->menu_id . ($permission->submenu_id ? '_' . $permission->submenu_id : '');
                                                 })
                                                 ->toArray();
        }

        return view('content.menu_permissions.index', compact('roles', 'menus', 'selectedPermissions'));
      }
        else {
          // Redirect to a permission restricted page if the role is not 9 or 10
          return redirect()->route('permission.restricted'); // Replace with the appropriate route
      }
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


      $roleId = $request->input('role_id');
      $permissions = $request->input('permissions', []); // Array of menu and submenu IDs

      // Remove old permissions for the role
      Menu_permissions::where('role_id', $roleId)->delete();

      // Save new permissions
      foreach ($permissions as $permission) {
          $ids = explode('_', $permission); // Format: menu_id or menu_id_submenu_id
          $menuId = $ids[0];
          $submenuId = $ids[1] ?? null;

          Menu_permissions::create([
              'role_id' => $roleId,
              'menu_id' => $menuId,
              'submenu_id' => $submenuId,
          ]);
      }

      return redirect()->back()->with('success', 'Permissions updated successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
