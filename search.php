<?php
// Search for a boardgame
include "assets/inc/main_header.php";
?>

<div class="container" style="padding-top: 85px;">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <?php
                        $gametitle = "Example title";
                        $gameCard = "
                            <div>
                                <h5 class=\"card-title\">{$gametitle}</h5>
                            </div>
                        ";
                        echo $gameCard;

                    ?>
                </div>
            </div>
        </div>
    </div>

</div>
</body>