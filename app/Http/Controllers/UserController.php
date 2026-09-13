<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Department;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * عرض جميع المستخدمين مع التحقق من القسم.
     */
    public function index(Request $request)
    {
        $query = User::orderBy('id', 'DESC');
    
        // إذا لم يكن المستخدم Admin، فإنه يرى فقط المستخدمين في قسمه
        if (!auth()->user()->hasRole('Admin')) {
            $query->where('department_id', auth()->user()->department_id);
        }
    
        // جلب جميع المستخدمين بدون تقسيم الصفحات
        $data = $query->get();
    
        return view('users.show_users', compact('data'))
            ->with('i', 0); // تحديث الفهرس ليبدأ من 0
    }
    

    /**
     * عرض صفحة إنشاء مستخدم جديد.
     */
    public function create()
    {
        $roles = Role::all();
        $departments = Department::all(); // جلب جميع الأقسام

        return view('users.Add_user', compact('roles', 'departments'));
    }

    /**
     * حفظ مستخدم جديد في قاعدة البيانات.
     */
    public function store(Request $request)
{
    $this->validate($request, [
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6',
        'Status' => 'required|in:مفعل,غير مفعل',
        'department_id_hidden' => 'nullable|exists:departments,id',
        'roles' => 'nullable|array',
        'roles.*' => 'exists:roles,id'
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'Status' => $request->Status,
        'password' => bcrypt($request->password),
        'department_id' => $request->department_id_hidden ?? null, // 🔥 استخدام department_id_hidden 🔥
    ]);

    $rolesToAssign = [];

    // إذا تم اختيار قسم، اجلب الأدوار المرتبطة به
    if ($request->filled('department_id_hidden')) {
        $department = Department::find($request->department_id_hidden);
        if ($department) {
            $departmentRoles = $department->roles()->pluck('roles.id')->toArray();
            $rolesToAssign = array_merge($rolesToAssign, $departmentRoles);
        }
    }

    // إذا تم اختيار أدوار يدوية، أضفها
    if ($request->filled('roles')) {
        $rolesToAssign = array_merge($rolesToAssign, $request->roles);
    }

    // تعيين الأدوار للمستخدم
    $user->roles()->sync($rolesToAssign);

    return redirect()->route('users.index')->with('success', 'تم إنشاء المستخدم بنجاح');
}

    
    


    /**
     * عرض تفاصيل مستخدم معين.
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        // التحقق من صلاحية العرض
        if (!auth()->user()->hasRole('Admin') && auth()->user()->department_id !== $user->department_id) {
            return redirect()->route('users.index')->with('error', 'لا يمكنك عرض هذا المستخدم.');
        }

        return view('users.show', compact('user'));
    }

    /**
     * عرض صفحة تعديل مستخدم.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        $userRole = $user->roles->pluck('name')->toArray();
        $departments = Department::all();

        // التحقق من أن المستخدم لا يمكنه تعديل مستخدم خارج قسمه إلا لو كان Admin
        if (!auth()->user()->hasRole('Admin') && auth()->user()->department_id !== $user->department_id) {
            return redirect()->route('users.index')->with('error', 'لا يمكنك تعديل مستخدم خارج قسمك.');
        }

        return view('users.edit', compact('user', 'roles', 'userRole', 'departments'));
    }

    /**
     * تحديث بيانات المستخدم.
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:6',
            'Status' => 'required|in:مفعل,غير مفعل',
            'department_id' => 'nullable|exists:departments,id',
            'roles' => 'nullable|array',
            'roles.*' => 'exists:roles,id'
        ]);
    
        $user = User::findOrFail($id);
    
        // تحديث بيانات المستخدم
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'Status' => $request->Status,
            'password' => $request->filled('password') ? bcrypt($request->password) : $user->password,
            'department_id' => $request->department_id,
        ]);
    
        $rolesToAssign = [];
    
        // إذا تم اختيار قسم، اجلب الأدوار المرتبطة به
        if ($request->filled('department_id')) {
            $department = Department::find($request->department_id);
            $departmentRoles = $department->roles()->pluck('roles.id')->toArray();
            $rolesToAssign = array_merge($rolesToAssign, $departmentRoles);
        }
    
        // إذا تم اختيار أدوار يدوية، أضفها
        if ($request->filled('roles')) {
            $rolesToAssign = array_merge($rolesToAssign, $request->roles);
        }
    
        // تحديث الأدوار للمستخدم
        $user->roles()->sync($rolesToAssign);
    
        return redirect()->route('users.index')->with('success', 'تم تحديث المستخدم بنجاح');
    }
    


    /**
     * حذف مستخدم.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // التحقق من أن المستخدم لا يمكنه حذف مستخدم خارج قسمه إلا لو كان Admin
        if (!auth()->user()->hasRole('Admin') && auth()->user()->department_id !== $user->department_id) {
            return redirect()->route('users.index')->with('error', 'لا يمكنك حذف مستخدم خارج قسمك.');
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'تم حذف المستخدم بنجاح.');
    }

    
}
