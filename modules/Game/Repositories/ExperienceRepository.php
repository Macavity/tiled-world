<?php

namespace Modules\Game\Repositories;

use Modules\Character\Entities\Character;

class Experience {

    private $baseExperience = [
        9, 22, 42, 68, 103, 144, 194, 251, 316, 390,            // bis 10  (02-11)
        473, 564, 664, 773, 891, 1018, 1155, 1301, 1456, 1621,            // 20      (12-21)
        1796, 2228, 2718, 3271, 3891, 4580, 5343, 6184, 7107, 8116,            // 30      (22-31)
        9216, 10687, 12385, 14345, 16605, 19213, 22220, 25687, 29684, 34291,        // 40      (32-41)
        39601, 44700, 50428, 56863, 64088, 72200, 81304, 91521, 102983, 115841,        // 50      (42-51)
        128692, 142784, 157528, 178184, 196300, 215198, 234879, 255341, 330188, 365914,            // 60      (52-61)
        403224, 442116, 482590, 536948, 585191, 635278, 687211, 740988, 925400, 1473746,        // 70      (62-71)
        1594058, 1718928, 1848355, 1982340, 2230113, 2386162, 2547417, 2713878, 3206160, 3681024,        // 80      (72-81)
        4022472, 4377024, 4744680, 5125440, 5767272, 6204000, 6655464, 7121664, 7602600, 9738720,        // 90      (82-91)
        11649960, 13643520, 18339300, 23836800, 35658000, 48687000, 58135000, 99999999                        // 99      (92-99)
    ];

    private $preJobExperience = [
        // Novice
        0,0,
        //  1   2   3   4   5   6   7   8   9
        10,	20,	28,	40,	91,	151,205,268,340,0
    ];

    private $firstJobExperience = [
        // First Job
        0,0,	30,	43,	58,	76,	116,	180,	220,	272,	336,
        520,	604,	699,	802,	948,	1125,	1668,	1937,	2226,	3040,
        3988,	5564,	6272,	7021,	9114,	11473,	15290,	16891,	18570,	23229,
        28359,	36478,	39716,	43088,	52417,	62495,	78160,	84175,	90404,	107611,
        125915,	153941,	191781,	204351,	248352,	286212,	386371,	409795,	482092,	509596,
        0
    ];

    private $secondJobExperience = [
        // Second Job
        0,0,	144,	184,	284,	348,	603,	887,	1096,	1598,	2540,
        3676,	4290,	4946,	6679,	9294,	12770,	14344,	16005,	20642,	27434,
        35108,	38577,	42206,	52708,	66971,	82688,	89544,	96669,	117821,	144921,
        174201,	186677,	199584,	238617,	286366,	337147,	358435,	380376,	447685,	526989,
        610246,	644736,	793535,	921810,	1106758,1260955,1487304,1557657,1990632,2083386,
        0
    ];

    /**
     * Get the required base experience for the next base levelup
     *
     * @param Character $character
     * @return int
     */
    public function nextBaseExpForChar(Character $character)
    {
        return $this->getBaseExperience($character->base_level);
    }

    /**
     * Get the required Job experience for the next job levelup
     *
     * @param Character $character
     * @return int
     * @throws \Exception
     */
    public function nextJobExpForChar(Character $character)
    {
        return $this->getJobExperience($character->job, $character->job_level);
    }

    public function getBaseExperience($currentLevel)
    {
        return isset($this->baseExperience[$currentLevel+1]) ? $this->baseExperience[$currentLevel+1] : -1;
    }

    public function getJobExperience($job, $currentLevel)
    {
        switch($job){
            case JOB_NOVICE:
                return isset($this->preJobExperience[$currentLevel+1]) ? $this->preJobExperience[$currentLevel+1] : -1;
            case JOB_SWORDMAN:
            case JOB_ARCHER:
            case JOB_ACOLYTE:
            case JOB_THIEF:
            case JOB_MAGE:
            case JOB_MERCHANT:
                return isset($this->firstJobExperience[$currentLevel+1]) ? $this->firstJobExperience[$currentLevel+1] : -1;
            default:
                throw new \Exception("Undefined Job");
        }
    }
}