<?php

namespace Tests\Functional;

use Illuminate\Database\Eloquent\Model;

trait RefreshDatabase
{
    /**
     * Start a transaction.
     *
     * @throws \Exception
     */
    public function beginTransaction()
    {
        $model = new class extends Model {};

        $model->getConnection()->beginTransaction();
    }

    /**
     * Do rollback in transaction.
     *
     * @throws \Exception
     */
    public function rollBackTransaction()
    {
        $model = new class extends Model {};

        $model->getConnection()->rollBack();
    }
}