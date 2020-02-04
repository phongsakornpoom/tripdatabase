<?php 

function switchRoomName($input){
    switch ($input) {
        case "master1":
            return 'Master Cabin Bed 1';
            break;
        case "master2":
            return 'Master Cabin Bed 2';
            break;
        case "master3":
            return 'Master Cabin Bed 3';
            break;
        case "deluxe1":
            return 'Deluxe Cabin 1 Bed 1';
            break;
        case "deluxe2":
            return 'Deluxe Cabin 1 Bed 2';
            break;
        case "deluxe3":
            return 'Deluxe Cabin 2 Bed 1';
            break;
        case "deluxe4":
            return 'Deluxe Cabin 2 Bed 2';
            break;
        case "superior1":
            return 'Superior Cabin 1 Bed 1';
            break;
        case "superior2":
            return 'Superior Cabin 1 Bed 2';
            break;
        case "superior3":
            return 'Superior Cabin 2 Bed 1';
            break;
        case "superior4":
            return 'Superior Cabin 2 Bed 2';
            break;
        case "superior5":
            return 'Superior Cabin 3 Bed 1';
            break;
        case "superior6":
            return 'Superior Cabin 3 Bed 2';
            break;
        case "superior7":
            return 'Superior Cabin 4 Bed 1';
            break;
        case "superior8":
            return 'Superior Cabin 4 Bed 2';
            break;
    }
}

function switchRoomNameColor($input){
    switch ($input) {
        case "master1":
            return '<span style="color:blue;text-align:center;">Master Cabin Bed 1</span>';
            break;
        case "master2":
            return '<span style="color:blue;text-align:center;">Master Cabin Bed 2</span>';
            break;
        case "master3":
            return '<span style="color:blue;text-align:center;">Master Cabin Bed 3</span>';
            break;
        case "deluxe1":
            return '<span style="color:green;text-align:center;">Deluxe Cabin 1 Bed 1</span>';
            break;
        case "deluxe2":
            return '<span style="color:green;text-align:center;">Deluxe Cabin 1 Bed 2</span>';
            break;
        case "deluxe3":
            return '<span style="color:forestgreen;text-align:center;">Deluxe Cabin 2 Bed 1</span>';
            break;
        case "deluxe4":
            return '<span style="color:forestgreen;text-align:center;">Deluxe Cabin 2 Bed 2</span>';
            break;
        case "superior1":
            return '<span style="color:red;text-align:center;">Superior Cabin 1 Bed 1</span>';
            break;
        case "superior2":
            return '<span style="color:red;text-align:center;">Superior Cabin 1 Bed 2</span>';
            break;
        case "superior3":
            return '<span style="color:maroon;text-align:center;">Superior Cabin 2 Bed 1</span>';
            break;
        case "superior4":
            return '<span style="color:maroon;text-align:center;">Superior Cabin 2 Bed 2</span>';
            break;
        case "superior5":
            return '<span style="color:orangered;text-align:center;">Superior Cabin 3 Bed 1</span>';
            break;
        case "superior6":
            return '<span style="color:orangered;text-align:center;">Superior Cabin 3 Bed 2</span>';
            break;
        case "superior7":
            return '<span style="color:firebrick;text-align:center;">Superior Cabin 4 Bed 1</span>';
            break;
        case "superior8":
            return '<span style="color:firebrick;text-align:center;">Superior Cabin 4 Bed 2</span>';
            break;

    }
}

function defaultRentalChecked($data, $name, $value, $showValue){

    if ($data == $value) {
        return "<input type='radio' name=$name value=$value checked> $showValue<br>";
    } else {
        return "<input type='radio' name=$name value=$value> $showValue<br>";
    }

}

function colorDisplayCell($data,$first,$second,$firstshow,$secondshow,$firstcolor,$secondcolor){
    
    if ($data == $first){
        return "<span style='color:$firstcolor;text-align:center;'>$firstshow</span>";
    } elseif ($data == $second) {
        return "<span style='color:$secondcolor;text-align:center;'>$secondshow</span>";
    } else {
        echo "Other";
    }
}

function switchDayName($input){
    switch ($input) {
        case "01":
            return '1';
            break;
        case "02":
            return '2';
            break;
        case "03":
            return '3';
            break;
        case "04":
            return '4';
            break;
        case "05":
            return '5';
            break;
        case "06":
            return '6';
            break;
        case "07":
            return '7';
            break;
        case "08":
            return '8';
            break;
        case "09":
            return '9';
            break;
        default:
            return $input;
            break;
    }
}

function switchMonthName($input){
    switch ($input) {
        case "01":
            return 'January';
            break;
        case "02":
            return 'February';
            break;
        case "03":
            return 'March';
            break;
        case "04":
            return 'April';
            break;
        case "05":
            return 'May';
            break;
        case "06":
            return 'June';
            break;
        case "07":
            return 'July';
            break;
        case "08":
            return 'August';
            break;
        case "09":
            return 'September';
            break;
        case "10":
            return 'October';
            break;
        case "11":
            return 'November';
            break;
        case "12":
            return 'December';
            break;
        default:
            return $input;
            break;
    }
}

?>