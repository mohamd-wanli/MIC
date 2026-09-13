<?php

namespace App\Policies;

use App\Models\Invoice;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class InvoicePolicy
{

    public function create(User $user, Invoice $invoice): bool
    {
        return $user->hasPermissionTo('manage invoices') && $user->department_id === $invoice->department_id;
    }

    public function view(User $user, Invoice $invoice): bool
    {
        return $user->hasPermissionTo('manage invoices') && $user->department_id === $invoice->department_id;
    }
    
    public function update(User $user, Invoice $invoice): bool
    {
        return $user->hasPermissionTo('manage invoices') && $user->department_id === $invoice->department_id;
    }
    
    public function delete(User $user, Invoice $invoice): bool
    {
        return $user->hasPermissionTo('manage invoices') && $user->department_id === $invoice->department_id;
    }
    
}
