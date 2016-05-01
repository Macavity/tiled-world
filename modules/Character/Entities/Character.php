<?php namespace Modules\Character\Entities;

use DB;
use App\User;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Character
 * @package Modules\Character\Entities
 *
 * @property integer id
 * @property integer user_id
 * @property integer gender
 * @property integer job
 * @property integer hair_color
 * @property integer hair_style
 *
 * @property integer health_points
 * @property integer special_points
 *
 * @property integer base_level
 * @property integer job_level
 *
 * @property integer base_exp
 * @property integer job_exp
 *
 * @property integer str
 * @property integer con
 * @property integer agi
 * @property integer dex
 * @property integer luk
 * @property integer int
 *
 * @property integer rank_points
 *
 */
class Character extends Model
{
    var $hp;
    var $sp;
    var $add_hp;
    var $add_sp;
    var $max_hp;
    var $max_sp;

    public $speed = "";
    public $hit = "";
    public $cast = "";
    public $crit = "";
    public $flee = "";

    var $sta_mod = array();

    var $st_points,$sk_points;
    var $add_stp,$add_skp;

    var $item = array();
    var $skill = array();

    var $quick_slot = array();

    var $save;
    var $location;
    var $map_state;
    var $battle_temp;

    private $equipBonus;


    protected $fillable = ["name", "gender", "job", "hair_color", "hair_style"];

    public function user(){
        $this->belongsTo(User::class);
    }

    public function equipmentSets(){
        return $this->hasMany(EquipmentSet::class);
    }

