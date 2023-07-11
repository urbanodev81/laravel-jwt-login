<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function profile(
        Request $request
    ) {
        Employee::where('id', $request->input(key:'user_id'))->update(
            [
                'name' => $request->input(key:'name')
            ]
        );

        return response()->json(
            [
                'message' => 'User atualizado com sucesso!',
            ]
        );

    }
}
