<?php

namespace App\Interfaces;

interface iBasicCRUD
{
    const ACTIVE = 'active';
    const INACTIVE = 'inactive';

    public static function add(array $data);
    public static function getAll();
    public static function update(array $data);
    public static function remove(int $id);
}
