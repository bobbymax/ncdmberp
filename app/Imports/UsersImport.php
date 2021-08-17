<?php

namespace App\Imports;

use App\Role;
use App\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Events\AfterImport;
use Maatwebsite\Excel\Validators\Failure;
use Throwable;

class UsersImport implements
    ToCollection,
    WithHeadingRow,
    SkipsOnError,
    WithValidation,
    SkipsOnFailure,
    WithChunkReading,
    WithEvents
{
    use Importable, SkipsErrors, SkipsFailures, RegistersEventListeners;
    /**
    * @param array $rows
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        $role = Role::where('label', 'staff')->first();

        if (! $role) {
            $role = Role::create([
                'name' => 'Staff',
                'label' => 'staff',
                'active' => true
            ]);
        }

        foreach ($rows as $row) {

            $exists = User::where('email', $row['email'])->first();

            if (! $exists) {
                $user = User::create([
                    'name'     => $row['name'],
                    'email'    => $row['email'],
                    'password' => Hash::make('Password1'),
                    'staff_no' => Str::random(5)
                ]);

                $user->roles()->save($role);
            }
        }
    }

    public function rules() : array
    {
        return [
            '*.email' => ['email', 'unique:users,email']
        ];
    }

    public function chunkSize(): int
    {
        // TODO: Implement chunkSize() method.
        return 100;
    }

    // php artisan queue:work
    public static function afterImport(AfterImport $event)
    {
        // TODO: Implement Event action onCompletion
    }

    public function onFailure(Failure ...$failures)
    {
        // TODO: Implement onFailure() method.
    }
}
