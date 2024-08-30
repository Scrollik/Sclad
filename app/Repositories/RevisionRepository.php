<?php

namespace App\Repositories;

use App\Data\RevisionData;
use App\Models\Revision;
use App\Models\RevisionMaterial;
use Spatie\LaravelData\DataCollection;

class RevisionRepository
{
    public function getRevision(): ?DataCollection
    {
        return RevisionData::collect(
            Revision::where('status', 0)
                ->get()
            ,
            DataCollection::class
        );
    }

    public function getRevisionHistory(): ?DataCollection
    {
        return RevisionData::collect(
            Revision::where('status', 1)
                ->get()
            ,
            DataCollection::class
        );
    }

    public function revisionStore(array $params): void
    {
        $revision = Revision::create([
            'date' => $params['date'],
        ]);

        foreach ($params['material'] as $materials) {
            $revision->revisionMaterials()->attach(
                $materials['id'],
                [
                    'amount' => $materials['amount_material'],
                    'type' => $materials['type'],
                    'old_amount' => $materials['old_amount'],
                ]
            );
        }
    }

    public function updateAfterAccept(int $id): void
    {
        Revision::where('id', $id)
            ->update([
                'status' => 1,
            ]);
    }

    public function getRevisionForModal(int $id): ?DataCollection
    {
        return RevisionData::collect(
            Revision::where('id', $id)
                ->with('revisionMaterials')
                ->get()
            ,
            DataCollection::class
        );
    }

    public function deleteRevision(int $id): void
    {
        Revision::destroy($id);
    }

}
