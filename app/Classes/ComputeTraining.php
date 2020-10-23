<?php

namespace App\Classes;

use App\TrainingDetail;
use App\Notifications\TrainingNotification;
use Carbon\Carbon;


class ComputeTraining
{
	/**
	 * Return inprogress if training has  started
	 */
	private const PROGRESS = "inprogress";

    /**
	 * Return completed if training has elapsed
	 */
    private const ELAPSED = "completed";

    /**
	 * Return completed if training has elapsed
	 */
    private const TRAINING = "training";

    /**
	 * Return completed if training has elapsed
	 */
    private const AVAIL = "available";

	public function init()
	{
		return $this->compute();
	}


	private function compute()
	{
		if ($this->load() !== null) {
			foreach ($this->load() as $training) {
				if ($training->end_date <= Carbon::now()) {
					// Set In Progress
					$training->status = "ongoing";
					$training->action = self::PROGRESS;
					$this->staffs($training);
				} else {
					// Set Elapsed
					$training->status = "elapsed";
					$training->action = self::ELAPSED;
					$training->completed = 1;
					$this->staffs($training, self::AVAIL);
				}

				$training->save();
			}

			return "Training record updated sucessfully.";
		}

		return "No training record was updated.";
	}


	private function staffs($training, $status="training")
	{
		foreach ($training->staffs as $staff) {
			$staff->status =  $status === "training" ? self::TRAINING : self::AVAIL;
			$staff->save();

			$staff->notify(new TrainingNotification($training));
		}

		return true;
	}


	private function load()
	{
		return TrainingDetail::where('status', 'scheduled')->where('start_date', '<=', Carbon::now())->latest()->get();
	}
}