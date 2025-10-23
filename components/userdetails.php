<div class="btn-group float-right">
    <?php if($_SESSION["admin"]){ ?>
        <div>
            <h6>Hello Admin</h6>
        </div>
    <?php } else { ?>
        <div style="display: flex; flex-direction: column;">
            <h6>Hello <?= $user["firstname"]." ". $user["lastname"]?></h6>
            <h6>Mat. No: <?= $user["mat_no"]?></h6>
        </div>
    <?php } ?>
</div>