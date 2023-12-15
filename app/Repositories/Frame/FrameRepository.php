<?php

namespace App\Repositories\Frame;

use App\Models\Frame;
use Illuminate\Pagination\LengthAwarePaginator;

class FrameRepository
{
    public function getAllPaginated($perPage = 15): LengthAwarePaginator
    {
        return Frame::paginate($perPage);
    }

    public function create(array $frameData)
    {
        return Frame::create($frameData);
    }

    public function findById($id)
    {
        return Frame::find($id);
    }

    public function findByIds(array $ids)
    {
        return Frame::with('images')->whereIn('id', $ids)->get();
    }

    public function delete($id)
    {
        $frame = Frame::find($id);

        if (!$frame) {
            return false;
        }

        $frame->delete();

        return $frame;
    }

    public function deleteMultiple(array $ids)
    {
        $frames = Frame::whereIn('id', $ids)->get();

        if ($frames->isEmpty()) {
            return false;
        }

        $frames->each->delete();
        return true;
    }
}
