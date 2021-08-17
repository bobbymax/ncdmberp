<?php

namespace App\Imports;

use App\Department;
use App\Vocabulary;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Validators\Failure;

class DepartmentsImport implements ToCollection, WithHeadingRow, SkipsOnError, SkipsOnFailure
{
    use Importable, SkipsErrors, SkipsFailures;

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $dept = Department::where('code', $row['code'])->first();
            $lower = strtolower($row['type']);

            if (! $dept) {
                $vocabulary = Vocabulary::where('label', $lower)->first();
                $parent = Department::where('code', $row['parent'])->first();

                Department::create([
                    'vocabulary_id' => $vocabulary ? $vocabulary->id : 3,
                    'name' => $row['name'],
                    'label' => Str::slug($row['name']),
                    'code' => $row['code'],
                    'parent' => $parent ? $parent->id : 0,
                ]);
            }
        }
    }

    public function onFailure(Failure ...$failures)
    {
        // TODO: Implement onFailure() method.
    }
}