    public function getClassName(){

        switch($this->job){
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

    public function attackPoints()
    {
        $bonusAttack = 0;

        // Influenced by status
        $attackPercentage = 100;

        $dex = $this->dex /* +bDex*/;
        $str = $this->str /* +bStr*/;
        $luk = $this->luk /* +bLuk*/;

        if($this->job === JOB_ARCHER || $this->job === JOB_HUNTER){
            $mainAttackStat = $dex;
            $secondAttackStat = $str;
        }
        else{
            $mainAttackStat = $str;
            $secondAttackStat = $dex;
        }
        $baseAttack = $mainAttackStat
            + ( floor( $mainAttackStat / 10 ) * floor( $mainAttackStat / 10 ) )
            + floor( $secondAttackStat / 5 )
            + floor( $luk / 5 );

        return ($bonusAttack > 0) ? $baseAttack.' +'.$bonusAttack : $baseAttack;
    }

    public function defensePoints()
    {
        return "";
    }

    public function damagePoints()
    {
        return "";
    }

    public function magicAttackPoints()
    {
        return "";
    }

    public function magicDefensePoints()
    {
        return "";
    }

    public function statPoints()
    {
        return "";
    }

    public function skillPoints()
    {
        return "";
    }

    // berechnet Modifikationen an den 6 Stats durch Statusver�nderungen
    function calcStaMod($char)
    {
        $sta_bonus[0] = $this->equipBonus->str;
        $sta_bonus[1] = $this->equipBonus->agi;
        $sta_bonus[2] = $this->equipBonus->con;
        $sta_bonus[3] = $this->equipBonus->int;
        $sta_bonus[4] = $this->equipBonus->dex;
        $sta_bonus[5] = $this->equipBonus->luk;

        $stat = array();
        $sta_mod = array();
        $level = $char['char_jlevel'];

        // Status Effekte?
        if ($status["Adrenaline"] >= 1){
            $p_agiu = true;
        }
        if (substr_count($char['char_status'],"�AGIUP�") >= 1)        {
            $p_agiu = true;
        }
        if (substr_count($char['char_status'],"�ANGELUS�") >= 1)        {
            $p_agiu = true;
        }
        if (substr_count($char['char_status'],"�BLESSED�") >= 1)        {
            $p_ble = true;
            $pos = strpos($user['user_status'],"�BLESSED�");
            $o_ble = substr($user['user_status'],$pos+8,1);
            if($o_ble=="a") $o_ble = 10;
            $o_ble = abs($o_ble);
        }
        if (substr_count($user['user_status'],"�BLIND�") >= 1)        {
            $p_agiu = true;
        }
        // B.S.S.
        if (substr_count($user['user_status'],"�o_bss�") >= 1)        {
            $o_bss = true;
        }
        if (substr_count($user['user_status'],"�p_burn�") >= 1)        {
            $p_burn = true;
        }
        // crazy uproar
        if (substr_count($user['user_status'],"�p_cu�") >= 1)        {
            $p_cu = true;
        }
        // cursed
        if (substr_count($user['user_status'],"�o_cu�") >= 1)        {
            $o_cur = true;
        }
        if (substr_count($user['user_status'],"�DEFAURA�") >= 1)        {
            $p_def = true;
        }
        if (substr_count($user['user_status'],"�FREEZE�") >= 1)        {
            $p_fre = true;
        }
        if (substr_count($user['user_status'],"�GLORIA�") >= 1)        {
            $p_glo = true;
        }
        if (substr_count($user['user_status'],"�IMPOSITIO�") >= 1)        {
            $p_agiu = true;
        }
        if (substr_count($user['user_status'],"�IMPROVECONC") >= 1)        {
            $p_ic = true;
        }
        if (substr_count($user['user_status'],"�MAGNIFICAT�") >= 1)        {
            $p_agiu = true;
        }
        if (substr_count($user['user_status'],"�OWL�") >= 1)        {
            $p_owl = true;
        }
        if (substr_count($user['user_status'],"�POISONED�") >= 1)        {
            $p_agiu = true;
        }
        if (substr_count($user['user_status'],"�PROVOKED�") >= 1)        {
            $p_agiu = true;
        }
        if (substr_count($user['user_status'],"�RESISTANTS�") >= 1)        {
            $p_agiu = true;
        }
        if (substr_count($user['user_status'],"�SIGNUM�") >= 1)        {
            $p_agiu = true;
        }
        if ($status[''] >= 1)        {
            $o_qua = true;
        }
        if (substr_count($user['user_status'],"�SUFFRA�") >= 1)        {
            $p_agiu = true;
        }
        if (substr_count($user['user_status'],"�STONECURSE�") >= 1)        {
            $p_agiu = true;
        }
        //global $mod_bonus;
        for ($i = 0; $i < 6; $i++) {
            $sta_mod[$i] = $stat[$i] + $sta_bonus[$i] + $mod_bonus[$job][$level][$i];
            $debug[] = "sta_mod[$i] = {$stat[$i]} + {$sta_bonus[$i]} + {$mod_bonus[$job][$level][$i]};";
        }

        if ($p_cu) $sta_mod[0] += 4;
        $sta_mod[0] += $o_ble;

        if ($p_ic) $sta_mod[1] *= 1.02 + $p_ic * 0.01;
        if ($o_agiu) $sta_mod[1] += 2 + $o_agiu;

        $sta_mod[3] += $o_ble;

        if ($p_owl) $sta_mod[4] += $p_owl;
        if ($p_ic) $sta_mod[4] *= 1.02 + $p_ic * 0.01;
        $sta_mod[4] += $o_ble;

        if ($o_glo) $sta_mod[5] += 30;
        $sta_mod[5] += $bonus[9][5];

        if ($o_cur) {
            $sta_mod[5] = 0;
            $dmg_mod_p -= 25;
        }

        if ($o_qua) {
            $sta_mod[1] *= 0.5;
            $sta_mod[4] *= 0.5;
        }

        for ($i = 0; $i < 6; $i++) {
            $sta_mod[$i] = floor($sta_mod[$i]);
        }
        return $sta_mod;
    }

    private function getJobStatBonus(){
        switch($this->job){
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

        for($i = 0; $i < $this->job_level && $i < count($bonus); ++$i){
            $stat = $bonus[$i];
            switch($stat){
                case STR:
                    $this->bonusStr++; break;
                case AGI:
                    $this->bonusAgi++; break;
                case INT:
                    $this->bonusInt++; break;
                case DEX:
                    $this->bonusDex++; break;
                case CON:
                    $this->bonusCon++; break;
                case LUK:
                    $this->bonusLuk++; break;
            }
        }
    }

    function getEquipmentBonus ()
    {
        $slang = array();
        /*****************************
         *  DB-Abfrage der Ausr�stung *
         ******************************/

        for ($i = 0; $i <= 9; $i++) {
            $where = '';
            if ($wstring[$i]['useritem_id'])
                $where .= "useritem_id = {$wstring[$i]}";
            if ($where != '') {
                $sql = "SELECT  useritem_id, user, item_id, item_number FROM {$table_prefix}useritems
          WHERE $where";
                if (!($result = $db->sql_query($sql))) {
                    message_die(GENERAL_MESSAGE, 'Gl�hend hei�... autsch, aua >.< 11<br>' . $sql . '<br>-' . $equip[3] . '<br>-' . $equip[5] . '<br>');
                }
                while ($row = $db->sql_fetchrow($result)) {
                    if ($row['useritem_id'] > 0) {
                        $eq = $row['item_id']; //Arrayeintr�ge �berschreiben, SonderID wird hier nicht gebraucht
                        //$i = (getWeaponType($equipment)>0) ? 5 : 3;
                        $wstring[$i] = $eq;
                        $debug[] = '$equip[' . $i . '] = ' . $wstring[$i];
                    }
                }
            }
        }

        $debug[] = '<br>';
        $where = '';
        $warray = array();
        for ($i = 0; $i <= 9; $i++) {
            if ($wstring[$i]) {
                $warray[] = $wstring[$i];
            }
        }
        if (sizeof($warray) > 0) {
            for ($i = 0; $i < sizeof($warray); $i++) {

                $where .= ' id = ' . $warray[$i] . ' ';
                $where .= ($i == sizeof($warray) - 1) ? '' : 'OR';

            }
        } elseif (sizeof($warray) == 0) {
            $where = 'id = 0';
        }
        $sql = "SELECT script_equip, attack, defence, type FROM {$table_prefix}item_db2
        WHERE ({$where})";
        if (!($result = $db->sql_query($sql))) {
            message_die(GENERAL_MESSAGE, 'Ein H�llenfeuer entfacht deine Kleidung T_T');
        }
        $item_script = '';
        while ($row = $db->sql_fetchrow($result)) {
            $item_script .= $row['script_equip'];
            $slang['def'] += $row['defence'];
            if ($row['type'] == 10) {
                $slang['arrow_att'] += $row['attack'];
            } else {
                $slang['att'] += $row['attack'];
            }
        }
        $debug[] = 'Attacke: ' . $slang['att'] . ', Verteidigung: ' . $slang['def'];
        if ($slang['arrow_att']) $debug[] = 'Pfeilattacke: ' . $slang['arrow_att'];

        /*****************************
         *  Auswertung/Interpretation *
         ******************************/
        $debug[] = '<br>Totales Equimentskript: ' . $item_script;
        $item_script = explode(';', $item_script);
        foreach ($item_script AS $script) {
            $script = explode(',', $script);
            $script[0] = ltrim(rtrim($script[0]));
            $bcheck = explode(' ', $script[0]);
            if ($bcheck[0] == '') $bcheck[0] = 'leer';
            switch ($bcheck[0]) {
                case 'bonus':
                    $debug[] = 'Bonustyp-Unterart->Wert' . $bcheck[0] . '-' . $bcheck[1] . '->' . $script[1];
                    switch ($bcheck[1]) {
                        case 'bStr':
                            $slang['str'] += $script[1];
                            break;
                        case 'bVit':
                            $slang['con'] += $script[1];
                            break;
                        case 'bDex':
                            $slang['dex'] += $script[1];
                            break;
                        case 'bInt':
                            $slang['int'] += $script[1];
                            break;
                        case 'bAgi':
                            $slang['agi'] += $script[1];
                            break;
                        case 'bLuk':
                            $slang['luk'] += $script[1];
                            break;
                        case 'bHit':
                            $slang['hit'] += $script[1];
                            break;
                        case 'bFlee':
                            $slang['flee'] += $script[1];
                            break;
                        case 'bFlee2':
                            $slang['flee'] += $script[1];
                            break;
                        case 'bAtk':
                            $slang['att'] += $script[1];
                            break;
                        case 'bMatk':
                            $slang['matk'] += $script[1];
                            break;
                        case 'bDef':
                            $slang['def'] += $script[1];
                            break;
                        case 'bMdef':
                            $slang['mdef'] += $script[1];
                            break;
                        case 'bMaxHP':
                            $slang['maxhp'] += $script[1];
                            break;
                        case 'bMaxSP':
                            $slang['maxsp'] += $script[1];
                            break;
                        case 'bMatkRate':
                            $slang['matkrate'] += $script[1];
                            break;                         //Matk + %
                        case 'bMaxHPrate':
                            $slang['maxhprate'] += $script[1];
                            break;                         //HP + %
                        case 'bMaxSPrate':
                            $slang['maxsprate'] += $script[1];
                            break;                         //SP + %
                        case 'bAtkEle':
                            $slang['atk_element'] = $script[1];
                            break;                         //Angriffselement (eins und nur eins)
                        case 'bCastrate':
                            $slang['castrate'] += $script[1];
                            break;                         //cast + % (negativ)
                        case 'bCritical':
                            $slang['critical'] += $script[1];
                            break;                         //critical + %
                        case 'bDoubleRate':
                            $slang['doublerate'] += $script[1];
                            break;             //-->       //Doppelschlag %
                        case 'bGetZenyNum':
                            $slang['gold'] += $script[1];
                            break;                         //Gold nach Kampf
                        case 'bLongAtkDef':
                            $slang['l_attdef'] += $script[1];
                            break;             //-->       //%-Resistenz gegen Fernkampfwaffen
                        case 'bAspd':
                            $slang['aspd'] += $script[1];
                            break;             //-->       //Attack Speed
                        case 'bAspdRate':
                            $slang['aspdrate'] += $script[1];
                            break;             //-->       //Attack Speed + %
                        case 'bSpeedRate':
                            $slang['speed'] += $script[1];
                            break;                         //Speed +
                        case 'bNoSizeFix':
                            $slang['nosizefix'] += $script[1];
                            break;             //-->       //100% gegen alle Gr��en
                        case 'bUseSPrate':
                            $slang['sp_cost'] += $script[1];
                            break;                         //Verbraucht SP pro Runde (negativ)
                        case 'bRange':
                            $slang['range'] += $script[1];
                            break;      //--> //bekommt spezielle Items von bestimmten Monstern
                        case 'bAspdAddRate':
                            $slang['aspdrate'] += $script[1];
                            break;  //--> //Attack Speed + %
                        case 'bSplashRange':
                            $slang['splash'] += $script[1];
                            break;  //--> //Alle Gegner erleiden Schaden
                        case 'bSPrecovRate':
                            $slang['sp_regen'] += $script[1];
                            break;        //bessere SP-Regeneration um %
                        case 'bIgnoreDefRace':
                            $slang['ignore_def_race'] = $script[1];
                            break;  //--> //Ignoriert RassenDEF (eine und nur eine)
                        case 'bPerfectHitRate':
                            $slang['hitrate'] += $script[1];
                            break;  //--> //Hit + %
                        case 'bMagicDamageReturn':
                            $slang['m_return'] += $script[1];
                            break;  //--> //% Magie zur�ckzuschlagen
                        case 'bRestartFullRecover':
                            $slang['RFR'] += $script[1];
                            break;        //Regeneriert nach dem Tod komplett
                        case 'bShortWeaponDamageReturn':
                            $slang['a_return'] += $script[1];
                            break;        //% Waffenschaden zur�ckzuschlagen
                        default:
                            $debug[] = 'FEHLER IN BONUS! pr�fe ->' . $script[0] . '<-';
                            break;
                    }
                    break;
                case 'bonus2':
                    $debug[] = 'Bonustyp-Unterart->Wert1, Wert2' . $bcheck[0] . '-' . $bcheck[1] . '->' . $script[1] . ', ' . $script[2];
                    switch ($bcheck[1]) {
                        case 'bAddEle':
                            $slang['addele-' . $script[1]] += $script[2];
                            break;
                        case 'bAddEff':
                            $slang['addeff-' . $script[1]] += $script[2];
                            break;
                        case 'bAddRace':
                            $slang['addrace-' . $script[1]] += $script[2];
                            break;
                        case 'bSubRace':
                            $slang['subrace-' . $script[1]] += $script[2];
                            break;
                        case 'bResEff':
                            $slang['res-' . $script[1]] += $script[2];
                            break;
                        case 'bSubEle':
                            $slang['subele-' . $script[1]] += $script[2];
                            break;
                        case 'bAddSize':
                            $slang['addsize-' . $script[1]] += $script[2];
                            break;
                        case 'bWeaponComaRace':
                            $slang['suddenkill-' . $script[1]] += $script[2];
                            break;
                        case 'bHPDrainRate':
                            $slang['hpdrain-' . $script[1]] += $script[2];
                            break;
                        case 'bSpDrainRate':
                            $slang['spdrain-' . $script[1]] += $script[2];
                            break;
                        case 'bAddDamageClass':
                            $slang['adddamclass-' . $script[1]] += $script[2];
                            break;
                        case 'bRandomAttackIncrease':
                            $slang['randomatt-' . $script[1]] += $script[2];
                            break;
                        default:
                            $debug[] = 'FEHLER IN BONUS2! pr�fe ->' . $script[0] . '<-';
                            break;
                    }
                    break;


                case 'bonus3':
                    $debug[] = 'Bonustyp-Unterart->Wert1, Wert2, Wert3' . $bcheck[0] . '-' . $bcheck[1] . '->' . $script[1] . ', ' . $script[2] . ', ' . $script[3];
                    switch ($bcheck[1]) {
                        case 'bAutoSpell':
                            $slang['autospell'] = array($script[1], $script[2], $script[3]);
                            break;
                        case 'bAddMonsterDropItem':
                            $slang['dropitem'] = array($script[1], $script[2], $script[3]);
                            break;
                        default:
                            $debug[] = 'FEHLER IN BONUS3! pr�fe ->' . $script[0] . '<-';
                            break;
                    }
                    break;
                /*case 'skill':$debug[] = 'Bonustyp-Unterart->Wert1, Wert2'.$bcheck[0].'-'.$bcheck[1].'->'.$script[1].', '.$script[2];
           $slang['skill-'.$script[1]] += $script[2];
        break;
        case 'refined':$debug[] = 'Bonustyp-Unterart->Wert1'.$bcheck[0].'-'.$bcheck[1].'->'.$script[1];
           $slang['???'] = $script[1];
        break;
        case 'slot':$debug[] = 'Bonustyp-Unterart->Wert1'.$bcheck[0].'-'.$bcheck[1].'->'.$script[1];
           $slang['slots'] += $script[1];
        break;*/
                case 'leer':
                    $debug[] = 'leerer Bonus';
                    break;
                default:
                    $debug[] = 'UNG�LTIGER BONUSTYP! pr�fe ->' . $script[0] . '<-';
                    break;
            }
        }

    }

    /*
     * ================================
     * Avatar Image Handling
     * ================================
     */

    private function getImageHeadPath(){
        return "images/avatars/".$this->id.".head.png";
    }

    private function getImageFullPath(){
        return "images/avatars/".$this->id.".png";
    }

    public function getImageHead(){

        $image = public_path($this->getImageHeadPath());

        if(!file_exists($image)){
            $this->generateAvatarHeadImage($this->gender, $this->hair_style, $this->hair_color);
        }

        return asset($this->getImageHeadPath());
    }

    public function getImageFull(){
        $image = public_path($this->getImageFullPath());

        if(!file_exists($image)){
            $this->generateAvatarImage($this);
        }

        return asset($this->getImageFullPath());

    }


    public function generateAvatarHeadImage ($gender, $hairStyle, $hairColor = "0", $pos = '00000') {

        $str_hair = base_path('public/images/hair/%s/%s_%s.png');
        $str_mask = base_path('public/images/hair/%s/%s_%s_mask.png');

        $gender = ($this->gender == 0) ? 'm' : 'f';

        $hairSource = sprintf($str_hair, $gender, $hairStyle, $pos);
        $maskSource = sprintf($str_mask, $gender, $hairStyle, $pos);

        if(!file_exists($hairSource)){
            throw new \Exception("Hair style base $hairSource file missing.");
        }
        if(!file_exists($maskSource)){
            throw new \Exception("Hair style mask $maskSource file missing.");
        }

        $hairImg = ImageCreateFromPNG($hairSource);
        $hairMask = ImageCreateFromPNG($maskSource);

        // Color the Hair if needed (#FF0000)
        if (strlen($hairColor) === 6) {

            // Convert #FF0000 to seperate RGB Values
            $dye = $this->hex2int($hairColor);
            $dye['red'] = $dye['r'];
            $dye['green'] = $dye['g'];
            $dye['blue'] = $dye['b'];

            $x = ImageSX($hairImg);
            $y = ImageSY($hairImg);

            // First Step: Grayscale
            for ($i = 0; $i < $y; $i++) {
                for ($j = 0; $j < $x; $j++) {
                    $pos = imagecolorat($hairImg, $j, $i);
                    $f = imagecolorsforindex($hairImg, $pos);

                    $posM = imagecolorat($hairMask, $j, $i);
                    $mask = imagecolorsforindex($hairMask, $posM);

                    $gst = $f["red"] * 0.15 + $f["green"] * 0.5 + $f["blue"] * 0.35;
                    if ($mask['red'] == 0 && $mask['green'] == 0 && $mask['blue'] == 0) {
                        $col = imagecolorresolve($hairImg, $gst, $gst, $gst);
                        imagesetpixel($hairImg, $j, $i, $col);
                    }
                }
            }
            // Then Lay the Color over the Grayscale
            for ($i = 0; $i < $x; $i++) {
                for ($j = 0; $j < $y; $j++) {
                    $pos = imagecolorat($hairImg, $i, $j);
                    $f = imagecolorsforindex($hairImg, $pos);

                    $posM = imagecolorat($hairMask, $i, $j);
                    $maskSource = imagecolorsforindex($hairMask, $posM);

                    if ($maskSource['red'] == 0 && $maskSource['green'] == 0 && $maskSource['blue'] == 0) {
                        if ($f['red'] <= 127) {
                            $new_color = $this->multiPlus($f, $dye);
                        } elseif ($f['red'] > 127) {
                            $new_color = $this->multiMinus($f, $dye);
                        }

                        $r = $new_color['red'];
                        $g = $new_color['green'];
                        $b = $new_color['blue'];

                        $col = imagecolorresolve($hairImg, $r, $g, $b);
                        imagesetpixel($hairImg, $i, $j, $col);
                    }
                }
            }
        }

        $hair_w = ImageSX($hairImg);
        $hair_h = ImageSY($hairImg);
        $origHair_w = ImageSX($hairImg);
        $origHair_h = ImageSY($hairImg);

        $this->getHeadgearImageData();

        $x = floor($hair_w / 2);
        $y = floor($hair_h / 2);

        ImagePNG($hairImg, $this->getImageHeadPath(), 0);

        // Aufraeumen
        ImageDestroy($hairImg);

    }

    private function getHeadgearImageData(){

        $str_gear = base_path('public/images/headgear/%s_%s.png');

        $equip = array();

        $counter = 0;
        $bool_gear = false;
        $last_l = 0;
        $last_t = 0;
        foreach ($equip as $e) {
            $counter++;

            $gearRow = DB::table('rpg_image_positions')->where([
                ['type', 'gear'],
                ['type2', $e],
            ])->get();

            if ($gearRow) {
                $gear = sprintf($str_gear, $e, '00000');
                if (file_exists($gear)) {
                    $gearImg = ImageCreateFromPNG($gear);
                    $bool_gear = true;
                    $g_top = $gearRow['pos_top'];
                    $g_left = $gearRow['pos_left'];
                    $gear_w = ImageSX($gearImg);
                    $gear_h = ImageSY($gearImg);

                    /*
                    $sql = "SELECT * FROM {$table_prefix}rpg_image_positions
						WHERE type='head2gear' AND gender='$gender' AND type2=$hstyle";
                    $result = $db->sql_query($sql);
                    if ($db->sql_numrows($result) > 0) {
                        $row = $db->sql_fetchrow($result);
                    }
                    $h2g_top = $row['pos_top'];
                    $h2g_left = $row['pos_left'];

                    $l = floor($origHair_w / 2) - floor($gear_w / 2) + $h2g_left + $g_left;
                    $t = floor($origHair_h / 2) - floor($gear_h / 2) + $h2g_top + $g_top;

                    $l += $last_l;
                    $t += $last_t;

                    //ImageCopyMerge($hairImg, $gearImg, $l, $t, 0, 0, $gear_w, $gear_h, 100);
                    $width = max($hair_w - $l, $gear_w, $hair_w);
                    $height = max($hair_h - $t, $gear_h, $hair_h);

                    $compilation = ImageCreate($width, $height) or $die .= 'Fehler X02';

                    $gray = $this->hex2int('333333');
                    $gray = ImageColorAllocate($compilation, $gray['r'], $gray['g'], $gray['b']);
                    $black = $this->hex2int('000000');
                    $black = ImageColorAllocate($compilation, $black['r'], $black['g'], $black['b']);
                    $none = ImageColorTransparent($compilation, $gray);

                    ImageCopyMerge($compilation, $hairImg, (($l < 0) ? abs($l) : 0), (($t < 0) ? abs($t) : 0), 0, 0, $hair_w, $hair_h, 100);
                    ImageCopyMerge($compilation, $gearImg, (($l > 0) ? abs($l) : 0), (($t > 0) ? abs($t) : 0), 0, 0, $gear_w, $gear_h, 100);

                    // Neuer hairImg
                    $hairImg = ImageCreate($width, $height);
                    $gray = $this->hex2int('333333');
                    $gray = ImageColorAllocate($hairImg, $gray['r'], $gray['g'], $gray['b']);
                    $black = $this->hex2int('000000');
                    $black = ImageColorAllocate($hairImg, $black['r'], $black['g'], $black['b']);
                    $none = ImageColorTransparent($hairImg, $gray);

                    ImageCopyMerge($hairImg, $compilation, 0, 0, 0, 0, $width, $height, 100);

                    $hair_w = ImageSX($hairImg);
                    $hair_h = ImageSY($hairImg);

                    $last_l = (($l < 0) ? abs($l) : $last_l);
                    $last_t = (($t < 0) ? abs($t) : $last_t);

                    ImagePNG($hairImg, 'images/avatars/test_' . $e, 100) or $die .= 'Fehler X03';
                    //echo ' <img src="images/avatars/test_'.$e.'" border="1"> ';
                    */
                    if ($bool_gear) {
                        ImageDestroy($gearImg);
                    }
                }
            }
        }
    }

    public function generateAvatarImage (Character $character, $pos = '00000'){
            global $db, $table_prefix, $equip, $debug;

            $job = $character->job;

            $str_bg = base_path('public/images/classes/body/%s/%s_%s_%s.png');

            $body = sprintf($str_bg, $job, $job, $gender, $pos);
            $head = $this->getImageHeadPath();

            $hairImg = ImageCreateFromPNG($hair);
            $bodyImg = ImageCreateFromPNG($body);
            $hairMask = ImageCreateFromPNG($mask);

            // Color the Hair if needed
            if (file_exists($mask)) {

                if (strlen($hcolor) == 6 && file_exists($hair)) {            // consists of exactly 6 digits

                    $dye = $this->hex2int($hcolor);
                    $dye['red'] = $dye['r'];
                    $dye['green'] = $dye['g'];
                    $dye['blue'] = $dye['b'];

                    $x = ImageSX($hairImg);
                    $y = ImageSY($hairImg);

                    // First Step: Grayscale
                    for ($i = 0; $i < $y; $i++) {
                        for ($j = 0; $j < $x; $j++) {
                            $pos = imagecolorat($hairImg, $j, $i);
                            $f = imagecolorsforindex($hairImg, $pos);

                            $posM = imagecolorat($hairMask, $j, $i);
                            $mask = imagecolorsforindex($hairMask, $posM);

                            $gst = $f["red"] * 0.15 + $f["green"] * 0.5 + $f["blue"] * 0.35;
                            if ($mask['red'] == 0 && $mask['green'] == 0 && $mask['blue'] == 0) {
                                $col = imagecolorresolve($hairImg, $gst, $gst, $gst);
                                imagesetpixel($hairImg, $j, $i, $col);
                            }
                        }
                    }
                    // Then Lay the Color over the Grayscale
                    for ($i = 0; $i < $x; $i++) {
                        for ($j = 0; $j < $y; $j++) {
                            $pos = imagecolorat($hairImg, $i, $j);
                            $f = imagecolorsforindex($hairImg, $pos);

                            $posM = imagecolorat($hairMask, $i, $j);
                            $mask = imagecolorsforindex($hairMask, $posM);

                            if ($mask['red'] == 0 && $mask['green'] == 0 && $mask['blue'] == 0) {
                                if ($f['red'] <= 127) {
                                    $new_color = $this->multiPlus($f, $dye);
                                }
                                elseif ($f['red'] > 127) {
                                    $new_color = $this->multiMinus($f, $dye);
                                }

                                $r = $new_color['red'];
                                $g = $new_color['green'];
                                $b = $new_color['blue'];

                                $col = imagecolorresolve($hairImg, $r, $g, $b);
                                imagesetpixel($hairImg, $i, $j, $col);
                                //print "<br>($i,$j) $r, $g, $b,";
                            }
                        }
                    }
                }
            }

            $hair_w = ImageSX($hairImg);
            $hair_h = ImageSY($hairImg);
            $body_w = ImageSX($bodyImg);
            $body_h = ImageSY($bodyImg);
            //
            $e = $equip[EQUIP_FACE_1];
            if ($e > 500) {
                $sql = "SELECT * FROM {$table_prefix}rpg_image_positions WHERE type='gear' AND type2='$e'";
                $result = $db->sql_query($sql);
                $debug[] = $sql . '<br>--> ' . $db->sql_numrows($result) . ' Results';
                if ($db->sql_numrows($result) > 0) {
                    $gearRow = $db->sql_fetchrow($result);
                    $gear1 = sprintf($str_gear, $e, '00000');
                    if (file_exists($gear1)) {
                        $gear1Img = ImageCreateFromPNG($gear1);
                        $g1_top = $gearRow['pos_top'];
                        $g1_left = $gearRow['pos_left'];
                        $gear1_w = ImageSX($gear1Img);
                        $gear1_h = ImageSY($gear1Img);
                        $bool_gear1 = true;
                        $gear = true;
                    } else {
                        $die .= 'gear1Img not found:' . $gear1;
                    }
                }
            }
            $e = $equip[1];
            if ($e > 500) {
                $sql = "SELECT * FROM {$table_prefix}rpg_image_positions WHERE type='gear' AND type2='$e'";
                $result = $db->sql_query($sql);
                $debug[] = $sql . '<br>--> ' . $db->sql_numrows($result) . ' Results';
                if ($db->sql_numrows($result) > 0) {
                    $gearRow = $db->sql_fetchrow($result);
                    $gear2 = sprintf($str_gear, $e, '00000');
                    if (file_exists($gear2)) {
                        $gear2Img = ImageCreateFromPNG($gear2);
                        $g2_top = $gearRow['pos_top'];
                        $g2_left = $gearRow['pos_left'];
                        $gear2_w = ImageSX($gear2Img);
                        $gear2_h = ImageSY($gear2Img);
                        $bool_gear2 = true;
                        $gear = true;
                    } else {
                        $die .= 'gear2Img not found';
                    }
                }
            }
            $e = $equip[9];
            if ($e > 500) {
                $sql = "SELECT * FROM {$table_prefix}rpg_image_positions WHERE type='gear' AND type2='$e'";
                $result = $db->sql_query($sql);
                $debug[] = $sql . '<br>--> ' . $db->sql_numrows($result) . ' Results';
                if ($db->sql_numrows($result) > 0) {
                    $gearRow = $db->sql_fetchrow($result);
                    $gear3 = sprintf($str_gear, $e, '00000');
                    if (file_exists($gear3)) {
                        $gear3Img = ImageCreateFromPNG($gear3);
                        $g3_top = $gearRow['pos_top'];
                        $g3_left = $gearRow['pos_left'];
                        $gear3_w = ImageSX($gear3Img);
                        $gear3_h = ImageSY($gear3Img);
                        $bool_gear3 = true;
                        $gear = true;
                    } else {
                        $die .= 'gear3Img not found';
                    }
                }
            }

            if ($gear) {
                $sql = "SELECT * FROM {$table_prefix}rpg_image_positions WHERE type='head2gear' AND gender='$gender' AND type2=$hstyle";
                $result = $db->sql_query($sql);
                if ($db->sql_numrows($result) > 0) {
                    $row = $db->sql_fetchrow($result);
                }
                $h2g_top = $row['pos_top'];
                $h2g_left = $row['pos_left'];
            }

            // Get Positions from DB
            $sql = "SELECT * FROM {$table_prefix}rpg_image_positions WHERE gender='$gender' AND type='job' AND type2='$job'";
            if (!$result = $db->sql_query($sql)) {
                $error = $db->sql_error();
                $debug .= '<br>Sql Fehler: ' . $error;
            }
            $row = $db->sql_fetchrow($result);

            $job_top = $row[pos_top];
            $job_left = $row[pos_left];

            $sql = "SELECT * FROM {$table_prefix}rpg_image_positions WHERE gender = '$gender' AND type = 'hstyle' AND type2 = '$hstyle'";
            if (!($result = $db->sql_query($sql))) {
                message_die(GENERAL_ERROR, "Fatal Error: Could not retrieve Image Positions.", "genImage()", __LINE__, __FILE__, $sql);
            }
            if ($db->sql_numrows($result) <= 0) {
                $h_top = $job_top + 0;
                $h_left = $job_left + 0;
            } else {
                $row = $db->sql_fetchrow($result);
                $h_top = $job_top + $row['pos_top'];
                $h_left = $job_left + $row['pos_left'];
            }
            //echo "<br>asd: $h_top $h_left $job_top $job_left";

            $width = max($body_w, $hair_w, $gear1_w, $gear2_w, $gear3_w); // Sp�ter die Breite des Rechtecks
            $height = max($body_h + $hair_h, $gear1_h, $gear2_h, $gear3_h); // Sp�ter die H�he des Rechtecks

            $compilation = ImageCreate($width, $height) or $die .= 'Fehler X02';
            $gray = $this->hex2int('333333');
            $gray = ImageColorAllocate($compilation, $gray[r], $gray[g], $gray[b]);
            $black = $this->hex2int('000000');
            $black = ImageColorAllocate($compilation, $black[r], $black[g], $black[b]);
            $none = ImageColorTransparent($compilation, $gray);

            //$h_top = 8;
            //$h_left = 5;

            $imagefile = sprintf($this->getImageFullPath(), 'chara_' . $char['save_id']);

            ImageCopyMerge($compilation, $bodyImg, 0, $hair_h, 0, 0, $body_w, $body_h, 100);
            ImageCopyMerge($compilation, $hairImg, 0 + $h_left, 0 + $h_top, 0, 0, $hair_w, $hair_h, 100);
            if ($bool_gear3) {
                $t = floor($hair_h / 2) - floor($gear3_h / 2) + $h2g_top + $g3_top;
                $l = floor($hair_w / 2) - floor($gear3_w / 2) + $h2g_left + $g3_left;
                ImageCopyMerge($compilation, $gear3Img, $l + $h_left, $t + $h_top, 0, 0, $gear3_w, $gear3_h, 100);
            }
            if ($bool_gear2) {
                $t = floor($hair_h / 2) - floor($gear2_h / 2) + $h2g_top + $g2_top;
                $l = floor($hair_w / 2) - floor($gear2_w / 2) + $h2g_left + $g2_left;
                ImageCopyMerge($compilation, $gear2Img, $l + $h_left, $t + $h_top, 0, 0, $gear2_w, $gear2_h, 100);
            }
            if ($bool_gear1) {
                $t = floor($hair_h / 2) - floor($gear1_h / 2) + $h2g_top + $g1_top;
                $l = floor($hair_w / 2) - floor($gear1_w / 2) + $h2g_left + $g1_left;
                ImageCopyMerge($compilation, $gear1Img, $l + $h_left, $t + $h_top, 0, 0, $gear1_w, $gear1_h, 100);
            }
            ImagePNG($compilation, $imagefile, 100) or $die .= 'Fehler X03';
            ImageDestroy($bodyImg);
            ImageDestroy($hairImg);
            ImageDestroy($compilation);

    }

    private function hex2int ($hex)
    {
        return array(
            'r' => hexdec(substr($hex, 0, 2)), // 1st pair of digits
            'g' => hexdec(substr($hex, 2, 2)), // 2nd pair
            'b' => hexdec(substr($hex, 4, 2))  // 3rd pair
        );
    }

    private function multiPlus ($col_1, $col_2)
    {
        $r['red'] = round($col_1['red'] * $col_2['red'] / 255 * 2);
        $r['green'] = round($col_1['green'] * $col_2['green'] / 255 * 2);
        $r['blue'] = round($col_1['blue'] * $col_2['blue'] / 255 * 2);
        return $r;
    }

    private function multiMinus ($col_1, $col_2)
    {
        $r['red'] = round(255 - ((255 - $col_1['red']) * (255 - $col_2['red']) / 255 * 2));
        $r['green'] = round(255 - ((255 - $col_1['green']) * (255 - $col_2['green']) / 255 * 2));
        $r['blue'] = round(255 - ((255 - $col_1['blue']) * (255 - $col_2['blue']) / 255 * 2));
        return $r;
    }
}
