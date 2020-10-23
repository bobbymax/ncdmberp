<?php

namespace App\Observers;

use App\TrainingDetail;

class TrainingObserver
{
    /**
     * Handle the training detail "created" event.
     *
     * @param  \App\TrainingDetail  $training
     * @return void
     */
    public function created(TrainingDetail $training)
    {
        //
    }

    /**
     * Handle the training detail "updated" event.
     *
     * @param  \App\TrainingDetail  $training
     * @return void
     */
    public function updated(TrainingDetail $training)
    {
        //
    }

    /**
     * Handle the training detail "deleted" event.
     *
     * @param  \App\TrainingDetail  $training
     * @return void
     */
    public function deleted(TrainingDetail $training)
    {
        //
    }

    /**
     * Handle the training detail "restored" event.
     *
     * @param  \App\TrainingDetail  $training
     * @return void
     */
    public function restored(TrainingDetail $training)
    {
        //
    }

    /**
     * Handle the training detail "force deleted" event.
     *
     * @param  \App\TrainingDetail  $training
     * @return void
     */
    public function forceDeleted(TrainingDetail $training)
    {
        //
    }
}
