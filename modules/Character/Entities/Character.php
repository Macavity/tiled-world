<?php namespace Modules\Character;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    private $name;
    private $gender;
    private $job;
    private $hair_color;
    private $hair_style;

    protected $fillable = ["name", "gender", "job", "hair_color", "hair_style"];

    public function getImageHead(){

    }

    public function user(){
        $this->belongsTo(User::class);
    }

    public function generateAvatarHeadImage (Character $char, $equip)
    {
        $pos = '00000';

        $imagefile = "images/avatars/%s_head.png";

        $hstyle = $char->hair_style;
        $hcolor = $char->hair_color;

        $str_hair = 'rpg/classes/hair/%s/%s_%s.png';
        $str_mask = 'rpg/classes/hair/%s/%s_%s_mask.png';
        $str_gear = 'rpg/headgear/%s_%s.png';

        $hair = sprintf($str_hair, $char->gender, $char->hair_style, $pos);
        $mask = sprintf($str_mask, $char->gender, $char->hair_style, $pos);

        if(!file_exists($hair)){
            throw new \Exception("Hair style base file missing.");
        }
        if(!file_exists($mask)){
            throw new \Exception("Hair style mask file missing.");
        }

        $hairImg = ImageCreateFromPNG($hair);
        $hairMask = ImageCreateFromPNG($mask);

        // Color the Hair if needed (#FF0000)
        if (strlen($char->hair_color) === 6) {

            // Convert #FF0000 to seperate RGB Values
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
                            $new_color = multiPlus($f, $dye);
                        } elseif ($f['red'] > 127) {
                            $new_color = multiMinus($f, $dye);
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


        if ($die) {
            return $die;
        }

        $hair_w = ImageSX($hairImg);
        $hair_h = ImageSY($hairImg);
        $origHair_w = ImageSX($hairImg);
        $origHair_h = ImageSY($hairImg);

        //
        $eq[0] = $equip[0];
        $eq[1] = $equip[1];
        $eq[2] = $equip[9];
        $counter = 0;
        $bool_gear = false;
        $last_l = 0;
        $last_t = 0;
        foreach ($eq as $e) {
            $counter++;
            $sql = "SELECT * FROM {$table_prefix}rpg_image_positions WHERE type='gear' AND type2='$e'";
            $result = $db->sql_query($sql);
            if ($db->sql_numrows($result) > 0) {
                $gearRow = $db->sql_fetchrow($result);
                $gear = sprintf($str_gear, $e, '00000');
                if (file_exists($gear)) {
                    $gearImg = ImageCreateFromPNG($gear);
                    $bool_gear = true;
                    $g_top = $gearRow['pos_top'];
                    $g_left = $gearRow['pos_left'];
                    $gear_w = ImageSX($gearImg);
                    $gear_h = ImageSY($gearImg);

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
                } else {
                    $die .= 'gearImg not found' . $gear;
                }
            }
        }

        $x = floor($hair_w / 2);
        $y = floor($hair_h / 2);

        $imagefile = ($bool_admin)
            ? sprintf($imagefile, 'admin_' . $char['save_id'])
            : sprintf($imagefile, 'chara_' . $char['save_id']);

        ImagePNG($hairImg, $imagefile, 100) or $die .= 'Fehler X03';

        // Aufraeumen
        ImageDestroy($hairImg);

        if ($gear) {
            ImageDestroy($gearImg);
        }
        return '<img src="' . $imagefile . '" border="1">' . $die . $adm_info;
    }

    public function generateAvatarImage ($char, $gender, $pos = '00000', $bool_admin = false)
        {
            global $db, $table_prefix, $equip, $debug;
            $imagefile = ($bool_admin) ? "../images/avatars/%s.png" : "images/avatars/%s.png";

            genHeadImage($char, $gender, $equip, $bool_admin);

            $char_name = $char['char_name'];
            $job = $char['char_job'];
            $hstyle = $char['char_hstyle'];
            $hcolor = $char['char_hcolor'];
            //$hcolor = '-1';

            $str_hair = ($bool_admin) ? '../rpg/classes/hair/%s/%s_%s.png' : 'rpg/classes/hair/%s/%s_%s.png';
            $str_mask = ($bool_admin) ? '../rpg/classes/hair/%s/%s_%s_mask.png' : 'rpg/classes/hair/%s/%s_%s_mask.png';
            $str_gear = ($bool_admin) ? '../rpg/headgear/%s_%s.png' : 'rpg/headgear/%s_%s.png';
            $str_bg = ($bool_admin) ? '../rpg/classes/body/%s/%s_%s_%s.png' : 'rpg/classes/body/%s/%s_%s_%s.png';
            $str_head = ($bool_admin) ? '../images/avatars/chara_%s_head.png' : 'images/avatars/chara_%s_head.png';

            $hair = sprintf($str_hair, $gender, $hstyle, $pos);
            $mask = sprintf($str_mask, $gender, $hstyle, $pos);
            $body = sprintf($str_bg, $job, $job, $gender, $pos);
            $head = sprintf($str_head, $char['save_id']);

            $hairImg = (file_exists($hair)) ? ImageCreateFromPNG($hair) : $die .= 'Keine Frisur ausgesucht';
            $bodyImg = (file_exists($body)) ? ImageCreateFromPNG($body) : $die .= '<br>Keine Klasse ausgesucht';

            // Color the Hair if needed
            if (file_exists($mask)) {

                if (strlen($hcolor) == 6 && file_exists($hair)) {            // consists of exactly 6 digits
                    $hairMask = (file_exists($mask)) ? ImageCreateFromPNG($mask) : $die .= '<br>failed to create Hair Mask';

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
                                    $new_color = multiPlus($f, $dye);
                                    //$out .= '<br><font color="ff0000">Grauwert: '.$f[red]." (127-) ";
                                    //foreach($new_color as $t => $u){
                                    //	$out .= ", $t => $u";
                                    //}
                                    //$out .= "</font>";
                                } elseif ($f['red'] > 127) {
                                    $new_color = multiMinus($f, $dye);
                                    //$out .= '<br><font color="00ff00">Grauwert: '.$f[red]." (127+) ";
                                    //foreach($new_color as $t => $u){
                                    //	$out .= ", $t => $u";
                                    //}
                                    //$out .= "</font>";
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
            }    // End If file_exists($mask)
            else {
                $adm_info .= '<br>nm' . $gender . $hstyle;
            }


            if ($die) return $die;

            $hair_w = ImageSX($hairImg);
            $hair_h = ImageSY($hairImg);
            $body_w = ImageSX($bodyImg);
            $body_h = ImageSY($bodyImg);
            //
            $e = $equip[0];
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

            $imagefile = sprintf($imagefile, 'chara_' . $char['save_id']);

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

            return '<img src="' . $imagefile . '" border=0><br>' . $die . $adm_info;

    }

    private function hex2int ($hex)
    {
        return array(
            'r' => hexdec(substr($hex, 0, 2)), // 1st pair of digits
            'g' => hexdec(substr($hex, 2, 2)), // 2nd pair
            'b' => hexdec(substr($hex, 4, 2))  // 3rd pair
        );
    }
}