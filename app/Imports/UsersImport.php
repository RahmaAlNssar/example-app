<?php

namespace App\Imports;


use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class UsersImport implements ToModel, WithChunkReading, ShouldQueue
{
    public function model(array $row)
    {
        return new User([
            'name' => $row[0],
            'email'=>$row[1],
            'password'=>$row[2],
            'created_at'=> $row[3],
            'updated_at'=> $row[4],
        ]);
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
