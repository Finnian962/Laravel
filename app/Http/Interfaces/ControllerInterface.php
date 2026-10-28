<?php

namespace App\Http\Interfaces;

use Illuminate\Http\Request;

interface ControllerInterface
{
    public function index();

    public function get(int $id);

    public function create(Request $request);

    public function update(Request $request, int $id);

    public function destroy(int $id);
}
