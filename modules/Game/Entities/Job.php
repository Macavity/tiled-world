<?php

namespace Modules\Game\Entities;

class Job {

    static function getJobSlug($job){
        switch($job){
            case JOB_NOVICE:
                return "nov";
            case JOB_SWORDMAN:
                return "swd";
            case JOB_ARCHER:
                return "arc";
            case JOB_THIEF:
                return "thf";
            case JOB_ACOLYTE:
                return "aco";
            case JOB_MERCHANT:
                return "mer";
            case JOB_MAGE:
                return "mag";
            default:
                return "";
        }
    }

}