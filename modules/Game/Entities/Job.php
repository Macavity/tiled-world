<?php

namespace Modules\Game\Entities;

class Job {

    static function getJobName($job){

        switch($job){
            case JOB_NOVICE:
                return trans('game.JOB_NOVICE');
            case JOB_SWORDMAN:
                return trans('game.JOB_SWORDMAN');
            case JOB_ARCHER:
                return trans('game.JOB_ARCHER');
            case JOB_THIEF:
                return trans('game.JOB_THIEF');
            case JOB_ACOLYTE:
                return trans('game.JOB_ACOLYTE');
            case JOB_MERCHANT:
                return trans('game.JOB_MERCHANT');
            case JOB_MAGE:
                return trans('game.JOB_MAGE');
            default:
                return "";
        }
    }

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

    static function getJobStatBonus($job){
        switch($job){
            // Swordman
            case JOB_SWORDMAN:
                $bonus = [1,0,1,0,0,0,3,0,0,0,5,0,0,0,1,0,0,0,3,0,0,0,5,0,0,0,6,0,0,0,2,0,0,1,0,0,5,0,3,0,1,0,3,0,6,0,2,1,0,1,1];
                break;
            case JOB_MAGE:
                // Magician
                $bonus = [2,0,4,0,0,0,5,0,0,0,5,0,0,0,4,0,0,0,2,0,0,0,4,0,0,0,2,0,0,0,6,0,0,4,0,0,5,0,4,0,2,0,6,0,4,0,4,2,0,6,4];
                break;
            case JOB_ARCHER:
                // Archer
                $bonus = [3,0,5,0,0,0,1,0,0,0,4,0,0,0,5,0,0,0,5,0,0,0,6,0,0,0,2,0,0,0,5,0,0,2,0,0,5,0,1,0,1,0,5,0,6,0,3,4,0,2,5];
                break;
            case JOB_ACOLYTE:
                // Acolyte
                $bonus = [4,0,6,0,0,0,3,0,0,0,4,0,0,0,5,0,0,0,6,0,0,0,2,0,0,0,1,0,0,0,3,0,0,4,0,0,5,0,6,0,2,0,1,0,3,0,4,5,0,1,6];
                break;
            case JOB_MERCHANT:
                // Merchant
                $bonus = [5,0,3,0,0,0,5,0,0,0,1,0,0,0,5,0,0,0,3,0,0,0,1,0,0,0,4,0,0,0,3,0,0,0,0,0,6,0,5,0,1,2,5,0,1,0,6,3,0,1,5];
                break;
            case JOB_THIEF:
                // Thief
                $bonus = [6,0,2,0,0,0,1,0,0,0,5,0,0,0,3,0,0,0,4,0,0,0,5,0,0,0,6,0,0,0,1,0,0,2,0,0,1,0,2,0,6,0,5,0,3,0,6,1,0,5,2];
                break;
            default:
                $bonus = [];
        }

        return $bonus;

    }

    static function getJobLevelStatBonus($job, $jobLevel){

        $bonus = Job::getJobStatBonus($job);

        $bonusForLevel = array_slice($bonus, 1, $jobLevel);
        $bonusCount = array_count_values($bonusForLevel);

        return $bonusCount;
    }

}