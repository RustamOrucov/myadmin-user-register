<?php

namespace App\Repositories\Abstract;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

abstract class AbstractRepository
{
    protected $modelClass;
    public function __construct()
    {
        if (!$this->modelClass) {
            throw new \Error("model class not defined");
        }
    }
    public function getLatest()
    {
        return $this->query()
            ->orderByDesc('id')
            ->first();
    }
    public function get($id, $with = [])
    {
        return $this->modelClass::with($with)->find($id);
    }
    public function first($orderBy = 'asc', $order_column = 'id', $with = [])
    {
        return $this->query()->with($with)->orderBy($order_column, $orderBy)->first();
    }
    public function all($with = [], $orderBy = 'asc', $order_column = 'id')
    {
        return $this
            ->query()
            ->with($with)
            ->orderBy($order_column, $orderBy)
            ->get();
    }
    public function paginate($count = 8, $with = [], $orderBy = 'asc', $order_column = 'id',)
    {
        return $this->query()->with($with)->orderBy($order_column, $orderBy)->paginate($count);
    }
    public function query()
    {
        return $this->modelClass::query();
    }
    public function findBy($column, $value, $operator = '=', $with = [], $conditions = [])
    {
        $query = $this->query()->with($with)->where($column, $operator, $value);
        if ($conditions) {
            $query->where($conditions);
        }
        return $query->first();
    }

    public function findByOrFail($column, $value, $operator = '=', $with = [], $conditions = [])
    {
        if (!$data = $this->findBy($column, $value, $operator, $with, $conditions)) {
            abort(404);
        }
        return $data;
    }
    public function save($data, Model $model)
    {
        if ($model->id) {
            $model->update($data);
        } else {

            $model->fill($data);
            $model->save();
        }
        return $model;
    }
    public function updateOrInsertMultiple($data): void
    {
        DB::transaction(function () use ($data) {
            foreach ($data as $item) {
                if ($id = $item['id']) {
                    unset($item['id']);
                    $this->query()->where('id', $id)->update($item);
                } else {
                    unset($item['id']);
                    $this->modelClass::create($item);
                }
            }
        });
    }
    public function groupBy($groupBy_column,$with=[],$count){
        return $this->query()->whereIn($groupBy_column, $this->query()->groupBy($groupBy_column)->pluck($groupBy_column))
            ->with($with)
            ->paginate($count);
    }
    public function whereIn(string $where_column, array $where_data, $with = [], $orderBy = 'asc', $order_column = 'id')
    {
        return $this->query()->with($with)->whereIn($where_column, $where_data)->orderBy($order_column, $orderBy)->get();
    }

    public function getByIds($ids, $limit = 24, $with = [])
    {
        return $this->query()->whereIn('id', $ids)->limit($limit)->with($with)->get();
    }
    public function bulkInsert($data)
    {
        $this->modelClass::insert($data);
    }
    public function delete($model)
    {
        $model->delete();
    }

    public function status($model)
    {
        if($model->status==0){
            $model->status='1';
            $model->save();
        }else{
            $model->status='0';
            $model->save();
        }
        return $model;
    }
}
