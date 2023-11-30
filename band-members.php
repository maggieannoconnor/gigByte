<?php
require("connect-db.php");
require("gigbyte-db.php");

$list_of_bands = getAllBands();
$list_of_band_members = getAllBandMembers();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['band']) && !empty($_POST['band_member'])) {
        // adds new member to played_with
        $members_in_new_band = getMembersByBandID($_POST['band']);
        foreach ($members_in_new_band as $new_member) {
            addMembersToPlayedWith($_POST['band_member'], $new_member['account_id']);
        }
        addBandMemberToBand(($_POST['band_member']), ($_POST['band']));
        $list_of_bands = getAllBands();
        $list_of_band_members = getAllBandMembers();
    } elseif (!empty($_POST['band_to_remove']) && !empty($_POST['band_member_to_remove'])) {
        removeBandMemberFromBand(($_POST['band_member_to_remove']), ($_POST['band_to_remove']));
        $list_of_bands = getAllBands();
        $list_of_band_members = getAllBandMembers();
    } elseif (!empty($_POST['member_played_with'])) {
        $list_of_members_played_with = getMemberPlayedWithByMemberId($_POST['member_played_with']);
        $current_member_played_with = getMemberById($_POST['member_played_with']);
    }
}
?>

<!DOCTYPE html> 
<html> 
<head> 
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Maggie O'Connor and Robbie Boyle">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <style>
        .rounded-box {
            border: 2px solid #ddd;
            border-radius: 10px;
            padding: 40px;
            margin: 5px 0;
        }

        .red-rounded-box {
            border: 2px solid #ff0000; 
            border-radius: 10px;
            padding: 40px;
            margin: 5px 0;
            background-color: #ffe6e6; 
        }

        .rounded-box-green {
            border: 2px solid #00cc00; 
            border-radius: 10px;
            padding: 40px;
            margin: 5px 0;
            background-color: #e6ffe6;
        }
    </style>
</head>

<body>
    <?php include("header.php");?>

    <h1 class="text-center">Band Members By Band</h1>

    <div class="row justify-content-center">
        <table class="table table-bordered table-card center" style="width:80%">
            <thead>
                <tr class="bg-secondary text-white">
                    <th width="20%">Band</th>
                    <th width="20%">Instagram</th>
                    <th width="50%">Members</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($list_of_bands as $band):?>
                    <tr>
                        <td><?php echo $band['name']?></td>
                        <td><?php echo $band['instagram']?></td>
                        <td>
                            <?php 
                                $list_of_members = getMembersByBandID($band["band_id"]);
                                foreach ($list_of_members as $member):
                            ?>
                            <?php echo $member['name']." on ".$member['instrument'].",  "?>
                            <?php endforeach; ?>
                        </td>
                    </tr>   
                <?php endforeach;?>
            </tbody>
        </table>
    </div>

    <hr>

    <div class="rounded-box-green">
        <h2 class="text-center">Add Band Member To Band</h2>
        <p class="text-center text-decoration-underline">Select Band and Member</p>
        <form action="" method="post" class="text-center">
            <label for="band">Select a Band:</label>
            <select id="band" name="band">
                <?php foreach($list_of_bands as $band):?>
                    <option value="<?php echo $band['band_id']; ?>"><?php echo $band['name']; ?></option>
                <?php endforeach;?>
            </select>
            <br>
            <label for="band_member">Select a Member:</label>
            <select id="band_member" name="band_member">
                <?php foreach($list_of_band_members as $member):?>
                    <option value="<?php echo $member['account_id']; ?>"><?php echo $member['name']; ?></option>
                <?php endforeach;?>
            </select>
            <br>
            <br>
            <input type="submit" value="Submit">
        </form>
    </div>

    <div class="red-rounded-box">
        <h2 class="text-center">Remove Band Member From Band</h2>
        <p class="text-center text-decoration-underline">Select Band and Member</p>
        <form action="" method="post" class="text-center">
            <label for="band_to_remove">Select a Band:</label>
            <select id="band_to_remove" name="band_to_remove">
                <?php foreach($list_of_bands as $band):?>
                    <option value="<?php echo $band['band_id']; ?>"><?php echo $band['name']; ?></option>
                <?php endforeach;?>
            </select>
            <br>
            <label for="band_member_to_remove">Select a Member:</label>
            <select id="band_member_to_remove" name="band_member_to_remove">
                <?php foreach($list_of_band_members as $member):?>
                    <option value="<?php echo $member['account_id']; ?>"><?php echo $member['name']; ?></option>
                <?php endforeach;?>
            </select>
            <br>
            <br>
            <input type="submit" class="btn btn-outline-danger" value="Remove">
        </form>
    </div>

    <div class="rounded-box">
        <h2 class="text-center">See Who Has Played With Each Band Member:</h2>
        <p class="text-center text-decoration-underline">Select Band Member</p>
        <form action="" method="post" class="text-center">
            <label for="member_played_with">Select a Band Member:</label>
            <select id="member_played_with" name="member_played_with">
                <?php foreach($list_of_band_members as $member):?>
                    <option value="<?php echo $member['account_id']; ?>"><?php echo $member['name']; ?></option>
                <?php endforeach;?>
            </select>
            <br>
            <br>
            <input type="submit" class="btn btn-info" value="See Members">
        </form>
        <?php foreach($list_of_members_played_with as $member):?>
            <p><?php echo('Name: '.$member['name'].' // Phone: '.$member['phoneNumber'].' // Email: '.$member['email']);?></p>
        <?php endforeach;?>
    </div>

    <br>
    <br>
    <?php include("footer.html");?>   
</body>
</html>
